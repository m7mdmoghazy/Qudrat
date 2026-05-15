<?php

require_once APP . '/Config/Database.php';

class QuizAttempt {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function start($quizId, $studentId) {
        $sql = "INSERT INTO quiz_attempts (quiz_id, student_id, start_time) VALUES (:quiz_id, :student_id, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':quiz_id' => $quizId,
            ':student_id' => $studentId
        ]);
        return $this->db->lastInsertId();
    }

    public function submit($attemptId, $score, $answers) {
        $sql = "UPDATE quiz_attempts SET end_time = NOW(), score = :score, answers = :answers WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':score' => $score,
            ':answers' => $answers,
            ':id' => $attemptId
        ]);
    }

    public function getStudentResult($quizId, $studentId) {
        $sql = "SELECT * FROM quiz_attempts WHERE quiz_id = :quiz_id AND student_id = :student_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':quiz_id' => $quizId,
            ':student_id' => $studentId
        ]);
        return $stmt->fetch();
    }
    
    public function getQuizResults($quizId) {
        $sql = "SELECT qa.*, u.name as student_name 
                FROM quiz_attempts qa 
                JOIN users u ON qa.student_id = u.id 
                WHERE qa.quiz_id = :quiz_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':quiz_id' => $quizId]);
        return $stmt->fetchAll();
    }
}
