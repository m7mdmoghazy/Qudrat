<?php

require_once APP . '/Config/Database.php';

class Assignment {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function create($data) {
        $sql = "INSERT INTO assignments (course_id, title, description, file_path, due_date, max_points) 
                VALUES (:course_id, :title, :description, :file_path, :due_date, :max_points)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':course_id' => $data['course_id'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':file_path' => $data['file_path'] ?? null,
            ':due_date' => $data['due_date'],
            ':max_points' => $data['max_points'] ?? 100
        ]);
    }

    public function getByCourse($courseId) {
        $sql = "SELECT * FROM assignments WHERE course_id = :course_id ORDER BY due_date ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':course_id' => $courseId]);
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $sql = "SELECT * FROM assignments WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getByCourseWithStudentStatus($courseId, $studentId) {
        $sql = "SELECT a.*, s.status, s.grade, s.id as submission_id 
                FROM assignments a 
                LEFT JOIN assignment_submissions s ON a.id = s.assignment_id AND s.student_id = :student_id 
                WHERE a.course_id = :course_id 
                ORDER BY a.due_date ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':course_id' => $courseId,
            ':student_id' => $studentId
        ]);
        return $stmt->fetchAll();
    }
}