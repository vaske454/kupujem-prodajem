<?php

namespace app\Validator;

class Validator
{
    public function validateRegistrationForm($email, $password, $password2): array
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

    private function validateEmail($email): array
    {
        if (empty($email)) {
            return ['success' => false, 'error' => 'Email address is required'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'error' => 'Invalid email address format'];
        }

        return ['success' => true];
    }

    private function validatePassword($password, $password2): array
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
