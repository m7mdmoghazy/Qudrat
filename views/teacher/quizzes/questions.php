<div class="main-header">
    <div>
        <h1>Add Questions</h1>
        <p style="color: var(--text-muted);"><?= $quiz['title'] ?></p>
    </div>
    <a href="<?= APP_URL ?>/teacher/courses/view/<?= $quiz['course_id'] ?>" class="btn btn-outline"><i class="fas fa-check"></i> Finish</a>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
    <!-- Question Form -->
    <div>
        <div class="card">
            <h3>New Question</h3>
            <form action="<?= APP_URL ?>/teacher/quizzes/add-question" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="quiz_id" value="<?= $quiz['id'] ?>">
                
                <div class="form-group">
                    <label class="form-label">Question Text</label>
                    <textarea name="question_text" class="form-control" rows="3" required></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Options (One per line)</label>
                    <textarea name="options" class="form-control" rows="4" required placeholder="Option A&#10;Option B&#10;Option C&#10;Option D"></textarea>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Correct Answer</label>
                        <input type="text" name="correct_answer" class="form-control" required placeholder="Exact text of option">
                        <small style="color: var(--text-muted);">Must match one option exactly.</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Points</label>
                        <input type="number" name="points" class="form-control" value="1" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Add Question</button>
            </form>
        </div>
    </div>
    
    <!-- Existing Questions -->
    <div>
        <h3 style="margin-bottom: 20px;">Questions in this Quiz</h3>
        <?php if (!empty($questions)): ?>
            <?php foreach($questions as $index => $q): ?>
            <div class="card" style="margin-bottom: 15px; padding: 15px;">
                <div style="display: flex; justify-content: space-between;">
                    <strong>Q<?= $index + 1 ?></strong>
                    <span style="font-size: 0.8rem; background: #eee; padding: 2px 6px; border-radius: 4px;"><?= $q['points'] ?> pts</span>
                </div>
                <p style="margin: 10px 0;"><?= $q['question_text'] ?></p>
                <div style="font-size: 0.9rem; color: var(--text-muted);">
                    Answer: <span style="color: green; font-weight: 500;"><?= $q['correct_answer'] ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card" style="text-align: center; color: var(--text-muted);">
                No questions added yet.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php view('layouts/footer'); ?>
