<?php
declare(strict_types=1);
require_once __DIR__ . '/../Core/Database.php';

class Post
{
    private PDO $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAll(): array
    {
        $sql = "SELECT posts.id,
                       posts.user_id,
                       posts.module_id,
                       posts.title,
                       posts.body AS content,
                       SUBSTRING_INDEX(posts.image_path, '/', -1) AS image,
                       posts.created_at,
                       users.name AS username,
                       COALESCE(modules.module_name, 'General') AS module_name
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                LEFT JOIN modules ON posts.module_id = modules.id
                ORDER BY posts.created_at DESC";

        $statement = $this->connection->query($sql);
        return $statement->fetchAll();
    }

    public function getById(int $id): array | false
    {
        $sql = "SELECT posts.id,
                       posts.user_id,
                       posts.module_id,
                       posts.title,
                       posts.body AS content,
                       SUBSTRING_INDEX(posts.image_path, '/', -1) AS image,
                       posts.created_at,
                       users.name AS username,
                       COALESCE(modules.module_name, 'General') AS module_name
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                LEFT JOIN modules ON posts.module_id = modules.id
                WHERE posts.id = :id";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function create(
        string $title,
        string $content,
        ?string $image,
        int $userId,
        int $moduleId
    ): bool
    {
        $sql = "INSERT INTO posts
                (user_id, module_id, title, body, image_path)
                VALUES
                (:user_id, :module_id, :title, :body, :image)";
        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ':user_id' => $userId,
            ':module_id' => $moduleId,
            ':title' => $title,
            ':body' => $content,
            ':image' => $image
        ]);
    }

    public function update(
        int $id,
        string $title,
        string $content,
        ?string $image,
        int $userId,
        int $moduleId
    ): bool
    {
        $sql = "UPDATE posts
                SET title = :title,
                    body = :body,
                    image_path = :image,
                    user_id = :user_id,
                    module_id = :module_id
                WHERE id = :id";

        $statement = $this->connection->prepare($sql);
        return $statement->execute([
            ':id' => $id,
            ':title' => $title,
            ':body' => $content,
            ':image' => $image,
            ':user_id' => $userId,
            ':module_id' => $moduleId
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM posts WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function search(string $keyword): array
    {
        $sql = "SELECT posts.id,
                       posts.user_id,
                       posts.module_id,
                       posts.title,
                       posts.body AS content,
                       SUBSTRING_INDEX(posts.image_path, '/', -1) AS image,
                       posts.created_at,
                       users.name AS username,
                       COALESCE(modules.module_name, 'General') AS module_name
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                LEFT JOIN modules ON posts.module_id = modules.id
                WHERE posts.title LIKE :keyword
                   OR posts.body LIKE :keyword
                   OR users.name LIKE :keyword
                   OR modules.module_name LIKE :keyword
                ORDER BY posts.created_at DESC";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':keyword', "%{$keyword}%", PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }
}
