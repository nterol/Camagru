<?php
session_start();
include_once("./functions/montage.php");
$montage = get_all_montage();
?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="style/gallery.css">
        <link rel="stylesheet" type="text/css" href="style/parts.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

        <title>gallery</title>
    </head>

    <body>
        <?php include('./parts/header.php') ?>
        <div class="body">

            <?php if (isset($_SESSION['id'])) {
    ?>

            <div class="main">
                <div class="select">
                    <img class="thumbnail" src="img/diademe.png" />
                    <input id="diademe.png" type="radio" name="img" value="./img/diademe.png" onclick="onCheckBoxChecked(this)">
                    <img class="thumbnail" src="img/lunettes.png" />
                    <input id="lunettes" type="radio" name="img" value="./img/lunettes.png" onclick="onCheckBoxChecked(this)">
                    <img class="thumbnail" src="img/illuminati.png" />
                    <input id="illuminati.png" type="radio" name="img" value="./img/illuminati.png" onclick="onCHeckBoxChecked(this)">
                    <img class="thumbnail" src="img/barbe.png" />
                    <input id="barbe.png" type="radio" name="img" value="./img/barbe.png" onclick="onCheckBoxChecked(this)">
                </div>
                <video width="100%" autoplay="true" id="webcam"></video>
                <div id="camera-not-available">LA CAMERA N'EST PAS DISPONIBLE</div>
                <img id="diademe" style="display:none;" src="img/diademe.png" />
                <img id="lunettes" style="display:none;" src="img/lunettes.png" />
                <img id="illuminati" style="display:none;" src="img/illuminati.png" />
                <img id="barbe" style="display:none;" src="img/barbe.png" />
                <div class="capture" id="pickImage">
                    <img class="camera" src="img/camera.png" />
                </div>
                <canvas id="canvas" style="display:none;" width="640" height="480"></canvas>
                <div class="captureFile" id="pickFile">
                    <img class="camera" src="img/camera.png" />
                </div>
                <input type="file" id="takePicture" style="display:none;" accept="image/*">
            </div>
            <div class="side">
                <div class="title">Montages</div>
                <div id="miniatures">
                    <?php
    $gallery="";
    if ($montages != null) {
        for ($i = 0; $montages[$i]; $i++) {
            $class = "icon";
            if ($montages[$i]['userid'] === $_SESSION['id']) {
                $class .= "removable";
            }
            $gallery .= "<img class=\"" .$class . "\" src=\"./montage/" . $montages[$i]['img'] . "\"data-userid=\"" .$montages[$i]['userid']. "\"><img>";
        }
        echo $gallery;
    } ?>
                </div>
            </div>
        </div>
        <?php
} else {
        ?> Connectes toi pour acceder à la galerie copain
        <?php
    } ?>
        <?php include './parts/footer.php' ?>

    </body>
    <?php if (isset($_SESSION['id'])) {
        ?>
    <script type="text/javascript" src="js/webcam.js"></script>
    <script type="text/javascript" src="js/drop.js"></script>
    <script type="text/javascript" src="js/import.js"></script>
    <?php
    }
?>

    </html>
