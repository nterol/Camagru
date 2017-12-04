<?php

function get_info($id, $username) {
    include_once('./config/database.php');
    try {
   
        $dbc = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbc->prepare("SELECT * FROM users WHERE id=:id AND username=:username");
        $query->execute(array(':id' => $id, ':username' => $username));
        $profile = $query->fetchAll();
        $query->closeCursor();
        return ($profile);

    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function change_username($newName, $uid) {
    include_once '../config/database.php';

    try {
        $dbc = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbc->prepare("UPDATE users SET username=:name WHERE id=:id");
        $query->execute(array(':name' => $newName, ':id'=> $uid));
        return (0);
} catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function change_password($password, $token)
{
    include_once '../config/database.php';

    try {
        $dbc = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbc->prepare("UPDATE users SET password=:password
      WHERE token=:token");
        $password = hash("whirlpool", $password);
        $query->execute(array(':password' => $password, ':token' => $token));
        $query->closeCursor();

        $query= $dbc->prepare("SELECT password FROM users WHERE token=:token");
        $query->execute(array(':token' => $token));
        $check = $query->fetch();
        if ($check['password'] == $password) {
            $_SESSION['change_success'] = true;
            return (0);
        } else {
            $_SESSION['error'] = "Il y a eu un problème";
            return (-1);
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        return (-1);
    }
}

function set_notifications($uid, $onOrOff) {
    include("../config/database.php");

    try {
        $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $lol->prepare("UPDATE users SET notifications=:val WHERE id=:id");
        $query->execute(array(':val'=> $onOrOff,':id' => $uid));
        return (0);
    } catch (PDOException $e) {
        return($e->getMessage());
    }
}
