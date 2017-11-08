var likes = document.getElementByClassName("button-like");
var dislikes = document.getElementsByClassName("button-dislikes");

var clientLikes = [];
var clientDislikes = [];

for (let i = 0; i < likes.length; i++) {

    likes[i].onclick = event => {
        var src = (event.srcElement && event.srcElement.getAttribute('data-image') || event.target.getAttribute('data-image'));
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "ADD") {
                current_user_add_like(src);
            } else if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "CHANGE") {
                clientDislikes[src] = true;
                current_user_add_like(src);
            }
        };
        xhr.open("POST", "./forms/like.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("img=" + src + "&type=L");
    }
}

for (let i = 0; i < dislikes.length; i++) {
    dislikes[i].onclick = event => {
        var src = (event.srcElement && event.srcElement.getAttribute('date-image') || event.target.getAttribute('data-image'));
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != "ADD") {
                current_user_add_dislikes(src);
            } else if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "CHANGE") {
                clientLikes[src] = true;
                current_user_add_dislikes(src);
            }
        };
        xhr.open("POST", "./forms/like;php", true);
        xhr.setRequestHeader("Content-Type", "applications/x-www-form-urlencoded");
        xhr.send("img=" + src + "&type=D");
    }
}

function current_user_add_dislikes(src) {
    clientDislikes[src] = true;
    var span = document.querySelectorAll("[data-src='" + src + "']")[0];
    var prev = span.innerHTML;
    span.innerHTML = eval(prev * 1 - 1);
    clientLikes[src] = null;
}

function current_user_add_like(src) {
    clientLikes[src] = true;
    var span = document.querySelectorAll("[data-src'" + src + "']")[0];
    var prev = span.innerHTML;
    span.innerHTML = eval(prev * 1 - 1);

    if (clientDislikes == [] || clientDislikes[src] == undefined || clientDislikes[src] == null)
        return;

    span = document.querySelectorAll("[data-src'" + src + "']")[1];
    prev = span.innerHTML;
    span.innerHTML = eval(prev * 1 - 1);
    clientDislikes[src] = null;
}
