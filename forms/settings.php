<?php
session_start();
include_once("../functions/settings.php");
$username = $_SESSION['username'];
$uid = $_SESSION['id'];

function take_me_home() {
    // header('Location: ../home.php');
    print_r($_SESSION);
}

if (isset($_POST['submit_new_password'])) {
    if ((isset($_POST['password_one']) && !isset($_POST['password_two'])) || 
    (isset($_POST['password_two']) && !isset($_POST['password_one'])) ||
    (!isset($POST['password_one']) && !isset($_POST['password_two'])))
    {
        $_SESSION['error']['password'] = "Tu veux bien compléter les deux champs steuplé ?";
        take_me_home();
    
    } else if ($_POST['password_one'] == '' || 
    $_POST['password_two'] == null || 
    $_POST['password_two'] == '' || 
    $_POST['password_two'] == null || 
    strlen($_POST['password_one']) < 5 || 
    strlen($_POST['password_one']) > 255 ||
    strlen($_POST['password_two']) < 5 || 
    strlen($_POST['password_two']) > 255) {
        $_SESSION['error']['password'] = "Ton nouveau mot de passe doit être compris entre 3 et 255 caractères";
    } else if ($_POST['password_one'] !== $_POST['password_two']) {
        $_SESSION['error']['password'] = "Les mots de passe ne correspondent pas";
        take_me_home();
    }
    else if ($_POST['password_one'] == $_POST['password_two']) {
        $pass = htmlspecialchars($_POST['password_one']);
        $hashPass = hash('whirlpool', $pass);
        $val = change_password($hashPass, $_SESSION['id']);
        if ($val == 0) {
            $_SESSION['success']['password'] = "Ton mot de passe a bien été changé";
            take_me_home();
        } else if ($val == -1)
            take_me_home();
    }
}

if (isset($_POST['submit_username'])) {
    if (isset($_POST['change_username'])) {
        $newUsername = htmlspecialchars($_POST['change_username']);
        if ($newUsername == null || $newUsername == '' || strlen($newUsername) < 3 || strlen($newUsername) > 255) {
            $_SESSION['error']['username'] = "Ton nom d'utilisateur doit comprendre entre 3 et 255 lettres";
            header('Location: ../home.php');
        } else {
            $new_name = change_username($username, $_SESSION['id']);
            if ($new_name == 0) {
                $_SESSION['username'] = $newUsername;
                $_SESSION['success']['username'] = "Ton username a bien été modifié";
                header('Location: ../home.php');
            } else if ($new_name == -1) {
                $_SESSION['error']['username'] = "Ton username n'a pas pu être updaté";
                header('Location: ../home.php');
            }
        }
    }
}

if (isset($_POST['notifications'])) {

    print_r($notif);    
    if ($notif == "Désactiver les notifications") 
        $switch = "N";
    if ($notif == "Activer les notifications")
        $switch = "Y";
    if ($switch != null) {
        $val = set_notifications($_SESSION['id'], $switch);
    } else {
        $_SESSION['error']['notifications'] = $notif;
    }
    if ($val == 0) {
        $_SESSION['success'] = "Vos préférences ont bien été mises à jour";
        header('Location: ../home.php');
     } else {
        $_SESSION['error'] = "Il y a eu un problème avec la mise à jour de vos préférences";
        header('Location: ../home.php');
    }
}
