<?php view('layouts/header', ['title' => 'Register', 'bodyClass' => 'bg-light']); ?>

<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
    <div class="card" style="width: 100%; max-width: 500px; padding: 40px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: var(--primary); margin-bottom: 10px;">Create Account</h1>
            <p style="color: var(--text-muted);">Join the Capacities Platform today</p>
        </div>
        
        <form action="<?= APP_URL ?>/register" method="POST">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <div style="position: relative;">
                    <i class="fas fa-user" style="position: absolute; top: 15px; left: 15px; color: var(--text-muted);"></i>
                    <input type="text" name="name" class="form-control" style="padding-left: 45px;" required placeholder="John Doe">
                </div>
            </div>
            
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
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Create Account</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px; font-size: 0.9rem;">
            Already have an account? <a href="<?= APP_URL ?>/login" style="color: var(--primary); font-weight: 600;">Sign In</a>
        </div>
    </div>
</div>

<?php view('layouts/footer'); ?>
