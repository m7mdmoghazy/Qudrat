<?php

class CourseController {

    private $courseModel;
    private $enrollmentModel;

    public function __construct() {
        (new AuthMiddleware())->handle();
        $this->courseModel = new Course();
        $this->enrollmentModel = new Enrollment();
    }

    public function index() {
        if (Session::isTeacher()) {
             $courses = $this->courseModel->getByTeacher(Session::get('user_id'));
             view('teacher/courses/index', ['courses' => $courses], 'sidebar-teacher');
        } elseif (Session::isAdmin()) {
             $courses = $this->courseModel->getAll(100);
             view('admin/courses/index', ['courses' => $courses], 'sidebar-admin');
        } else {
             // Student: view enrolled or browse all?
             // Usually browse
             $courses = $this->courseModel->getAll(); // Pagination needed
             view('student/courses/index', ['courses' => $courses], 'sidebar-student');
        }
    }

    public function create() {
        (new TeacherMiddleware())->handle();
        view('teacher/courses/create', [], 'sidebar-teacher');
    }

    public function store() {
        (new TeacherMiddleware())->handle();
        if (is_post()) {
            verify_csrf();
            
            $data = [
                'title' => $_POST['title'],
                'code' => $_POST['code'],
                'description' => $_POST['description'],
                'teacher_id' => Session::get('user_id')
            ];
            
            // Handle Image Upload
             if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload = new Upload();
                $path = $upload->process($_FILES['image'], 'courses');
                if ($path) {
                    $data['image'] = $path;
                }
            }

            if ($this->courseModel->create($data)) {
                Session::setFlash('success', 'Course created successfully.');
                redirect('teacher/courses');
            } else {
                Session::setFlash('error', 'Failed to create course.');
                redirect('teacher/courses/create');
            }
        }
    }

    public function view($id) {
        $course = $this->courseModel->findById($id);
        if (!$course) {
            // 404
            die('Course not found');
        }

        if (Session::isTeacher()) {
            // Check ownership? Or allow viewing other courses? Usually ownership.
            if ($course['teacher_id'] != Session::get('user_id') && !Session::isAdmin()) {
                 // Check if admin?
                 redirect('teacher/courses'); 
            }
            view('teacher/courses/view', ['course' => $course], 'sidebar-teacher');
        } elseif (Session::isStudent()) {
             // Check enrollment
             $isEnrolled = $this->enrollmentModel->isEnrolled(Session::get('user_id'), $id);
             view('student/courses/view', ['course' => $course, 'isEnrolled' => $isEnrolled], 'sidebar-student');
        }
    }
    
    public function edit($id) {
        (new TeacherMiddleware())->handle();
        $course = $this->courseModel->findById($id);
        
        if (!$course) {
            Session::setFlash('error', 'Course not found.');
            redirect('teacher/courses');
        }
        
        if ($course['teacher_id'] != Session::get('user_id') && !Session::isAdmin()) {
            Session::setFlash('error', 'Unauthorized.');
            redirect('teacher/courses');
        }
        
        view('teacher/courses/edit', ['course' => $course], 'sidebar-teacher');
    }

    public function update($id) {
        (new TeacherMiddleware())->handle();
        if (is_post()) {
            verify_csrf();
            
            // Re-verify ownership
            $course = $this->courseModel->findById($id);
            if (!$course || ($course['teacher_id'] != Session::get('user_id') && !Session::isAdmin())) {
                redirect('teacher/courses');
            }

            $data = [
                'title' => $_POST['title'],
                'code' => $_POST['code'],
                'description' => $_POST['description']
            ];
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                 $upload = new Upload();
                 $path = $upload->process($_FILES['image'], 'courses');
                 if ($path) $data['image'] = $path;
            }
            
            if ($this->courseModel->update($id, $data)) {
                Session::setFlash('success', 'Course updated.');
                redirect('teacher/courses');
            } else {
                Session::setFlash('error', 'Update failed.');
                redirect('teacher/courses/edit/' . $id);
            }
        }
    }

    public function delete($id) {
        (new TeacherMiddleware())->handle();
        $course = $this->courseModel->findById($id);
        
        if (!$course || ($course['teacher_id'] != Session::get('user_id') && !Session::isAdmin())) {
             Session::setFlash('error', 'Unauthorized.');
             redirect('teacher/courses');
        }
        
        if ($this->courseModel->delete($id)) {
            Session::setFlash('success', 'Course deleted.');
        } else {
            Session::setFlash('error', 'Delete failed.');
        }
        redirect('teacher/courses');
    }

    // For Teacher: View Students
    public function students($id) {
        (new TeacherMiddleware())->handle();
        // Check ownership
        view('teacher/courses/students', ['course_id' => $id], 'sidebar-teacher'); 
    }
}