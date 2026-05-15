<?php

class StudentMiddleware {
    public function handle() {
        if (!Session::isStudent()) {
             Session::setFlash('error', 'Access denied. Students only.');
             if (Session::isAdmin()) {
                redirect('admin/dashboard');
            } elseif (Session::isTeacher()) {
                redirect('teacher/dashboard');
            } else {
                redirect('login');
            }
        }
    }
}
