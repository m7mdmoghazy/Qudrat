<div class="main-header">
    <div>
        <h1>Edit User</h1>
        <p style="color: var(--text-muted);">Update user details</p>
    </div>
    <a href="<?= APP_URL ?>/admin/users" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

<div class="card" style="max-width: 600px;">
    <form action="<?= APP_URL ?>/admin/users/update/<?= $user['id'] ?>" method="POST">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" value="<?= $user['email'] ?>" disabled title="Email cannot be changed">
        </div>
        
        <div class="form-group">
            <label class="form-label">Password (Leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>
        
        <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-control">
                <option value="student" <?= $user['role'] == 'student' ? 'selected' : '' ?>>Student</option>
                <option value="teacher" <?= $user['role'] == 'teacher' ? 'selected' : '' ?>>Teacher</option>
                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>

<?php view('layouts/footer'); ?>
