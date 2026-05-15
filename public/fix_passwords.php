<?php
// Standalone script to fix passwords
// Access via: http://localhost/capacities-platform/public/fix_passwords.php

require_once __DIR__ . '/../app/Config/Constants.php';
require_once __DIR__ . '/../app/Helpers/functions.php'; // For dd, redirect etc if needed
require_once APP . '/Config/Database.php';

try {
    $db = Database::connect();

    $password = '123456';
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = :password";
    $stmt = $db->prepare($sql);
    $stmt->execute([':password' => $hash]);

    echo "<div style='font-family: sans-serif; text-align: center; padding: 50px;'>";
    echo "<h1 style='color: green;'>Success!</h1>";
    echo "<p>All user passwords have been reset to: <strong>123456</strong></p>";
    echo "<p>You should now be able to login.</p>";
    echo "<a href='" . APP_URL . "/login' style='background: #6366f1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Login</a>";
    echo "</div>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
