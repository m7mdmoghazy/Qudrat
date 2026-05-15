<div class="main-header">
    <div>
        <h1>Attendance Report</h1>
        <p style="color: var(--text-muted);">Monthly attendance summary</p>
    </div>
    <a href="<?= APP_URL ?>/admin/reports" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Reports</a>
</div>

<div class="card">
    <div style="display: flex; gap: 20px; margin-bottom: 20px;">
        <select class="form-control" style="width: 200px;">
            <option>Select Month</option>
            <option>January</option>
            <option>February</option>
            <option selected>December</option>
        </select>
        <button class="btn btn-primary">Filter</button>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 2px solid var(--border-color);">
                <th style="padding: 15px;">Date</th>
                <th style="padding: 15px;">Course</th>
                <th style="padding: 15px;">Present</th>
                <th style="padding: 15px;">Absent</th>
                <th style="padding: 15px;">Rate</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;">Dec 01, 2024</td>
                <td style="padding: 15px;">Web Development 101</td>
                <td style="padding: 15px;">40</td>
                <td style="padding: 15px;">5</td>
                <td style="padding: 15px;">89%</td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;">Dec 03, 2024</td>
                <td style="padding: 15px;">Advanced Database Design</td>
                <td style="padding: 15px;">30</td>
                <td style="padding: 15px;">2</td>
                <td style="padding: 15px;">94%</td>
            </tr>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
