<?php
session_start();

include_once("../functions/comments.php");
include_once("../functions/mail.php");
// header("Location: " . $_SERVER['HTTP_REFERER']);
$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$imgId = $_POST['data'];
$comment = $_POST['comment-area'];
$length = strlen($comment);

if ($uid == "" || $uid == null || $comment == null || $comment == "" || $imgId == null || $imgId == "" || $length >= 255) {
    echo "did not work";
    echo " zut";
}
$theMessage = htmlspecialchars($comment);
;$val = post_comment($uid, $imgId, $theMessage);
echo $val;
$userInfos = get_user_info($imgId);

$url = $_SERVER['HTTP_POST'].str_replace("/forms/comment.php", "",$_SERVER['REQUEST_URI']);

if ($val == 0) {
    if ($userInfos['username']) {
        send_comment_mail($userInfos['mail'], $userInfos['username'], $theMessage, $username, $imgId, $url);
    }
}