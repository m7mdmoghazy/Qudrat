<?php

require_once APP . '/Config/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Register a new user
     */
    public function register($data) {
        $sql = "INSERT INTO users (name, email, password, role, school_id, phone, iqama_id, birth_date, gender) 
                VALUES (:name, :email, :password, :role, :school_id, :phone, :iqama_id, :birth_date, :gender)";
        $stmt = $this->db->prepare($sql);
        
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role' => $data['role'],
            ':school_id' => isset($data['school_id']) ? $data['school_id'] : null,
            ':phone' => isset($data['phone']) ? $data['phone'] : null,
            ':iqama_id' => isset($data['iqama_id']) ? $data['iqama_id'] : null,
            ':birth_date' => isset($data['birth_date']) ? $data['birth_date'] : null,
            ':gender' => isset($data['gender']) ? $data['gender'] : null,
        ]);
    }

    /**
     * Login user
     */
    public function login($email, $password) {
        $user = $this->findByEmail($email);
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    /**
     * Find user by email
     */
    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Find user by ID
     */
    public function findById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Update profile
     */
    public function update($id, $data) {
        $fields = [];
        $params = [':id' => $id];

        if (isset($data['name'])) {
            $fields[] = "name = :name";
            $params[':name'] = $data['name'];
        }
        if (isset($data['bio'])) {
            $fields[] = "bio = :bio";
            $params[':bio'] = $data['bio'];
        }
        if (isset($data['phone'])) {
            $fields[] = "phone = :phone";
            $params[':phone'] = $data['phone'];
        }
        if (isset($data['avatar'])) {
            $fields[] = "avatar = :avatar";
            $params[':avatar'] = $data['avatar'];
        }
        if (isset($data['password'])) {
            $fields[] = "password = :password";
            $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        if (isset($data['iqama_id'])) {
            $fields[] = "iqama_id = :iqama_id";
            $params[':iqama_id'] = $data['iqama_id'];
        }
        if (isset($data['birth_date'])) {
            $fields[] = "birth_date = :birth_date";
            $params[':birth_date'] = $data['birth_date'];
        }
        if (isset($data['gender'])) {
            $fields[] = "gender = :gender";
            $params[':gender'] = $data['gender'];
        }

        if (empty($fields)) {
            return true;
        }

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    
    /**
     * Get all users (Admin only usually)
     */
    public function getAll($role = null) {
        $sql = "SELECT * FROM users";
        $params = [];
        
        if ($role) {
            $sql .= " WHERE role = :role";
            $params[':role'] = $role;
        }
        
        $sql .= " ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Delete user
     */
    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Count users by role
     */
    public function countByRole($role) {
        $sql = "SELECT COUNT(*) as total FROM users WHERE role = :role";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':role' => $role]);
        $result = $stmt->fetch();
        return $result['total'];
    }
}