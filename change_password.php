<?php
session_start();
$_SESSION['token'] = $_GET['token'];
 ?>

 <!DOCTYPE html>
 <html>
 <head>
   <title>CAMAGRU - PASSWORD CHANGE</title>
 </head>
 <body>
 <div id="login">
<?php
if (isset($_SESSION['change_success'])) {
     ?>
  Changement confirmé !
  <a href="./index.php">Se connecter</a>
  <?php
 } else {
     ?>
   <div class="title">New Password</div>
   <form method="post" action="forms/change_password.php">
     <label>Entre ton nouveau mot de passe</label>
     <input id="password" name="password1" type="password">
     <label>Confirme ton nouveau mot de passe</label>
     <input id="password" name="password2" type="password">
     <input name="submit" type="submit" value="OK">
     <span>
       <?php
       if ($_SESSION['error']) {
           echo $_SESSION['error'];
       }
     $_SESSION['error'] = null; ?>
     </span>
   </form>
 <?php
 }
  ?>
</div>
 </body>
 </html>
