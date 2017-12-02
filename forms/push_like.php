<?php
session_start();

include_once('../functions/like.php');

if (isset($_SESSION)) {

    $uid = $_SESSION['id'];
    $img = $_GET['img'];
    $imgId = $_GET['id'];
    $flag = $_GET['type'];
    $pattern = '/^[0-9 a-z]{13}.png$/';
    
    if ($img == "" || $img == null || preg_match_all($pattern, $img) === 0 || $imgId == null || $img == "" || !is_numeric($imgId)) {
        return ;
        header('Location: ../museum.php');
    }
    if ($flag === "like")
        $var = post_like($uid, $imgId, $img);
    else if ($flag === "unlike")
        $var = unlike($uid, $imgId, $img); 
    if ($var == 0)
        header('Location: ../museum.php');
} else {
    header('Location: ./config/setup.php');
}



