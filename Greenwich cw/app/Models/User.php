<?php
declare(strict_types=1);
require_once __DIR__ . '/../Core/Database.php';

class User
{
    private \PDO $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAll(): array
    {
        $sql = "SELECT *
                FROM users
                ORDER BY username ASC";
        $statement = $this->connection->query($sql);
        return $statement->fetchAll();
    }

    public function getById(int $id): array | false
    {
        $sql = "SELECT *
                FROM users
                WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function create(string $username, string $email): bool
    {
        $sql = "INSERT INTO users (username, email)
                VALUES (:username, :email)";
        $statement = $this->connection->prepare($sql);
        return $statement->execute([
            ':username' => $username,
            ':email' => $email
        ]);
    }

    public function update(int $id, string $username, string $email): bool
    {
        $sql = "UPDATE users
                SET username = :username,
                    email = :email
                WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        return $statement->execute([
            ':id' => $id,
            ':username' => $username,
            ':email' => $email
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM users
                WHERE id = :id";
        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ':id' => $id
        ]);
    }
}