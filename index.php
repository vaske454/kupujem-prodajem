<?php
$file = "templates/layout/html.php";
if (file_exists($file) && is_readable($file)) {
    require $file;
}