#!/usr/bin/php
<?php
include 'database.php';

//CREATE DATABASE
try {
    $db = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PSSWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE `".$DB_NAME."`";
    $db->exec($sql);
    echo "ok, ça marche la db est créee\n";
} catch (PDOException $e) {
    echo "Could not generate database sorry\n".$e->getMessage()."\nAborting process\n";
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
    echo "Table users created successfully\n";
} catch (PDOException $e) {
    echo "Yeah..sorry there was a mistake while creating the table\n".$e->getMessage()."\nAborting process\n";
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
    echo "Table gallery was created successfully\n";
} catch (PDOException $e) {
    echo "déso y a une couille dans le potage\n".$e->getMessage()."\nAborting Process\n";
}

//Creation de la table Like
try {
    $db = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `likes` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userid` INT(11) NOT NULL,
    `galleryid`  INT(11) NOT NULL,
    `type` VARCHAR(1) NOT NULL,
    FOREIGN KEY (userid) REFERENCES users(id),
    FOREIGN KEY (galleryid) REFERENCES gallery(id)
  )";
    $db->exec($sql);
    echo "Table likes created successfully\n";
} catch (PDOException $e) {
    echo "Error while creating table\n".$e->getMessage()."\nAborting Process\n";
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
    echo "Table comments successfully created\n";
} catch (PDOException $e) {
    echo "Désolé la table n'a pas pu être crée\n".$e->getMessage()."\nAborting Process\n";
}
