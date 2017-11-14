<?php
    session_start();

    include_once("functions/montage.php");
    include_once("functions/like.php");

    $imgPerPages = 5;

    $montages = get_montage(0, $imgPerPages);
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
  <link rel="stylesheet" type="text/css" href="style/views.css">
  <link rel="stylesheet" type="text/css" href="style/parts.css">
</head>
<body>
<?php include "parts/header.php" ?>
  <div id="views">
    <?php
    if (isset($montages['error'])) {
      echo $montages['error'];
    } else if ($montages != null) {
      for ($i = 0; $montages[$i] && $i < $imgPerPages; $i++) {
        $class = "icon";
        if ($montages[$i]['userid'] === $_SESSION['id'])
          $class .= " removable";
        $comments = get_comment($montages[$i]['img']);
        $j = 0;
        while ($comments[$j] != null) {
          $commentToHTML .= "<span class=\"comment\">" .htmlspecialchars($comments[$j]['username']).": " .htmlspecialchars($comments[$j]['comment'])."</span>";
          $j++;
        }
        $gallery .= "
        <div class=\"img\" data-img=\"".$montages[$i]['img']."\">
          <img class=\"".$class."\" src=\"montage/".$montages[$i]['img']."\" />
          <div id=\"button-like\">
            <img class=\"button-like\" src=\"img/up.png\" data-image=\"".$montages[$i]['img']."\" />
        <span class=\"nb-like\" data-src=\"".$montages[$i]['img']."\">".get_nb_like($montages[$i]['img'])."</span>
        <img class=\"button-dislike\" src=\"img/down.png\" data-image=\"".$montages[$i]['img']."\" />
        <span class=\"nb-dislike\" data-src=\"".$montages[$i]['img']."\">".get_nb_dislikes($montages[$i]['img'])."</span>
        </div>"
        .$commentToHTML.
        "</div>";
      }
      echo $gallery;
    }
    ?>
  </div>
  <div id="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&otimes;</span>
      </div>
      <div class="modal-body">
        <img id="img-modal" />
      </div>
      <div class="modal-footer">
        <textarea
        <?php 
        if(!$_SESSION['id']) 
          echo "disabled"
        ?>
        id="comment" placeholder="Laisse un gentil com..." rows="10" cols="50" maxlength="255"></textarea>
        <div
        <?php
        if (!$_SESSION['id'])
          echo "diable=\"true\""
          ?>
        id="send-comment" class="button-send 
        <?php
        if (!$_SESSION['id']) echo "disabled"
        ?>
        ">Send</div>
      </div>
    </div>
  </div>
  <?php if ($more === true) {?>
    <div id="load-more" onclick="loadMore(<?php echo ($lastIdMontage) ?>, <?php echo($imgPerPages) ?>)">...Load more</div>
  <?php } ?>
</body>
<script src="js/modal.js"></script>
<script src="js/like.js"></script>
<script src="js/loadMore.js"></script>
</html>
