<div class="main-header">
    <div>
        <h1>Gradebook</h1>
        <p style="color: var(--text-muted);"><?= $course['title'] ?></p>
    </div>
    <a href="<?= APP_URL ?>/teacher/courses/view/<?= $course['id'] ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Course</a>
</div>

<div class="card" style="overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color); background: var(--bg-body);">
                <th style="padding: 15px; text-align: left; position: sticky; left: 0; background: var(--bg-body);">Student</th>
                <?php foreach($assignments as $assign): ?>
                    <th style="padding: 15px; min-width: 100px;"><?= substr($assign['title'], 0, 15) ?>... <br><small style="font-weight: normal; color: var(--text-muted);">(<?= $assign['max_points'] ?>)</small></th>
                <?php endforeach; ?>
                <?php foreach($quizzes as $quiz): ?>
                    <th style="padding: 15px; min-width: 100px;"><?= substr($quiz['title'], 0, 15) ?>... <br><small style="font-weight: normal; color: var(--text-muted);">(<?= $quiz['total_points'] ?? 100 ?>)</small></th>
                <?php endforeach; ?>
                <th style="padding: 15px; background: #f9f9f9;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($students as $student): ?>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px; font-weight: 500; position: sticky; left: 0; background: var(--bg-card);"><?= $student['name'] ?></td>
                
                <!-- Mock Grades Loop for assignments -->
                <?php foreach($assignments as $assign): ?>
                    <td style="padding: 15px; text-align: center;">-</td>
                <?php endforeach; ?>
                
                <!-- Mock Grades Loop for quizzes -->
                <?php foreach($quizzes as $quiz): ?>
                    <td style="padding: 15px; text-align: center;">-</td>
                <?php endforeach; ?>
                
                <td style="padding: 15px; text-align: center; font-weight: bold;">0%</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
