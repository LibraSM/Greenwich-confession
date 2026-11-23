<?php
require_once __DIR__ . '/../../config/config.php';

class Database
{
    private $connection;
    
    public function connect()
    {
        if ($this->connection == null) {
            try {
                $dsn = 'mysql:host=' . DB_HOST .
                    ';port=' . DB_PORT .
                    ';dbname=' . DB_NAME .
                    ';charset=utf8mb4';
                $this->connection = new PDO (
                    $dsn,
                    DB_USER,
                    DB_PASS
                );
                $this->connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
                $this->connection->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {
                throw new RuntimeException('Database connection failed:' . $e->getMessage(), 0, $e);
            }
        }

        return $this->connection;
    }
}
