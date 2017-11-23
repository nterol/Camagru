<?php
session_start();
header("Location: ". $_SERVER['HTTP_REFERER']);
include_once("../functions/comments.php");
include_once("../functions/mail.php");

// Retrieve value

$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$imgId = $_POST['data'];
$comment = $_POST['comments'];

if ($uid == "" || 
    $uid == null || 
    $comment == null || 
    $comment == "" || 
    $img == null || 
    $img == "" || strlen($comment) > 255)
    return ;
    $theMessage = htmlspecialchars($comment);
$val = comment($uid, $imgId, $theMessage);
$userInfos = get_user_info($imgId);

$url = $_SERVER['HTTP_POST'].str_replace("/forms/comment.php", "",$_SERVER['REQUEST_URI']);

if ($val == 0) {
    if ($userInfos['username']) {
        send_comment_mail($userInfos['mail'], $userInfos['username'], $theMessage, $username, $imgId, $url);
    }
    echo htmlspecialchars($username);
}
