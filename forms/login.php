<?php
session_start();

include '../functions/log_user.php';

$mail = strtolower($_POST['email']);
$password = $_POST['password'];
$password = hash("whirlpool", $password);

if (($log = log_user($mail, $password)) == -1) {
    $_SESSION['error'] = "user not found";
} elseif (isset($log['err'])) {
    $_SESSION['error'] = $log['err'];
} else {
    $_SESSION['id'] = $log['id'];
    $_SESSION['username'] = $log['username'];
}

header("Location: ../index.php");
