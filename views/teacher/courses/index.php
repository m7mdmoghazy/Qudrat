<?php // Reusing Dashboard logic essentially, but purely list view if needed ?>
<?php view('teacher/dashboard', ['courses' => $courses, 'course_count' => count($courses)]); ?>
