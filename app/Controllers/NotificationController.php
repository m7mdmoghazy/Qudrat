<?php

class NotificationController {
    
    private $notificationModel;

    public function __construct() {
        (new AuthMiddleware())->handle();
        $this->notificationModel = new Notification();
    }

    public function index() {
        // AJAX usually fetches this
        $notifications = $this->notificationModel->getUserNotifications(Session::get('user_id'));
        echo json_encode($notifications);
    }

    public function read($id) {
        $this->notificationModel->markAsRead($id);
    }
}
