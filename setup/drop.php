#!/usr/bin/php
<?php
include 'database.php';

//detruire la base de donnée
try {
  $db = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PSSWD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "DROP DATABASE `".$DB_NAME."`";
  $db->exec($sql);
  echo "database was dropped successfully";
} catch (PDOException $e) {
  echo "There was a mistake while dropping the database\n".$e->getMessage()."\nAborting Process\n";
}
?>
