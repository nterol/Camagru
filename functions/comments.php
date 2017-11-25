<?php

function get_comment($src) {
    include('./setup/database.php');
  
    try {
      $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
      $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query = $lol->prepare("SELECT comments.comment, 'users.username' FROM comments WHERE 'gallery.img'=:img AND 'gallery.id'=comments.galleryid AND comments.userid='users.id'");
      $query->execute(array(':img' => $src));

      $val = $query->fetchAll();
      print_r($val);
      return ($val);
    } catch (PDOException $e) {
      $ret = "";
      $ret['error'] = $e->getMessage();
      return ($ret);
    }
  }

  function  post_comment($uid, $galleryId, $comment) {
    include('../setup/database.php');
    include('f_database.php');
    
    try {
      $query = $lol->prepare("INSERT INTO comments(userid, galleryid, comment) VALUES (:uid, :gId, :comment)");
      $query->execute(array(':userid' => $uid, ':gId' => $galleryId, ':comment' => $comment));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
  }

  function get_user_info($galleryId) {
    include_once './setup/database.php';
  
    try {
      $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
      $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query = $lol->prepare("SELECT mail, username FROM users, gallery WHERE gallery.id=:id AND users.id=gallery.userid");
      $query->execute(array(':id' => $galleryId));
  
      $val = $query->fetch();
      $query->closeCursor();
  
      return ($val);
    } catch (PDOException $e) {
      $ret = "";
      $ret['error'] = $e->getMessage();
      return ($ret);
    }
  }