<?php

class Upload {
    private $errors = [];

    public function process($file, $destination = 'uploads') {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->errors[] = "Upload failed with error code: " . $file['error'];
            return false;
        }

        // Limit size
        if ($file['size'] > MAX_UPLOAD_SIZE) {
            $this->errors[] = "File is too large. Max size is " . (MAX_UPLOAD_SIZE / 1024 / 1024) . "MB.";
            return false;
        }

        // Check type
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ALLOWED_FILE_TYPES)) {
            $this->errors[] = "Invalid file type. Allowed: " . implode(', ', ALLOWED_FILE_TYPES);
            return false;
        }

        // Generate unique name
        $filename = uniqid() . '.' . $ext;
        $targetDir = UPLOAD_PATH . '/' . $destination;
        
        // Create dir if not exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . '/' . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return 'uploads/' . $destination . '/' . $filename; // Return relative path for DB
        } else {
            $this->errors[] = "Failed to move uploaded file.";
            return false;
        }
    }

    public function getErrors() {
        return $this->errors;
    }
}
