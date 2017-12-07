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
        $query = $dbc->prepare("SELECT username FROM users WHERE username=:name");
        $query->execute(array(':name' => $newName));
        $check = $query->fetchAll();
        $query->closeCursor();
        if (empty($check)) {
            $query = $dbc->prepare("UPDATE users SET username=:newname WHERE id=:id");
            $query->execute(array(':newname' => $newName, ':id' => $uid));
            return (0);
        } else
            return (-1);
} catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function change_mail($mail, $uid) {
    include '../config/database.php';

    try {
        $dbc = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbc->prepare("SELECT mail FROM users");
        $query->execute(array());
        $check = $query->fetchAll();
        $query->closeCursor();
        foreach($check as $c) {
            if ($c['mail'] == $mail)
                return (-1);
        }
        $query = $dbc-> prepare("UPDATE users SET mail=:mail WHERE id=:id");
        $query->execute(array(':mail' => $mail, ':id' => $uid));
        return (0);
    } catch (PDOException $e) {
        $_SESSION['error']['mail'] = $e->getMessage();
        return (-2);
    }
}

function change_password($password, $uid)
{
    include_once '../config/database.php';

    try {
        $dbc = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbc->prepare("SELECT password FROM users WHERE id=:id");
        $query->execute(array(':id' => $uid));
        $original = $query->fetchAll();
        $query->closeCursor();
        if ($original[0]['password'] != $password) {
            $query = $dbc->prepare("UPDATE users SET password=:password WHERE id=:id");
            $query->execute(array(':password' => $password, ':id' => $uid));
            $query->closeCursor();
            $query= $dbc->prepare("SELECT password FROM users WHERE id=:id");
            $query->execute(array(':id' => $uid));
            $check = $query->fetch();
            if ($check['password'] == $password) {
                $_SESSION['success']['password'] = "Ton mot de passe a bien été modifié";
                return (0);
            } else {
                $_SESSION['error']['password'] = "Il y a eu un problème";
                return (-1);
            }
        } else {
            $_SESSION['error']['password'] = "Tu ne peux pas réutiliser un vieux mot de passe";
            return (-1);
        }
    } catch (PDOException $e) {
        $_SESSION['error']['password'] = $e->getMessage();
        return (-2);
    }
}

function set_notifications($uid, $notifs) {
    include("../config/database.php");

    try {
        $lol = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $lol->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $lol->prepare("UPDATE users SET notifications=:val WHERE id=:id");
        $query->execute(array(':val'=> $notifs, ':id' => $uid));
        return (0);
    } catch (PDOException $e) {
        return($e->getMessage());
    }
}
