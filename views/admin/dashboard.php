<div class="main-header">
    <div>
        <h1>Dashboard</h1>
        <p style="color: var(--text-muted);">Welcome back, Admin</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <!-- Stat Card 1 -->
    <div class="card" style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 50px; height: 50px; background: hsl(var(--primary-hue), 80%, 90%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-user-graduate" style="font-size: 1.5rem; color: var(--primary);"></i>
        </div>
        <div>
            <h3 style="margin: 0; font-size: 1.8rem;"><?= $total_students ?></h3>
            <span style="color: var(--text-muted);">Total Students</span>
        </div>
    </div>
    
    <!-- Stat Card 2 -->
    <div class="card" style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 50px; height: 50px; background: hsl(var(--secondary-hue), 80%, 90%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-chalkboard-teacher" style="font-size: 1.5rem; color: var(--secondary);"></i>
        </div>
        <div>
            <h3 style="margin: 0; font-size: 1.8rem;"><?= $total_teachers ?></h3>
            <span style="color: var(--text-muted);">Total Teachers</span>
        </div>
    </div>
    
    <!-- Stat Card 3 -->
    <div class="card" style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 50px; height: 50px; background: hsl(var(--accent-hue), 80%, 90%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-book" style="font-size: 1.5rem; color: var(--accent);"></i>
        </div>
        <div>
            <h3 style="margin: 0; font-size: 1.8rem;"><?= $total_courses ?></h3>
            <span style="color: var(--text-muted);">Active Courses</span>
        </div>
    </div>
</div>

<div class="card">
    <h3>Quick Actions</h3>
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="<?= APP_URL ?>/admin/users/create" class="btn btn-primary"><i class="fas fa-plus"></i> Add User</a>
        <a href="<?= APP_URL ?>/admin/courses/create" class="btn btn-outline"><i class="fas fa-plus"></i> Add Course</a>
        <a href="<?= APP_URL ?>/admin/reports" class="btn btn-outline"><i class="fas fa-file-alt"></i> View Reports</a>
    </div>
</div>

<?php view('layouts/footer'); ?>
