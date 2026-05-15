<?php

require_once APP . '/Config/Database.php';

class Validation {
    private $db;
    private $errors = [];

    public function __construct() {
        $this->db = Database::connect();
    }

    public function validate($data, $rules) {
        foreach ($rules as $field => $ruleset) {
            $value = isset($data[$field]) ? trim($data[$field]) : null;
            $ruleList = explode('|', $ruleset);

            foreach ($ruleList as $rule) {
                // Parse rule with parameters
                $params = [];
                if (strpos($rule, ':') !== false) {
                    list($rule, $paramStr) = explode(':', $rule);
                    $params = explode(',', $paramStr);
                }

                $methodName = 'validate' . ucfirst($rule);
                if (method_exists($this, $methodName)) {
                    if (!$this->$methodName($value, $field, $params)) {
                        break; // Stop validating this field on first error
                    }
                }
            }
        }
        
        $_SESSION['errors'] = $this->errors;
        $_SESSION['old'] = $data;
        
        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    // --- Validation Rules ---

    private function validateRequired($value, $field, $params) {
        if (empty($value)) {
            $this->errors[$field] = ucfirst($field) . " is required.";
            return false;
        }
        return true;
    }

    private function validateEmail($value, $field, $params) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "Invalid email format.";
            return false;
        }
        return true;
    }

    private function validateMin($value, $field, $params) {
        if (strlen($value) < $params[0]) {
            $this->errors[$field] = ucfirst($field) . " must be at least {$params[0]} characters.";
            return false;
        }
        return true;
    }

    private function validateUnique($value, $field, $params) {
        $table = $params[0];
        $column = isset($params[1]) ? $params[1] : $field;
        
        $sql = "SELECT id FROM $table WHERE $column = :value";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':value' => $value]);
        
        if ($stmt->fetch()) {
            $this->errors[$field] = ucfirst($field) . " already exists.";
            return false;
        }
        return true;
    }
    
    private function validateMatch($value, $field, $params) {
        $otherField = $params[0];
        // We need the original data to match against, but $data is local to validate()
        // Simplification: check against $_POST since we usually validate POST data
        if ($value !== $_POST[$otherField]) {
             $this->errors[$field] = ucfirst($field) . " does not match $otherField.";
             return false;
        }
        return true;
    }
}