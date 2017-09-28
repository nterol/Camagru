//je ne sais pas du tout à quoi ce fichier sert
<?php
session_start();

include('./database.php');

try {
    $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
    $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM `comment`";
    $lol->exec($sql);

    $sql ="DELETE FROM `like`";
    $lol->exec($sql);

    $sql = "DELETE FROM `gallery`";
    $lol->exec($sql);
} catch (PDOException $e) {
}
 ?>
