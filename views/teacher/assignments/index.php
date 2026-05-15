<div class="main-header">
    <h1>Assignments</h1>
</div>

<?php if (empty($assignments)): ?>
<div class="card" style="text-align: center; padding: 60px 20px;">
    <i class="fas fa-tasks" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 20px;"></i>
    <h3 style="color: var(--text-muted); margin-bottom: 10px;">No Assignments Yet</h3>
    <p style="color: var(--text-muted); margin-bottom: 20px;">Create assignments for your courses to get started.</p>
    <a href="<?= APP_URL ?>/teacher/courses" class="btn btn-primary">
        <i class="fas fa-book"></i> View Courses
    </a>
</div>
<?php else: ?>
<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color);">
                <th style="text-align: left; padding: 12px 8px; color: var(--text-muted); font-weight: 500;">Assignment</th>
                <th style="text-align: left; padding: 12px 8px; color: var(--text-muted); font-weight: 500;">Course</th>
                <th style="text-align: left; padding: 12px 8px; color: var(--text-muted); font-weight: 500;">Due Date</th>
                <th style="text-align: center; padding: 12px 8px; color: var(--text-muted); font-weight: 500;">Max Points</th>
                <th style="text-align: center; padding: 12px 8px; color: var(--text-muted); font-weight: 500;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment): ?>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 16px 8px;">
                    <div style="font-weight: 500;"><?= htmlspecialchars($assignment['title']) ?></div>
                    <?php if (!empty($assignment['description'])): ?>
                    <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 4px;">
                        <?= htmlspecialchars(substr($assignment['description'], 0, 50)) ?>...
                    </div>
                    <?php endif; ?>
                </td>
                <td style="padding: 16px 8px;">
                    <span style="background: var(--primary-light); color: var(--primary); padding: 4px 10px; border-radius: 12px; font-size: 0.85rem;">
                        <?= htmlspecialchars($assignment['course_title'] ?? 'N/A') ?>
                    </span>
                </td>
                <td style="padding: 16px 8px;">
                    <?php 
                    $dueDate = strtotime($assignment['due_date']);
                    $isOverdue = $dueDate < time();
                    ?>
                    <span style="color: <?= $isOverdue ? '#ef4444' : 'var(--text-main)' ?>;">
                        <i class="fas fa-calendar"></i>
                        <?= date('M d, Y', $dueDate) ?>
                    </span>
                </td>
                <td style="padding: 16px 8px; text-align: center;">
                    <span style="font-weight: 600;"><?= $assignment['max_points'] ?? 100 ?></span>
                </td>
                <td style="padding: 16px 8px; text-align: center;">
                    <a href="<?= APP_URL ?>/teacher/assignments/submissions/<?= $assignment['id'] ?>" 
                       class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem;">
                        <i class="fas fa-users"></i> Submissions
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php view('layouts/footer'); ?>
