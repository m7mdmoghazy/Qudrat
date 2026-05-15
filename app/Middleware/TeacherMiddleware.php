<?php

class TeacherMiddleware {
    public function handle() {
        if (!Session::isTeacher()) {
            Session::setFlash('error', 'Access denied. Teachers only.');
             if (Session::isAdmin()) {
                redirect('admin/dashboard');
            } elseif (Session::isStudent()) {
                redirect('student/dashboard');
            } else {
                redirect('login');
            }
        }
    }
}
