<?php

/**
 * Dump and die for debugging
 */
function dd($data) {
    if (DEBUG) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
    }
}

/**
 * Redirect to a specific URL
 */
function redirect($url) {
    if (!headers_sent()) {
        header("Location: " . APP_URL . '/' . ltrim($url, '/'));
        exit;
    }
}

/**
 * Sanitize input data
 */
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

/**
 * Get current date time
 */
function now() {
    return date('Y-m-d H:i:s');
}

/**
 * Format date
 */
function format_date($date, $format = 'd M Y') {
    return date($format, strtotime($date));
}

/**
 * Check if request is POST
 */
function is_post() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Get old input value
 */
function old($key) {
    return isset($_SESSION['old'][$key]) ? $_SESSION['old'][$key] : '';
}

/**
 * Get validation error
 */
function error($key) {
    return isset($_SESSION['errors'][$key]) ? $_SESSION['errors'][$key] : '';
}