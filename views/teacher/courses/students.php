<div class="main-header">
    <div>
        <h1>Enrolled Students</h1>
        <p style="color: var(--text-muted);">Manage students in this course</p>
    </div>
    <a href="<?= APP_URL ?>/teacher/courses" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="card">
    <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
        <input type="text" placeholder="Search students..." class="form-control" style="max-width: 300px; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
        <span style="color: var(--text-muted);">Total: <strong>0</strong> students</span>
    </div>
    
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 2px solid var(--border-color);">
                <th style="padding: 15px;">Student</th>
                <th style="padding: 15px;">Email</th>
                <th style="padding: 15px;">Enrolled On</th>
                <th style="padding: 15px;">Progress</th>
                <th style="padding: 15px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-muted);">
                    <i class="fas fa-users" style="font-size: 2rem; margin-bottom: 10px; display: block; opacity: 0.3;"></i>
                    No students enrolled yet
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
