<div class="main-header">
    <div>
        <h1>Create User</h1>
        <p style="color: var(--text-muted);">Add a new user to the platform</p>
    </div>
    <a href="<?= APP_URL ?>/admin/users" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

<div class="card" style="max-width: 600px;">
    <form action="<?= APP_URL ?>/admin/users/store" method="POST">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-control">
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>

<?php view('layouts/footer'); ?>
