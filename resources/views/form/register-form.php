<?php
require __DIR__ . "/../../app/Controller/RegisterController.php";

use app\Controller\RegisterController;

$instance = new RegisterController();

?>
<h2>Register form:</h2>
<form action="<?= $instance->handleFormSubmission(); ?>" method="post">
    <div class="form-group">
        <label for="InputEmail">Email address</label>
        <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="InputPassword">Password</label>
        <input type="password" class="form-control" id="InputPassword" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="InputConfirmPassword">Confirm Password</label>
        <input type="password" class="form-control" id="InputConfirmPassword" placeholder="Confirm Password">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </div>
</form>