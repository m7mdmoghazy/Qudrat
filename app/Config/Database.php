<?php

require_once 'Constants.php';

class Database {
    private static $connection = null;

    private function __construct() {
        // Private constructor to prevent instantiation
    }

    public static function connect() {
        if (self::$connection === null) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHAR;
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                
                self::$connection = new PDO($dsn, DB_USER, DB_PASS, $options);
                
            } catch (PDOException $e) {
                if (DEBUG) {
                    die("Database Connection Error: " . $e->getMessage());
                } else {
                    die("System Error: Could not connect to the database.");
                }
            }
        }
        return self::$connection;
    }

    // Method to close connection (optional as PHP does it automatically)
    public static function close() {
        self::$connection = null;
    }
}