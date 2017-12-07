<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <header>
  <link rel="stylesheet" type="text/css" href="style/parts.css">
    <link rel="stylesheet" type="text/css" href="style/forms.css">

    <title>Password Forgot</title>
  </header>
  <body>
    <?php include('./parts/header.php') ?>
    <div class="body-forms">
      <div class="title-forms">
        <h1>FORGOT</h1>
      </div>
      <div class="container forgot">
        <form method="post" action="forms/forgot.php">
          <label>Email</label>
          <input id="mail" name="email" type="mail" size="30">
          <input name="submit" type="submit" value="Send">
          <span>
            <?php
            echo $_SESSION['error'];
            $_SESSION['error'] = null;
            if (isset($_SESSION['forgot_success'])) {
            echo "Hold on tight fella, an email has been sent to your address";
            $_SESSION['forgot_success'] = null;
            }
            ?>
          </span>
        </form>
      </div>
    </div>
    <?php include("./parts/footer.php") ?>
  </body>
</html>
