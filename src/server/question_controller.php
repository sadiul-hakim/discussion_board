<?php

namespace App\Server;

require __DIR__ . '/../../vendor/autoload.php';

use App\Database\QuestionService;
use App\Database\OpinionService;

$question_service = new QuestionService();
$opinion_service = new OpinionService();

session_start();
$user_id = $_SESSION['user']['id'];

if (isset($_POST) && isset($_POST['ask_question'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $saved = $question_service->createQuestion($title, $description, $category, $user_id);

    if ($saved) {
        header('Location: /discussion_board?question_added=true');
        exit;
    } else {
        header('Location: /discussion_board/ask_question.php?error=true');
        exit;
    }
}

if (isset($_GET['delete_question']) && $_GET['delete_question'] == true) {
    $qId = $_GET['qId'];
    $question = $question_service->findById($qId);
    if ($question['user_id'] != $user_id) {
        header('Location: /discussion_board/my_questions.php?error=true');
        exit;
    }

    $opinion_service->deleteAllByQuestionId($qId);
    $deleted = $question_service->deleteById($qId);

    if ($deleted) {
        header('Location: /discussion_board/my_questions.php?success=true');
        exit;
    }
}
