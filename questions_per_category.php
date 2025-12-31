<?php session_start();
    require __DIR__ . '/vendor/autoload.php';

    if (!isset($_GET['category'])) {
        header('Location: /~sadiulh1');
        exit;
    }

    use App\Database\QuestionService;

    $question_service = new QuestionService();
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

    $questions = $question_service->findAllByCategory($_GET['category']);
    require_once('./component/navbar.php');
    ?>

    <div class="container">
        <div class="row mt-4">
            <div class="col-12 col-md-8 mx-auto">
                <h1 class="text-center my-2">Questions about <?php echo $_GET['category'];?></h1>
                <?php foreach ($questions as $question) { ?>

                    <div class="shadow my-1 p-2">
                        <a href="./question_details.php?qId=<?php echo $question['id']; ?>" class="text-primary lead text-decoration-none">
                            <?php echo $question['title']; ?>
                        </a>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>