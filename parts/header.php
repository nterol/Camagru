<div class="header">
<?php 
    $tab = explode("/", $_SERVER['REQUEST_URI']);
   ?>
    <div class="Camagru">
        <span class="camagru-title" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']."/".$tab[1] ?>/index.php'">Camagru.</span>
    </div>
    <div class="nav">

<? if ($tab[2] == "museum.php") {?>
        <div class="button-header" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']."/".$tab[1] ?>/index.php'">
            <span>Photobooth</span>
        </div>
    <?php } else {?>

        <div class="button-header" onclick="location.href='http://<?php echo  $_SERVER['HTTP_HOST']."/".$tab[1] ?>/museum.php'">
            <span>Views</span>
        </div>
    <?php } 
        if (isset($_SESSION['id'])) { 
            if ($tab[2] == "home.php") { ?>
        <div class="button-header" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']."/".$tab[1] ?>'/index.php'">
            <span>Photobooth</span>
        </div>
    <?php } else { ?>
        <div class="button-header" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']."/".$tab[1] ?>/home.php'">
            <span>Settings</span>
        </div>
    <?php } ?>
        <div class="button-header" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']."/".$tab[1] ?>/forms/disconnect.php'">
            <span> Deconnexion </span>
        </div>
    <?php } else { ?>
        <div class="button-header" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']."/".$tab[1]?>/index.php'">
            <span>Login</span>
        </div>
    <?php } ?>
    </div>
</div>
