<?php

namespace App\Server;

require __DIR__ . '/../../vendor/autoload.php';

use App\Database\QuestionService;
use App\Database\UserService;

if (isset($_POST) && isset($_POST['ask_question'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $question_service = new QuestionService();
    $user_service = new UserService();

    session_start();
    $userEmail = $_SESSION['user']['email'];
    $user = $user_service -> findUser($userEmail);
    $saved = $question_service -> createQuestion($title,$description,$category,$user['id']);

    if($saved){
        header('Location: /discussion_board?question_added=true');
        exit;
    } else{
        header('Location: /discussion_board/ask_question.php?error=true');
        exit;
    }
}
