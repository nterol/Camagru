<?php
session_start();
include_once('../functions/change_password.php');

//retrieve value :
$pass_one = $_POST['password1'];
$pass_two = $_POST['password2'];
$previous = $_SERVER['HTTP_REFERER'];
$token = $_SESSION['token'];

$pattern = '/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/';

$_SESSION['error'] = null;

if ($pass_one == "" || $pass_one == null || strlen($pass_one) < 5 || strlen($pass_one) > 40) {
    $_SESSION['error'] = "Ton mot de passe doit avoir entre 5 et 40 caracteres";
    header("Location: ".$previous);
} elseif ($pass_two == "" || $pass_two == null || strlen($pass_two) < 5 || strlen($pass_two) > 40) {
    $_SESSION['error'] = "Penses à bien confirmer ton mot de passe";
    header("Location: ".$previous);
} elseif (!preg_match_all($pattern, $pass_one) && !preg_match_all($pattern, $pass_two)) {
    $_SESSION['error'] = "Ton mot de passe doit contenir au moins un chiffre et pas d'espaces";
    header('Location: '.$previous);
} elseif (strcmp($pass_one, $pass_two) !== 0) {
    $_SESSION['error'] = "Les mots de passes ne correspondent pas";
    header("Location: ".$previous);
} else {
   
    $password = $pass_one;

    $val = change_password($password, $token);
    switch ($val) {
        case(0):
        header("Location: ../change_password.php");
        break;
        case(-1):
        header("Location: ../change_password.php");
        break;
        case(-2):
        header('Location: ../config/setup.php');
        break;
    }
}
