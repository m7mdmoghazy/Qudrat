<?php

class AssignmentController {

    private $assignmentModel;
    private $submissionModel;
    private $courseModel;

    public function __construct() {
        (new AuthMiddleware())->handle();
        $this->assignmentModel = new Assignment();
        $this->submissionModel = new AssignmentSubmission();
        $this->courseModel = new Course();
    }

    // List assignments for a course (Teacher View mostly, Student view is in StudentController usually or here)
    public function index($courseId = null) {
        $userId = Session::get('user_id');
        $role = Session::get('role');
        
        // Determine view based on URL path
        $urlPath = $_SERVER['REQUEST_URI'] ?? '';
        if (strpos($urlPath, '/teacher/') !== false) {
            $viewRole = 'teacher';
        } elseif (strpos($urlPath, '/student/') !== false) {
            $viewRole = 'student';
        } else {
            $viewRole = $role ?: 'student';
        }
        
        if ($courseId) {
            // Get assignments for specific course
            $assignments = $this->assignmentModel->getByCourse($courseId);
            $course = $this->courseModel->findById($courseId);
        } else {
            // Get all assignments based on role
            if ($viewRole === 'teacher') {
                // Get assignments for teacher's courses
                $courses = $this->courseModel->getByTeacher($userId);
                $assignments = [];
                foreach ($courses as $course) {
                    $courseAssignments = $this->assignmentModel->getByCourse($course['id']);
                    foreach ($courseAssignments as $assignment) {
                        $assignment['course_title'] = $course['title'];
                        $assignments[] = $assignment;
                    }
                }
            } else {
                // Get assignments for enrolled courses (student)
                $enrolledCourses = $this->courseModel->getByStudent($userId);
                $assignments = [];
                foreach ($enrolledCourses as $course) {
                    $courseAssignments = $this->assignmentModel->getByCourseWithStudentStatus($course['id'], $userId);
                    foreach ($courseAssignments as $assignment) {
                        $assignment['course_title'] = $course['title'];
                        $assignments[] = $assignment;
                    }
                }
            }
            $course = null;
        }
        
        $layout = $viewRole === 'teacher' ? 'sidebar-teacher' : 'sidebar-student';
        view($viewRole . '/assignments/index', [
            'assignments' => $assignments,
            'course' => $course
        ], $layout);
    }

    public function create($courseId) {
        (new TeacherMiddleware())->handle();
        view('teacher/assignments/create', ['course_id' => $courseId], 'sidebar-teacher');
    }

    public function store() {
        (new TeacherMiddleware())->handle();
        if (is_post()) {
            verify_csrf();
            
            $data = [
                'course_id' => $_POST['course_id'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'due_date' => $_POST['due_date'],
                'max_points' => $_POST['max_points']
            ];
            
            // File upload (attachment)
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $upload = new Upload();
                $path = $upload->process($_FILES['file'], 'assignments');
                if ($path) {
                    $data['file_path'] = $path;
                }
            }

            if ($this->assignmentModel->create($data)) {
                Session::setFlash('success', 'Assignment created.');
                redirect('teacher/courses/view/' . $data['course_id']);
            } else {
                Session::setFlash('error', 'Failed to create assignment.');
                redirect('teacher/assignments/create/' . $data['course_id']);
            }
        }
    }

    public function submissions($assignmentId) {
        (new TeacherMiddleware())->handle();
        $submissions = $this->submissionModel->getByAssignment($assignmentId);
        $assignment = $this->assignmentModel->findById($assignmentId);
        
        view('teacher/assignments/submissions', [
            'submissions' => $submissions, 
            'assignment' => $assignment
        ], 'sidebar-teacher');
    }

    public function grade() {
        (new TeacherMiddleware())->handle();
        if (is_post()) {
            verify_csrf();
            
            $id = $_POST['submission_id'];
            $grade = $_POST['grade'];
            $feedback = $_POST['feedback'];
            $assignmentId = $_POST['assignment_id'];

            if ($this->submissionModel->grade($id, $grade, $feedback)) {
                Session::setFlash('success', 'Grade saved.');
            } else {
                Session::setFlash('error', 'Failed to save grade.');
            }
            redirect('teacher/assignments/submissions/' . $assignmentId);
        }
    }

    public function submit($assignmentId) {
        $userId = Session::get('user_id');
        
        // Handle POST submission
        if (is_post()) {
            verify_csrf();
            
            $data = [
                'assignment_id' => $assignmentId,
                'student_id' => $userId,
                'file_path' => ''
            ];
            
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                // Check if Upload class exists, if not use simple upload
                if (class_exists('Upload')) {
                    $upload = new Upload();
                    $path = $upload->process($_FILES['file'], 'submissions');
                    if ($path) {
                        $data['file_path'] = $path;
                    }
                } else {
                    // Simple fallback upload if Upload class not found
                    $targetDir = "uploads/submissions/";
                    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
                    $fileName = time() . '_' . basename($_FILES["file"]["name"]);
                    $targetFilePath = $targetDir . $fileName;
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                         $data['file_path'] = $fileName;
                    }
                }
            } else {
                 Session::setFlash('error', 'Please upload a file.');
                 redirect('student/assignments/submit/' . $assignmentId);
            }

            if ($this->submissionModel->submit($data)) {
                 Session::setFlash('success', 'Assignment submitted successfully.');
                 redirect('student/assignments');
            } else {
                 Session::setFlash('error', 'Failed to submit assignment.');
                 redirect('student/assignments/submit/' . $assignmentId);
            }
        }
        
        // Handle GET View
        $assignment = $this->assignmentModel->findById($assignmentId);
        $submission = $this->submissionModel->getStudentSubmission($assignmentId, $userId);
        
        view('student/assignments/submit', [
            'assignment' => $assignment,
            'submission' => $submission
        ], 'sidebar-student');
    }
}