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
    require __DIR__ . '/vendor/autoload.php';
    session_start();

    if (!isset($_GET['qId'])) {
        header('Location: /discussion_board');
        exit;
    }

    use App\Database\QuestionService;
    use App\Database\OpinionService;

    $question_service = new QuestionService();
    $opinion_service = new OpinionService();
    $question = $question_service->findById($_GET['qId']);
    $opinions = $opinion_service -> findAllByQuestion($question['id']);


    require_once('./component/navbar.php');
    ?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12 col-md-8 mx-auto">
                <h1 class="text-primary text-center my-2">Question</h1>
                <div class="shadow p-2">
                    <p class="text-primary lead my-2">
                        <?php echo $question['title'] ?>
                    </p>
                    <p class="text-muted">
                        <?php echo $question['description'] ?>
                    </p>
                    <form action="./src/server/opinion_controller.php" class="mt-1" method="post">
                        <input type="hidden" name="question_id" value="<?php echo $question['id'];?>">
                        <textarea name="opinion" id="opinion" placeholder="Write an opinion.." class="form-control"></textarea><br />
                        <input type="submit" value="Write" name="write_opinion" class="btn btn-primary">
                    </form>
                </div>

                <br/>
                <?php foreach($opinions as $opinion){?>
                    <div class="shadow my-1 p-3">
                        <h4 class="text-primary"><?php echo $opinion['user_name']?></h4>
                        <p class="lead text-muted"><?php echo $opinion['text']?></p>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</body>

</html>