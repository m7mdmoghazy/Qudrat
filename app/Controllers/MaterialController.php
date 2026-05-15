<?php

class MaterialController {

    private $materialModel;

    public function __construct() {
        (new AuthMiddleware())->handle();
        $this->materialModel = new Material();
    }
    
    // Teacher methods to upload are likely in CourseController or here. Plan said MaterialController (view) in Student features.
    // But Teacher also needs to create.
    // I'll add create() for teacher here too.
    
    public function store() {
        (new TeacherMiddleware())->handle();
        if (is_post()) {
             // ... Logic to store material similar to assignment
             // $this->materialModel->create($data);
             // redirect ...
        }
    }

    public function download($id) {
        // Verify access (enrolled or teacher)
        // Serve file
    }
}
