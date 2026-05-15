<div class="main-header">
    <div>
        <h1>Gradebook</h1>
        <p style="color: var(--text-muted);">View and manage student grades</p>
    </div>
    <div>
        <select class="form-control" style="padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0;">
            <option>All Courses</option>
            <option>Web Development 101</option>
            <option>Database Design</option>
        </select>
    </div>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 2px solid var(--border-color);">
                <th style="padding: 15px;">Student</th>
                <th style="padding: 15px;">Assignments</th>
                <th style="padding: 15px;">Quizzes</th>
                <th style="padding: 15px;">Attendance</th>
                <th style="padding: 15px;">Total</th>
                <th style="padding: 15px;">Grade</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 35px; height: 35px; background: var(--primary-light); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">M</div>
                        <div>
                            <div>Mohamed Moghazy</div>
                            <small style="color: var(--text-muted);">mohamed@example.com</small>
                        </div>
                    </div>
                </td>
                <td style="padding: 15px;">95/100</td>
                <td style="padding: 15px;">98/100</td>
                <td style="padding: 15px;">100%</td>
                <td style="padding: 15px; font-weight: bold;">98%</td>
                <td style="padding: 15px;"><span style="background: #dcfce7; color: #16a34a; padding: 5px 12px; border-radius: 20px; font-weight: 600;">A+</span></td>
            </tr>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
