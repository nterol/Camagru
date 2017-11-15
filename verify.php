<?php
session_start();
include_once './functions/get_verify.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>CAMAGRU - VERIFY</title>
</head>
<body>
  <div id="login">
  <div class="title">VERIFY</div>
  <?php
  if (get_verify($_GET["token"]) == 0) {
      ?>
    <strong>
      C'est bon tu es vérifié !
    </strong>
    <br/>
    <a href="./gallery.php">Connexion</a>
    <?php
  } else {
      ?>
    <strong>
      Wesh pelo y a eu un piti souci
    </strong>
    <?php
  } ?>
  </div>
</body>
</html>
