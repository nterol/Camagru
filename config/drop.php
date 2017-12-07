<?php
session_start();
$_SESSION['error'] = null;
$_SESSION['id'] = null;
$_SESSION['username'] = null;
include 'database.php';
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style/parts.css">
  <link rel="stylesheet" type="text/css" href="../style/forms.css">
  <title>Drop It like it's hot</title>
</head>
<body>
<?php include('../parts/header.php') ?>
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
  echo "Database already dropped";
}
$dir = '../montage/';
function deleteDirectory($dir) {
  if (!file_exists($dir)) {
      return true;
  }

  if (!is_dir($dir)) {
      return unlink($dir);
  }

  foreach (scandir($dir) as $item) {
      if ($item == '.' || $item == '..') {
          continue;
      }

      if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
          return false;
      }

  }

  return rmdir($dir);
}

deleteDirectory($dir);
?>
<br/>
         <a href="./setup.php"><div>Re-build DB ?</div></a>
</div>
</div>
<?php include('../parts/footer.php')?>
</body>
</html>
