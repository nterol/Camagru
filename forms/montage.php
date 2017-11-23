<?php
session_start();

include_once '../functions/montage.php';

$montageDir = "../montage/";

$img = $_POST['img'];
$filter = $_POST['f'];
$id = $_SESSION['id'];

$filter = str_replace('data:image/png;base64,', '', $filter);
$filter = str_replace(' ', '+', $filter);
$data = base64_decode($filter);

$iuid = uniqid();

if (!file_exists($montageDir))
  mkdir($montageDir);

file_put_contents($montageDir. $iuid . '.png', $data);

if (strcmp($img, "../img/lunettes.png") == 0)
  $copy = imagecreatetruecolor(195, 175);
else if (strcmp($img, "../img/barbe.png") == 0)
    $copy = imagecreatetruecolor(330, 250);
else $copy = imagecreatetruecolor(240, 180);


imagealphablending($copy, false);
imagesavealpha($copy, true);

$src = imagecreatefrompng($img);

if (strcmp($img, "../img/lunettes.png") == 0)
  imagecopyresized($copy, $src, 0, 0, 0, 0, 320, 230, 1024, 768);
else if (strcmp($img, "../img/barbe.png") == 0)
    imagecopyresized($copy, $src, 0, 0, 0, 0, 331, 350, 1024, 1024);
else if (strcmp($img, "../img/illuminati.png") == 0)
    imagecopyresized($copy, $src, 0, 0, 0, 0, 480, 300, 1024, 768);
else imagecopyresized($copy, $src, 0, 0, 0, 0, 332, 352, 512, 384);

$destination = imagecreatefrompng($montageDir . $iuid . ".png");

$x_src = imagesx($copy);
$y_src = imagesy($copy);
$x_dest = imagesx($destination);
$y_dest = imagesy($destination);

imageflip($destination, IMG_FLIP_HORIZONTAL);

if (strcmp($img, "../img/lunettes.png") == 0)
{
  $dest_x = 240;
  $dest_y = 0;
} elseif (strcmp($img, "../img/barbe.png") == 0) {
    $dest_x = 150;
    $dest_y = 150;
}
else if (strcmp($img, "../img/illuminati.png") == 0) {
  $dest_x = 206;
  $dest_y = 100;
} else if (strcmp($img, "../img/diademe.png") == 0) {
  $dest_x = 206;
  $dest_y = 0; 
}
imagecopymerge_alpha($destination, $copy, $dest_x, $dest_y, 0, 0, $x_src, $y_src, 100);

$success = imagepng($destination, $montageDir.$iuid.".png");

if ($success) {
  if (($val = put_montage($id, $iuid . ".png")) === 0)
    echo ($iuid.'.png');
   else echo $val;
}

function imagecopymerge_alpha($dest, $srcIm, $dest_x, $dest_y, $src_x, $src_y, $src_w, $src_h, $wtf) {
    $cut = imagecreatetruecolor($src_w, $src_h);
    imagecopy($cut, $dest, 0, 0, $dest_x, $dest_y, $src_w, $src_h);
    imagecopy($cut, $srcIm, 0, 0, $src_x, $src_y, $src_w, $src_h);
    imagecopymerge($dest, $cut, $dest_x, $dest_y, 0, 0, $src_w, $src_h, $wtf);
}
?>
