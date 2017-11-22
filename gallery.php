<?php
session_start();
include_once("./functions/montage.php");
$montages = get_all_montage();
?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="style/gallery.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style/test.css">
        <title>gallery</title>
    </head>

    <body>
        <?php include('./parts/header.php') ?>

        <?php if (isset($_SESSION['id'])) {
    ?>
        <div class="welcome" onclick="this.style.display = 'none';">
            <span onclick="this.parentNode.style.display = 'none';" class="closebtn">&otimes;</span>
            <p>Bienvenue sur camagru,
                <?php echo htmlspecialchars(ucfirst($_SESSION['username'])); ?>
            </p>
        </div>
        <div class="body">

            <div class="main">
                <div class="select">
                    <img class="diademe thumbnail" src="img/diademe.png" />
                    <input class="box" id="diademe.png" onclick="onBoxChecked(this)" type="radio" name="img" value="./img/diademe.png">
                    <img class="lunettes thumbnail" src="img/lunettes.png" />
                    <input class="box" id="lunettes.png" type="radio" name="img" value="./img/lunettes.png" onclick="onBoxChecked(this)">
                    <img class="illuminati thumbnail" src="img/illuminati.png" />
                    <input class="box" id="illuminati.png" type="radio" name="img" value="./img/illuminati.png" onclick="onBoxChecked(this)">
                    <img class="barbe thumbnail" src="img/barbe.png" />
                    <input class="box" id="barbe.png" type="radio" name="img" value="./img/barbe.png" onclick="onBoxChecked(this)">
                </div>
                <video width="100%" autoplay="true" id="webcam"></video>
                <div id="camera-not-available">LA CAMERA N'EST PAS DISPONIBLE</div>
                <img id="diademe" style="display:none;" src="img/diademe.png" />
                <img id="lunettes" style="display:none;" src="img/lunettes.png" />
                <img id="illuminati" style="display:none;" src="img/illuminati.png" />
                <img id="barbe" style="display:none;" src="img/barbe.png" />
                <div class="capture" id="capture-button">
                    <img class="camera" src="img/camera.png" />
                </div>
                <canvas id="canvas" width="640" height="480"></canvas>
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
        foreach($montages as $i) {
            $class = "icon";
            if ($i['userid'] === $_SESSION['id']) {
                $class .= "removable";
            }
            $gallery .= "<img class=\"" .$class . "\" src=\"./montage/" . $i['img'] . "\"data-userid=\"" .$i['userid']. "\"/>";
        }
        echo $gallery;
    } ?>
                </div>
            </div>
        </div>
        <?php
} else {
        ?>
            <div class="overlay">
                <div class="title-forms">
                    <h1>Connexion</h1>
                </div>
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
        $_SESSION['error'] = null;
    }
                            ?>
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
    <script type="text/javascript" src="./js/webcam.js"></script>
    <script type="text/javascript" src="./js/drop.js"></script>
    <script type="text/javascript" src="./js/import.js"></script>
    <?php
    }
?>

    </html>
