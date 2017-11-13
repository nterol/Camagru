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
        <link rel="stylesheet" type="text/css" href="style/test.css">
        <title>gallery</title>
    </head>

    <body>
        <?php //include('./parts/header.php') ?>

        <?php if (isset($_SESSION['id'])) {
    ?>
        <div class="welcome" onclick="this.style.display = 'none';">
            <span onclick="this.parentNode.style.display = 'none';" class="closebtn">&otimes;</span>
            <p>Bienvenue sur camagru,
                <?php echo htmlspecialchars(ucfirst($_SESSION['username'])); ?>
            </p>
        </div>
        <div class="main">
            <div class="select">
                <div id="diademe.png" type="radio" name="img" value="./img/diademe.png" onclick="onBoxChecked(this)">
                    <img class="thumbnail" src="img/diademe.png" />
                </div>
                <div id="lunettes" type="radio" name="img" onclick="onBoxChecked(this)" value="./img/lunettes.png">
                    <img class="thumbnail" src="img/lunettes.png" />
                </div>
                <div id="illuminati.png" type="radio" name="img" onclick="onBoxChecked(this)" value="./img/illuminati.png">
                    <img class="thumbnail" src="img/illuminati.png" />
                </div>
                <div id="barbe.png" type="radio" name="img" value="./img/barbe.png" onclick="onBoxChecked(this)">
                    <img class="thumbnail" src="img/barbe.png" />
                </div>
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
            $gallery .= "<img class=\"" .$class . "\" src=\"./montage/" . $montages[$i]['img'] . "\"data-userid=\"" .$montages[$i]['userid']. "\"/>";
        }
        echo $gallery;
    } ?>
            </div>
        </div>
        <?php
} else {
        ?>
            <div class="overlay">
                <div class="container">
                    <form method="post" action="forms/login.php">
                        <label> email : </label>
                        <input id="mail" name="email" type="mail">
                        <label> password : </label>
                        <input id="password" name="password" type="password">
                        <input name="submit" type="submit" value="Send">
                        <a href="signup.php">Create account</a>
                        <a href="forgot.php">Mot de passe oublié ?</a>
                        <span>
                    <?php
                    if ($_SESSION['error']) {
                        echo $_SESSION['error'];
                    }
        $_SESSION['error'] = null; ?>
                  </span>
                    </form>
                </div>
            </div>
            <?php
    } ?>
                <?php //include './parts/footer.php' ?>

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
