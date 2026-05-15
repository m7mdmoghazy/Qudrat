<div class="main-header">
    <div>
        <h1>Create Quiz</h1>
        <p style="color: var(--text-muted);">Setup a new quiz</p>
    </div>
    <a href="<?= APP_URL ?>/teacher/courses/view/<?= $course_id ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Course</a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="<?= APP_URL ?>/teacher/quizzes/store" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="course_id" value="<?= $course_id ?>">
        
        <div class="form-group">
            <label class="form-label">Quiz Title</label>
            <input type="text" name="title" class="form-control" required placeholder="e.g., Midterm Exam">
        </div>
        
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="2"></textarea>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Duration (Minutes)</label>
                <input type="number" name="duration_minutes" class="form-control" value="60" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Start Time</label>
                <input type="datetime-local" name="start_time" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">End Time</label>
                <input type="datetime-local" name="end_time" class="form-control" required>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Quiz & Add Questions</button>
    </form>
</div>

<?php view('layouts/footer'); ?>
