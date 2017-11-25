<?php
session_start();
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
    <div class="title-forms">SET UP</div>
      <div class="container verify">
        <div class="verify">
        <ul>

<?php

if (isset($_SESSION['id']))
    unset($_SESSION);

//CREATE DATABASE
try {
    $db = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PSSWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE `".$DB_NAME."`";
    $db->exec($sql);
    echo "<li>DB Camagru successfuly created</li>";
} catch (PDOException $e) {
    echo "<li>Could not generate database sorry :".$e->getMessage()."</br>Aborting process</li>";
    ?>  </br>
    <a href="./drop.php"><div>Drop DB</div></a>
    <?php
    exit(-1);
};

//CREATE TABLE USERS
try {
    //se connecter à la db qui vient d'etre cree.
    $db  = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `users`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(40) NOT NULL,
    `mail` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `token` VARCHAR(50) NOT NULL,
    `verified` VARCHAR(1) NOT NULL DEFAULT 'N'
  )";
    $db->exec($sql);
    echo "<li>Table users created successfully</li>";
} catch (PDOException $e) {
    echo "<li>Yeah..sorry there was a mistake while creating the table</br>".$e->getMessage()."</br>Aborting process</li>";
}
//creation de la table gallery
try {
    $db  = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `gallery`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userid` INT(11) NOT NULL,
    `img` VARCHAR(100),
    FOREIGN KEY (userid) REFERENCES users(id)
  )";
    $db->exec($sql);
    echo "<li>Table gallery was created successfully</li>";
} catch (PDOException $e) {
    echo "<li>Something went wrong while creating gallery : ".$e->getMessage()."</br>Aborting Process</li>";
}

//Creation de la table Like
try {
    $db = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `likes` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userid` INT(11) NOT NULL,
    `galleryid`  INT(11) NOT NULL,
    FOREIGN KEY (userid) REFERENCES users(id),
    FOREIGN KEY (galleryid) REFERENCES gallery(id)
  )";
    $db->exec($sql);
    echo "<li>Table likes created successfully</li>";
} catch (PDOException $e) {
    echo "<li>Something went wrong while creating Like".$e->getMessage()."</br>Aborting Process</li>";
}

//creation de la table comments
try {
    $db  = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `comments` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userid` INT(11) NOT NULL,
    `galleryid` INT(11) NOT NULL,
    `comment` VARCHAR(255),
    FOREIGN KEY (userid) REFERENCES users(id),
    FOREIGN KEY (galleryid) REFERENCES gallery(id)
  )";
    $db->exec($sql);
    echo "<li>Table comments successfully created</li>";
} catch (PDOException $e) {
    echo "<li>Something went wrong while creating comments : ".$e->getMessage()."<\br>Aborting Process</li>";
}

?>
 </ul>
 </br>
          <a href="../si.php"><div>Go Sign Up</div></a>
</div>
</div>
</body>
</html>