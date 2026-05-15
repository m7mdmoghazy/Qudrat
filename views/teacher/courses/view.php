<div class="main-header">
    <div>
        <h1><?= $course['title'] ?></h1>
        <p style="color: var(--text-muted);"><?= $course['code'] ?></p>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="<?= APP_URL ?>/teacher/assignments/create/<?= $course['id'] ?>" class="btn btn-outline"><i class="fas fa-plus"></i> Assignment</a>
        <a href="<?= APP_URL ?>/teacher/quizzes/create/<?= $course['id'] ?>" class="btn btn-outline"><i class="fas fa-plus"></i> Quiz</a>
        <a href="<?= APP_URL ?>/teacher/attendance/record/<?= $course['id'] ?>" class="btn btn-primary"><i class="fas fa-check"></i> Attendance</a>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
    <!-- Main Content -->
    <div>
        <div class="card" style="margin-bottom: 20px;">
            <h3>About this Course</h3>
            <p><?= nl2br($course['description']) ?></p>
        </div>
        
        <!-- Tabs or Sections -->
        <div style="margin-bottom: 20px; border-bottom: 2px solid var(--border-color);">
            <ul style="display: flex; gap: 20px;">
                <li style="padding: 10px 0; border-bottom: 2px solid var(--primary); font-weight: bold; color: var(--primary);">Assignments</li>
                <li style="padding: 10px 0; color: var(--text-muted);">Quizzes</li>
                <li style="padding: 10px 0; color: var(--text-muted);">Materials</li>
            </ul>
        </div>
        
        <!-- Content Area (Example Assignments) -->
        <div class="card">
            <?php 
            // In a real view we'd iterate over assignments passed to the view
            // Using a placeholder message for now as we didn't pass assignments in view() yet
            // See CourseController::view
            ?>
            <div style="text-align: center; padding: 40px; color: var(--text-muted);">
                <i class="fas fa-tasks" style="font-size: 2rem; margin-bottom: 10px; opacity: 0.5;"></i>
                <p>Manage course content from the sidebar or add new items above.</p>
                <a href="<?= APP_URL ?>/teacher/assignments?course_id=<?= $course['id'] ?>" class="btn btn-outline" style="margin-top: 10px;">View All Assignments</a>
            </div>
        </div>
    </div>
    
    <!-- Sidebar Info -->
    <div>
        <div class="card" style="margin-bottom: 20px;">
            <h3>Stats</h3>
            <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                <span>Students</span>
                <strong>25</strong> <!-- Placeholder -->
            </div>
            <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                <span>Assignments</span>
                <strong>5</strong>
            </div>
            <a href="<?= APP_URL ?>/teacher/courses/students/<?= $course['id'] ?>" class="btn btn-outline" style="width: 100%; text-align: center;">View Students</a>
        </div>
        
        <div class="card">
            <h3>Quick Links</h3>
            <ul style="display: flex; flex-direction: column; gap: 10px;">
                <li><a href="<?= APP_URL ?>/teacher/courses/edit/<?= $course['id'] ?>" style="color: var(--primary);"><i class="fas fa-edit"></i> Edit Settings</a></li>
                <li><a href="<?= APP_URL ?>/teacher/grades/index/<?= $course['id'] ?>" style="color: var(--primary);"><i class="fas fa-table"></i> Gradebook</a></li>
            </ul>
        </div>
    </div>
</div>

<?php view('layouts/footer'); ?>
