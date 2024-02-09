<?php

namespace app\Model;

class UserModel
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getPdo();
    }

    public function createUser($email, $password): array
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        try {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user) {
                return ['success' => false, 'error' => 'email_exists'];
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare("INSERT INTO user (email, password) VALUES (:email, :password)");
            $stmt->execute(['email' => $email, 'password' => $passwordHash]);
            $userId = $this->pdo->lastInsertId();

            $this->sendEmail($email);

            $stmt = $this->pdo->prepare("INSERT INTO user_log (action, user_id, log_time) VALUES ('register', :userId, NOW())");
            $stmt->execute(['userId' => $userId]);

            return ['success' => true, 'userId' => $userId];
        } catch (\PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    private function sendEmail($email): void
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
