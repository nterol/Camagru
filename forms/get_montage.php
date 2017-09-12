<?php
session_start();

include_once("../functions/montage.php");
include("../functions/likes.php");

$id = $_POST['id'];
$nb = $_POST['nb'];

if ($id == null || $id == "" || $nb == null || $nb == "") {
    echo "OK";
    return ;
}

$montages = [];

$montages = get_montages();
