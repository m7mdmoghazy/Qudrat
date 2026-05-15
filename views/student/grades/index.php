<div class="main-header">
    <div>
        <h1>My Grades</h1>
        <p style="color: var(--text-muted);">Academic Performance</p>
    </div>
    <a href="<?= APP_URL ?>/student/dashboard" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color); text-align: left;">
                <th style="padding: 15px;">Course</th>
                <th style="padding: 15px;">Item</th>
                <th style="padding: 15px;">Type</th>
                <th style="padding: 15px;">Date</th>
                <th style="padding: 15px;">Grade</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($grades)): ?>
            <?php foreach($grades as $grade): ?>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px; font-weight: 500;"><?= $grade['course_title'] ?></td>
                <td style="padding: 15px;"><?= $grade['item_title'] ?></td>
                <td style="padding: 15px; text-transform: capitalize;"><?= $grade['type'] ?></td>
                <td style="padding: 15px;"><?= date('M d, Y', strtotime($grade['date'])) ?></td>
                <td style="padding: 15px; font-weight: bold; color: var(--primary);"><?= $grade['score'] ?> / <?= $grade['max_points'] ?></td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="5" style="padding: 30px; text-align: center; color: var(--text-muted);">No grades recorded yet.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
