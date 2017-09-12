<?php
function change_password($password, $token)
{
    include_once '../setup/database.php';

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
