<?php

namespace app\Controller;

/**
 * Class FormHandler
 * Handles the registration form submission.
 */
class FormHandler
{
    /**
     * Handles the registration form submission.
     */
    public function handleRegistrationForm(): void
    {
        // Create an instance of the RegisterController
        $instance = new RegisterController();

        // Check if the form is submitted via POST method
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['formSubmitted'])) {
            // Call the RegisterController to handle the form submission
            $result = $instance->handleFormSubmission();
            // Check if the result is in JSON format and parse it
            $jsonResult = json_decode($result, true);
            // If the result is in JSON format and contains success key
            if ($jsonResult && isset($jsonResult['success'])) {
                // If the registration is successful, display a success message as a JavaScript alert
                if ($jsonResult['success']) {
                    echo '<script>alert("Registration successful. Please take a look on your email: ");</script>';
                } else {
                    // If an error occurred during registration, display an error message as a JavaScript alert
                    echo '<script>alert("Registration failed. Error: ' . $jsonResult['error'] . '");</script>';
                }
            }
        }
    }
}
