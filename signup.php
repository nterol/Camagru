<?php
session_start();
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style/parts.css">
    <link rel="stylesheet" type="text/css" href="style/forms.css">

    <title>Sign Up</title>
</head>

<body>
    <?php include('./parts/header.php') ?>
    <div class="body-forms">
        <div class="title-forms">
            <h1>SIGN UP !</h1>
        </div>
        <div class="container signup">
            <form method="post" action="forms/signup_check.php">
                <label>Email</label>
                <input id="mail" name="email" type="mail" size="30">
                <label>Username</label>
                <input id="username" name="username" type="text" size="30">
                <label>Password</label>
                <input id="password" name="password" type="password" size="30">
                <input name="submit" type="submit" value="Send">
                <span>
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            $_SESSION['error'] = null;
                        } else if (isset($_SESSION['signup_success'])) {
                            echo "Hey welcome ! Please check your mails to verify your account";
                            $_SESSION['signup_success'] = null;
                        }
                    ?>
                </span>
            </form>
        </div>
    </div>
    <?php include('./parts/footer.php') ?>
</body>
</html>
