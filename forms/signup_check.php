<?php
session_start();
include '../functions/signup_stock.php';

$mail = htmlspecialchars($_POST['email']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$_SESSION['error'] = null;

if ($mail == "" || $mail == null || $username == "" || $username == null ||
$password == "" || $password == null) {
    $_SESSION['error'] = "Frère, renseigne tous les champs steuplé sois pas teubé";
    header("Location: ../signup.php");
} else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Mets un mail valide stp j'ai pas ton temps bro";
    header("Location: ../signup.php");
} else if (strlen($username) < 3 || strlen($username) > 255) {
    $_SESSION['error'] = "Ton nom d'utilisateur doit comprendre entre 3 et 255 lettres";
    header("Location: ../signup.php");
} else if (strlen($password) < 5 || strlen($password) > 255) {
    $_SESSION['error'] = "votre mot de passe doit être compris entre 5 et 255 caractères";
    header("Location: ../signup.php");
} else {
    $host = $_SERVER['HTTP_POST'].str_replace("/forms/signup_check.php", "", $_SERVER['REQUEST_URI']);
    signup($mail, $username, $password, $host);
    header("Location: ../signup.php");
}