<?php view('layouts/header'); ?>

<div class="app-layout">
    <aside class="sidebar">
        <div class="sidebar-header" style="padding: 24px; font-weight: bold; font-size: 1.2rem; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-graduation-cap" style="color: var(--primary);"></i>
            <span>Capacities</span>
        </div>
        
        <nav class="sidebar-nav">
            <a href="<?= APP_URL ?>/admin/dashboard" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false ? 'active' : '' ?>">
                <i class="fas fa-chart-pie" style="width: 20px;"></i> Dashboard
            </a>
            <a href="<?= APP_URL ?>/admin/users" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'users') !== false ? 'active' : '' ?>">
                <i class="fas fa-users" style="width: 20px;"></i> Users
            </a>
            <a href="<?= APP_URL ?>/admin/courses" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'courses') !== false ? 'active' : '' ?>">
                <i class="fas fa-book" style="width: 20px;"></i> Courses
            </a>
            <a href="<?= APP_URL ?>/admin/reports" class="nav-link">
                <i class="fas fa-file-alt" style="width: 20px;"></i> Reports
            </a>
            <a href="<?= APP_URL ?>/admin/settings" class="nav-link">
                <i class="fas fa-cog" style="width: 20px;"></i> Settings
            </a>
        </nav>
        
        <div style="position: absolute; bottom: 0; padding: 20px; width: 100%; border-top: 1px solid var(--border-color);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                <div style="width: 32px; height: 32px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">A</div>
                <div style="font-size: 0.9rem;">
                    <div><?= Session::get('user_name') ?></div>
                    <small style="color: var(--text-muted);">Admin</small>
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
