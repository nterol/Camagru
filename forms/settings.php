<?php
session_start();
include_once("../functions/settings.php");
$username = $_SESSION['username'];
$uid = $_SESSION['id'];
$newUsername = htmlspecialchars($_POST['change_username']);
$newPassOne = htmlspecialchars($_POST['password_one']);
$newPassTwo = htmlspecialchars($_POST['password_two']);
$notification = htmlspecialchars($_POST['notifications']);

if (isset($newUsername)) {
    echo $newUsername;
    if ($newUsername == null || $newUsername == '' || strlen($newUsername) < 3 || strlen($newUsername) > 255) {
        $_SESSION['error'] = "Ton nom d'utilisateur doit comprendre entre 3 et 255 lettres";
        header('Location: ../home.php');
    } else {
        
    }
}

if (isset($notification)) {
    if ($notification == "Désactiver les notifications")
        $switch = 'N';
    else if ($notification = "Activer les notifications")
        $switch = 'Y';
    else {
        $_SESSION['error'] = "Il y a eu un problème avec la mise à jour de vos préférences";
        header('Location: ../home.php');
    }
    $val = set_notifications($_SESSION['id'], $switch);
    echo $val;
    if ($val == 0) {
        $_SESSION['error'] = "Vos préférences ont bien été mises à jour";
        header('Location: ../home.php');
    } else {
        $_SESSION['error'] = "Il y a eu un problème avec la mise à jour de vos préférences";
        header('Location: ../home.php');
    }
}

if (isset($newPassOne)) {
    echo $newPassOne;
} else {
    echo "prout";
}
