<?php
function log_user($mail, $password)
{
    include_once '../config/database.php';

    try {
        $fdp = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $fdp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $fdp->prepare("SELECT id, username
        FROM users WHERE mail=:mail AND password=:password AND verified='Y'");
        $query->execute(array(':mail' => $mail, ':password' => $password));
        $val = $query->fetch();
        if ($val == null) {
            $query->closeCursor();
            return (-1);
        }
        $query->closeCursor();
        return ($val);
    } catch (PDOException $e) {
        $v['err'] = $e->getMessage();
        return ($v);
    }
}
