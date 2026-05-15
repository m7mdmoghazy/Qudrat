<div class="main-header">
    <div>
        <h1>My Assignments</h1>
        <p style="color: var(--text-muted);">Upcoming deadlines and grades</p>
    </div>
    <a href="<?= APP_URL ?>/student/dashboard" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color); text-align: left;">
                <th style="padding: 15px;">Assignment</th>
                <th style="padding: 15px;">Course</th>
                <th style="padding: 15px;">Due Date</th>
                <th style="padding: 15px;">Status</th>
                <th style="padding: 15px;">Grade</th>
                <th style="padding: 15px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($assignments)): ?>
            <?php foreach($assignments as $assign): ?>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px; font-weight: 500;"><?= $assign['title'] ?></td>
                <td style="padding: 15px;"><?= $assign['course_title'] ?? 'N/A' ?></td>
                <td style="padding: 15px;"><?= date('M d, H:i', strtotime($assign['due_date'])) ?></td>
                <td style="padding: 15px;">
                    <span style="padding: 4px 10px; border-radius: 50px; font-size: 0.85rem; background: <?= $assign['status'] == 'submitted' ? 'rgba(0,0,255,0.1)' : ($assign['status'] == 'graded' ? 'rgba(0,128,0,0.1)' : 'rgba(128,128,128,0.1)') ?>; color: <?= $assign['status'] == 'submitted' ? 'blue' : ($assign['status'] == 'graded' ? 'green' : 'gray') ?>;">
                        <?= ucfirst($assign['status'] ?? 'Pending') ?>
                    </span>
                </td>
                <td style="padding: 15px;"><?= $assign['grade'] !== null ? $assign['grade'] . '/' . $assign['max_points'] : '-' ?></td>
                <td style="padding: 15px;">
                    <a href="<?= APP_URL ?>/student/assignments/view/<?= $assign['id'] ?>" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">View</a>
                    <?php if(!isset($assign['status']) || $assign['status'] == 'pending'): ?>
                        <a href="<?= APP_URL ?>/student/assignments/submit/<?= $assign['id'] ?>" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.8rem;">Submit</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="6" style="padding: 30px; text-align: center; color: var(--text-muted);">No assignments found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
