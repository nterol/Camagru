<?php
session_start();

include_once("./functions/comments.php");

function get_color($id, $current_user) {
    if ($id === $current_id)
        $com_color = "grey";
    else $com_color = "blue";
    return ($com_color);
}

function print_comment($comments, $current_user) {

    foreach($comments as $message) {
        echo "
        <div class=\"message\">
            <p class=\"content\">". $message['comment'] ."</p>
            <p class=\"diverse\">" . $message['username'] . "</p>
        </div>";
    }
}


function display_infinite($montages, $current_user) {
    foreach($montages as $picture) {
        $comments = get_comment($picture['img']);
        print_r($comments);
        if ($picture['id'] > 9) {
            $card_class = "card-hidden";
        } else $card_class = "card";
        echo "
        <div class=\"". $card_class . "\">
            <div class=\"photo\" id=\"". $picture['id'] ."\">
                <img src=\"montage/" . $picture['img'] . "\" />
            </div>
            <div class=\"misc\">
                <span class=\"like\"
                <img src=\"img/up.png\"/>
            </div>
            <div class=\"panel-group\" id=\"accordion\">
                <div class=\"comments panel panel-default\" id=\"panel". $picture['id'] . "\">
                    <div class=\"panel-heading\">
                        <h4 class=\"panel-heading\">
                            <a data-toggle=\"collapse\" data-target=\"#collapse" . $picture['id'] . "\"
                            href=\"#collapse" . $picture['id'] . "\">
                            Comments
                            </a>
                        </h4>
                    </div>

                    <div id=\"collapse" . $picture['id'] . "\" class=\"panel-collapse collapse in\">
                        <div \"panel-body\">
                            <div =\"forum\">
                            ";
        print_comment($comments, $current_user);
        echo                    "
                            </div>
                            <form method=\"post\" action=\"./forms/comment.php\">
                            <input type=\"hidden\" name=\"data\" value=\"". $picture['id'] ."\" />
                                <textarea name=\"comment-area\" cols=\"30\" rows=\"10\"></textarea>
                                <input name=\"submit\" type=\"submit\" value=\"Envoyer\">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
} 