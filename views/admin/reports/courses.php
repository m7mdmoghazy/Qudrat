<div class="main-header">
    <div>
        <h1>Courses Report</h1>
        <p style="color: var(--text-muted);">Course popularity and completion rates</p>
    </div>
    <a href="<?= APP_URL ?>/admin/reports" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Reports</a>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 2px solid var(--border-color);">
                <th style="padding: 15px;">Course Name</th>
                <th style="padding: 15px;">Teacher</th>
                <th style="padding: 15px;">Enrolled Students</th>
                <th style="padding: 15px;">Avg. Rating</th>
                <th style="padding: 15px;">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;">Web Development 101</td>
                <td style="padding: 15px;">John Doe</td>
                <td style="padding: 15px;">45</td>
                <td style="padding: 15px;">4.8</td>
                <td style="padding: 15px;"><span style="color: green;">Active</span></td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;">Advanced Database Design</td>
                <td style="padding: 15px;">Jane Smith</td>
                <td style="padding: 15px;">32</td>
                <td style="padding: 15px;">4.5</td>
                <td style="padding: 15px;"><span style="color: green;">Active</span></td>
            </tr>
             <tr>
                <td style="padding: 15px;">UI/UX Fundamentals</td>
                <td style="padding: 15px;">John Doe</td>
                <td style="padding: 15px;">50</td>
                <td style="padding: 15px;">4.9</td>
                <td style="padding: 15px;"><span style="color: orange;">Review</span></td>
            </tr>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
