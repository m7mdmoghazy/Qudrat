<div class="main-header">
    <div>
        <h1>Record Attendance</h1>
        <p style="color: var(--text-muted);">Mark student attendance for today</p>
    </div>
    <a href="<?= APP_URL ?>/teacher/attendance" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="card" style="margin-bottom: 20px;">
    <div style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center;">
        <select class="form-control" style="padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0; min-width: 250px;">
            <option>Select Course</option>
            <option selected>Web Development 101</option>
            <option>Database Design</option>
        </select>
        <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" style="padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
        <button class="btn btn-primary"><i class="fas fa-search"></i> Load Students</button>
    </div>
</div>

<div class="card">
    <form action="<?= APP_URL ?>/teacher/attendance/save" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <input type="hidden" name="course_id" value="1">
        <input type="hidden" name="date" value="<?= date('Y-m-d') ?>">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color);">
            <div>
                <button type="button" onclick="markAll('present')" class="btn btn-outline" style="padding: 8px 15px; font-size: 0.9rem;">
                    <i class="fas fa-check-circle"></i> Mark All Present
                </button>
                <button type="button" onclick="markAll('absent')" class="btn btn-outline" style="padding: 8px 15px; font-size: 0.9rem; margin-left: 10px; color: #dc2626; border-color: #dc2626;">
                    <i class="fas fa-times-circle"></i> Mark All Absent
                </button>
            </div>
            <span style="color: var(--text-muted);">20 students</span>
        </div>
        
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid var(--border-color);">
                    <th style="padding: 15px; width: 50px;">#</th>
                    <th style="padding: 15px;">Student Name</th>
                    <th style="padding: 15px;">Email</th>
                    <th style="padding: 15px; text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 1; $i <= 5; $i++): ?>
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <td style="padding: 15px;"><?= $i ?></td>
                    <td style="padding: 15px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 35px; height: 35px; background: hsl(<?= $i * 50 ?>, 50%, 90%); color: hsl(<?= $i * 50 ?>, 70%, 40%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">S</div>
                            Student <?= $i ?>
                        </div>
                    </td>
                    <td style="padding: 15px; color: var(--text-muted);">student<?= $i ?>@example.com</td>
                    <td style="padding: 15px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 10px;">
                            <label style="display: flex; align-items: center; gap: 5px; cursor: pointer; padding: 8px 15px; border-radius: 20px; background: #dcfce7; color: #16a34a;">
                                <input type="radio" name="attendance[<?= $i ?>]" value="present" checked> Present
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px; cursor: pointer; padding: 8px 15px; border-radius: 20px; background: #fee2e2; color: #dc2626;">
                                <input type="radio" name="attendance[<?= $i ?>]" value="absent"> Absent
                            </label>
                        </div>
                    </td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        
        <div style="margin-top: 30px; text-align: center;">
            <button type="submit" class="btn btn-primary" style="padding: 15px 50px;"><i class="fas fa-save"></i> Save Attendance</button>
        </div>
    </form>
</div>

<script>
function markAll(status) {
    document.querySelectorAll('input[type="radio"][value="' + status + '"]').forEach(function(radio) {
        radio.checked = true;
    });
}
</script>

<?php view('layouts/footer'); ?>
