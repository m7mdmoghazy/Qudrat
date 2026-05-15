<div class="main-header">
    <div>
        <h1>Quizzes</h1>
        <p style="color: var(--text-muted);">Tests and exams</p>
    </div>
    <a href="<?= APP_URL ?>/student/dashboard" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color); text-align: left;">
                <th style="padding: 15px;">Quiz Title</th>
                <th style="padding: 15px;">Course</th>
                <th style="padding: 15px;">Duration</th>
                <th style="padding: 15px;">Due Date</th>
                <th style="padding: 15px;">Status</th>
                <th style="padding: 15px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($quizzes)): ?>
            <?php foreach($quizzes as $quiz): ?>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px; font-weight: 500;"><?= $quiz['title'] ?></td>
                <td style="padding: 15px;"><?= $quiz['course_code'] ?></td>
                <td style="padding: 15px;"><?= $quiz['duration_minutes'] ?> mins</td>
                <td style="padding: 15px;"><?= date('M d, H:i', strtotime($quiz['end_time'])) ?></td>
                <td style="padding: 15px;">
                    <?php if(isset($quiz['attempt'])): ?>
                        <span style="color: green;">Completed (<?= $quiz['attempt']['score'] ?> pts)</span>
                    <?php else: ?>
                        <span style="color: orange;">Pending</span>
                    <?php endif; ?>
                </td>
                <td style="padding: 15px;">
                    <?php if(isset($quiz['attempt'])): ?>
                        <a href="<?= APP_URL ?>/student/quizzes/results/<?= $quiz['id'] ?>" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">Results</a>
                    <?php else: ?>
                        <a href="<?= APP_URL ?>/student/quizzes/take/<?= $quiz['id'] ?>" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.8rem;">Start Quiz</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="6" style="padding: 30px; text-align: center; color: var(--text-muted);">No upcoming quizzes.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
