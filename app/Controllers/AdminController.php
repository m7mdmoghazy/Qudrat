<?php

class AdminController {

    private $userModel;

    public function __construct() {
        (new AdminMiddleware())->handle();
        $this->userModel = new User();
    }

    /**
     * List all users
     */
    public function users() {
        $data['users'] = $this->userModel->getAll(); // Pagination later?
        view('admin/users/index', $data, 'sidebar-admin');
    }

    /**
     * Create user form
     */
    public function createUser() {
        view('admin/users/create', [], 'sidebar-admin');
    }

    /**
     * Store new user
     */
    public function storeUser() {
        if (is_post()) {
            verify_csrf();
            
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role' => $_POST['role']
            ];
            
            if ($this->userModel->findByEmail($data['email'])) {
                Session::setFlash('error', 'Email already exists.');
                redirect('admin/users/create');
            }
            
            if ($this->userModel->register($data)) {
                Session::setFlash('success', 'User created successfully.');
                redirect('admin/users');
            } else {
                Session::setFlash('error', 'Failed to create user.');
                redirect('admin/users/create');
            }
        }
    }

    /**
     * Edit user form
     */
    public function editUser($id) {
        $user = $this->userModel->findById($id);
        if (!$user) {
            Session::setFlash('error', 'User not found.');
            redirect('admin/users');
        }
        view('admin/users/edit', ['user' => $user], 'sidebar-admin');
    }

    /**
     * Update user
     */
    public function updateUser($id) {
        if (is_post()) {
            verify_csrf();
            
            $data = [
                'name' => $_POST['name'],
                'role' => $_POST['role']
            ];
            
            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
            }
            
            if ($this->userModel->update($id, $data)) {
                Session::setFlash('success', 'User updated successfully.');
                redirect('admin/users');
            } else {
                 Session::setFlash('error', 'Failed to update user.');
                 redirect('admin/users/edit/' . $id);
            }
        }
    }

    /**
     * Delete user
     */
    public function deleteUser($id) {
        if ($id == Session::get('user_id')) {
            Session::setFlash('error', 'You cannot delete yourself.');
            redirect('admin/users');
        }
        
        if ($this->userModel->delete($id)) {
            Session::setFlash('success', 'User deleted.');
        } else {
             Session::setFlash('error', 'Failed to delete user.');
        }
        redirect('admin/users');
    }
    /**
     * Settings Page
     */
    public function settings() {
        view('admin/settings', [], 'sidebar-admin');
    }

    public function updateSettings() {
        // Mock update
        Session::setFlash('success', 'Settings updated successfully.');
        redirect('admin/settings');
    }

    /**
     * Reports Pages
     */
    public function reports() {
        view('admin/reports/index', [], 'sidebar-admin');
    }

    public function reportStudents() {
        // Mock data for report
        $data = [
            'total_students' => 120, // Replace with real count
            'active_students' => 115,
            'avg_grade' => 85
        ];
        view('admin/reports/students', $data, 'sidebar-admin');
    }

    public function reportCourses() {
        $data = [
            'total_courses' => 15,
            'most_popular' => 'Introduction to PHP'
        ];
        view('admin/reports/courses', $data, 'sidebar-admin');
    }

    public function reportAttendance() {
        view('admin/reports/attendance', [], 'sidebar-admin');
    }
}
