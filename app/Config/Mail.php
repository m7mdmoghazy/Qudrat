<?php

require_once 'Constants.php';

class MailConfig {
    public static function getSettings() {
        global $config;
        return [
            'host' => $config['mail']['smtp_host'],
            'port' => $config['mail']['smtp_port'],
            'username' => $config['mail']['smtp_user'],
            'password' => $config['mail']['smtp_pass'],
            'from_email' => $config['mail']['from_email'],
            'from_name' => $config['mail']['from_name']
        ];
    }
}
