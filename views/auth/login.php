<?php view('layouts/header', ['title' => 'Login', 'bodyClass' => 'bg-light']); ?>

<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
    <div class="card" style="width: 100%; max-width: 400px; padding: 40px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: var(--primary); margin-bottom: 10px;">Login</h1>
            <p style="color: var(--text-muted);">Welcome back to Capacities</p>
        </div>
        
        <form action="<?= APP_URL ?>/login" method="POST">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div style="position: relative;">
                    <i class="fas fa-envelope" style="position: absolute; top: 15px; left: 15px; color: var(--text-muted);"></i>
                    <input type="email" name="email" class="form-control" style="padding-left: 45px;" required placeholder="name@example.com">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <div style="position: relative;">
                    <i class="fas fa-lock" style="position: absolute; top: 15px; left: 15px; color: var(--text-muted);"></i>
                    <input type="password" name="password" class="form-control" style="padding-left: 45px;" required placeholder="••••••••">
                </div>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-size: 0.9rem;">
                <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                    <input type="checkbox"> Remember me
                </label>
                <a href="<?= APP_URL ?>/forgot-password" style="color: var(--primary);">Forgot Password?</a>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Sign In</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px; font-size: 0.9rem;">
            Don't have an account? <a href="<?= APP_URL ?>/register" style="color: var(--primary); font-weight: 600;">Sign Up</a>
        </div>
    </div>
</div>

<?php view('layouts/footer'); ?>