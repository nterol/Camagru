<?php
function get_verify($token)
{
    include_once './setup/database.php';

    try {
        $fdp = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
        $fdp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $fdp->prepare("SELECT id FROM users WHERE token=:token");
        $query->execute(array(':token' => $token));

        $val = $query->fetch();
        if ($val == null) {
            return (-1);
        }
        $query->closeCursor();
        $query = $fdp->prepare("UPDATE users SET verified='Y' WHERE id=:id");
        $query->execute(array(':id' => $val['id']));
        $query->closeCursor();
        return (0);
    } catch (PDOException $e) {
        return (-2);
    }
}

?>
