<?php

session_start();
require __DIR__ . '/vendor/autoload.php';

use App\Database\CategoryService;

$category_service = new CategoryService();
$categories = $category_service->findAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask a Question</title>
    <?php require_once('./component/links.php'); ?>
</head>

<body>
    <?php

    if (!isset($_SESSION['user'])) {
        header('Location: /~sadiulh1/login.php');
        exit;
    }

    require_once('./component/navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">

                <?php if (isset($_GET['error']) && $_GET['error'] == true) { ?>
                    <div class='alert alert-danger my-2 p-3 text-center'>
                        Could not add the question. Please try again.
                    </div>
                <?php } ?>
                <h2 class="text-center my-2">Ask a Question</h2>

                <form action="./src/server/question_controller.php" class="shadow mt-2 p-3" method="post">
                    <div>
                        <label for="title">Title</label><br />
                        <input type="text" name="title" id="title" class="form-control" required />
                    </div><br />
                    <div>
                        <label for="category">Category</label><br />
                        <select name="category" id="category" class="form-control">
                            <?php
                            foreach ($categories as $category) { ?>
                                <option value="<?php echo $category['title']; ?>"><?php echo $category['title']; ?></option>
                            <?php } ?>
                        </select>
                    </div><br />
                    <div>
                        <label for="description">Description</label><br />
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div><br />
                    <input type="submit" value="Ask" name="ask_question" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>

</html>