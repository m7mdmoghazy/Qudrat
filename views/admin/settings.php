<div class="main-header">
    <div>
        <h1>Settings</h1>
        <p style="color: var(--text-muted);">Manage application settings</p>
    </div>
</div>

<div class="card">
    <form action="<?= APP_URL ?>/admin/settings/update" method="POST">
        <?= \Session::getFlash('success') ? '<div class="alert alert-success">'.\Session::getFlash('success').'</div>' : '' ?>
        <?= \Session::getFlash('error') ? '<div class="alert alert-danger">'.\Session::getFlash('error').'</div>' : '' ?>
        
        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <div class="form-group">
            <label for="app_name">Application Name</label>
            <input type="text" id="app_name" name="app_name" class="form-control" value="Capacities Platform">
        </div>

        <div class="form-group">
            <label for="admin_email">Admin Email</label>
            <input type="email" id="admin_email" name="admin_email" class="form-control" value="admin@capacities.com">
        </div>

        <div class="form-group">
            <label for="timezone">Timezone</label>
            <select id="timezone" name="timezone" class="form-control">
                <option value="UTC">UTC</option>
                <option value="Africa/Cairo" selected>Africa/Cairo</option>
                <option value="Asia/Riyadh">Asia/Riyadh</option>
                <option value="Europe/London">Europe/London</option>
                <option value="America/New_York">America/New_York</option>
            </select>
        </div>
        
        <div style="margin-top: 20px; border-top: 1px solid var(--border-color); padding-top: 20px;">
             <h3>Maintenance Mode</h3>
             <div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
                 <input type="checkbox" id="maintenance_mode" name="maintenance_mode"> 
                 <label for="maintenance_mode" style="margin:0;">Enable Maintenance Mode</label>
             </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>
    </form>
</div>

<?php view('layouts/footer'); ?>
