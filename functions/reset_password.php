<?php

function reset_password($mail, $host)
{
    include_once '../config/database.php';
    include_once '../functions/mail.php';

    try {
        $lel = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $lel->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $lel->prepare("SELECT username, token FROM users WHERE mail=:mail AND verified='Y'");

        $mail = strtolower($mail);
        $query->execute(array(':mail' => $mail));
        $val = $query->fetch();

        if ($val == null) {
            $query->closeCursor();
            return (-1);
        }
        $query->closeCursor();
        $username = $val['username'];
        $token = $val['token'];
        send_forgot_mail($mail, $username, $token, $host);
        return (0);
    } catch (PDOException $e) {
        return (-2);
    }
}
