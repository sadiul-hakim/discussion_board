<?php

namespace App\Database;

use PDO;
use PDOException;

class DB{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO {

        if (self::$connection === null) {
            $host = "localhost:3307";
            $db = "discussion_board";
            $user = "root";
            $pass = "hakim@123";
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

            try {
                self::$connection = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]);
            } catch (PDOException $e) {
                die("DB connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}