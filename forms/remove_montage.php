<?php
session_start();

include_once('../functions/montage.php');

if (isset($_SESSION)) {

    $uid = $_SESSION['id'];
    $img = $_GET['img'];
    $imgId = $_GET['id'];
    $pattern = '/^[0-9a-z]{13}.png$/';
    
    if ($img == "" || $img == null || preg_match_all($pattern, $img) === 0 || $imgId == null || $img == "" || !is_numeric($imgId)) {
        return ;
        header('Location: '. $_SERVER['REQUEST_URI']);
    }
        $var = post_like($uid, $imgId, $img);
    if ($var == 0)
        header('Location: ' . $_SERVER['REQUEST_URI']);
} else {
    header('Location: ./config/setup.php');
}
