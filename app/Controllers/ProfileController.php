<?php

class ProfileController {
    
    private $userModel;

    public function __construct() {
        // Auth Check
        (new AuthMiddleware())->handle();
        $this->userModel = new User();
    }

    public function index() {
        $user = $this->userModel->findById(Session::get('user_id'));
        view('student/profile', ['user' => $user], 'navbar'); // Assuming dynamic layout or handle in view
    }

    public function update() {
        if (!is_post()) {
            return;
        }

        verify_csrf();
        
        $id = Session::get('user_id');
        $data = [
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'bio' => $_POST['bio']
        ];
        
        // Handle Avatar Upload
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $upload = new Upload();
            $path = $upload->process($_FILES['avatar'], 'profiles');
            if ($path) {
                $data['avatar'] = $path;
                Session::set('user_avatar', $path); // Update session
            } else {
                Session::setFlash('error', implode(', ', $upload->getErrors()));
                redirect('profile'); // Assuming a route alias or student/profile
            }
        }
        
        // Handle Password Change
        if (!empty($_POST['password'])) {
            $data['password'] = $_POST['password'];
        }

        if ($this->userModel->update($id, $data)) {
            Session::setFlash('success', 'Profile updated successfully.');
        } else {
            Session::setFlash('error', 'Failed to update profile.');
        }

        // Determine redirect back
        if (Session::isStudent()) {
            redirect('student/profile'); // Adjust route based on routes in index.php
        } else {
            // Placeholder: maybe create profile views for other roles or share one
            // Ideally: profile/index
            redirect('dashboard'); 
        }
    }
}
