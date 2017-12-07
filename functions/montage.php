<?php

include_once("comments.php");
include_once("like.php");

function put_montage($userId, $imgPath)
{
    include_once('../config/database.php');
    try {
        $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $lol->prepare("INSERT INTO gallery(userid, img) VALUES (:userid, :img)");
        $query->execute(array(':userid' => $userId, ':img' => $imgPath));
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function get_all_montage() {
    include_once('./config/database.php');
    try {
        $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $lol->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME ='camagru'");
        $query->execute();
        $val = $query->fetchAll();
        $query->closeCursor();
        if ($val != null) {
            $query = $lol->prepare("SELECT * FROM gallery ORDER BY id DESC");
            $query->execute();
            $tab = $query->fetchAll();
            $query->closeCursor();
            return ($tab);
        }
    } catch (PDOException $e) {
        header('Location: ./config/setup.php');
    }
}

function remove_montage($uid, $imgId, $img) {
    include_once('../config/database.php');
    
         try {
            $dbh = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $dbh->prepare("DELETE FROM gallery WHERE id=:id AND img=:img AND userid=:uid");
            $query->execute(array(':id' => $imgId, ':img' => $img, ':uid' => $uid));
            $query->closeCursor();
            return (0);
            } catch (PDOException $e) {
                return ($e->getMessage());
            }
}