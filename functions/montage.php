<?php

function get_all_montage()
{
    include_once('../set/database.php');

    try {
        $dbc = new PDOException($DB_DSN, $DB_USER, $DB_PSSWD);
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbc->prepare("SELECT userid, img FROM gallery");
        $query->execute();

        $i = 0;
        $tab = null;
        while ($val = $query->fetch()) {
            $tab[$i] = $val;
            $i++;
        }
        $query->closeCursor();

        return ($tab);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function get_montage($start, $nb)
{
    include_once('../setup/database.php');
}


function remove_montage($uid, $img)
{
    include_once('../setup/database.php');

    try {
        $dbc = new PDO($DB_DSN, $DB_USER, $DP_PSSWD);
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbc->prepare("SELECT * FROM gallery WHERE img=:img AND userid=:userid");
        $query->execute(array(':userid' => $uid, ':img' => $img));
        $val = $query->fetch();
        if ($val == null) {
            $query->closeCursor();
            return (-1);
        }
        $query->closeCursor();
        $query = $dbc->prepare("DELETE FROM likes WHERE galleryid=:galleryid");
        $query->execute(array(':galleryid' => $val['id']));
        $query->closeCursor();

        $query = $dbc->prepare("DELETE FROM comments WHERE galleryid=:galleryid");
        $query->execute(array(':galleryid' => $val['id']));
        $query->closeCursor();

        $query = $dbc->prepare("DELETE FROM gallery WHERE img=:img AND userid=:userid");
        $query->execute(array(':userid' => $uid, ':img' => $img));
        $query->closeCursor();
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}
