<?php

require_once APP . '/Config/Database.php';

class Course {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Create a new course
     */
    public function create($data) {
        $sql = "INSERT INTO courses (title, code, description, teacher_id, image, start_date, end_date) 
                VALUES (:title, :code, :description, :teacher_id, :image, :start_date, :end_date)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $data['title'],
            ':code' => $data['code'],
            ':description' => $data['description'],
            ':teacher_id' => $data['teacher_id'],
            ':image' => $data['image'] ?? 'course-placeholder.jpg',
            ':start_date' => $data['start_date'] ?? null,
            ':end_date' => $data['end_date'] ?? null
        ]);
    }

    /**
     * Get all courses
     */
    public function getAll($limit = 10, $offset = 0) {
        $sql = "SELECT c.*, u.name as teacher_name 
                FROM courses c 
                JOIN users u ON c.teacher_id = u.id 
                WHERE c.status = 'active' 
                ORDER BY c.created_at DESC 
                LIMIT :limit OFFSET :offset";
        
        // PDO limit/offset requires integer binding
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get course by ID
     */
    public function findById($id) {
        $sql = "SELECT c.*, u.name as teacher_name, u.avatar as teacher_avatar
                FROM courses c 
                JOIN users u ON c.teacher_id = u.id 
                WHERE c.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Get courses by teacher ID
     */
    public function getByTeacher($teacherId) {
        $sql = "SELECT * FROM courses WHERE teacher_id = :teacher_id AND status != 'archived'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':teacher_id' => $teacherId]);
        return $stmt->fetchAll();
    }

    /**
     * Get courses a student is enrolled in
     */
    public function getByStudent($studentId) {
        $sql = "SELECT c.*, e.status as enrollment_status, u.name as teacher_name 
                FROM courses c 
                JOIN enrollments e ON c.id = e.course_id 
                JOIN users u ON c.teacher_id = u.id
                WHERE e.student_id = :student_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':student_id' => $studentId]);
        return $stmt->fetchAll();
    }
    
    /**
     * Get statistics
     */
    public function getStudentCount($courseId) {
        $sql = "SELECT COUNT(*) as total FROM enrollments WHERE course_id = :course_id AND status = 'active'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':course_id' => $courseId]);
        $result = $stmt->fetch();
        return $result['total'];
    }

    /**
     * Update course
     */
    public function update($id, $data) {
        // Implementation similar to User::update...
        // For brevity
        $sql = "UPDATE courses SET title = :title, description = :description WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':id' => $id
        ]);
    }
}