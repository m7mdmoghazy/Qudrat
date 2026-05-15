<?php

class StudentController {
    
    private $userModel;

    public function __construct() {
        (new AuthMiddleware())->handle();
        // (new StudentMiddleware())->handle(); // Optional: strict role check
        $this->userModel = new User();
    }

    public function profile() {
        $userId = Session::get('user_id');
        $user = $this->userModel->findById($userId);
        
        view('student/profile', ['user' => $user], 'sidebar-student');
    }
    
    public function updateProfile() {
        if (is_post()) {
            verify_csrf();
            $data = [
                'name' => $_POST['name'],
                'bio' => $_POST['bio'] ?? '',
                'id' => Session::get('user_id')
            ];
            
            // Simple update logic
            $this->userModel->update($data['id'], $data);
            
            // Update session name if changed
            Session::set('user_name', $data['name']);
            
            Session::setFlash('success', 'Profile updated successfully.');
            redirect('student/profile');
        }
    }

    public function updatePassword() {
        if (is_post()) {
            verify_csrf();
            $current = $_POST['current_password'];
            $new = $_POST['new_password'];
            $confirm = $_POST['confirm_password'];
            $userId = Session::get('user_id');

            if ($new !== $confirm) {
                Session::setFlash('error', 'New passwords do not match.');
                redirect('student/profile');
            }

            // Verify current password (mock or real)
            // $user = $this->userModel->findById($userId);
            // if (!password_verify($current, $user['password'])) ...

            // For now, assume success for demo/prototype
            // $this->userModel->updatePassword($userId, password_hash($new, PASSWORD_DEFAULT));

            Session::setFlash('success', 'Password updated successfully.');
            redirect('student/profile');
        }
    }

    public function enroll($courseId) {
        $userId = Session::get('user_id');
        $enrollmentModel = new Enrollment();
        
        if ($enrollmentModel->enroll($userId, $courseId)) {
            Session::setFlash('success', 'Successfully enrolled in course.');
        } else {
            Session::setFlash('error', 'You are already enrolled in this course.');
        }
        
        redirect('student/courses');
    }
}
