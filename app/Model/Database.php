<?php

namespace app\Model;

use PDO;

/**
 * Class Database
 *
 * This class represents a database connection.
 */
class Database
{
    /** @var Database|null The instance of the Database class */
    private static ?Database $instance = null;

    /** @var PDO The PDO object used for database connection */
    private PDO $pdo;

    /**
     * Private constructor to prevent instantiation from outside the class.
     */
    private function __construct()
    {
        // Set up the PDO connection here
        $this->pdo = new PDO("mysql:host=db;dbname=db", "db", "db");
    }

    /**
     * Returns an instance of the Database class.
     *
     * @return Database|null The Database instance
     */
    public static function getInstance(): ?Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    /**
     * Retrieves the PDO object for the database connection.
     *
     * @return PDO The PDO object
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
