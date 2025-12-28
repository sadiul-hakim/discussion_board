<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class CategoryService
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DB::getConnection();
    }

    public function createCategory($title, $description): bool
    {
        $stmt = $this->connection->prepare("INSERT into category(title,description) values (:title,:description)");
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description
        ]);
    }

    public function findAll(): array
    {
        $stmt = $this->connection->prepare("SELECT * from category");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findCategoryByTitle($title): array
    {
        $stmt = $this->connection->prepare(
            "SELECT * from category where title = :title"
        );

        $stmt->execute([':title' => $title]);
        return $stmt->fetch();
    }
}
