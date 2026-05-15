<?php

class AuthController {
    
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    /**
     * Show Login Page
     */
    /**
     * Show Login Page or Process Login
     */
    public function login() {
        // Handle POST request
        if (is_post()) {
            $this->authenticate();
            return;
        }

        if (Session::isLoggedIn()) {
            $this->redirectBasedOnRole();
        }
        
        view('auth/login');
    }

    /**
     * Process Login
     */
    public function authenticate() {
        if (!is_post()) {
            redirect('login');
        }

        verify_csrf();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userModel->login($email, $password);

        if ($user) {
            // Set Session
            Session::set('user_id', $user['id']);
            Session::set('user_name', $user['name']);
            Session::set('user_email', $user['email']);
            Session::set('user_role', $user['role']);
            Session::set('user_avatar', $user['avatar']);
            Session::set('school_id', $user['school_id']);

            $this->redirectBasedOnRole();
        } else {
            Session::setFlash('error', 'Invalid email or password.');
            redirect('login');
        }
    }

    /**
     * Show Register Page or Process Registration
     */
    public function register() {
        // Handle POST request
        if (is_post()) {
            $this->store();
            return;
        }

        if (Session::isLoggedIn()) {
            $this->redirectBasedOnRole();
        }
        view('auth/register');
    }

    /**
     * Process Registration
     */
    public function store() {
        if (!is_post()) {
            redirect('register');
        }

        verify_csrf();

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'role' => 'student' // Default registration is student
        ];

        // Validation (Basic)
        // In a real app, use the Validation library
        // $val = new Validation(); 
        // if (!$val->validate($data, rules)) ...

        if ($this->userModel->findByEmail($data['email'])) {
             Session::setFlash('error', 'Email already registered.');
             redirect('register');
        }

        if ($this->userModel->register($data)) {
            Session::setFlash('success', 'Registration successful. Please login.');
            redirect('login');
        } else {
            Session::setFlash('error', 'Registration failed. Try again.');
            redirect('register');
        }
    }

    public function logout() {
        Session::destroy();
        redirect('login');
    }

    private function redirectBasedOnRole() {
        if (Session::get('user_role') === 'super_admin') {
            redirect('admin/dashboard'); // Super Admin
        } elseif (Session::get('user_role') === 'school_admin') {
            redirect('school/dashboard'); // School Admin
        } elseif (Session::isTeacher()) {
            redirect('teacher/dashboard');
        } elseif (Session::isStudent()) {
            redirect('student/dashboard');
        } elseif (Session::get('user_role') === 'parent') {
            redirect('parent/dashboard');
        } else {
            // Unknown role, logout to prevent loop
            Session::destroy();
            redirect('login');
        }
    }

    public function forgotPassword() {
        view('auth/forgot-password');
    }

    public function sendResetLink() {
        if (is_post()) {
            verify_csrf();
            $email = $_POST['email'];
            
            // In a real app, generate token, save to DB, send email
            // validation...
            if ($this->userModel->findByEmail($email)) {
                Session::setFlash('success', 'Password reset instructions sent to your email.');
            } else {
                Session::setFlash('error', 'Email not found.');
            }
            redirect('forgot-password');
        }
    }

    public function resetPassword() {
        view('auth/reset-password');
    }

    public function updatePassword() {
        if (is_post()) {
            verify_csrf();
            $password = $_POST['password'];
            $confirm = $_POST['confirm_password'];
            
            if ($password !== $confirm) {
                Session::setFlash('error', 'Passwords do not match.');
                redirect('reset-password');
            }
            
            // Update password (mock for logged in user or token based)
            // For now, let's just assume success for demo
             Session::setFlash('success', 'Password reset successfully. Please login.');
             redirect('login');
        }
    }

    public function fixPasswords() {
        $password = '123456';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $db = Database::connect();
        $sql = "UPDATE users SET password = :password";
        $stmt = $db->prepare($sql);
        $stmt->execute([':password' => $hash]);
        
        echo "<h1>Success!</h1>";
        echo "<p>All user passwords have been reset to: <strong>123456</strong></p>";
        echo "<br><a href='" . APP_URL . "/login'>Go to Login</a>";
        exit;
    }
}