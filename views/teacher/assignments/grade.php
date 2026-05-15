<div class="main-header">
    <div>
        <h1>Grade Submission</h1>
        <p style="color: var(--text-muted);">Student: <?= $submission['student_name'] ?> | Assignment: <?= $assignment['title'] ?></p>
    </div>
    <a href="<?= APP_URL ?>/teacher/assignments/submissions/<?= $assignment['id'] ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
    <div>
        <div class="card">
            <h3>Student Submission</h3>
            <div style="padding: 20px; background: var(--bg-body); border-radius: 8px; margin-top: 15px;">
                <p style="margin-bottom: 15px;"><strong>File:</strong> <?= basename($submission['file_path']) ?></p>
                <a href="<?= APP_URL . '/' . $submission['file_path'] ?>" class="btn btn-outline" target="_blank"><i class="fas fa-download"></i> Download File</a>
            </div>
        </div>
    </div>
    
    <div>
        <div class="card">
            <h3>Grade & Feedback</h3>
            <form action="<?= APP_URL ?>/teacher/assignments/save-grade" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="submission_id" value="<?= $submission['id'] ?>">
                <input type="hidden" name="assignment_id" value="<?= $assignment['id'] ?>">
                
                <div class="form-group">
                    <label class="form-label">Grade (Max: <?= $assignment['max_points'] ?>)</label>
                    <input type="number" name="grade" class="form-control" max="<?= $assignment['max_points'] ?>" value="<?= $submission['grade'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Feedback</label>
                    <textarea name="feedback" class="form-control" rows="5"><?= $submission['feedback'] ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Save Grade</button>
            </form>
        </div>
    </div>
</div>

<?php view('layouts/footer'); ?>
