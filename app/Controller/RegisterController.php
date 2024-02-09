<?php

namespace app\Controller;

use app\Model\UserModel;
use app\Validator\Validator;

/**
 * Class RegisterController
 *
 * This class handles the form submission for user registration.
 */
class RegisterController
{
    /**
     * Handles the form submission for user registration.
     *
     * @return string|null A JSON-encoded string representing the registration result, or null if the request method is not POST or the formSubmitted parameter is not set
     */
    public function handleFormSubmission(): ?string
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['formSubmitted'])) {
            return null;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';

        // Validate input data
        $validator = new Validator();
        $validationResult = $validator->validateRegistrationForm($email, $password, $password2);

        if (!$validationResult['success']) {
            return json_encode($validationResult);
        }

        // Insert new user into the database
        $userModel = new UserModel();
        $registrationResult = $userModel->createUser($email, $password);

        return json_encode($registrationResult);
    }
}
