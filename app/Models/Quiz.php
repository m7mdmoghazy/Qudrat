<?php

require_once APP . '/Config/Database.php';

class Quiz {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function create($data) {
        $sql = "INSERT INTO quizzes (course_id, title, description, duration_minutes, start_time, end_time) 
                VALUES (:course_id, :title, :description, :duration_minutes, :start_time, :end_time)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':course_id' => $data['course_id'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':duration_minutes' => $data['duration_minutes'],
            ':start_time' => $data['start_time'] ?? null,
            ':end_time' => $data['end_time'] ?? null
        ]);
    }

    public function getByCourse($courseId) {
        $sql = "SELECT * FROM quizzes WHERE course_id = :course_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':course_id' => $courseId]);
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $sql = "SELECT * FROM quizzes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getByCourseWithStudentStatus($courseId, $studentId) {
        $sql = "SELECT q.*, qa.id as attempt_id, qa.score, qa.end_time 
                FROM quizzes q 
                LEFT JOIN quiz_attempts qa ON q.id = qa.quiz_id AND qa.student_id = :student_id 
                WHERE q.course_id = :course_id 
                ORDER BY q.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':course_id' => $courseId,
            ':student_id' => $studentId
        ]);
        return $stmt->fetchAll();
    }
}
