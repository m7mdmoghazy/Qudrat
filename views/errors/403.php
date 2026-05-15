<?php view('layouts/header', ['title' => 'Access Denied']); ?>

<div class="container" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 80vh; text-align: center;">
    <h1 style="font-size: 6rem; color: #dc2626; margin: 0;">403</h1>
    <h2 style="margin-bottom: 20px;">Access Denied</h2>
    <p style="color: var(--text-muted); max-width: 500px; margin-bottom: 30px;">
        You do not have permission to view this page.
    </p>
    <a href="<?= APP_URL ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Go Back</a>
</div>

<?php view('layouts/footer'); ?>
