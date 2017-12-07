<?php
session_start();

include_once("./functions/comments.php");
include_once("./functions/like.php");

function get_color($comment_username, $current_user) {
    if ($comment_username === $current_user)
        $com_color = "grey";
    else $com_color = "blue";
    return ($com_color);
}


function print_comment($comments, $current_username) {

    foreach($comments as $message) {
        $com_color = get_color($message['username'], $current_username);
        if ($com_color === "grey")
            $name_side = "you";
        else $name_side = "me";
        if ($message != null) {
            echo("
            <div class=\"all\">
                <span class=\"username ".$name_side."\">". $message['username']. "</span>
                <div class=\"message ".$com_color."\">
                    <span class=\"content\">". $message['comment'] ."</span>
                    <span class=\"diverse\">
                 <span class=\"date\">" . $message['date'] . "</span>
                 </span>
            </div>
            </div>");
        }
    }
}

function define_like($firstLove) {
    $current_userid = $_SESSION['id'];
    foreach ($firstLove as $like) { 
        if ($like['touch'] == 1 && $current_userid == $like['userid']) {
            $like['src'] = "img/heart.png";
            $like['url'] = "&type=unlike";
            return ($like);
         } 
        }
        $like = array(
            "src" => "img/no_heart.png",
            "url" => "&type=like"
        );
        return ($like);
}

function display_infinite($montages) {
    $current_username = $_SESSION['username'];
    $i = 0;
    foreach($montages as $picture) {
        $i++;
        $firstLove = get_like($picture['id'], $picture['img']);
        $nb_like = count($firstLove);
        $like = define_like($firstLove);
        $comments = get_comment($picture['id'], $picture['img']);
        if ($i > 6) {
            $card_class = "card-hidden";
        } else $card_class = "card";
        echo "
        <div class=\"". $card_class ."\" id=\"post" .$i . "\">
            <div class=\"photoCell\" id=\"". $picture['id'] ."\">
                <img class=\"photo\" src=\"montage/" . $picture['img'] . "\" />
                <div class=\"overlay\">
                    <a href=\"./forms/push_like.php?img=". $picture['img'] . "&id=". $picture['id'] . $like['url']. "\">
                        <img class=\"like-overlay\" src=\"". $like['src']. "\">
                    </a>
                </div>
            </div>
            <div class=\"misc\">
                <span class=\"like\">
                <img class=\"icon\" src=\"".$like['src'] ."\"/>
                <span class=\"nb-like\">". $nb_like . "<span\">
                <span></span>
                <span>
            </div>
                    <div class=\"comment-section\">
                        <div class=\"forum\">"; 
                            print_comment($comments, $current_username);
                            echo "
                        </div>
                        <div class=\"text-section\">
                            <form method=\"post\" action=\"./forms/comment.php\">
                            <input type=\"hidden\" name=\"data-id\" value=\"". $picture['id'] ."\" />
                            <input type=\"hidden\" name=\"data-img\" value=\"". $picture['img']."\" />
                            <textarea placeholder=\"Say something...    \" name=\"comment-area\"rows=\"3\"></textarea>
                            <input name=\"submit\" type=\"submit\" value=\"Envoyer\">
                            </form>
                        </div>
                    </div>
        </div>
        ";
    }
} 