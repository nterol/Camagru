<div id="header">
    <?php
    if (isset($_SESSION['id'])) {
        ?>
        <div class="button" onclick="location.href='forms/disconnect.php'">
        <span>
            Deconnexion
        </span>
    </div>
    <?php } else { ?>
    <div class="button" onclick="location.href='index.php'"><span>
        Login
    </span>
    </div>
    <?php } ?>
    <?php
    if (isset($_SESSION['id'])) {
    ?>
    <div class="button" onclick="location.href='gallery.php'">
        <span>
            Views
        </span>
    </div>
    <?php } ?>   
</div>