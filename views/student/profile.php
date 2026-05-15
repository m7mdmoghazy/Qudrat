<div class="main-header">
    <div>
        <h1>My Profile</h1>
        <p style="color: var(--text-muted);">Manage your personal information</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 300px 1fr; gap: 30px;">
    <!-- Profile Card -->
    <div class="card" style="text-align: center; padding: 30px;">
        <div style="width: 120px; height: 120px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 3rem; color: white;">
            <?= strtoupper(substr(Session::get('user_name'), 0, 1)) ?>
        </div>
        <h2 style="margin-bottom: 5px;"><?= Session::get('user_name') ?></h2>
        <p style="color: var(--text-muted); margin-bottom: 20px;"><?= Session::get('user_email') ?></p>
        <span style="background: var(--primary-light); color: var(--primary); padding: 5px 15px; border-radius: 20px; font-size: 0.9rem;">Student</span>
        
        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <div style="display: flex; justify-content: space-around;">
                <div>
                    <h3 style="color: var(--primary);">5</h3>
                    <small style="color: var(--text-muted);">Courses</small>
                </div>
                <div>
                    <h3 style="color: var(--secondary);">12</h3>
                    <small style="color: var(--text-muted);">Assignments</small>
                </div>
                <div>
                    <h3 style="color: var(--accent);">85%</h3>
                    <small style="color: var(--text-muted);">Avg Grade</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Profile Form -->
    <div class="card">
        <?= \Session::getFlash('success') ? '<div style="background: #dcfce7; color: #16a34a; padding: 15px; border-radius: 8px; margin-bottom: 20px;">'.\Session::getFlash('success').'</div>' : '' ?>
        <?= \Session::getFlash('error') ? '<div style="background: #fee2e2; color: #dc2626; padding: 15px; border-radius: 8px; margin-bottom: 20px;">'.\Session::getFlash('error').'</div>' : '' ?>
        
        <h3 style="margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color);">Personal Information</h3>
        
        <form action="<?= APP_URL ?>/student/updateProfile" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Full Name</label>
                    <input type="text" name="name" value="<?= Session::get('user_name') ?>" class="form-control" 
                           style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;">
                </div>
                
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Email Address</label>
                    <input type="email" value="<?= Session::get('user_email') ?>" class="form-control" disabled
                           style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f5f5f5;">
                </div>
            </div>
            
            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Bio</label>
                <textarea name="bio" rows="3" class="form-control" placeholder="Tell us about yourself..."
                          style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; resize: vertical;"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" style="margin-top: 20px;"><i class="fas fa-save"></i> Save Changes</button>
        </form>
        
        <h3 style="margin: 40px 0 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color);">Change Password</h3>
        
        <form action="<?= APP_URL ?>/student/updatePassword" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Current Password</label>
                    <input type="password" name="current_password" class="form-control" required
                           style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;">
                </div>
                
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">New Password</label>
                    <input type="password" name="new_password" class="form-control" required
                           style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;">
                </div>
                
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required
                           style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;">
                </div>
            </div>
            
            <button type="submit" class="btn btn-outline" style="margin-top: 20px;"><i class="fas fa-key"></i> Update Password</button>
        </form>
    </div>
</div>

<?php view('layouts/footer'); ?>
