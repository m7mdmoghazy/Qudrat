<?php view('layouts/header'); ?>

<div class="app-layout">
    <aside class="sidebar">
        <div class="sidebar-header" style="padding: 24px; font-weight: bold; font-size: 1.2rem; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-chalkboard-teacher" style="color: var(--secondary);"></i>
            <span>Capacities</span>
        </div>
        
        <nav class="sidebar-nav">
            <a href="<?= APP_URL ?>/teacher/dashboard" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false ? 'active' : '' ?>">
                <i class="fas fa-home" style="width: 20px;"></i> Dashboard
            </a>
            <a href="<?= APP_URL ?>/teacher/courses" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'courses') !== false ? 'active' : '' ?>">
                <i class="fas fa-book-open" style="width: 20px;"></i> My Courses
            </a>
            <a href="<?= APP_URL ?>/teacher/assignments" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'assignments') !== false ? 'active' : '' ?>">
                <i class="fas fa-tasks" style="width: 20px;"></i> Assignments
            </a>
            <a href="<?= APP_URL ?>/teacher/quizzes" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'quizzes') !== false ? 'active' : '' ?>">
                <i class="fas fa-puzzle-piece" style="width: 20px;"></i> Quizzes
            </a>
            <a href="<?= APP_URL ?>/teacher/grades" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'grades') !== false ? 'active' : '' ?>">
                <i class="fas fa-clipboard-list" style="width: 20px;"></i> Gradebook
            </a>
        </nav>
        
        <div style="position: absolute; bottom: 0; padding: 20px; width: 100%; border-top: 1px solid var(--border-color);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                <div style="width: 32px; height: 32px; background: var(--secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">T</div>
                <div style="font-size: 0.9rem;">
                    <div><?= Session::get('user_name') ?></div>
                    <small style="color: var(--text-muted);">Teacher</small>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                 <button id="theme-toggle" class="btn-outline" style="border: none; padding: 5px;"><i class="fas fa-moon"></i></button>
                 <a href="<?= APP_URL ?>/logout" style="color: var(--accent); font-size: 0.9rem;">Logout</a>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <?= isset($content) ? $content : '' ?>
    </main>
</div>
