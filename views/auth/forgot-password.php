<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Capacities</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/css/main.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/css/auth.css">
    <style>
        .auth-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #f8fafc;">
    <div class="auth-card">
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="width: 50px; height: 50px; background: var(--primary); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin-bottom: 15px;">
                <i class="fas fa-key"></i>
            </div>
            <h1 style="font-size: 1.8rem; color: #1e293b; margin-bottom: 10px;">Forgot Password?</h1>
            <p style="color: #64748b;">Enter your email to receive instructions</p>
        </div>

        <?= \Session::getFlash('error') ? '<div class="alert alert-danger" style="background: #fee2e2; color: #dc2626; padding: 15px; border-radius: 8px; margin-bottom: 20px;">'.\Session::getFlash('error').'</div>' : '' ?>
        <?= \Session::getFlash('success') ? '<div class="alert alert-success" style="background: #dcfce7; color: #16a34a; padding: 15px; border-radius: 8px; margin-bottom: 20px;">'.\Session::getFlash('success').'</div>' : '' ?>

        <form action="<?= APP_URL ?>/forgot-password/send" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; color: #475569; font-weight: 500;">Email Address</label>
                <div style="position: relative;">
                    <i class="fas fa-envelope" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="email" name="email" required placeholder="name@example.com" 
                           style="width: 100%; padding: 12px 12px 12px 45px; border: 1px solid #e2e8f0; border-radius: 10px; outline: none; transition: all 0.3s;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; border-radius: 10px; font-weight: 600; font-size: 1rem; cursor: pointer; border:none; background: var(--primary); color: white;">Send Reset Link</button>
        </form>

        <div style="text-align: center; margin-top: 25px;">
            <a href="<?= APP_URL ?>/login" style="color: #64748b; text-decoration: none; font-size: 0.95rem;">
                <i class="fas fa-arrow-left"></i> Back to Login
            </a>
        </div>
    </div>
</div>

</body>
</html>
