<?php

class GradeController {

    private $gradeModel;
    private $courseModel;

    public function __construct() {
        (new AuthMiddleware())->handle();
        $this->gradeModel = new Grade();
        $this->courseModel = new Course();
    }

    // Teacher Gradebook
    public function index($courseId = null) {
        (new TeacherMiddleware())->handle();
        
        if ($courseId) {
            $course = $this->courseModel->findById($courseId);
            view('teacher/grades/gradebook', ['course' => $course], 'sidebar-teacher');
        } else {
            // Show general gradebook overview
            $courses = $this->courseModel->getByTeacher(Session::get('user_id'));
            view('teacher/grades/index', ['courses' => $courses], 'sidebar-teacher');
        }
    }
}
