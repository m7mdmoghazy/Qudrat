<div class="main-header">
    <div>
        <h1><?= $quiz['title'] ?></h1>
        <p style="color: var(--text-muted);">Time Limit: <?= $quiz['duration_minutes'] ?> Mins</p>
    </div>
    <div style="font-size: 1.5rem; font-weight: bold; color: var(--accent); background: var(--bg-card); padding: 10px 20px; border-radius: 8px; box-shadow: var(--shadow-sm);">
        <i class="fas fa-clock"></i> <span id="timer">00:00</span>
    </div>
</div>

<form action="<?= APP_URL ?>/student/quizzes/submit" method="POST" id="quiz-form">
    <?= csrf_field() ?>
    <input type="hidden" name="quiz_id" value="<?= $quiz['id'] ?>">
    
    <div style="display: flex; flex-direction: column; gap: 20px; max-width: 800px; margin: 0 auto;">
        <?php foreach($questions as $index => $q): ?>
        <div class="card">
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <h3 style="margin: 0;">Question <?= $index + 1 ?></h3>
                <span style="font-size: 0.8rem; background: #eee; padding: 2px 8px; border-radius: 4px;"><?= $q['points'] ?> pts</span>
            </div>
            
            <p style="font-size: 1.1rem; margin-bottom: 20px;"><?= $q['question_text'] ?></p>
            
            <?php if($q['type'] == 'mcq'): ?>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <?php 
                    $options = json_decode($q['options']); 
                    foreach($options as $opt):
                    ?>
                    <label style="display: flex; align-items: center; gap: 10px; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; cursor: pointer; transition: background 0.2s;">
                        <input type="radio" name="answers[<?= $q['id'] ?>]" value="<?= htmlspecialchars($opt) ?>">
                        <?= htmlspecialchars($opt) ?>
                    </label>
                    <?php endforeach; ?>
                </div>
            <?php elseif($q['type'] == 'true_false'): ?>
                <div style="display: flex; gap: 20px;">
                    <label style="padding: 10px 20px; border: 1px solid var(--border-color); border-radius: 8px; cursor: pointer;">
                        <input type="radio" name="answers[<?= $q['id'] ?>]" value="True"> True
                    </label>
                    <label style="padding: 10px 20px; border: 1px solid var(--border-color); border-radius: 8px; cursor: pointer;">
                        <input type="radio" name="answers[<?= $q['id'] ?>]" value="False"> False
                    </label>
                </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        
        <button type="submit" class="btn btn-primary" style="padding: 15px; font-size: 1.1rem; margin-bottom: 50px;">Submit Quiz</button>
    </div>
</form>

<script>
    // Simple Timer Logic
    let duration = <?= $quiz['duration_minutes'] ?> * 60;
    const timerDisplay = document.getElementById('timer');
    
    const timer = setInterval(() => {
        let minutes = Math.floor(duration / 60);
        let seconds = duration % 60;
        
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        
        timerDisplay.textContent = minutes + ":" + seconds;
        
        if (--duration < 0) {
            clearInterval(timer);
            alert("Time is up! Submitting quiz...");
            document.getElementById('quiz-form').submit();
        }
    }, 1000);
</script>

<?php view('layouts/footer'); ?>
