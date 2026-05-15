<div class="main-header">
    <h1>Quizzes</h1>
</div>

<?php if (empty($quizzes)): ?>
<div class="card" style="text-align: center; padding: 60px 20px;">
    <i class="fas fa-clock" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 20px;"></i>
    <h3 style="color: var(--text-muted); margin-bottom: 10px;">No Quizzes Yet</h3>
    <p style="color: var(--text-muted); margin-bottom: 20px;">Create quizzes for your courses to test student knowledge.</p>
    <a href="<?= APP_URL ?>/teacher/courses" class="btn btn-primary">
        <i class="fas fa-book"></i> View Courses
    </a>
</div>
<?php else: ?>
<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color);">
                <th style="text-align: left; padding: 12px 8px; color: var(--text-muted); font-weight: 500;">Quiz</th>
                <th style="text-align: left; padding: 12px 8px; color: var(--text-muted); font-weight: 500;">Course</th>
                <th style="text-align: center; padding: 12px 8px; color: var(--text-muted); font-weight: 500;">Duration</th>
                <th style="text-align: center; padding: 12px 8px; color: var(--text-muted); font-weight: 500;">Start Time</th>
                <th style="text-align: center; padding: 12px 8px; color: var(--text-muted); font-weight: 500;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quizzes as $quiz): ?>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 16px 8px;">
                    <div style="font-weight: 500;"><?= htmlspecialchars($quiz['title']) ?></div>
                    <?php if (!empty($quiz['description'])): ?>
                    <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 4px;">
                        <?= htmlspecialchars(substr($quiz['description'], 0, 50)) ?>...
                    </div>
                    <?php endif; ?>
                </td>
                <td style="padding: 16px 8px;">
                    <span style="background: var(--primary-light); color: var(--primary); padding: 4px 10px; border-radius: 12px; font-size: 0.85rem;">
                        <?= htmlspecialchars($quiz['course_title'] ?? 'N/A') ?>
                    </span>
                </td>
                <td style="padding: 16px 8px; text-align: center;">
                    <i class="fas fa-clock"></i> <?= $quiz['duration_minutes'] ?? 30 ?> min
                </td>
                <td style="padding: 16px 8px; text-align: center;">
                    <?php if (!empty($quiz['start_time'])): ?>
                    <?= date('M d, H:i', strtotime($quiz['start_time'])) ?>
                    <?php else: ?>
                    <span style="color: var(--text-muted);">Not set</span>
                    <?php endif; ?>
                </td>
                <td style="padding: 16px 8px; text-align: center;">
                    <a href="<?= APP_URL ?>/teacher/quizzes/questions/<?= $quiz['id'] ?>" 
                       class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem; margin-right: 5px;">
                        <i class="fas fa-question-circle"></i> Questions
                    </a>
                    <a href="<?= APP_URL ?>/teacher/quizzes/results/<?= $quiz['id'] ?>" 
                       class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem;">
                        <i class="fas fa-chart-bar"></i> Results
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php view('layouts/footer'); ?>
