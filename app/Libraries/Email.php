<?php

require_once APP . '/Config/Mail.php';

class Email {
    public static function send($to, $subject, $body) {
        $settings = MailConfig::getSettings();
        
        // For development/XAMPP without SMTP server, we might just log it or rely on PHP's mail() configured with sendmail
        // Or essentially, just return true and log content for checking
        
        if (ENV === 'development') {
            // Log email to file
            $log = "[" . date('Y-m-d H:i:s') . "] To: $to | Subject: $subject\n$body\n\n";
            file_put_contents(ROOT . '/email.log', $log, FILE_APPEND);
            return true;
        }

        $headers = "From: " . $settings['from_name'] . " <" . $settings['from_email'] . ">\r\n";
        $headers .= "Reply-To: " . $settings['from_email'] . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        return mail($to, $subject, $body, $headers);
    }
}
