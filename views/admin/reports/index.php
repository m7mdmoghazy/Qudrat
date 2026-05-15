<div class="main-header">
    <div>
        <h1>Reports</h1>
        <p style="color: var(--text-muted);">View system reports and analytics</p>
    </div>
</div>

<div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
    <!-- Students Report Card -->
    <div class="card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
            <div style="width: 50px; height: 50px; background: rgba(99, 102, 241, 0.1); color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div>
                <h3>Students Performance</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Grades and progress analysis</p>
            </div>
        </div>
        <a href="<?= APP_URL ?>/admin/reports/students" class="btn btn-outline" style="width: 100%; justify-content: center;">View Report</a>
    </div>

    <!-- Courses Report Card -->
    <div class="card">
         <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
            <div style="width: 50px; height: 50px; background: rgba(16, 185, 129, 0.1); color: var(--secondary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-book-open"></i>
            </div>
            <div>
                <h3>Course Engagement</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Enrollment and activity stats</p>
            </div>
        </div>
        <a href="<?= APP_URL ?>/admin/reports/courses" class="btn btn-outline" style="width: 100%; justify-content: center;">View Report</a>
    </div>

    <!-- Attendance Report Card -->
    <div class="card">
         <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
            <div style="width: 50px; height: 50px; background: rgba(245, 158, 11, 0.1); color: var(--accent); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div>
                <h3>Attendance</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Absence and presence records</p>
            </div>
        </div>
        <a href="<?= APP_URL ?>/admin/reports/attendance" class="btn btn-outline" style="width: 100%; justify-content: center;">View Report</a>
    </div>
</div>

<?php view('layouts/footer'); ?>
