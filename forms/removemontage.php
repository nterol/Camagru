<?php
session_start();
include_once "../functions/montage.php";

$src = $_POST['src'];
$uid = $_SESSION['id'];

$val = remove_montage($uid, $src);

if ($val == 0) {
    echo "OK";
    unlink("../montage/" . $src);
} else {
    echo "KO";
}
