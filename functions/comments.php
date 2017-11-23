<?php

function get_comment($src) {
    include_once './setup/database.php';
  
    try {
      $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
      $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query = $lol->prepare("SELECT comments.comment, users.username FROM comments WHERE gallery.img=:img AND gallery.id=c.galleryid AND comments.userid=u.id");
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

  function  comment($uid, $src, $comment) {
    include_once './setup/database.php';
  
    try {
      $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
      $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query = $lol->prepare("INSERT INTO comment(userid, galleryid, comment) SELECT :userid, id, :comment FROM gallery WHERE img=:img");
      $query->execute(array(':userid' => $uid, ':comment' => $comment, ':img' => $src));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
  }