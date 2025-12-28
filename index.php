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
    use App\Database\QuestionService;
    use App\Database\CategoryService;

    $question_service = new QuestionService();
    $category_service = new CategoryService();
    
    $questions = $question_service->findAllOrderByDate();
    $categories = $category_service -> findAll();

    require_once('./component/navbar.php');
    ?>
    <div class="container">
        <?php
        if (isset($_GET['question_added']) && $_GET['question_added'] == true) { ?>
            <div class='alert alert-success my-2 p-3 text-center'>
                Your question is successfully added.
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-12 col-md-8">
                <h1 class="text-center my-2">Latest Questions</h1>
                <?php foreach ($questions as $question) { ?>

                    <div class="shadow my-1 p-2">
                        <a href="./question_details.php?qId=<?php echo $question['id'];?>" class="text-primary lead text-decoration-none">
                            <?php echo $question['title']; ?>
                        </a>
                    </div>

                <?php } ?>
            </div>
            <div class="col-12 col-md-4">
                <h1 class="text-center my-2">Categories</h1>
                <?php foreach ($categories as $category) { ?>

                    <div class="shadow my-1 p-2">
                        <a href="./questions_per_category.php?category=<?php echo $category['title'];?>" class="text-primary lead text-decoration-none">
                            <?php echo $category['title']; ?>
                        </a>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>