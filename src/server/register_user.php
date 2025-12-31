<?php

declare(strict_types=1);

namespace App\Server;

require __DIR__ . '/../../vendor/autoload.php';

use App\Database\UserService;

if (isset($_POST) && isset($_POST['register_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_service = new UserService();

    $saved = $user_service->registerUser($name, $email, $password);
    if ($saved) {
        header("Location: /~sadiulh1/login.php?registerSuccessful=true");
        exit;
    } else{
         header("Location: /~sadiulh1/register.php?error=true");
        exit;
    }
}
