<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?><?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/css/main.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/css/chatbot.css">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php if(isset($css)): ?>
        <?php foreach($css as $file): ?>
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/css/<?= $file ?>.css">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body class="<?= isset($bodyClass) ? $bodyClass : '' ?>">
    <?php 
    // Show Flash Messages
    $flash = Session::getFlash();
    if($flash): ?>
        <div style="position: fixed; top: 20px; right: 20px; z-index: 1000;" class="alert alert-<?= $flash['type'] ?>">
            <?= $flash['message'] ?>
        </div>
    <?php endif; ?>