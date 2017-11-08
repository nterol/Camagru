<?php
session_start();

include_once("../functions/montage.php");
include_once("../functions/mail.php");

// Retrieve value

$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$img = $_POST['img'];
$comment = $_POST['comment'];

if ($uid == "" || 
    $uid == null || 
    $comment == null || 
    $comment == "" || 
    $img == null || 
    $img == "" || 
    strlen($comment) > 255)
    return ;
$val = comment($uid, $img, $comment);
$userInfos = get_user_info($img);

$url = $_SERVER['HTTP_POST'].str_replace("/forms/comment.php", "",$_SERVER['REQUEST_URI']);

if ($val == 0) {
    if ($userInfos['username']) {
        send_comment_mail($userInfos['mail'], $userInfos['username'], $comment, $username, $img, $url);
    }
    echo htmlspecialchars($username);
}



?>