<?php

// Define an anonymous function that serves as an autoload function
spl_autoload_register(function ($class) {
    // Convert the class name to a file path
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

    // Check if the file exists and include it if it does
    if (file_exists($file)) {
        require_once $file;
    }
});
