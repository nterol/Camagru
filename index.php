<?php
session_start();
 ?>

    <!DOCTYPE html>
    <html>
    <header>
        <link rel="stylesheet" type="text/css" href="styles/index.css">
    </header>

    <body>
        <div id="login">
            <div class="title">LOGIN</div>
            <div>
              <?php
              if (isset($_SESSION['id'])) {
                  ?>
                Tu es connecté,
                <?php
                print_r(htmlspecialchars($_SESSION['username'])) ?>

              <?php
              } else {
                  ?>
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
              <?php
              } ?>

            </div>
        </div>
    </body>
</html>
