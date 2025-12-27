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
    session_start();
    require_once('./component/navbar.php'); ?>
    <div class="container">
        <?php
        if (isset($_GET['question_added']) && $_GET['question_added'] == true) { ?>
            <div class='alert alert-success my-2 p-3 text-center'>
                Your question is successfully added.
            </div>
        <?php } ?>
    </div>
</body>

</html>