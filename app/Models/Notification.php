<?php

require_once APP . '/Config/Database.php';

class Notification {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Create notification
     */
    public function create($userId, $title, $message) {
        $sql = "INSERT INTO notifications (user_id, title, message) VALUES (:user_id, :title, :message)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':title' => $title,
            ':message' => $message
        ]);
    }

    /**
     * Get user notifications
     */
    public function getUserNotifications($userId, $limit = 5) {
        $sql = "SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Mark as read
     */
    public function markAsRead($id) {
        $sql = "UPDATE notifications SET is_read = 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
