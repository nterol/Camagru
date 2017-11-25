<?php
include 'database.php';
?>

<!DOCTYPE html>
<html>
  <link rel="stylesheet" type="text/css" href="../style/forms.css">
<head>
  <title>Verify</title>
</head>
<body>
  <div class="body-forms">
    <div class="title-forms">DROP DATABASE</div>
      <div class="container verify">
        <div class="verify">

<?php 
try {
  $db = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PSSWD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "DROP DATABASE `".$DB_NAME."`";
  $db->exec($sql);
  echo "database was dropped successfully";
} catch (PDOException $e) {
  echo "There was a mistake while dropping the database\n".$e->getMessage()."</br>Aborting Process</br>";
}
?>
<br/>
         <a href="./setup.php"><div>Re-build DB ?</div></a>
</div>
</div>
</body>
</html>
