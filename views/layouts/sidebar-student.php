<?php view('layouts/header'); ?>

<div class="app-layout">
    <aside class="sidebar">
        <div class="sidebar-header" style="padding: 24px; font-weight: bold; font-size: 1.2rem; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-user-graduate" style="color: var(--accent);"></i>
            <span>Capacities</span>
        </div>
        
        <nav class="sidebar-nav">
            <a href="<?= APP_URL ?>/student/dashboard" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false ? 'active' : '' ?>">
                <i class="fas fa-home" style="width: 20px;"></i> Dashboard
            </a>
            <a href="<?= APP_URL ?>/student/courses" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'courses') !== false ? 'active' : '' ?>">
                <i class="fas fa-book" style="width: 20px;"></i> Browse Courses
            </a>
            <a href="<?= APP_URL ?>/student/assignments" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'assignments') !== false ? 'active' : '' ?>">
                <i class="fas fa-tasks" style="width: 20px;"></i> My Assignments
            </a>
            <a href="<?= APP_URL ?>/student/quizzes" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'quizzes') !== false ? 'active' : '' ?>">
                <i class="fas fa-clock" style="width: 20px;"></i> My Quizzes
            </a>
            <a href="<?= APP_URL ?>/student/grades" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'grades') !== false ? 'active' : '' ?>">
                <i class="fas fa-chart-bar" style="width: 20px;"></i> Grades
            </a>
            <a href="<?= APP_URL ?>/student/profile" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'profile') !== false ? 'active' : '' ?>">
                <i class="fas fa-user" style="width: 20px;"></i> Profile
            </a>
        </nav>
        
        <div style="position: absolute; bottom: 0; padding: 20px; width: 100%; border-top: 1px solid var(--border-color);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                <div style="width: 32px; height: 32px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">S</div>
                <div style="font-size: 0.9rem;">
                    <div><?= Session::get('user_name') ?></div>
                    <small style="color: var(--text-muted);">Student</small>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                 <button id="theme-toggle" class="btn-outline" style="border: none; padding: 5px;"><i class="fas fa-moon"></i></button>
                 <a href="<?= APP_URL ?>/logout" style="color: var(--primary); font-size: 0.9rem;">Logout</a>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <?= isset($content) ? $content : '' ?>
    </main>
</div>
