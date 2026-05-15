<div class="main-header">
    <div>
        <h1>Submit Assignment</h1>
        <p style="color: var(--text-muted);"><?= $assignment['title'] ?></p>
    </div>
    <a href="<?= APP_URL ?>/student/assignments" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

<div class="card" style="max-width: 800px;">
    <div style="margin-bottom: 30px;">
        <h3 style="margin-bottom: 10px;">Instructions</h3>
        <p style="color: var(--text-muted); line-height: 1.6;"><?= nl2br(htmlspecialchars($assignment['description'])) ?></p>
        
        <div style="margin-top: 20px; display: flex; gap: 20px; color: var(--text-muted); font-size: 0.9rem;">
            <span><i class="fas fa-calendar"></i> Due: <?= date('M d, Y H:i', strtotime($assignment['due_date'])) ?></span>
            <span><i class="fas fa-star"></i> Points: <?= $assignment['max_points'] ?></span>
        </div>
        
        <?php if(!empty($assignment['file_path'])): ?>
        <div style="margin-top: 20px;">
            <a href="<?= APP_URL ?>/uploads/assignments/<?= $assignment['file_path'] ?>" class="btn btn-outline" download>
                <i class="fas fa-download"></i> Download Attachment
            </a>
        </div>
        <?php endif; ?>
    </div>
    
    <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 30px 0;">
    
    <div>
        <h3 style="margin-bottom: 20px;">Your Submission</h3>
        
        <?php if($submission): ?>
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 20px; border-radius: 8px;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                    <i class="fas fa-check-circle" style="color: #16a34a; font-size: 1.5rem;"></i>
                    <div>
                        <h4 style="color: #166534; margin: 0;">Submitted Successfully</h4>
                        <small style="color: #15803d;"><?= date('M d, Y H:i', strtotime($submission['submitted_at'] ?? 'now')) ?></small>
                    </div>
                </div>
                
                <?php if($submission['grade'] !== null): ?>
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #bbf7d0;">
                        <strong>Grade: </strong> <?= $submission['grade'] ?> / <?= $assignment['max_points'] ?>
                        <?php if(!empty($submission['feedback'])): ?>
                            <p style="margin-top: 5px; color: #166534;"><strong>Feedback:</strong> <?= $submission['feedback'] ?></p>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p style="margin-top: 10px; color: #166534;">Status: <span style="font-weight: 600;">Pending Grading</span></p>
                <?php endif; ?>
                
                <div style="margin-top: 15px;">
                    <a href="<?= APP_URL ?>/uploads/submissions/<?= $submission['file_path'] ?>" class="btn btn-outline" style="font-size: 0.9rem;" download>Download File</a>
                </div>
            </div>
        <?php else: ?>
            <form action="<?= APP_URL ?>/student/assignments/submit/<?= $assignment['id'] ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <div class="form-group">
                    <label style="display: block; margin-bottom: 10px; font-weight: 500;">Upload File</label>
                    <div style="border: 2px dashed var(--border-color); padding: 40px; text-align: center; border-radius: 8px; cursor: pointer; transition: all 0.3s;" onclick="document.getElementById('file-upload').click()">
                        <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: var(--text-muted); margin-bottom: 10px;"></i>
                        <p style="color: var(--text-muted); margin-bottom: 0;">Click to upload or drag and drop</p>
                        <input type="file" name="file" id="file-upload" style="display: none;" required onchange="document.getElementById('file-name').textContent = this.files[0].name">
                    </div>
                    <p id="file-name" style="margin-top: 10px; font-weight: 500; color: var(--primary);"></p>
                </div>
                
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">
                    <i class="fas fa-paper-plane"></i> Submit Assignment
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php view('layouts/footer'); ?>
