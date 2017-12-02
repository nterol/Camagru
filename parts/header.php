<div id="header">
    <div class="Camagru">
       <span class="camagru-title">Camagru</span>
    </div>
    
    <?php 
        $tab = explode("/", $_SERVER['REQUEST_URI']);
        if ($tab[2] == "museum.php") {?> 
    <div class="button-header" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']."/".$tab[1] ?>/gallery.php'">
        <span>Photobooth</span>
    </div>
    
    <?php } else {?>
    <div class="button-header" onclick="location.href='http://<?php echo  $_SERVER['HTTP_HOST']."/".$tab[1] ?>/museum.php'">
        <span>Gallery</span>
    </div>
    <?php } 
        if (isset($_SESSION['id'])) { ?> 
    <div class="button-header" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']."/".$tab[1] ?>/forms/disconnect.php'">
        <span> Deconnexion </span>
    </div>
    <?php } else { ?>
    <div class="button-header" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']."/".$tab[1]?>/gallery.php'">
        <span>Login</span>
    </div>
    
    <?php } ?>
</div> 