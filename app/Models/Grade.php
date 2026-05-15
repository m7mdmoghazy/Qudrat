<?php

require_once APP . '/Config/Database.php';

class Grade {
    // This model might be a wrapper to fetch grades from submissions and quiz attempts
    // Or if we have a centralized grades table (we don't effectively, we have item specific tables, 
    // but the plan mentioned Grade model.
    // I can implement a method to aggregate grades.
    
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getStudentGrades($studentId, $courseId) {
        // Fetch assignment grades
        $sqlAssignments = "SELECT a.title, s.grade, a.max_points, 'assignment' as type 
                           FROM assignment_submissions s 
                           JOIN assignments a ON s.assignment_id = a.id 
                           WHERE s.student_id = :student_id AND a.course_id = :course_id";
        
        // Fetch quiz grades
        $sqlQuizzes = "SELECT q.title, qa.score as grade, 100 as max_points, 'quiz' as type 
                       FROM quiz_attempts qa 
                       JOIN quizzes q ON qa.quiz_id = q.id 
                       WHERE qa.student_id = :student_id AND q.course_id = :course_id";
                       
        $stmt = $this->db->prepare($sqlAssignments);
        $stmt->execute([':student_id' => $studentId, ':course_id' => $courseId]);
        $assignments = $stmt->fetchAll();
        
        $stmt = $this->db->prepare($sqlQuizzes);
        $stmt->execute([':student_id' => $studentId, ':course_id' => $courseId]);
        $quizzes = $stmt->fetchAll();
        
        return array_merge($assignments, $quizzes);
    }
}
