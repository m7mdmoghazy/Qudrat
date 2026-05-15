<div class="main-header">
    <div>
        <h1><?= $assignment['title'] ?></h1>
        <p style="color: var(--text-muted);"><?= $assignment['course_title'] ?></p>
    </div>
    <a href="<?= APP_URL ?>/student/assignments" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

<div class="card" style="margin-bottom: 20px;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 20px;">
        <div>
            <div style="font-size: 0.9rem; color: var(--text-muted);">Due Date</div>
            <div style="font-weight: 500; font-size: 1.1rem;"><?= date('F d, Y h:i A', strtotime($assignment['due_date'])) ?></div>
        </div>
        <div>
            <div style="font-size: 0.9rem; color: var(--text-muted);">Points</div>
            <div style="font-weight: 500; font-size: 1.1rem;"><?= $assignment['max_points'] ?></div>
        </div>
    </div>
    
    <h3>Instructions</h3>
    <p style="line-height: 1.8; color: var(--text-main);"><?= nl2br($assignment['description']) ?></p>
    
    <?php if($assignment['file_path']): ?>
    <div style="margin-top: 30px;">
        <a href="<?= APP_URL . '/' . $assignment['file_path'] ?>" class="btn btn-outline" target="_blank"><i class="fas fa-paperclip"></i> Download Attachment</a>
    </div>
    <?php endif; ?>
</div>

<!-- Submission Area -->
<div class="card">
    <h3>Your Submission</h3>
    
    <?php if(isset($submission)): ?>
        <div style="padding: 20px; background: rgba(0,255,0,0.05); border: 1px solid green; border-radius: 8px; margin-top: 15px;">
            <div style="color: green; font-weight: bold; margin-bottom: 10px;"><i class="fas fa-check-circle"></i> Submitted on <?= date('M d, H:i', strtotime($submission['submitted_at'])) ?></div>
            <p>File: <a href="<?= APP_URL . '/' . $submission['file_path'] ?>" target="_blank"><?= basename($submission['file_path']) ?></a></p>
            
            <?php if($submission['grade']): ?>
                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #ccc;">
                    <strong>Grade:</strong> <?= $submission['grade'] ?> / <?= $assignment['max_points'] ?>
                    <?php if($submission['feedback']): ?>
                        <div style="margin-top: 10px; font-style: italic; color: var(--text-muted);">"<?= $submission['feedback'] ?>"</div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p style="margin-top: 10px; font-style: italic; color: var(--text-muted);">Not graded yet.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <form action="<?= APP_URL ?>/student/assignments/submit" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
            <?= csrf_field() ?>
            <input type="hidden" name="assignment_id" value="<?= $assignment['id'] ?>">
            
            <div class="form-group">
                <label class="form-label">Upload Work (PDF, Doc, Zip)</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit Assignment</button>
        </form>
    <?php endif; ?>
</div>

<?php view('layouts/footer'); ?>
