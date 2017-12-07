<?php
session_start();

include_once '../functions/montage.php';

if (empty($_FILES) || empty($_POST)) {
    return;
}
if (isset($_POST['filter']))
    $filter = $_POST['filter'];

switch($_FILES['file']['type']) {
    case "image/png":
    $type = ".png";
    break;
    case "image/jpg":
    $type = ".jpg";
    break;
    case "image/jpeg":
    $type = ".jpeg";
    break;
    default:
    $type = null;
    break;
}

if ($type !== null && 
($filter == "illuminati.png" 
|| $filter == "barbe.png" 
|| $filter == "lunettes.png" 
|| $filter == "diademe.png")) {
    if ($_FILES['file']['size'] < $_POST['MAX_FILE_SIZE'] && $_FILES['file']['error'] === 0) {
        echo "<br/>Coucou";
        $filter="../img/".$filter;
        $i_id = uniqid();
        $montageDir = "../montage/".$i_id. $type;
        $id = $_SESSION['id'];
        if (!file_exists("../montage/")) {
            mkdir("../montage/");
        }
        echo $montageDir;
        echo $_FILES['file']['tmp_name'];
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $montageDir)) {
            echo "<br/>cant upload";
            return ;
        }
        $data= file_get_contents($montageDir);
        $source = imagecreatefrompng("../img/".$filter);
        $destination = imagecreatefromstring($data);

        if ($filter == "../img/lunettes.png")
            $trueColor = imagecreatetruecolor(195, 175);
        elseif ($filter == "../img/barbe.png")
            $trueColor = imagecreatetruecolor(330, 250);
        else $trueColor = imagecreatetruecolor(240, 180);

        imagealphablending($trueColor, false);
        imagesavealpha($trueColor, true);

        if (strcmp($filter, "../img/lunettes.png") == 0)
        imagecopyresized($trueColor, $source, 0, 0, 0, 0, 320, 230, 1024, 768);
        else if (strcmp($filter, "../img/barbe.png") == 0)
          imagecopyresized($trueColor, $source, 0, 0, 0, 0, 331, 350, 1024, 1024);
        else if (strcmp($filter, "../img/illuminati.png") == 0)
          imagecopyresized($trueColor, $source, 0, 0, 0, 0, 480, 300, 1024, 768);
        else imagecopyresized($trueColor, $source, 0, 0, 0, 0, 332, 352, 512, 384);


        $source_w = imagesx($trueColor);
        $source_h= imagesy($trueColor);
        $dest_w = imagesx($destination);
        $dest_h = imagesy($destination);

        switch ($filter) {
            case "diademe.png":
                $dest_x = 206;
                $dest_y = 0;
                break;
            case "barbe.png":
                $dest_x = 150;
                $dest_y= 150;
                break;
            case "lunettes.png":
                $dest_x = 240;
                $dest_y = 0;
            case "illuminati.png":
                $dest_x = 206;
                $dest_y = 100;
                break;
        }
        imagecopymerge_alpha($destination, $trueColor, $dest_x, $dest_y, 0, 0, $source_w, $source_h, 100);

        $success = imagepng($destination, $montageDir);
        if ($success) {
            if (($val = put_montage($id, $i_id.$type)) === 0) {
                header('Location: ../index.php');
            }
    }
}


function imagecopymerge_alpha($dest, $srcIm, $dest_x, $dest_y, $src_x, $src_y, $src_w, $src_h, $wateva) {
    $cut = imagecreatetruecolor($src_w, $src_h);
    imagecopy($cut, $dest, 0, 0, $dest_x, $dest_y, $src_w, $src_h);
    imagecopy($cut, $srcIm, 0, 0, $src_x, $src_y, $src_w, $src_h);
    imagecopymerge($dest, $cut, $dest_x, $dest_y, 0, 0, $src_w, $src_h, $wateva);
}