<?php
session_start();

include_once '../functions/montage.php';

$montageDir = "../montage/";

$img = $_POST['img'];
$filter = $_POST['f'];
$id = $_SESSION['id'];

$filter = str_replace('data:image/png;base64,','', $filter);
$filter = str_replace(' ', '+', $filter);
$data = base64_decode($filter);

$iuid = uniqid();

if (!file_exists($montageDir)) {
  mkdir($montageDir);
}

file_put_contents($montageDir. $iuid . '.png', $data);

if (strcmp($img, "../img/diademe.png") == 0 || strcmp($img, "../img/illuminati.png") == 0)
  $copy = imagecreatetruecolor(240, 180);
else
  $copy = imagecreatetruecolor(640, 480);

imagealphablending($copy, false);

 ?>
