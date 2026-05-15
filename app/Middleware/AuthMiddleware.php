<?php

class AuthMiddleware {
    public function handle() {
        if (!Session::isLoggedIn()) {
            Session::setFlash('error', 'You must be logged in to access this page.');
            redirect('login');
        }
    }
}