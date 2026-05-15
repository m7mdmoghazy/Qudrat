<div class="main-header">
    <div>
        <h1>Browse Courses</h1>
        <p style="color: var(--text-muted);">Find a new course to learn</p>
    </div>
    <a href="<?= APP_URL ?>/student/dashboard" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
    <?php foreach($courses as $course): ?>
    <div class="card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
        <div style="height: 150px; background: #eee; position: relative;">
            <!-- Simple image logic -->
            <div style="width: 100%; height: 100%; background: linear-gradient(45deg, var(--secondary), var(--accent)); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: bold;">
                <?= substr($course['title'], 0, 1) ?>
            </div>
        </div>
        <div style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
            <div style="margin-bottom: 10px;">
                <span style="font-size: 0.8rem; background: var(--bg-body); padding: 4px 8px; border-radius: 4px;"><?= $course['code'] ?></span>
            </div>
            <h3 style="font-size: 1.2rem; margin-bottom: 10px;"><?= $course['title'] ?></h3>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 20px; flex: 1;"><?= substr($course['description'], 0, 100) ?>...</p>
            
            <form action="<?= APP_URL ?>/student/enroll/<?= $course['id'] ?>" method="POST">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Enroll Now</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php view('layouts/footer'); ?>
