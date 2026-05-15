<?php

class QuizController {

    private $quizModel;
    private $questionModel;
    private $courseModel;
    private $attemptModel;

    public function __construct() {
        (new AuthMiddleware())->handle();
        $this->quizModel = new Quiz();
        $this->questionModel = new Question();
        $this->courseModel = new Course();
        $this->attemptModel = new QuizAttempt();
    }

    public function index($courseId = null) {
        $userId = Session::get('user_id');
        
        // Determine view based on URL path
        $urlPath = $_SERVER['REQUEST_URI'] ?? '';
        if (strpos($urlPath, '/teacher/') !== false) {
            $viewRole = 'teacher';
        } elseif (strpos($urlPath, '/student/') !== false) {
            $viewRole = 'student';
        } else {
            $viewRole = Session::get('role') ?: 'student';
        }
        
        if ($courseId) {
            $quizzes = $this->quizModel->getByCourse($courseId);
            $course = $this->courseModel->findById($courseId);
        } else {
            if ($viewRole === 'teacher') {
                $courses = $this->courseModel->getByTeacher($userId);
                $quizzes = [];
                foreach ($courses as $course) {
                    $courseQuizzes = $this->quizModel->getByCourse($course['id']);
                    foreach ($courseQuizzes as $quiz) {
                        $quiz['course_title'] = $course['title'];
                        $quizzes[] = $quiz;
                    }
                }
            } else {
                $enrolledCourses = $this->courseModel->getByStudent($userId);
                $quizzes = [];
                foreach ($enrolledCourses as $course) {
                    $courseQuizzes = $this->quizModel->getByCourseWithStudentStatus($course['id'], $userId);
                    foreach ($courseQuizzes as $quiz) {
                        $quiz['course_title'] = $course['title'];
                        $quiz['course_code'] = $course['code'];
                        
                        // Map attempt structure for view
                        if ($quiz['attempt_id']) {
                            $quiz['attempt'] = [
                                'id' => $quiz['attempt_id'],
                                'score' => $quiz['score'],
                                'completed_at' => $quiz['end_time']
                            ];
                        }
                        
                        $quizzes[] = $quiz;
                    }
                }
            }
            $course = null;
        }
        
        $layout = $viewRole === 'teacher' ? 'sidebar-teacher' : 'sidebar-student';
        view($viewRole . '/quizzes/index', [
            'quizzes' => $quizzes,
            'course' => $course
        ], $layout);
    }

    public function create($courseId) {
        (new TeacherMiddleware())->handle();
        view('teacher/quizzes/create', ['course_id' => $courseId], 'sidebar-teacher');
    }

    public function store() {
        (new TeacherMiddleware())->handle();
        if (is_post()) {
            verify_csrf();
            
            $data = [
                'course_id' => $_POST['course_id'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'duration_minutes' => $_POST['duration_minutes'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time']
            ];

            if ($this->quizModel->create($data)) {
                Session::setFlash('success', 'Quiz created. Now add questions.');
                // Redirect to questions page (Need logic to get last inserted ID or pass it? 
                // DB create returns true/false. Better to return ID or fetch last.
                // For now redirect to course view or index
                redirect('teacher/courses/view/' . $data['course_id']);
            } else {
                Session::setFlash('error', 'Failed to create quiz.');
                redirect('teacher/quizzes/create/' . $data['course_id']);
            }
        }
    }

    public function questions($quizId) {
        (new TeacherMiddleware())->handle();
        $quiz = $this->quizModel->findById($quizId);
        $questions = $this->questionModel->getByQuiz($quizId);
        
        view('teacher/quizzes/questions', ['quiz' => $quiz, 'questions' => $questions], 'sidebar-teacher');
    }

    public function storeQuestion() {
        (new TeacherMiddleware())->handle();
        if (is_post()) {
            // Logic to save question
            $data = [
                'quiz_id' => $_POST['quiz_id'],
                'question_text' => $_POST['question_text'],
                'type' => 'mcq', // Hardcoded for now or from form
                'options' => json_encode(explode("\n", $_POST['options'])), // Simple newline split for options
                'correct_answer' => $_POST['correct_answer'],
                'points' => $_POST['points']
            ];
            
            $this->questionModel->create($data);
            redirect('teacher/quizzes/questions/' . $data['quiz_id']);
        }
    }
    
    public function results($quizId) {
        (new TeacherMiddleware())->handle();
        $results = $this->attemptModel->getQuizResults($quizId);
        $quiz = $this->quizModel->findById($quizId);
        
        view('teacher/quizzes/results', ['results' => $results, 'quiz' => $quiz], 'sidebar-teacher');
    }
}
