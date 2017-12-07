<?php
session_start();

include_once('../functions/montage.php');
include_once('../functions/like.php');
include_once('../functions/comments.php');

if (isset($_SESSION)) {

    $uid = $_SESSION['id'];
    $img = $_GET['img'];
    $imgId = $_GET['id'];
    $pattern = '/^[0-9a-z]{13}.png$/';
    
    if ($img == "" || $img == null || preg_match_all($pattern, $img) === 0 || $imgId == null || $img == "" || !is_numeric($imgId)) {
        header('Location: '. $_SERVER['HTTP_REFFERER']);
    }
    $var = remove_montage($uid, $imgId, $img);
    $like = unlike_all($imgId, $img);
    $comment = uncomment_all($imgId, $img);
    if ($var == 0 && $like == 0 && $comment == 0) {
        unlink("../montage/".$img);
        header('Location: ../index.php');
    } else if ($var== -1)
        echo "nik ta mere";
} else {
    header('Location: ./config/setup.php');

}
