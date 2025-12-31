<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: /~sadiulh1");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <?php require_once('./component/links.php'); ?>
</head>

<body>
    <?php require_once('./component/navbar.php'); ?>
    <div class="container">
        <div class="row  mt-5">
            <div class="col-12 col-md-6 mx-auto">

                <?php
                if (isset($_GET['error']) && $_GET['error'] == true) { ?>
                    <div class='alert alert-danger my-2 p-3 text-center'>
                        Something went wrong.
                    </div>
                <?php } ?>
                <h2 class="text-primary lead text-center">Create an Account</h2>
                <form class="shadow p-3" method="post" action="./src/server/register_user.php">
                    <div>
                        <label for="name">Name</label><br />
                        <input type="text" name="name" id="name" class="form-control" required />
                    </div><br />
                    <div>
                        <label for="email">Email</label><br />
                        <input type="email" name="email" id="email" class="form-control" required />
                    </div><br />
                    <div>
                        <label for="password">Password</label><br />
                        <input type="password" name="password" id="password" class="form-control" required />
                    </div><br />
                    <input type="submit" value="Register" name="register_user" class="btn btn-primary">
                    <br />
                    <p>Already have an account? <a href="./login.php">Login Here</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>