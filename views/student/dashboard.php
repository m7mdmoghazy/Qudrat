<div class="main-header">
    <div>
        <h1>Dashboard</h1>
        <p style="color: var(--text-muted);">Welcome back, Student</p>
    </div>
    <a href="<?= APP_URL ?>/student/courses" class="btn btn-primary"><i class="fas fa-search"></i> Browse Courses</a>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <!-- Stat Card -->
    <div class="card" style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 50px; height: 50px; background: hsl(var(--primary-hue), 80%, 90%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-book-reader" style="font-size: 1.5rem; color: var(--primary);"></i>
        </div>
        <div>
            <h3 style="margin: 0; font-size: 1.8rem;"><?= $course_count ?></h3>
            <span style="color: var(--text-muted);">Enrolled Courses</span>
        </div>
    </div>
</div>

<h3 style="margin-bottom: 20px;">My Enrolled Courses</h3>
<?php if (!empty($enrolled_courses)): ?>
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
    <?php foreach($enrolled_courses as $course): ?>
    <div class="card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
        <div style="height: 150px; background: #eee; position: relative;">
            <?php if($course['image'] && $course['image'] != 'course-placeholder.jpg'): ?>
                <img src="<?= APP_URL . '/' . $course['image'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
            <?php else: ?>
                <div style="width: 100%; height: 100%; background: linear-gradient(45deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: bold;">
                    <?= substr($course['title'], 0, 1) ?>
                </div>
            <?php endif; ?>
        </div>
        <div style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
            <div style="margin-bottom: 10px;">
                <span style="font-size: 0.8rem; background: var(--bg-body); padding: 4px 8px; border-radius: 4px;"><?= $course['code'] ?></span>
            </div>
            <h3 style="font-size: 1.2rem; margin-bottom: 10px;"><a href="<?= APP_URL ?>/student/courses/view/<?= $course['id'] ?>"><?= $course['title'] ?></a></h3>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 20px; flex: 1;"><?= substr($course['description'], 0, 100) ?>...</p>
            
            <a href="<?= APP_URL ?>/student/courses/view/<?= $course['id'] ?>" class="btn btn-outline" style="text-align: center;">Enter Course</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="card" style="text-align: center; padding: 50px;">
    <i class="fas fa-book-open" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 20px; opacity: 0.5;"></i>
    <h3>You haven't enrolled in any courses yet.</h3>
    <p style="color: var(--text-muted); margin-bottom: 20px;">Browse the catalog to find classes.</p>
    <a href="<?= APP_URL ?>/student/courses" class="btn btn-primary">Browse Courses</a>
</div>
<?php endif; ?>

<?php view('layouts/footer'); ?>