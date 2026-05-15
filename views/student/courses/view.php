<div class="main-header">
    <div>
        <h1><?= $course['title'] ?></h1>
        <p style="color: var(--text-muted);"><?= $course['code'] ?></p>
    </div>
    <div>
        <?php if($isEnrolled): ?>
            <span class="btn btn-outline" style="cursor: default; border-color: green; color: green;"><i class="fas fa-check"></i> Enrolled</span>
        <?php else: ?>
            <form action="<?= APP_URL ?>/student/enroll/<?= $course['id'] ?>" method="POST" style="display: inline;">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-primary">Enroll</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
    <!-- Main Content -->
    <div>
        <div class="card" style="margin-bottom: 20px;">
            <h3>Overview</h3>
            <p><?= nl2br($course['description']) ?></p>
        </div>
        
        <?php if($isEnrolled): ?>
        <div style="margin-bottom: 20px; border-bottom: 2px solid var(--border-color);">
            <ul style="display: flex; gap: 20px;">
                <li style="padding: 10px 0; border-bottom: 2px solid var(--primary); font-weight: bold; color: var(--primary);">Course Content</li>
                <li style="padding: 10px 0; color: var(--text-muted);">Grades</li>
            </ul>
        </div>
        
        <!-- Assignments Section -->
        <h3 style="margin-bottom: 15px;">Assignments</h3>
        <div class="card" style="margin-bottom: 20px;">
            <!-- Would iterate assignments here. Placeholder for now. -->
             <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; margin-bottom: 15px;">
                <div>
                    <strong>Example Assignment 1</strong>
                    <div style="font-size: 0.85rem; color: var(--text-muted);">Due: Oct 15, 2023</div>
                </div>
                <a href="#" class="btn btn-outline" style="font-size: 0.85rem;">View</a>
            </div>
            <div style="text-align: center; color: var(--text-muted); font-size: 0.9rem;">
                Check back for new assignments.
            </div>
        </div>
        
        <!-- Quizzes Section -->
        <h3 style="margin-bottom: 15px;">Quizzes</h3>
        <div class="card">
             <div style="text-align: center; color: var(--text-muted); font-size: 0.9rem;">
                No quizzes available yet.
            </div>
        </div>
        <?php else: ?>
        <div class="alert alert-warning">
            You must enroll in this course to view its content and take assessments.
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Sidebar -->
    <div>
        <div class="card">
            <h3>Instructor</h3>
            <div style="display: flex; align-items: center; gap: 10px; margin-top: 15px;">
                <div style="width: 40px; height: 40px; background: #eee; border-radius: 50%;"></div>
                <div>
                    <div style="font-weight: 500;">Teacher Name</div> <!-- Should fetch from course[teacher_id] -->
                    <div style="font-size: 0.85rem; color: var(--text-muted);">Professor</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php view('layouts/footer'); ?>
