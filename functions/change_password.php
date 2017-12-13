<?php
function change_password($password, $token)
{
    include_once '../config/database.php';

    try {
        $dbc = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query= $dbc->prepare("SELECT password FROM `users` WHERE token=:token");
        $query->execute(array(':token' => $token));
        $check = $query->fetchAll();
        $query->closeCursor();
        $password = hash("whirlpool", $password);
        if ($check[0]['password'] == $password) {
            $_SESSION['error'] = "Tu ne peux pas utiliser le meme mot de passe";
            return (-1);
        } else {
            $query = $dbc->prepare("UPDATE users SET password=:password WHERE token=:token");
            $query->execute(array(':password' => $password, ':token' => $token));
            $query->closeCursor();
            $_SESSION['change_success'] = true;
            return (0);
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        return (-2);
    }
}
