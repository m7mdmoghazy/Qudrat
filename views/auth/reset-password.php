<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Capacities</title>
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
                <i class="fas fa-lock"></i>
            </div>
            <h1 style="font-size: 1.8rem; color: #1e293b; margin-bottom: 10px;">Reset Password</h1>
            <p style="color: #64748b;">Create a new secure password</p>
        </div>

        <?= \Session::getFlash('error') ? '<div class="alert alert-danger" style="background: #fee2e2; color: #dc2626; padding: 15px; border-radius: 8px; margin-bottom: 20px;">'.\Session::getFlash('error').'</div>' : '' ?>

        <form action="<?= APP_URL ?>/reset-password/update" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #475569; font-weight: 500;">New Password</label>
                <div style="position: relative;">
                    <i class="fas fa-lock" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="password" name="password" required placeholder="••••••••" 
                           style="width: 100%; padding: 12px 12px 12px 45px; border: 1px solid #e2e8f0; border-radius: 10px; outline: none; transition: all 0.3s;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; color: #475569; font-weight: 500;">Confirm Password</label>
                <div style="position: relative;">
                    <i class="fas fa-lock" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="password" name="confirm_password" required placeholder="••••••••" 
                           style="width: 100%; padding: 12px 12px 12px 45px; border: 1px solid #e2e8f0; border-radius: 10px; outline: none; transition: all 0.3s;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; border-radius: 10px; font-weight: 600; font-size: 1rem; cursor: pointer; border:none; background: var(--primary); color: white;">Reset Password</button>
        </form>
    </div>
</div>

</body>
</html>
