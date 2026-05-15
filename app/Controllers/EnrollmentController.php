<?php

class EnrollmentController {

    private $enrollmentModel;

    public function __construct() {
        (new StudentMiddleware())->handle();
        $this->enrollmentModel = new Enrollment();
    }

    public function enroll($courseId) {
        // CSRF check implicitly done on post, but enrollment might be via link for now? 
        // Better to be POST.
        
        $studentId = Session::get('user_id');
        
        if ($this->enrollmentModel->enroll($studentId, $courseId)) {
            Session::setFlash('success', 'Enrolled successfully.');
        } else {
            Session::setFlash('error', 'Already enrolled or failed.');
        }
        
        redirect('student/courses/view/' . $courseId); // Redirect to course view
    }

    public function drop($courseId) {
        $studentId = Session::get('user_id');
        // Add confirmation logic in view, but here is the action
        if ($this->enrollmentModel->drop($studentId, $courseId)) {
             Session::setFlash('warning', 'Course dropped.');
        }
        redirect('student/dashboard');
    }
}
