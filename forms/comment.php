<?php
session_start();

include_once("../functions/comments.php");
include_once("../functions/mail.php");
header("Location: " . $_SERVER['HTTP_REFERER']);
$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$imgId = $_POST['data-id'];
$imgName = $_POST['data-img'];
$comment = $_POST['comment-area'];
$length = strlen($comment);


if ($uid == "" || $uid == null || $comment == null || $comment == "" || $imgId == null || $imgId == "" || $length > 255) {
    return ;
}

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

$date = strftime("%A %d %B %Y");
$theMessage = htmlspecialchars($comment);
$val = post_comment($uid, $imgId, $imgName, $theMessage, $date);
$userInfos = get_user_info($imgId, $imgName);
$url = $_SERVER['HTTP_POST'].str_replace("/forms/comment.php", "",$_SERVER['REQUEST_URI']);
$check = check_notif($_SESSION['id']);
if ($val == 0 && $check['notifications'] == 'Y') {
    if ($userInfos['username']) {
        send_comment_mail($userInfos['mail'], $userInfos['username'], $theMessage, $username, $imgId, $url);
    }
}
