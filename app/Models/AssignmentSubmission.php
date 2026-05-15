<?php

require_once APP . '/Config/Database.php';

class AssignmentSubmission {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function submit($data) {
        $sql = "INSERT INTO assignment_submissions (assignment_id, student_id, file_path, status) 
                VALUES (:assignment_id, :student_id, :file_path, :status)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':assignment_id' => $data['assignment_id'],
            ':student_id' => $data['student_id'],
            ':file_path' => $data['file_path'],
            ':status' => 'submitted'
        ]);
    }

    public function grade($id, $grade, $feedback) {
        $sql = "UPDATE assignment_submissions SET grade = :grade, feedback = :feedback, status = 'graded' WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':grade' => $grade,
            ':feedback' => $feedback,
            ':id' => $id
        ]);
    }

    public function getByAssignment($assignmentId) {
        $sql = "SELECT s.*, u.name as student_name, u.email as student_email 
                FROM assignment_submissions s 
                JOIN users u ON s.student_id = u.id 
                WHERE s.assignment_id = :assignment_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':assignment_id' => $assignmentId]);
        return $stmt->fetchAll();
    }
    
    public function getStudentSubmission($assignmentId, $studentId) {
        $sql = "SELECT * FROM assignment_submissions WHERE assignment_id = :assignment_id AND student_id = :student_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':assignment_id' => $assignmentId,
            ':student_id' => $studentId
        ]);
        return $stmt->fetch();
    }
}
