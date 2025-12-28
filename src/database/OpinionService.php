<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class OpinionService
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DB::getConnection();
    }

    public function createOpinion(string $text, int $question_id, int $user_id,string $user_name): bool
    {
        $stmt = $this->connection->prepare("INSERT into opinion(text,question_id,user_id,user_name,created_at) values (:text,:question_id,:user_id,:user_name,:created_at)");
        $date = date('Y-m-d H:i:s');
        return $stmt->execute([
            ':text' => $text,
            ':question_id' => $question_id,
            ':user_id' => $user_id,
            ':user_name' => $user_name,
            ':created_at' => $date
        ]);
    }

    public function findById(int $id): array
    {
        $stmt = $this->connection->prepare("SELECT * from opinion where id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch();
    }

    public function deleteById(int $id): array
    {
        $stmt = $this->connection->prepare("delete from opinion where id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch();
    }

    public function findAllByQuestion(int $question_id): array
    {
        $stmt = $this->connection->prepare("SELECT * from opinion where question_id = :question_id");
        $stmt->execute([
            ':question_id' => $question_id
        ]);
        return $stmt->fetchAll();
    }
}
