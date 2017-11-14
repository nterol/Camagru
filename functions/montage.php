<?php
function add_montage($userId, $imgPath)
{
    include_once('./setup/database.php');

    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbh->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
        $query->execute(array(':userid' => $userId, ':img' => $imgPath));
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function get_all_montage()
{
    include_once('./setup/database.php');

    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbh->prepare("SELECT userid, img FROM gallery");
        $query->execute();

        $i = 0;
        $tab = null;
        while ($val = $query->fetch()) {
            $tab[$i] = $val;
            $i++;
        }
        $query->closeCursor();

        return ($tab);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function remove_montage($uid, $img)
{
    include_once('./setup/database.php');

    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbh->prepare("SELECT * FROM gallery WHERE img=:img AND userid=:userid");
        $query->execute(array(':img' => $img, ':userid' => $uid));

        $val = $query->fetch();
        if ($val == null) {
            $query->closeCursor();
            return(-1);
        }
        $query->closeCursor();

        $query = $dbh->prepare("DELETE FROM `like` WHERE galleryid=:galleryid");
        $query->execute(array(':galleryid' => $val['id']));
        $query->closeCursor;

        $query = $dbh->prepare("DELETE FROM comment WHERE galleryid=:galleryid");
        $query->execute(array(':galleryid' => $val['id']));
        $query->closeCursor();

        $query = $dbh->prepare("DELETE FROM gallery WHERE img=:img AND userid=:userid");
        $query->execute(array(':img' => $img, ':userid' => $uid));
        $query->closeCursor();

        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}


function get_montage($start, $nb)
{
    include_once('./setup/database.php');

    try {
        if ($start < 0) {
            $start = 0;
        }
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbh->prepare("SELECT userid, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
        $query->bindValue(':lim', $nb + 1, PDO::PARAM_INT);
        $query->bindValue(':id', $start, PDO::PARAM_INT);
        $query->execute();


        $i = 0;
        $tab = null;
        while (($val = $query->fetch())) {
          if ($i >= $nb) {
            $tab['more'] = true;
          } else {
            $tab[$i] = $val;
          }
            $i++;
        }
        $query->closeCursor();

        return ($tab);
    } catch (PDOException $e) {
        $s;
        $s['error'] = $e->getMessage();
        return ($s);
    }
}

// function get_other_montages($start, $nb)
// {
//     include_once('./setup/database.php');
//     try {
//         if ($start < 0) {
//             $start = 0;
//         }
//         $dbh = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
//         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         $query = $dbh->prepare("SELECT userid, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
//         $query->bindValue(':lim', $nb + 1, PDO::PARAM_INT);
//         $query->bindValue(':id', $start, PDO::PARAM_INT);
//         $query->execute();
//
//         $i = 0;
//         $tab = null;
//         while (($val = $query->fetch())) {
//             if ($i >= $nb) {
//                 $tab['more'] = true;
//             } else {
//                 $tab[$i] = $val;
//             }
//             $i++;
//         }
//     } catch (PDOException $e) {
//         $s;
//         $s['error'] = $e->getMessage();
//         return ($s);
//     }
// }

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

function get_comment($src) {
  include_once './setup/database.php';

  try {
    $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
    $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $lol->prepare("SELECT c.comment, u.username FROM comment AS c, user AS u, gallery AS g WHERE g.img=:img AND g.id=c.galleryid AND c.userid=u.id");
    $query->execute(array(':img' => $src));

    $i = 0;
    $tab = "";
    while ($val = $query->fetch()) {
      $tab[$i] = $val;
      $i++;
    }
    $tab[$i] = null;
    $query->closeCursor();
  } catch (PDOException $e) {
    $ret = "";
    $ret['error'] = $e->getMessage();
    return ($ret);
  }
}

function get_user_info($src) {
  include_once './setup/database.php';

  try {
    $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
    $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $lol->prepare("SELECT mail, username FROM users, gallery WHERE gallery.img=:img AND users.id=gallery.userid");
    $query->execute(array(':img' => $src));

    $val = $query->fetch();
    $query->closeCursor();

    return ($val);
  } catch (PDOException $e) {
    $ret = "";
    $ret['error'] = $e->getMessage();
    return ($ret);
  }
}
