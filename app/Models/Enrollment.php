<?php

require_once APP . '/Config/Database.php';

class Enrollment {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Enroll a student in a course
     */
    public function enroll($studentId, $courseId) {
        // Check if already enrolled
        if ($this->isEnrolled($studentId, $courseId)) {
            return false;
        }

        $sql = "INSERT INTO enrollments (student_id, course_id) VALUES (:student_id, :course_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':student_id' => $studentId,
            ':course_id' => $courseId
        ]);
    }

    /**
     * Check if student is enrolled
     */
    public function isEnrolled($studentId, $courseId) {
        $sql = "SELECT id FROM enrollments WHERE student_id = :student_id AND course_id = :course_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':student_id' => $studentId,
            ':course_id' => $courseId
        ]);
        return $stmt->fetch() !== false;
    }

    /**
     * Drop a course
     */
    public function drop($studentId, $courseId) {
        $sql = "UPDATE enrollments SET status = 'dropped' WHERE student_id = :student_id AND course_id = :course_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':student_id' => $studentId,
            ':course_id' => $courseId
        ]);
    }
}