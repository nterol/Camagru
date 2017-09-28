<?php
session_start();
?>


<!DOCTYPE html>
<html>
    <header>
        <link rel="stylesheet" type="text/css" href="style/test.css">
        <link rel="stylesheet" type="text/css" href="style/parts.css">
    </header>
    <body>
        <?php include('parts/header.php') ?>
        <?php if (isset($_SESSION['id'])) { ?>
        <div class="lol">
            Salut toi !
        </div>
<? } else { ?>
        <div class="overlay">
          <form method="post" action="forms/login.php">
                  <label> email : </label>
                  <input id="mail" name="email" type="mail" >
                  <label> password : </label>
                  <input id="password" name="password" type="password">
                  <input name="submit" type="submit" value="Send">
                  <a href="signup.php">Create account</a>
                  <a href="forgot.php">Mot de passe oublié ?</a>
                  <span>
                    <?php
                    if ($_SESSION['error']) {
                        echo $_SESSION['error'];
                    }
                  $_SESSION['error'] = null; ?>
                  </span>
                </form>  
        </div>
    <?php }?>
    </body>
</html>