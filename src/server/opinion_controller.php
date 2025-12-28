<?php

namespace App\Server;

require __DIR__ . '/../../vendor/autoload.php';

session_start();

use App\Database\OpinionService;

$user_id = $_SESSION['user']['id'];

$opinion_service = new OpinionService();

if (isset($_POST['write_opinion'])) {
    $user_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['username'];
    $text = $_POST['opinion'];
    $question_id = $_POST['question_id'];

    $saved = $opinion_service->createOpinion($text, $question_id, $user_id, $user_name);
    header('Location: /discussion_board/question_details.php?qId=' . $question_id);
    exit;
}

if (isset($_GET['delete_opinion'])) {
    $opinion_id = $_GET['oId'];
    $qid = $_GET['qId'];
    $opinion = $opinion_service->findById($opinion_id);

    if ($opinion['user_id'] != $user_id) {
        header("Location: /discussion_board/question_details.php?qId=$qid&ftdo=true");
        exit;
    }

    $deleted = $opinion_service->deleteById($opinion_id);
    if ($deleted) {
        header("Location: /discussion_board/question_details.php?qId=$qid&sdo=true");
        exit;
    } else {
        header("Location: /discussion_board/question_details.php?qId=$qid&ftdo=true");
        exit;
    }
}
