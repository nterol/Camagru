<?php
session_start();

// include_once("./functions/like.php");
// include_once("./functions/comment.php");

// function get_comment($src) {
//     include_once './setup/database.php';

// }

function display_infinite($montages) {
    print_r($montages);
    // foreach($montages as $picture) {
    //     if ($picture['id'] > 9) {
    //         $card_class = "card-hidden";
    //     } else $card_class = "card";
    //     echo "
    //     <div class=\"". $card_class . "\">
    //         <div class=\"photo\" id=\"". $picture['id'] ."\">
    //             <img src=\"montage/" . $picture['img'] . "\" />
    //         </div>
    //         <div class=\"misc\">
    //             <span class=\"like\"
    //             <img src=\"img/up.png\"/>
    //         </div>
    //         <div class=\"comments\">
    //         <div class=\"forum\">
    //             <div id=nb></div>
    //         </div>
    //         <textarea name="" id="" cols="30" rows="10"></textarea>
    //     </div>
    //     </div>
    //     ";
}