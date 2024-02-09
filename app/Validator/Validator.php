<?php

namespace app\Validator;

/**
 * Class Validator
 *
 * This class provides methods for validating registration form inputs.
 */
class Validator
{
    /**
     * Validates the registration form inputs.
     *
     * @param string $email The email address to validate
     * @param string $password The password to validate
     * @param string $password2 The confirmation password to validate
     * @return array An array indicating the validation result
     */
    public function validateRegistrationForm(string $email, string $password, string $password2): array
    {
        $emailValidationResult = $this->validateEmail($email);
        if (!$emailValidationResult['success']) {
            return $emailValidationResult;
        }

        $passwordValidationResult = $this->validatePassword($password, $password2);
        if (!$passwordValidationResult['success']) {
            return $passwordValidationResult;
        }

        return ['success' => true];
    }

    /**
     * Validates an email address.
     *
     * @param string $email The email address to validate
     * @return array An array indicating the validation result
     */
    private function validateEmail(string $email): array
    {
        if (empty($email)) {
            return ['success' => false, 'error' => 'Email address is required'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'error' => 'Invalid email address format'];
        }

        return ['success' => true];
    }

    /**
     * Validates a password and its confirmation.
     *
     * @param string $password The password to validate
     * @param string $password2 The confirmation password to validate
     * @return array An array indicating the validation result
     */
    private function validatePassword(string $password, string $password2): array
    {
        if (empty($password) || mb_strlen($password) < 8) {
            return ['success' => false, 'error' => 'Password must be at least 8 characters long'];
        }

        if ($password !== $password2) {
            return ['success' => false, 'error' => 'Passwords do not match'];
        }

        return ['success' => true];
    }
}
