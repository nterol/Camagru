<?php
session_start();
include('./functions/settings.php');

$profile = get_info($_SESSION['id'], $_SESSION['username']);
print_r($_SESSION);
echo "<br />";
print_r($profile);
echo($profile[0]['notifications']);
?>
    <!DOCTYPE HTML>
    <html>

    <head>

        <title>Settings</title>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style/parts.css">
        <link rel="stylesheet" type="text/css" href="style/forms.css">
        <link rel="stylesheet" type="text/css" href="style/home.css">

    </head>

    <body>
        <?php include('./parts/header.php') ?>
        <div class="body-forms">
            <div class="title-forms">
                <h1>My home</h1>
            </div>
            <?php if (!isset($_SESSION)) { ?>
            <div class="container">
                <h1>
                    <?php echo htmlspecialchars("You're not connected") ?>
                </h1>
                <br/>
                <a href="../signup.php">
                    <div>Go Sign Up</div>
                </a>
                <?php
        } else { ?>
                    <div class="container profil">
                        <div class="username">
                            <div class="display-username">
                                <strong>My Username :</strong><br/>
                                <span>
                    <?php
                        echo htmlspecialchars($profile[0]['username']);
                    ?>
                </span>
                            </div>
                            <form method='post' action='./forms/settings.php'>
                                <input placeholder="Change my Username" id="change_username" name="change_username" type="text" size="20">
                                <input name="submit_username" type="submit" value="OK">
                            </form>
                        </div>
                        <div class="mailAdress">
                            <div class="display-mail">
                                <strong>My Mail Adress:</strong><br/>
                                <span>
                        <?php 
                        echo htmlspecialchars($profile[0]['mail']); ?>
                        </span>
                            </div>
                            <form method='post' action='./forms/settings.php'>
                                <input placeholder="Change my mail adress" id="change_mail" name="change_mail" type="text" size="20">
                                <input name="submit_username" type="submit" value="OK">
                            </form>
                        </div>
                        <div class="password">
                            <span>Change password</span>
                            <form method="post" action="./forms/settings.php">
                                <input name="password_one" id="change_password" type="password" placeholder="Entrez votre mot de passe" size="20">
                                <input name="password_two" id="change_password" type="password" placeholder="Confirmez le mot de passe" size="20">
                                <input name="submit_new_password" type="submit" value="OK">
                            </form>
                        </div>
                        <div class="notifications">
                            <form method="post" action="./forms/settings.php">
                                <input type="submit" name="notifications" value="
                                <?php 
    if ($profile[0]['notifications'] == 'Y') { ?>
        Désactiver les notifications
    <?php } else {  ?>
        Activer les notifications<?php } ?>" size="10">
                            </form>
                        </div>
                    </div>
            </div>
        </div>
        <?php } ?>
        <?php include('./parts/footer.php') ?>
    </body>

    </html>
