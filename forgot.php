<?php
session_start();
?>

<!DOCTYPE html>
<html>
<header>
  <link rel="stylesheet" type="text/css" href="style/index.css">
  <title>Camagru - forgot</title>
</header>
<body>
  <div id="login">
    <div class="title">FORGOT</div>
    <form method="post" action="forms/forgot.php">
      <input id="mail" name="email" type="mail">
      <input name="submit" type="submit" value="Send">
    </form>
  </div>
  <?php
  echo $_SESSION['error'];
  $_SESSION['error'] = null;
  if (isset($_SESSION['forgot_success'])) {
      echo "Hold on tight fella, an email has been sent to your address";
      $_SESSION['forgot_success'] = null;
  }
  ?>
</body>
</html>
