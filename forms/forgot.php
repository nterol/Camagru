<?php
session_start();

include '../functions/reset_password.php';

$mail = $_POST['email'];
$host = $_SERVER['HTTP_POST'].str_replace("/forms/forgot.php", "", $_SERVER['REQUEST_URI']);

$_SESSION['error'] = null;

if (($res = reset_password($mail, $host)) !== 0) {
    if ($res == -1) {
        $_SESSION['error'] = "User not found  ".$mail;
    } else {
        $_SESSION['error'] = "Internal error   ".print_r($res);
    }
} else {
    $_SESSION['forgot_success'] = true;
}

header("Location: ../forgot.php");
