<?php

namespace app\Model;

class Database
{
    private static ?Database $instance = null;
    private \PDO $pdo;

    private function __construct()
    {
        // Set up the PDO connection here
        $this->pdo = new \PDO("mysql:host=db;dbname=db", "db", "db");
    }

    public static function getInstance(): ?Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }
}
