<?php

namespace App\Server;

require __DIR__ . '/../../vendor/autoload.php';

session_start();
use App\Database\OpinionService;

$opinion_service = new OpinionService();

if (isset($_POST['write_opinion'])) {
    $user_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['username'];
    $text = $_POST['opinion'];
    $question_id = $_POST['question_id'];

    $saved = $opinion_service->createOpinion($text, $question_id, $user_id,$user_name);
    header('Location: /discussion_board/question_details.php?qId=' . $question_id);
    exit;
}
