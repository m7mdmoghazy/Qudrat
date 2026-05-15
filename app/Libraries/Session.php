<?php

class Session {
    public static function init() {
        if (session_status() == PHP_SESSION_NONE) {
            // Set session cookie parameters for security
            session_set_cookie_params([
                'lifetime' => 0, // Until browser closes
                'path' => '/',
                'domain' => '',
                'secure' => false, // Set to true if using HTTPS
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            session_start();
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function has($key) {
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy() {
        session_destroy();
        $_SESSION = [];
    }

    /**
     * Flash message (set message to be shown once)
     */
    public static function setFlash($type, $message) {
        $_SESSION['flash'] = [
            'type' => $type, // success, error, warning, info
            'message' => $message
        ];
    }

    /**
     * Get and clear flash message
     */
    public static function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function isAdmin() {
        return self::isLoggedIn() && $_SESSION['user_role'] === 'admin';
    }

    public static function isTeacher() {
        return self::isLoggedIn() && $_SESSION['user_role'] === 'teacher';
    }

    public static function isStudent() {
        return self::isLoggedIn() && $_SESSION['user_role'] === 'student';
    }
}