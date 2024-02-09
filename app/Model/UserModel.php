<?php

namespace app\Model;

use app\Interfaces\DatabaseInterface;
use PDO;

/**
 * Class UserModel
 *
 * This class represents the user model, which interacts with the database
 * to perform user-related operations such as user creation, retrieval,
 * and logging.
 */
class UserModel implements DatabaseInterface
{
    /** @var PDO $pdo The PDO instance */
    private PDO $pdo;

    /**
     * Constructor method.
     *
     * Initializes the PDO instance.
     */
    public function __construct()
    {
        $this->pdo = Database::getInstance()->getPdo();
    }

    /**
     * Creates a new user.
     *
     * @param string $email The email address of the user
     * @param string $password The password of the user
     *
     * @return array An array containing the result of the operation
     */
    public function createUser(string $email, string $password): array
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        try {
            // Check if user with the same email exists
            $existingUser = $this->selectUserByEmail($email);
            if ($existingUser) {
                return ['success' => false, 'error' => 'email_exists'];
            }

            // Create a new user
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $userId = $this->insertUser($email, $passwordHash);

            // Send email
            $this->sendEmail($email);

            // Insert user registration log
            $this->insertUserLog($userId);

            return ['success' => true, 'userId' => $userId];
        } catch (\PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Selects a user by email address.
     *
     * @param string $email The email address of the user
     *
     * @return array|null An array containing the user data if found, null otherwise
     */
    public function selectUserByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            return null; // If user is not found, return null
        }

        return $user;
    }

    /**
     * Inserts a new user into the database.
     *
     * @param string $email The email address of the user
     * @param string $passwordHash The hashed password of the user
     *
     * @return int The ID of the newly inserted user
     */
    public function insertUser(string $email, string $passwordHash): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO user (email, password) VALUES (:email, :password)");
        $stmt->execute(['email' => $email, 'password' => $passwordHash]);
        return $this->pdo->lastInsertId();
    }

    /**
     * Inserts a log entry for user registration.
     *
     * @param int $userId The ID of the user
     *
     * @return void
     */
    public function insertUserLog(int $userId): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_log (action, user_id, log_time) VALUES ('register', :userId, NOW())");
        $stmt->execute(['userId' => $userId]);
    }

    /**
     * Sends an email to the user.
     *
     * @param string $email The email address of the user
     *
     * @return void
     */
    private function sendEmail(string $email): void
    {
        $to = $email;
        $subject = 'Dobro došli';
        $message = 'Dobro dosli na nas sajt. Potrebno je samo da potvrdite email adresu ...';
        $headers = 'From: adm@kupujemprodajem.com' . "\r\n" .
            'Reply-To: adm@kupujemprodajem.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }
}
