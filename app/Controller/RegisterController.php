<?php
// app/Controller/RegisterController.php

namespace app\Controller;

use app\Model\UserModel;
use app\Validator\Validator;

class RegisterController
{
    public function handleFormSubmission()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['formSubmitted'])) {
            return;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';

        // Validacija unetih podataka
        $validator = new Validator();
        $validationResult = $validator->validateRegistrationForm($email, $password, $password2);

        if (!$validationResult['success']) {
            return json_encode($validationResult);
        }

        // Upisivanje novog korisnika u bazu podataka
        $userModel = new UserModel();
        $registrationResult = $userModel->createUser($email, $password);

        return json_encode($registrationResult);
    }
}
