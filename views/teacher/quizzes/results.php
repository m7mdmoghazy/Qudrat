<div class="main-header">
    <div>
        <h1>Quiz Results</h1>
        <p style="color: var(--text-muted);"><?= $quiz['title'] ?></p>
    </div>
    <a href="<?= APP_URL ?>/teacher/courses/view/<?= $quiz['course_id'] ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Course</a>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color); text-align: left;">
                <th style="padding: 15px;">Student</th>
                <th style="padding: 15px;">Attempted At</th>
                <th style="padding: 15px;">Score</th>
                <th style="padding: 15px;">Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($results)): ?>
            <?php foreach($results as $res): ?>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;"><?= $res['student_name'] ?></td>
                <td style="padding: 15px;"><?= date('M d, H:i', strtotime($res['end_time'])) ?></td>
                <td style="padding: 15px; font-weight: bold;"><?= $res['score'] ?> / <?= $quiz['total_points'] ?></td>
                <td style="padding: 15px;">
                    <?php $pct = ($res['score'] / $quiz['total_points']) * 100; ?>
                    <span style="color: <?= $pct >= 50 ? 'green' : 'red' ?>;"><?= number_format($pct, 1) ?>%</span>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="4" style="padding: 30px; text-align: center; color: var(--text-muted);">No attempts yet.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
