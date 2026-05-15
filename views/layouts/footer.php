    <script src="<?= APP_URL ?>/public/assets/js/theme-switcher.js"></script>
    <script src="<?= APP_URL ?>/public/assets/js/main.js"></script>
    <script src="<?= APP_URL ?>/public/assets/js/chatbot.js"></script>
    <?php if(isset($js)): ?>
        <?php foreach($js as $file): ?>
            <script src="<?= APP_URL ?>/public/assets/js/<?= $file ?>.js"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
