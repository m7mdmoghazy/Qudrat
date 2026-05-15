<?php view('layouts/header', ['title' => 'Page Not Found']); ?>

<div class="container" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 80vh; text-align: center;">
    <h1 style="font-size: 6rem; color: var(--primary); margin: 0;">404</h1>
    <h2 style="margin-bottom: 20px;">Page Not Found</h2>
    <p style="color: var(--text-muted); max-width: 500px; margin-bottom: 30px;">
        The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
    </p>
    <a href="<?= APP_URL ?>" class="btn btn-primary"><i class="fas fa-home"></i> Go to Homepage</a>
</div>

<?php view('layouts/footer'); ?>
