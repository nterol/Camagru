<?php
session_start();
include_once('./functions/change_password.php');

//retrieve value :
$pass_one = $_POST['password1'];
$pass_two = $_POST['password2'];
$previous = $_SERVER['HTTP_REFERER'];
$token = $_SESSION['token'];

$_SESSION['error'] = null;

if ($pass_one == "" || $pass_one == null || strlen($pass_one) < 5) {
    $_SESSION['error'] = "Ton mot de passe doit avoir entre 5 et 255 caracteres";
    header("Location: ".$previous);
}
if ($pass_two == "" || $pass_two == null || strlen($pass_two) < 5) {
    $_SESSION['error'] = "Penses à bien confirmer ton mot de passe";
    header("Location: ".$previous);
}
if (strcmp($pass_one, $pass_two) !== 0) {
    $_SESSION['error'] = "Les mots de passes ne correspondent pas";
    header("Location: ".$previous);
}

$password = $pass_one;

change_password($password, $token);
header("Location: ../change_password.php");
