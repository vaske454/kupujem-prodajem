<?php
// Including autoload.php which will automatically load classes using namespaces
require_once "autoload.php";

// Path to the html.php file in the templates/layout directory
$file = "templates/layout/html.php";

// Checking if the file exists and is readable
if (file_exists($file) && is_readable($file)) {
    // Including the html.php file if available
    require $file;
}