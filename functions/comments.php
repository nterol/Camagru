<?php

function get_comment($galleryId, $img) {
    include('./config/database.php');
  
    try {
      $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
      $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query = $lol->prepare("SELECT comments.comment, comments.date,  users.username FROM comments, users WHERE comments.galleryid=:gId AND comments.galleryimg=:img AND users.id=comments.userid ORDER BY comments.id ASC");
      $query->execute(array(':gId' => $galleryId, ':img'=> $img));

      $val = $query->fetchAll();
      return ($val);
    } catch (PDOException $e) {
      $ret = "";
      $ret['error'] = $e->getMessage();
      return ($ret);
    }
  }

  function  post_comment($uid, $galleryId, $img, $comment, $date) {
    include('../config/database.php');
    
    try {
      $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
      $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query = $lol->prepare("INSERT INTO comments(userid, galleryid, galleryimg, date, comment) VALUES (:uid, :gId, :img, :date, :comment)");
      $query->execute(array(':uid' => $uid, ':gId' => $galleryId, ':img' => $img, ':date' => $date, ':comment' => $comment));
      return (0);
    } catch (PDOException $e) {
      $ret['error'] = "post_comment : " . $e->getMessage();
      return (print_r($ret));
    }
  }

  function uncomment_all($imgId, $img) {
    try {
      include('../config/database.php');
      $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
      $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $query = $lol->prepare("ALTER TABLE comments DROP FOREIGN KEY userid, galleryid WHERE galleryid=:id AND img=:img");
      // $query->execute(array(':gId' => $imgId, ':img' => $img));
      // $query->closeCursor();     
      $query = $lol->prepare("DELETE FROM comments WHERE galleryid=:gId AND galleryimg=:img");
      $query->execute(array(':gId' => $imgId, ':img' => $img));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
  }
}

  function get_user_info($galleryId, $img) {
    include('../config/database.php');
  
    try {
      $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
      $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query = $lol->prepare("SELECT mail, username FROM users, gallery WHERE gallery.id=:id AND gallery.img=:img AND users.id=gallery.userid");
      $query->execute(array(':id' => $galleryId, ':img' =>$img));
  
      $val = $query->fetch();
      $query->closeCursor();
  
      return ($val);
    } catch (PDOException $e) {
      $ret = "";
      $ret['error'] = "get_user_infos : " . $e->getMessage();
      return ($ret);
    }
  }