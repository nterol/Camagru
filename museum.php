<?php
    session_start();

    echo ($_SERVER['']);
    include_once("functions/montage.php");
    // include_once("functions/like.php");
    include_once("functions/display_infinite.php");

    $imgPerPages = 4;
    $current_user = $_SESSION['id'];

    $montages = get_all_montage();
    $more = false;
    if ($montages != "" && array_key_exists("more", $montages)) {
      $more = true;
      $lastIdMontage = $montages[count($montages) - 2]['id'];
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Camagru</title>
  <link rel="stylesheet" type="text/css" href="./style/header.css">
  <link rel="stylesheet" type="text/css" href="style/parts.css">
  <link rel="stylesheet" type="text/css" href="style/museum.css">
</head>
<body>
<?php include "parts/header.php" ?>
  <div id="views">
    <?php
    if (isset($montages['error'])) {
      echo $montages['error'];
    } else if ($montages != null) {
        display_infinite($montages, $current_user);
        
        }
        ?>
        </body>
        </html>