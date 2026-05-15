<div class="main-header">
    <div>
        <h1>Submissions</h1>
        <p style="color: var(--text-muted);"><?= $assignment['title'] ?></p>
    </div>
    <a href="<?= APP_URL ?>/teacher/courses/view/<?= $assignment['course_id'] ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Course</a>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color); text-align: left;">
                <th style="padding: 15px;">Student</th>
                <th style="padding: 15px;">Submitted At</th>
                <th style="padding: 15px;">Status</th>
                <th style="padding: 15px;">Grade</th>
                <th style="padding: 15px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($submissions)): ?>
            <?php foreach($submissions as $sub): ?>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;"><?= $sub['student_name'] ?></td>
                <td style="padding: 15px;"><?= date('M d, H:i', strtotime($sub['submitted_at'])) ?></td>
                <td style="padding: 15px;">
                    <span style="padding: 4px 10px; border-radius: 50px; font-size: 0.85rem; background: <?= $sub['status'] == 'graded' ? 'rgba(0,128,0,0.1)' : 'rgba(255,165,0,0.1)' ?>; color: <?= $sub['status'] == 'graded' ? 'green' : 'orange' ?>;">
                        <?= ucfirst($sub['status']) ?>
                    </span>
                </td>
                <td style="padding: 15px;"><?= $sub['grade'] !== null ? $sub['grade'] . '/' . $assignment['max_points'] : '-' ?></td>
                <td style="padding: 15px;">
                    <a href="<?= APP_URL ?>/teacher/assignments/grade/<?= $sub['id'] ?>" class="btn btn-primary" style="padding: 5px 15px; font-size: 0.8rem;">Grade</a>
                    <a href="<?= APP_URL . '/' . $sub['file_path'] ?>" target="_blank" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;"><i class="fas fa-download"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="5" style="padding: 30px; text-align: center; color: var(--text-muted);">No submissions yet.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
