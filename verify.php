<?php
session_start();
include_once './functions/get_verify.php';
?>

<!DOCTYPE html>
<html>
  <link rel="stylesheet" type="text/css" href="style/forms.css">
<head>
  <title>Verify</title>
</head>
<body>
  <div class="body-forms">
    <div class="title-forms">VERIFY</div>
      <div class="container verify">
        <div class="verify">
        <?php
          if (get_verify($_GET["token"]) == 0) {
        ?>
          <p>C'est bon tu es vérifié !</p>
          <br/>
          <a href="./index.php"><div>Connexion</div></a>
        
        <?php
        } else {
        ?>
        <strong>
        Wesh pelo y a eu un piti souci
        </strong>
        </div>
        <?php
        } ?>
      </div>
    </div>
</body>
</html>
