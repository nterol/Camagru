<?php
    session_start();
    include_once("./functions/montage.php");
    // include_once("functions/like.php");
    include_once("functions/display_infinite.php");
    include_once("./functions/comments.php");
    $montages = get_all_montage();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Camagru</title>
  <link rel="stylesheet" type="text/css" href="style/parts.css">
  <link rel="stylesheet" type="text/css" href="style/museum.css">
</head>
<body>
<?php include "parts/header.php" ?>
  <div class="thegrid">
    <div class="views">
      <?php
      if (isset($montages['error'])) {
        echo $montages['error'];
        print_r($montages);
      }else if (empty($montages)) {
        ?> <div class="card">There is no pictures yet, come back later !</div> <?php 
      } else if ($montages != null) {
            display_infinite($montages);
          }
        ?>
    </div>
    </div>
    <?php include("parts/footer.php")?>
</body>
<script type="text/javascript" src="./js/infinity.js"></script>
</html>