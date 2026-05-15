<?php

require_once APP . '/Config/Database.php';

class Attendance {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function record($data) {
        // Upsert logic (Insert or Update if exists)
        $sql = "INSERT INTO attendance (course_id, student_id, date, status) 
                VALUES (:course_id, :student_id, :date, :status)
                ON DUPLICATE KEY UPDATE status = :status";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':course_id' => $data['course_id'],
            ':student_id' => $data['student_id'],
            ':date' => $data['date'],
            ':status' => $data['status']
        ]);
    }

    public function getByCourseAndDate($courseId, $date) {
        $sql = "SELECT a.*, u.name as student_name 
                FROM attendance a 
                JOIN users u ON a.student_id = u.id 
                WHERE a.course_id = :course_id AND a.date = :date";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':course_id' => $courseId,
            ':date' => $date
        ]);
        return $stmt->fetchAll();
    }
    
    public function getStudentAttendance($studentId, $courseId) {
        $sql = "SELECT * FROM attendance WHERE student_id = :student_id AND course_id = :course_id ORDER BY date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':student_id' => $studentId, 
            ':course_id' => $courseId
        ]);
        return $stmt->fetchAll();
    }
}
