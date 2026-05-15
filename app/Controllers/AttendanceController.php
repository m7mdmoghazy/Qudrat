<?php

class AttendanceController {

    private $attendanceModel;
    private $courseModel;
    private $enrollmentModel; // Need to get students

    public function __construct() {
        (new AuthMiddleware())->handle();
        $this->attendanceModel = new Attendance();
        $this->courseModel = new Course();
    }

    public function index() {
        (new TeacherMiddleware())->handle();
        // Get all teacher's courses and their attendance records
        $courses = $this->courseModel->getByTeacher(Session::get('user_id'));
        view('teacher/attendance/index', ['courses' => $courses], 'sidebar-teacher');
    }

    public function record($courseId = null) {
        (new TeacherMiddleware())->handle();
        // Get students logic needed here (Mocked or queried)
        // Assume we pass students to view
        $course = $this->courseModel->findById($courseId);
        
        view('teacher/attendance/record', ['course' => $course], 'sidebar-teacher');
    }

    public function store() {
        (new TeacherMiddleware())->handle();
        if (is_post()) {
             $courseId = $_POST['course_id'];
             $date = $_POST['date'];
             $status = $_POST['status']; // Array of student_id => status
             
             foreach ($status as $studentId => $s) {
                 $this->attendanceModel->record([
                     'course_id' => $courseId,
                     'student_id' => $studentId,
                     'date' => $date,
                     'status' => $s
                 ]);
             }
             
             Session::setFlash('success', "Attendance recorded for $date.");
             redirect('teacher/courses/view/' . $courseId);
        }
    }
}
