<?php view('layouts/header', ['title' => 'Server Error']); ?>

<div class="container" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 80vh; text-align: center;">
    <h1 style="font-size: 6rem; color: #dc2626; margin: 0;">500</h1>
    <h2 style="margin-bottom: 20px;">Internal Server Error</h2>
    <p style="color: var(--text-muted); max-width: 500px; margin-bottom: 30px;">
        Something went wrong on our end. Please try again later.
    </p>
    <a href="<?= APP_URL ?>" class="btn btn-primary"><i class="fas fa-redo"></i> Refresh Page</a>
</div>

<?php view('layouts/footer'); ?>
