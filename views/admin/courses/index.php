<div class="main-header">
    <div>
        <h1>All Courses</h1>
        <p style="color: var(--text-muted);">Manage platform courses</p>
    </div>
    <!-- <a href="<?= APP_URL ?>/admin/courses/create" class="btn btn-primary"><i class="fas fa-plus"></i> New Course</a> -->
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color); text-align: left;">
                <th style="padding: 15px;">Image</th>
                <th style="padding: 15px;">Title</th>
                <th style="padding: 15px;">Code</th>
                <th style="padding: 15px;">Instructor</th>
                <th style="padding: 15px;">Students</th>
                <th style="padding: 15px;">Status</th>
                <th style="padding: 15px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($courses)): ?>
            <?php foreach($courses as $course): ?>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;">
                    <div style="width: 50px; height: 50px; border-radius: 8px; overflow: hidden; background: #f1f5f9;">
                         <?php if(!empty($course['image'])): ?>
                            <img src="<?= APP_URL ?>/uploads/courses/<?= $course['image'] ?>" alt="<?= $course['title'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #94a3b8;">
                                <i class="fas fa-book"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                </td>
                <td style="padding: 15px; font-weight: 500;"><?= $course['title'] ?></td>
                <td style="padding: 15px; font-family: monospace; color: var(--primary);"><?= $course['code'] ?></td>
                <td style="padding: 15px;"><?= $course['teacher_name'] ?></td>
                <td style="padding: 15px;">
                    <!-- Could fetch count or use placeholder -->
                    <span style="background: #f1f5f9; padding: 2px 8px; border-radius: 10px; font-size: 0.8rem;">-</span>
                </td>
                <td style="padding: 15px;">
                    <span style="padding: 4px 10px; border-radius: 50px; font-size: 0.85rem; background: #dcfce7; color: #16a34a;">
                        Active
                    </span>
                </td>
                <td style="padding: 15px;">
                    <a href="#" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">Edit</a>
                    <a href="#" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem; color: #ef4444; border-color: #ef4444;">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="7" style="padding: 30px; text-align: center; color: var(--text-muted);">No courses found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
