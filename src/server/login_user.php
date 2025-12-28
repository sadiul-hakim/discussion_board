<?php

declare(strict_types=1);

namespace App\Server;

require __DIR__ . '/../../vendor/autoload.php';

use App\Database\UserService;

session_start();

if (isset($_POST) && isset($_POST['login_user'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_service = new UserService();
    $user = $user_service->findUser($email);
    if ($user && $user['password'] === $password) {
        $_SESSION['user'] = ['username' => $user['name'], 'email' => $user['email'], 'id' => $user['id']];
        header("Location: /discussion_board");
        exit;
    } else {
        header("Location: /discussion_board/login.php?error=true");
        exit;
    }
}
