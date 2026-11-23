<?php
declare(strict_types=1);
require_once __DIR__ . '/../Core/Database.php';

class Module
{
    private PDO $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAll(): array
    {
        $sql = "SELECT id, module_name
                FROM modules
                ORDER BY module_name ASC";
        $statement = $this->connection->query($sql);

        return $statement->fetchAll();
    }

    public function getById(int $id): array | false
    {
        $sql = "SELECT id, module_name
                FROM modules
                WHERE id = :id";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function create(string $moduleName): bool
    {
        $sql = "INSERT INTO modules (module_name)
                VALUES (:module_name)";
        $statement = $this->connection->prepare($sql);
        return $statement->execute([
            ':module_name' => $moduleName
        ]);
    }

    public function update(int $id, string $moduleName): bool
    {
        $sql = "UPDATE modules
                SET module_name = :module_name
                WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        return $statement->execute([
            ':id' => $id,
            ':module_name' => $moduleName
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM modules WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        return $statement->execute([':id' => $id]);
    }
}
