<?php
session_start();
include 'database.php';
?>

<!DOCTYPE html>
<html>
  <link rel="stylesheet" type="text/css" href="../style/forms.css">
<head>
  <title>Drop it like it's hot</title>
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
    `notifications` VARCHAR(1) NOT NULL DEFAULT 'Y',
    `verified` VARCHAR(1) NOT NULL DEFAULT 'N'
  )";
    $db->exec($sql);
    $add_user = ("INSERT INTO users(username, mail, password, token, verified) VALUES (\"nterol\", \"nterol@student.42.fr\", \"d6b46b446d1dd479a5089982e6980f692ffca9000eb90b61f6cb087618eac39d1ae10e87da93510b24ae5bd1954292d0ce9d59930579c92cda9cf5782c122635\", \"16263962745a1c67da3c8873.23791818\", \"Y\")");
    $db->exec($add_user);
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

//Creation de la table Likes
try {
    $db = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `likes` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userid` INT(11) NOT NULL,
    `galleryid`  INT(11) NOT NULL,
    `img` VARCHAR(100),
    `touch` INT(1) NOT NULL,
    FOREIGN KEY (userid) REFERENCES users(id),
    FOREIGN KEY (galleryid) REFERENCES gallery(id)
  )";
    $db->exec($sql);
    echo "<li>Table likes created successfully</li>";
} catch (PDOException $e) {
    echo "<li>Something went wrong while creating table Like".$e->getMessage()."</br>Aborting Process</li>";
}

//creation de la table comments
try {
    $db  = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `comments` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userid` INT(11) NOT NULL,
    `galleryid` INT(11) NOT NULL,
    `galleryimg` VARCHAR(100) NOT NULL,
    `date` VARCHAR(255),
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
          <a href="../signup.php"><div>Go Sign Up</div></a>
</div>
</div>
</body>
</html>