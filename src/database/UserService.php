<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class UserService
{
    private PDO $connection;

    public function __construct()
    {
        // use is only needed when you want to reference a class from another namespace.
        // Both DB and UserService are in namespace database;
        $this->connection = DB::getConnection();
    }

    public function registerUser(string $name, string $email, string $password): bool {
        $stmt = $this->connection->prepare(
            "INSERT INTO user(name,email,password,join_date) VALUES(:name,:email,:password,:join_date)"
        );
        $date = date('Y-m-d H:i:s');
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
            ':join_date' => $date
        ]);
    }
}
