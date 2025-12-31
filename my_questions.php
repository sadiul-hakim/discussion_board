<?php session_start();
    require __DIR__ . '/vendor/autoload.php';

    if (!isset($_SESSION['user'])) {
        header('Location: /~sadiulh1/login.php');
    }

    use App\Database\QuestionService;

    $question_service = new QuestionService();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Questions</title>
    <?php require_once('./component/links.php'); ?>
</head>

<body>
    <?php

    $user_id = $_SESSION['user']['id'];
    $questions = $question_service->findAllByUser($user_id);
    require_once('./component/navbar.php');
    ?>

    <div class="container">
        <div class="row mt-4">
            <div class="col-12 col-md-8 mx-auto">

                <?php
                if (isset($_GET['success']) && $_GET['success'] == true) { ?>
                    <div class='alert alert-success my-2 p-3 text-center'>
                        Successfully deleted the question.
                    </div>
                <?php } ?>

                <?php if (isset($_GET['error']) && $_GET['error'] == true) { ?>
                    <div class='alert alert-danger my-2 p-3 text-center'>
                        Failed to delete question!
                    </div>
                <?php } ?>

                <h1 class="text-center my-2">My Questions</h1>
                <?php foreach ($questions as $question) { ?>

                    <div class="shadow my-1 p-2 d-flex justify-content-between">
                        <a href="./question_details.php?qId=<?php echo $question['id'];?>" class="text-primary lead text-decoration-none">
                            <?php echo $question['title']; ?>
                        </a>
                        <a href="./src/server/question_controller.php?delete_question=true&qId=<?php echo $question['id'];?>" class="text-decoration-none btn btn-danger text-light">Delete</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</body>

</html>