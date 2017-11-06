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

$montages = get_montages($id, $nb);
for ($i = 0; $i < count($montages); $i++) {
  $montages[$i]['dislikes'] = get_nb_dislikes($montages[$i]['img']);
  $montages[$i]['likes'] = get_nb_likes($montages[$i]['img']);
  $comments = get_comment($montages[$id]['img']);
  if ($comments[0] != null)
    $montages[$i]['comments'] = $comments;
  else
    $montages[$i]['comments'] = null;
}
if (count($montages) <= 0) {
  echo "KO";
  return ;
}
print_r(json_encode($montages));
