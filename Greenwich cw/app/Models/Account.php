<?php
declare(strict_types=1);
require_once __DIR__ . '/../Core/Database.php';

class Account
{
    private PDO $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function create(
        string $username,
        string $email,
        string $password
    ): bool
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password_hash)
                VALUES (:name, :email, :password_hash)";

        $statement = $this->connection->prepare($sql);
        return $statement->execute([
            ':name' => $username,
            ':email' => $email,
            ':password_hash' => $passwordHash
        ]);
    }

    public function getByEmail(string $email): array | false
    {
        $sql = "SELECT id,
                       name AS username,
                       email,
                       password_hash AS password,
                       is_admin,
                       NULL AS profile_image,
                       created_at
                FROM users
                WHERE email = :email";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();

        return $statement->fetch();
    }

    public function emailExists(string $email): bool
    {
        return $this->getByEmail($email) !== false;
    }

    public function getById(int $id): array | false
    {
        $sql = "SELECT id,
                       name AS username,
                       email,
                       password_hash AS password,
                       is_admin,
                       NULL AS profile_image,
                       created_at
                FROM users
                WHERE id = :id";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function getAll(): array
    {
        $sql = "SELECT id,
                       name AS username,
                       email,
                       is_admin,
                       NULL AS profile_image,
                       created_at
                FROM users
                ORDER BY name ASC";

        $statement = $this->connection->query($sql);
        return $statement->fetchAll();
    }

    public function update(
        int $id,
        string $username,
        string $email,
        ?string $profileImage,
        ?string $password = null
    ): bool
    {
        if ($password !== null && $password !== '') {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users
                    SET name = :name,
                        email = :email,
                        password_hash = :password_hash
                    WHERE id = :id";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':password_hash', $passwordHash);
        } else {
            $sql = "UPDATE users
                    SET name = :name,
                        email = :email
                    WHERE id = :id";
            $statement = $this->connection->prepare($sql);
        }

        $statement->bindParam(':name', $username);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        return $statement->execute([':id' => $id]);
    }

    public function emailExistsForOtherUser(string $email, int $id): bool
    {
        $sql = "SELECT id
                FROM users
                WHERE email = :email
                AND id != :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch() !== false;
    }
}
