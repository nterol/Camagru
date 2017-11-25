<div id="header">
    <section class="animate">
        <button class="draw">Camagru</button>
    </section>
    
    <?php if (isset($_SESSION['id'])) {
        $tab = explode("/", $_SERVER['REQUEST_URI']);
        if ($tab[2] == "museum.php") {?>
    
    <div class="button-header" onclick="location.href='gallery.php'">
        <span>Views</span>
    </div>
    
    <?php } else if ($tab[2] == "gallery.php") {?>
    
    <div class="button-header" onclick="location.href='museum.php'">
        <span>Gallery</span>
    </div>

        <?php } ?> 

    <div class="button-header" onclick="location.href='forms/disconnect.php'">
        <span> Deconnexion </span>
    </div>

    <?php } else { ?>
    
    <div class="button-header" onclick="location.href='gallery.php'">
        <span>Login</span>
    </div>
    
    <?php } ?>

</div> 