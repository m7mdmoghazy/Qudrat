<div class="main-header">
    <div>
        <h1>Create Assignment</h1>
        <p style="color: var(--text-muted);">Add a new task for students</p>
    </div>
    <a href="<?= APP_URL ?>/teacher/courses/view/<?= $course_id ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Course</a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="<?= APP_URL ?>/teacher/assignments/store" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="course_id" value="<?= $course_id ?>">
        
        <div class="form-group">
            <label class="form-label">Assignment Title</label>
            <input type="text" name="title" class="form-control" required placeholder="e.g., Essay on History">
        </div>
        
        <div class="form-group">
            <label class="form-label">Description / Instructions</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Due Date</label>
                <input type="datetime-local" name="due_date" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Max Points</label>
                <input type="number" name="max_points" class="form-control" value="100" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Attachment (Optional)</label>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 5px;">Upload a PDF or Doc for students to read.</p>
            <input type="file" name="file" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Create Assignment</button>
    </form>
</div>

<?php view('layouts/footer'); ?>
