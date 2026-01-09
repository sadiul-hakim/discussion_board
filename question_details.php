<?php session_start();
    require __DIR__ . '/vendor/autoload.php';

    if (!isset($_GET['qId'])) {
        header('Location: /~sadiulh1');
        exit;
    }

    use App\Database\QuestionService;
    use App\Database\OpinionService;

    $question_service = new QuestionService();
    $opinion_service = new OpinionService();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussion Board</title>
    <?php require_once('./component/links.php'); ?>
</head>

<body>
    <?php

    $user_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
    $question = $question_service->findById($_GET['qId']);
    $opinions = $opinion_service->findAllByQuestion($question['id']);


    require_once('./component/navbar.php');
    ?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12 col-md-8 mx-auto">

                <?php
                if (isset($_GET['sdo']) && $_GET['sdo'] == true) { ?>
                    <div class='alert alert-success my-2 p-3 text-center'>
                        Successfully deleted the opinion.
                    </div>
                <?php } ?>

                <?php if (isset($_GET['ftdo']) && $_GET['ftdo'] == true) { ?>
                    <div class='alert alert-danger my-2 p-3 text-center'>
                        Failed to delete opinion!
                    </div>
                <?php } ?>

                <h1 class="text-primary text-center my-2">Question</h1>
                <div class="shadow p-2">
                    <p class="text-primary lead my-2">
                        <?php echo $question['title'] ?>
                    </p>
                    <p class="text-muted">
                        <?php echo $question['description'] ?>
                    </p>
                    <?php
                    if ($user_id != 0) {
                    ?>
                        <form action="./src/server/opinion_controller.php" class="mt-1" method="post">
                            <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                            <textarea name="opinion" id="opinion" placeholder="Write an opinion.." class="form-control"></textarea><br />
                            <input type="submit" value="Write" name="write_opinion" class="btn btn-primary">
                        </form>
                    <?php } ?>
                </div>

                <br />
                <?php foreach ($opinions as $opinion) { ?>
                    <div class="shadow my-1 p-3">
                        <div class="d-flex justify-content-between">
                            <h4 class="text-primary"><?php echo $opinion['user_name'] ?></h4>
                            <?php
                            if ($user_id == $opinion['user_id']) {
                            ?>
                                <a
                                    href="./src/server/opinion_controller.php?delete_opinion=true&oId=<?php echo $opinion['id']; ?>&qId=<?php echo $question['id']; ?>"
                                    class="text-decoration-none btn btn-danger text-light">Delete</a>
                            <?php } ?>
                        </div>
                        <p class="lead text-muted"><?php echo $opinion['text'] ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>