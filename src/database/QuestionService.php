<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class QuestionService
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DB::getConnection();
    }

    public function createQuestion(string $title, string $description, string $category, int $userId): bool
    {
        $stmt = $this->connection->prepare("INSERT into question(title,description,category,user_id,created_at) 
        values (:title,:description,:category,:user_id,:created_at)");

        $date = date('Y-m-d H:i:s');
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':category' => $category,
            ':user_id' => $userId,
            ':created_at' => $date
        ]);
    }

    public function findAllByUser(int $userId): array
    {
        $stmt = $this->connection->prepare("SELECT * from question where user_id = :user_id");
        $stmt->execute([
            ':user_id' => $userId
        ]);
        return $stmt->fetchAll();
    }

    public function findById(int $id): array
    {
        $stmt = $this->connection->prepare("SELECT * from question where id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch();
    }

    public function deleteById(int $id): bool
    {
        $stmt = $this->connection->prepare("delete from question where id = :id");
        return $stmt->execute([
            ':id' => $id
        ]);
    }

    public function findAllOrderByDate(): array
    {
        $stmt = $this->connection->prepare("SELECT * from question order by created_at desc");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
