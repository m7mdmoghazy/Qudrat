<?php

require_once APP . '/Config/Database.php';

class Question {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function create($data) {
        $sql = "INSERT INTO questions (quiz_id, question_text, type, options, correct_answer, points) 
                VALUES (:quiz_id, :question_text, :type, :options, :correct_answer, :points)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':quiz_id' => $data['quiz_id'],
            ':question_text' => $data['question_text'],
            ':type' => $data['type'],
            ':options' => $data['options'], // Expecting JSON string
            ':correct_answer' => $data['correct_answer'],
            ':points' => $data['points'] ?? 1
        ]);
    }

    public function getByQuiz($quizId) {
        $sql = "SELECT * FROM questions WHERE quiz_id = :quiz_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':quiz_id' => $quizId]);
        return $stmt->fetchAll();
    }
}
