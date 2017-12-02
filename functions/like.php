<?php 
function post_like($uid, $imgId, $img) {
    include_once("../config/database.php");

    try {
        $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $lol->prepare("INSERT INTO likes(userid, galleryid, img, touch) VALUES(:uid, :gId, :img, 1)");
        $query->execute(array(':uid' => $uid, ':gId' => $imgId, ':img' => $img));
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function unlike($uid, $gId, $img) {
    include_once("../config/database.php");

    try {
        $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $lol->prepare("DELETE FROM likes WHERE userid=:uid AND galleryid=:gId AND img=:img");
        $query->execute(array(':uid' => $uid, ':gId' => $gId, ':img' => $img));
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function  get_like($gId, $img) {
    include("./config/database.php");

    try {
        $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $lol->prepare("SELECT userid, touch FROM likes WHERE galleryid=:gId AND img=:img");
        $query->execute(array(':gId'=> $gId, ":img" =>$img));
        $val = $query->fetchAll();

        $query->closeCursor();
        return ($val);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function unlike_all($gId, $img) {
    include_once("./config/database.php");

    try {
        $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $lol->prepare("DELETE FROM likes WHERE galleryid=:gId AND img=:img");
        $query->execute(array(':gId' => $gId, ':img' => $img));
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}