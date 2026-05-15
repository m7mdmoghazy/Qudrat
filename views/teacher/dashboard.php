<div class="main-header">
    <div>
        <h1>Dashboard</h1>
        <p style="color: var(--text-muted);">Welcome back, Teacher</p>
    </div>
    <a href="<?= APP_URL ?>/teacher/courses/create" class="btn btn-primary"><i class="fas fa-plus"></i> Create Course</a>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <!-- Stat Card -->
    <div class="card" style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 50px; height: 50px; background: hsl(var(--primary-hue), 80%, 90%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-book" style="font-size: 1.5rem; color: var(--primary);"></i>
        </div>
        <div>
            <h3 style="margin: 0; font-size: 1.8rem;"><?= $course_count ?></h3>
            <span style="color: var(--text-muted);">Active Courses</span>
        </div>
    </div>
</div>

<h3 style="margin-bottom: 20px;">My Courses</h3>
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
    <?php foreach($courses as $course): ?>
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
            <h3 style="font-size: 1.2rem; margin-bottom: 10px;"><a href="<?= APP_URL ?>/teacher/courses/view/<?= $course['id'] ?>"><?= $course['title'] ?></a></h3>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 20px; flex: 1;"><?= substr($course['description'], 0, 100) ?>...</p>
            
            <div style="display: flex; gap: 10px;">
                <a href="<?= APP_URL ?>/teacher/courses/view/<?= $course['id'] ?>" class="btn btn-outline" style="flex: 1; text-align: center;">Manage</a>
                <a href="<?= APP_URL ?>/teacher/courses/edit/<?= $course['id'] ?>" class="btn btn-outline" style="padding: 10px;"><i class="fas fa-edit"></i></a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    
    <!-- Add New Course Card -->
    <a href="<?= APP_URL ?>/teacher/courses/create" class="card" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 10px; border: 2px dashed var(--border-color); background: transparent; transition: all 0.2s; min-height: 350px;">
        <div style="width: 60px; height: 60px; background: var(--bg-body); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-plus" style="color: var(--primary); font-size: 1.5rem;"></i>
        </div>
        <span style="font-weight: 500; color: var(--primary);">Create New Course</span>
    </a>
</div>

<?php view('layouts/footer'); ?>
