<?php
session_start();
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style/parts.css">
    <link rel="stylesheet" type="text/css" href="style/test.css">

    <title>Sign Up</title>
</head>

<body>
<div class="titre-forms">
            <h1>SIGN UP !</h1>
        </div>
        <div class="container">
        <form method="post" action="forms/signup_check.php">
            <label>Email</label>
            <input id="mail" name="email" type="mail">             <label>Username</label>
                <input id="username" name="username" type="text">
                <label>Password</label>
                <input id="password" name="password" type="password">
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
        <?php include('./parts/footer.php') ?>
    </div>
</body>

</html>
