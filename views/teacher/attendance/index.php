<div class="main-header">
    <div>
        <h1>Attendance</h1>
        <p style="color: var(--text-muted);">Record and manage student attendance</p>
    </div>
    <a href="<?= APP_URL ?>/teacher/attendance/record" class="btn btn-primary"><i class="fas fa-plus"></i> Record Attendance</a>
</div>

<div class="card" style="margin-bottom: 20px;">
    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
        <select class="form-control" style="padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0; min-width: 200px;">
            <option>Select Course</option>
            <option>Web Development 101</option>
            <option>Database Design</option>
        </select>
        <input type="date" class="form-control" style="padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0;">
        <button class="btn btn-outline">Filter</button>
    </div>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 2px solid var(--border-color);">
                <th style="padding: 15px;">Date</th>
                <th style="padding: 15px;">Course</th>
                <th style="padding: 15px;">Present</th>
                <th style="padding: 15px;">Absent</th>
                <th style="padding: 15px;">Rate</th>
                <th style="padding: 15px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;">Dec 28, 2024</td>
                <td style="padding: 15px;">Web Development 101</td>
                <td style="padding: 15px;"><span style="color: #16a34a;">18</span></td>
                <td style="padding: 15px;"><span style="color: #dc2626;">2</span></td>
                <td style="padding: 15px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="flex: 1; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                            <div style="width: 90%; height: 100%; background: #16a34a;"></div>
                        </div>
                        <span>90%</span>
                    </div>
                </td>
                <td style="padding: 15px;">
                    <a href="#" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.85rem;"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;">Dec 26, 2024</td>
                <td style="padding: 15px;">Database Design</td>
                <td style="padding: 15px;"><span style="color: #16a34a;">15</span></td>
                <td style="padding: 15px;"><span style="color: #dc2626;">5</span></td>
                <td style="padding: 15px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="flex: 1; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                            <div style="width: 75%; height: 100%; background: #f59e0b;"></div>
                        </div>
                        <span>75%</span>
                    </div>
                </td>
                <td style="padding: 15px;">
                    <a href="#" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.85rem;"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
