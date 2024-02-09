<?php

namespace app\Interfaces;

/**
 * Interface DatabaseInterface
 *
 * This interface defines the methods required for database interaction in the UserModel.
 */
interface DatabaseInterface
{
    /**
     * Selects a user by email address.
     *
     * @param string $email The email address of the user
     *
     * @return array|null An array containing the user data if found, null otherwise
     */
    public function selectUserByEmail(string $email): ?array;

    /**
     * Inserts a new user into the database.
     *
     * @param string $email The email address of the user
     * @param string $passwordHash The hashed password of the user
     *
     * @return int The ID of the newly inserted user
     */
    public function insertUser(string $email, string $passwordHash): int;

    /**
     * Inserts a log entry for user registration.
     *
     * @param int $userId The ID of the user
     *
     * @return void
     */
    public function insertUserLog(int $userId): void;
}
