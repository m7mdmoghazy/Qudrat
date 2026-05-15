<?php

class AdminMiddleware {
    public function handle() {
        if (!Session::isAdmin()) {
            // If logged in but not admin, redirect to respective dashboard
            if (Session::isTeacher()) {
                redirect('teacher/dashboard');
            } elseif (Session::isStudent()) {
                redirect('student/dashboard');
            } else {
                Session::setFlash('error', 'Access denied.');
                redirect('login');
            }
        }
    }
}