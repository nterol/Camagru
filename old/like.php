<?php
// session_start();
// include_once ("../functions/like.php");

// $uid = $_SESSION['id'];
// $username = $_SESSION['username'];
// $img = $_POST['img'];
// $type = $_POST['type'];

// $fdp = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
// $fdp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $query = $fdp->prepare("SELECT * FROM `likes` gallery WHERE `likes`.galleryid=gallery.id AND gallery.img=:img AND likes.userid=:uid");
// $query->execute(array(':img'=> $img, ':uid'=> $uid));
// $val = $query->fetch();
// $query->closeCursor();

// if ()

// if ($uid == null || $img == null || $img == "" || $type == null || $type == "" || ($type != "L" && $type != "D"))
//   return ;

// $ret = get_like($uid, $img);

// if ($ret != null && array_key_exists('type', $ret)) {
//   if ($ret['type'] == $type) {
//     echo "KO";
//   } else {
//     $val = update_like($uid, $img, $type);
//     if ($val == 0) {
//       echo "CHANGE";
//     } else {
//       echo $val;
//     }
//   }
// } else {
//   $val = add_like($uid, $img, $type);

//   if ($val == 0) {
//     echo "ADD";
//   } else {
//     echo $val;
//   }
// }

session_start();
include './setup/database.php';

$dbsql = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
$dbsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['logged_on_user']))
{
    $prep4 = $dbsql->prepare('SELECT COUNT(*) FROM likes WHERE galleryid=:picture_id AND userid=:author_id');
    $prep4 -> bindParam(':picture_id', htmlspecialchars($_POST['img']));
    $prep4 -> bindParam(':author_id', $_SESSION['id']);
    $prep4->execute();
    $like_user = $prep4->fetchAll();
    if ($like_user[0]['COUNT(*)'] == 0)
    {
        $prep2 = $dbsql->prepare('INSERT INTO `likes` (`galleryid`, `userid`) VALUES (:picture_id, :author_id);');
        $prep2 -> bindParam(':picture_id', htmlspecialchars($_GET['id']));
        $prep2 -> bindParam(':author_id', $_SESSION['logged_on_user']);
        $prep2->execute();
    }   
    else
    {
        $prep3 = $dbsql->prepare('DELETE FROM `likes` WHERE galleryid=:picture_id AND userid=:author_id;');
        $prep3 -> bindParam(':picture_id', htmlspecialchars($_GET['id']));
        $prep3 -> bindParam(':author_id', $_SESSION['logged_on_user']);
        $prep3->execute();
    }
}
 ?>
