<?php
require __DIR__ . "/../../../app/Controller/RegisterController.php";

use app\Controller\RegisterController;

$instance = new RegisterController();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['formSubmitted'])) {
    $result = $instance->handleFormSubmission();
    // Check if the result is in JSON format and parse it
    $jsonResult = json_decode($result, true);
    if ($jsonResult && isset($jsonResult['success'])) {
        // If the result is successful, display a message as a JavaScript alert
        if ($jsonResult['success']) {
            echo '<script>alert("Registration successful. Please take a look on your email: ");</script>';
        } else {
            // If an error occurred, display an error message as a JavaScript alert
            echo '<script>alert("Registration failed. Error: ' . $jsonResult['error'] . '");</script>';
        }
    }
}
?>
<h2>Register form:</h2>
<form action="" method="post">
    <input type="hidden" name="formSubmitted" value="true">
    <div class="form-group">
        <label for="InputEmail">Email address</label>
        <input type="email" class="form-control" id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="InputPassword">Password</label>
        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="InputConfirmPassword">Confirm Password</label>
        <input type="password" class="form-control" id="InputConfirmPassword" name="password2" placeholder="Confirm Password">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </div>
</form>
