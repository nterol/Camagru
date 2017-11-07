<?php
    function add_like($uid, $img, $type) {
        include '../setup/database.php';

        try {
            $fdp = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
            $fdp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $fdp->prepare("INSERT INTO `likes`(userid, galleryid, type) SELECT :userid, id, :type FROM gallery WHERE img=:img");
            $query->execute(array(':userid' => $uid, ':img' => $img, ':type' => $type));
            return (0);
        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }

    function update_like($uid, $img, $type) {
        include '../setup/database.php';

        try {
            $fdp = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
            $fdp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $fdp->prepare("INSERT INTO `likes`(userid, galleryid, type) SELECT :userid, id, :type FROM gallery WHERE img=:img");
            $query->execute(array(':userid' => $uid, ':img' => $img, ':type' => $type));
            return (0);
        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }

    function get_like($uid, $img) {
        include '../setup/database.php';

        try {
            $fdp = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
            $fdp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $fdp->prepare("UPDATE `likes`, gallery WHERE `likes`.userid=:userid AND `likes`.galleryid=gallery.id AND gallery.img=:img");
            $query->execute(array(':userid' => $uid, ':img' => $img));
            $val = $query->fetch();
            $query->closeCursor();
            return ($val);
        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }

    function get_nb_like($uid, $img) {
        include '../setup/database.php';

        try {
            $fdp = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
            $fdp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $fdp->prepare("SELECT type FROM `likes`, gallery WHERE `likes`.galleryid=gallery.id AND gallery.img=:img AND `likes`.type='L'");
            $query->execute(array(':img'=> $img));

            $count = 0;
            while ($val = $query->fetch()) {
                $count++;
            }
            $query->closeCursor();
            return ($count);
        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }

    function get_nb_dislikes($uid, $img) {
        include '../setup/database.php';

        try {
            $fdp = new PDO($DS_DSN, $DB_USER, $DB_PSSWD);
            $fdp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $fdp->prepare("SELECT type FROM `likes`, gallery WHERE `likes`.galleryid=gallery.id AND gallery.img=:img AND `likes`.type = 'D'");
            $query->execute(array('img' => $img));
        } catch (PDOException $e) {
          return ($e->getMessage());
        }
    }
?>
