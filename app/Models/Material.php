<?php

require_once APP . '/Config/Database.php';

class Material {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function create($data) {
        $sql = "INSERT INTO materials (course_id, title, description, file_path) 
                VALUES (:course_id, :title, :description, :file_path)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':course_id' => $data['course_id'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':file_path' => $data['file_path']
        ]);
    }

    public function getByCourse($courseId) {
        $sql = "SELECT * FROM materials WHERE course_id = :course_id ORDER BY uploaded_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':course_id' => $courseId]);
        return $stmt->fetchAll();
    }
    
    public function delete($id) {
        $sql = "DELETE FROM materials WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
