<?php
session_start();

include_once('functions/montage/php');

$montage = get_all_montage();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style/gallery.css">
  <title>gallery</title>
</head>
<body>
  //inserer le header
  <div class="body">
    <?php if (isset($_SESSION['id'])) {
    ?>
      <div class="main">
        <div class="select">
          <img class="thumbnail" src="img/diademe.png"></img>
          <input id="diademe.png" type="radio" name="img" value="./img/diademe.png" onclick="onCheckBoxChecked(this)">
          <img class="thumbnail" src"img/lunettes.png"></img>
          <input id="lunettes" type="radio" name="img" value="./img/lunettes.png" onclick="onCheckBoxChecked(this)">
          <img class="thumbnail" src="img/illuminati.png"></img>
          <input id="illuminati.png" type="radio" name="img" value="./img/illuminati.png" onclick="onCHeckBoxChecked(this)">
          <img class="thumbnail" src="img/barbe.png"></img>
          <input id="barbe.png" type="radio" name="img" value="./img/barbe.png" onclick="onCheckBoxChecked(this)">
      </div>
      <video width="100%" autoplay="true" id="webcam"></video>
      <div id="camera-not-available">LA CAMERA N'EST PAS DISPONIBLE</div>
      <img id="diademe" style="display:none;" src="img/diademe.png"></img>
      <img id="lunettes" style="displya:none;" src="img/lunettes.png"></img>
      <img id="illuminati" style="display:none;" src="img/illuminati.png"></img>
      <img id="barbe" style="display:none;" src="img/barbe.png"></img>
      <div class="capture" id="pickImage">
        <img class="camera" src="img/camera.png"></img>
      </div>
      <canvas id="canvas" style="display:none;" width="640" height="480"></canvas>
      <div class="captureFile" id="pickFile">
        <img class="camera" src="img/camera.png"></img>
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
<?php
} else {
        ?>
  Connectes toi pour acceder à la galerie copain
      <?php
    }
    ?>
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
