<?php

class DashboardController {

    public function __construct() {
        (new AuthMiddleware())->handle();
    }

    public function index() {
        if (Session::isAdmin()) {
            $this->adminDashboard();
        } elseif (Session::isTeacher()) {
            $this->teacherDashboard();
        } elseif (Session::isStudent()) {
            $this->studentDashboard();
        } else {
            redirect('login');
        }
    }

    private function adminDashboard() {
        // Gather Statistics
        $userModel = new User();
        
        $data = [
            'total_students' => $userModel->countByRole('student'),
            'total_teachers' => $userModel->countByRole('teacher'),
            // Add Course counts etc later when Course model is ready (Wait, Course model IS ready)
            'total_courses' => (new Course())->getAll(1000) ? count((new Course())->getAll(1000)) : 0 // Imperfect count but okay for now or add count method to Course
        ];
        
        // Pass counts directly if models support count methods, implemented simple one in User
        // Need to add count methods to other models for efficiency, but let's stick to basic for now.
        
        view('admin/dashboard', $data, 'sidebar-admin');
    }

    private function teacherDashboard() {
        $teacherId = Session::get('user_id');
        $courseModel = new Course();
        $courses = $courseModel->getByTeacher($teacherId);
        
        $data = [
            'courses' => $courses,
            'course_count' => count($courses)
        ];
        
        view('teacher/dashboard', $data, 'sidebar-teacher');
    }

    private function studentDashboard() {
        $studentId = Session::get('user_id');
        $courseModel = new Course();
        $enrolledCourses = $courseModel->getByStudent($studentId);
        
        $data = [
            'enrolled_courses' => $enrolledCourses,
            'course_count' => count($enrolledCourses)
        ];
        
        view('student/dashboard', $data, 'sidebar-student');
    }
}