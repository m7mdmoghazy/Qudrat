<?php

// Define Base Path
defined('ROOT') || define('ROOT', dirname(dirname(__DIR__)));
defined('APP') || define('APP', ROOT . '/app');
defined('PUBLIC_PATH') || define('PUBLIC_PATH', ROOT . '/public');
defined('VIEWS') || define('VIEWS', ROOT . '/views');

// Load Config
$config = parse_ini_file(ROOT . '/config.ini', true);

// Application Constants
define('APP_NAME', $config['app']['app_name']);
define('APP_URL', $config['app']['app_url']);
define('ENV', $config['app']['env']);
define('DEBUG', filter_var($config['app']['debug'], FILTER_VALIDATE_BOOLEAN));

// Database Constants
define('DB_HOST', $config['database']['host']);
define('DB_USER', $config['database']['username']);
define('DB_PASS', $config['database']['password']);
define('DB_NAME', $config['database']['dbname']);
define('DB_CHAR', $config['database']['charset']);

// User Roles
define('ROLE_ADMIN', 'admin');
define('ROLE_TEACHER', 'teacher');
define('ROLE_STUDENT', 'student');

// Upload Constants
define('MAX_UPLOAD_SIZE', $config['upload']['max_size']);
define('ALLOWED_FILE_TYPES', explode(',', $config['upload']['allowed_types']));
define('UPLOAD_PATH', PUBLIC_PATH . '/assets/uploads');