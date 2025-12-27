<?php
session_start();

if ($_SESSION['user']['email']) {
    header("Location: /discussion_board");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require_once('./component/links.php'); ?>
</head>

<body>
    <?php require_once('./component/navbar.php'); ?>
    <div class="container">
        <div class="row  mt-5">
            <div class="col-12 col-md-6 mx-auto">
                <?php
                if (isset($_GET['registerSuccessful']) && $_GET['registerSuccessful'] == true) { ?>
                    <div class='alert alert-success my-2 p-3 text-center'>
                        You are successfully register. Please login.
                    </div>
                <?php } ?>

                <?php if (isset($_GET['error']) && $_GET['error'] == true) { ?>
                    <div class='alert alert-danger my-2 p-3 text-center'>
                        Login attempt failed, please try again!
                    </div>
                <?php } ?>

                <h2 class="text-primary lead text-center">Login to Account</h2>
                <form class="mx-auto shadow p-3" method="post" action="./src/server/login_user.php">
                    <div>
                        <label for="email">Email</label><br />
                        <input type="email" name="email" id="email" class="form-control" required />
                    </div><br />
                    <div>
                        <label for="password">Password</label><br />
                        <input type="password" name="password" id="password" class="form-control" required />
                    </div><br />
                    <input type="submit" value="Login" name="login_user" class="btn btn-primary">
                    <br />
                    <p>Don't have an account yet? <a href="./register.php">Register Here</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>