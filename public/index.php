<?php

/**
 * Front Controller
 */

// Load Configuration and Constants
require_once __DIR__ . '/../app/Config/Constants.php';
require_once __DIR__ . '/../app/Helpers/functions.php';
require_once __DIR__ . '/../app/Helpers/view.php';
require_once __DIR__ . '/../app/Helpers/security.php';

// Load Core Libraries
require_once APP . '/Libraries/Session.php';

// Initialize Session
Session::init();

// Simple Autoloader for Controllers and Models
spl_autoload_register(function ($class_name) {
    $paths = [
        APP . '/Controllers/',
        APP . '/Models/',
        APP . '/Libraries/',
        APP . '/Middleware/'
    ];

    foreach ($paths as $path) {
        $file = $path . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});


// Basic Routing
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = filter_var($url, FILTER_SANITIZE_URL);
// DEBUG
// echo "Request URL: " . $url; 
// die(); 
$urlParts = explode('/', $url);

// Default Controller and Method
$controllerName = 'AuthController'; // Default to login page if not specified? Or maybe Home? 
// Let's make a generic Router or just switch/case for now.
// For now, let's map /admin -> AdminController, /login -> AuthController@login, etc.
// A simple router logic:

// If empty, show home page
if (empty($url)) {
    $url = 'home';
}

// Routes Mapping (Simple version)
// Format: 'url_segment' => ['Controller', 'Method']
$routes = [
    'home' => ['HomeController', 'index'],
    'about' => ['HomeController', 'about'],
    'contact' => ['HomeController', 'contact'],
    'login' => ['AuthController', 'login'],
    'register' => ['AuthController', 'register'],
    'logout' => ['AuthController', 'logout'],
    'dashboard' => ['DashboardController', 'index'],
    'admin/dashboard' => ['DashboardController', 'index'],
    'teacher/dashboard' => ['DashboardController', 'index'],
    'student/dashboard' => ['DashboardController', 'index'],
    
    // Auth Routes
    'forgot-password' => ['AuthController', 'forgotPassword'],
    'forgot-password/send' => ['AuthController', 'sendResetLink'],
    'reset-password' => ['AuthController', 'resetPassword'],
    'reset-password/update' => ['AuthController', 'updatePassword'],

    // Admin Routes
    'admin/settings' => ['AdminController', 'settings'],
    'admin/settings/update' => ['AdminController', 'updateSettings'],
    'admin/reports' => ['AdminController', 'reports'],
    'admin/reports/students' => ['AdminController', 'reportStudents'],
    'admin/reports/courses' => ['AdminController', 'reportCourses'],
    'admin/reports/attendance' => ['AdminController', 'reportAttendance'],

    // Admin Routes
    'admin/users' => ['AdminController', 'users'],
    'admin/users/create' => ['AdminController', 'createUser'],
    'admin/users/store' => ['AdminController', 'storeUser'],
    // 'admin/users/edit' handled by logic or need explicit? fallback logic handles Params but URL structure here is admin/users/edit/1 -> explode -> admin, users, edit, 1? 
    // No. explode: admin, users, edit, 1.
    // routes['admin']? No.
    // Fallback: AdminController, method users? No. Fallback takes urlParts[0]=admin, urlParts[1]=users.
    // So admin/users/edit/1 -> AdminController::users('edit', '1'). -> Wrong.
    // The fallback logic is: Controller = part[0], Method = part[1].
    // So admin/users/edit/1 -> AdminController -> users. 
    // This is MESSY.
    
    // BETTER FIX: Map 'admin/users' -> AdminController::users.
    // 'admin/courses' -> CourseController::index.
    
    'admin/courses' => ['CourseController', 'index'],
    
    // Teacher Routes
    'teacher/courses' => ['CourseController', 'index'],
    'teacher/courses/create' => ['CourseController', 'create'],
    'teacher/courses/store' => ['CourseController', 'store'],
    'teacher/assignments' => ['AssignmentController', 'index'],
    'teacher/quizzes' => ['QuizController', 'index'],
    'teacher/grades' => ['GradeController', 'index'],
    'teacher/attendance' => ['AttendanceController', 'index'],
    'teacher/attendance/record' => ['AttendanceController', 'record'],
    
    // Student Routes
    'student/courses' => ['CourseController', 'index'],
    'student/assignments' => ['AssignmentController', 'index'],
    'student/quizzes' => ['QuizController', 'index'],
    'student/grades' => ['GradeController', 'index'],
    // Detailed Admin Routes
    'admin/users/edit' => ['AdminController', 'editUser'],
    'admin/users/delete' => ['AdminController', 'deleteUser'],
    
    // Detailed Teacher Routes
    'teacher/courses/view' => ['CourseController', 'view'],
    'teacher/courses/edit' => ['CourseController', 'edit'],
    'teacher/courses/update' => ['CourseController', 'update'],
    'teacher/courses/delete' => ['CourseController', 'delete'],
    // 'teacher/courses/edit' -> CourseController method 'edit'. If it doesn't exist, I need to add it or fix this. CourseController had 'create' and 'view'. No 'edit'.
    // Checking CourseController.. it has no edit(). I should route to 'create' or add 'edit'. 
    // Wait, task list said "Course management (list, create, edit, view)".
    // I likely missed `edit` in CourseController. I will add it later.
    
    'teacher/assignments/view' => ['AssignmentController', 'view'],
    'teacher/assignments/create' => ['AssignmentController', 'create'],
    
    'student/courses/view' => ['CourseController', 'view'],
    'student/assignments/view' => ['AssignmentController', 'view'],
    'student/assignments/submit' => ['AssignmentController', 'submit'], // Maybe in SubmissionController?
    
    // Add missing routes for sub-resources used by new router logic
    'admin/users/create' => ['AdminController', 'createUser'],
];

// Advanced Routing with Prefix Matching
$foundRoute = false;
$params = [];

// 1. Exact Match
if (array_key_exists($url, $routes)) {
    $controllerName = $routes[$url][0];
    $methodName = $routes[$url][1];
    $foundRoute = true;
} else {
    // 2. Prefix Match (Longest match first)
    // Sort routes by length desc to ensure longest prefix matches first
    $routeKeys = array_keys($routes);
    usort($routeKeys, function($a, $b) {
        return strlen($b) - strlen($a);
    });

    foreach ($routeKeys as $routeKey) {
        // If URL starts with routeKey + '/' (to avoid partial word matches like admin/user vs admin/users)
        // OR if URL is exactly routeKey (handled above, but included)
        if (strpos($url, $routeKey . '/') === 0) {
            $controllerName = $routes[$routeKey][0];
            $methodName = $routes[$routeKey][1];
            
            // Extract params
            $remainder = substr($url, strlen($routeKey) + 1);
            $params = explode('/', $remainder);
            $foundRoute = true;
            break; 
        }
    }
}

if (!$foundRoute) {
    // 3. Fallback: /Controller/Method/Params
    if (!empty($urlParts[0])) {
        $controllerName = ucfirst($urlParts[0]) . 'Controller';
        $methodName = isset($urlParts[1]) ? $urlParts[1] : 'index';
        $params = isset($urlParts[2]) ? array_slice($urlParts, 2) : [];
    } else {
        // Should catch empty url earlier, but just in case
        $controllerName = 'AuthController';
        $methodName = 'login';
    }
}

// Log resolution
file_put_contents(__DIR__ . '/debug_log.txt', "Resolved: $controllerName @ $methodName Params: " . implode(',', $params) . "\n", FILE_APPEND);

if (file_exists(APP . '/Controllers/' . $controllerName . '.php')) {
    $controller = new $controllerName();
    if (method_exists($controller, $methodName)) {
        call_user_func_array([$controller, $methodName], $params);
        exit;
    } else {
         require VIEWS . '/errors/404.php';
         file_put_contents(__DIR__ . '/debug_log.txt', "404: Method $methodName not found\n", FILE_APPEND);
    }
} else {
     // Check for 404
     if (file_exists(VIEWS . '/errors/404.php')) {
        require VIEWS . '/errors/404.php';
     } else {
        echo "404 Not Found";
     }
     file_put_contents(__DIR__ . '/debug_log.txt', "404: Controller $controllerName not found\n", FILE_APPEND);
}
