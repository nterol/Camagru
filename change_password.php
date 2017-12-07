<?php
session_start();
$_SESSION['token'] = $_GET['token'];
 ?>

 <!DOCTYPE html>
 <html>
 <head>
   <title>CAMAGRU - PASSWORD CHANGE</title>
   <link rel="stylesheet" type="text/css" href="style/parts.css">
   <link rel="stylesheet" type="text/css" href="style/forms.css">
 </head>
 <body>
 <?php include('./parts/header.php') ?>
 <div class="body-forms">
 <div class="container">
<?php
if (isset($_SESSION['change_success'])) {
     ?>
  Changement confirmé !
  <a href="./index.php">Se connecter</a>
  </div>
  </div>
  <?php
 } else {
     ?>
   <div class="title-forms"><h1>New Password</h1></div>
   <div class="container changepass">
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
   </div>
 <?php
 }
  ?>
</div>
</div>
<?php include('./parts/footer.php') ?>
 </body>
 </html>
