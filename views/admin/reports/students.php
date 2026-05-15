<div class="main-header">
    <div>
        <h1>Students Report</h1>
        <p style="color: var(--text-muted);">Detailed analysis of student performance</p>
    </div>
    <a href="<?= APP_URL ?>/admin/reports" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Reports</a>
</div>

<div class="grid" style="grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px;">
    <div class="card">
        <h3>Total Students</h3>
        <p style="font-size: 2rem; font-weight: bold; color: var(--primary);">120</p>
    </div>
    <div class="card">
        <h3>Active Learners</h3>
        <p style="font-size: 2rem; font-weight: bold; color: var(--secondary);">96%</p>
    </div>
    <div class="card">
        <h3>Average Grade</h3>
        <p style="font-size: 2rem; font-weight: bold; color: var(--accent);">B+</p>
    </div>
</div>

<div class="card">
    <h3>Performance Distribution</h3>
    <!-- Placeholder for Chart -->
    <div style="height: 300px; display: flex; align-items: center; justify-content: center; background: #f9fafb; border-radius: 8px; margin-top: 20px; color: var(--text-muted);">
        Chart Visualization Placeholder
    </div>
</div>

<?php view('layouts/footer'); ?>
