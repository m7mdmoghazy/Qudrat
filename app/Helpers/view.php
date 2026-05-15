<?php

/**
 * Render a view file
 * 
 * @param string $view Path to view file (e.g., 'auth/login')
 * @param array $data Data to pass to the view
 * @param string $layout Layout file to use (default: null for no layout)
 */
function view($view, $data = [], $layout = null) {
    // Extract data to make variables available in view
    extract($data);
    
    // Check if view file exists
    $view_file = VIEWS . '/' . $view . '.php';
    
    if (file_exists($view_file)) {
        // Start output buffering
        ob_start();
        
        // Include the view file
        require $view_file;
        
        // Get the content
        $content = ob_get_clean();
        
        // If layout is specified, include it
        if ($layout) {
            require VIEWS . '/layouts/' . $layout . '.php';
        } else {
            echo $content;
        }
    } else {
        if (DEBUG) {
            die("View file not found: " . $view_file);
        } else {
            die("System Error: Page not found.");
        }
    }
}

/**
 * Include a partial view (component)
 */
function component($name, $data = []) {
    extract($data);
    $file = VIEWS . '/components/' . $name . '.php'; // Assuming components folder or direct path
    // If not in components folder, try direct path relative to views
    if (!file_exists($file)) {
        $file = VIEWS . '/' . $name . '.php';
    }
    
    if (file_exists($file)) {
        require $file;
    }
}