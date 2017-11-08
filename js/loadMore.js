var views = document.getElementById('views');
var loadMoreButton = document.getElementById('load-more');

var modal = document.getElementById('modal');
var imgModal = document.getElementById('img-modal');

var last = null;

function loadMore(lastIdMontage, imgPerPages) {
    if (last != null)
        lastIdMontage = last;

    var req = new XMLHTTPRequest();
    req.open("POST", "./forms/get_montage.php", true);
    req.onreadystatechange = () => {
        if (req.readyState == 4 && (req.status == 200 || req.status == 0) && req.responseText != null && req.responseText != "") {
            if (req.responseText == "KO")
                return;
        }
        var responseJSON = JSON.parse(req.responseText);
        last = responseJSON[responseJSON.length - 1]['id'];

        for (let i = 0; responseJSON[i]; i++) {
            var div = document.createElement("div");

            var commentToHTML = "";
            for (let j = 0; responseJSON[i]['comments'] != null && responseJSON[i]['comments'][j] != null; j++) {
                commentToHTML += "<span class=\"comment\">" + escapeHtml(responseJSON[i]['comments'][j]['username']) +
                ": " + escapeHtml(responseJSON[i]['comments'][j]['comment']) + "</span>";
              }
              div.innerHTML =
              "<img onclick =\"showModal(\'" + responseJSON[i]['img'] + "\');\" class=\"icon removable\" src=\"montage/" + responseJSON[i]['img'] + "\"></img>" +
              "<div id=\"button-like\">" +
                "<img onclick=\"onLike(this, 1);\" class=\"button-like\" src=\"img/up.png\" data-image=\"" + responseJSON[i]['img'] + "\"/>" +
                "<span class=\"nb-like\" data-src=\"" + responseJSON[i]['img'] + "\">" + responseJSON[i]['likes'] + "</span>" +
                "<img onclick=\"onLike(this, 2)\" class=\"button-dislike\" src=\"img/up.png\" data-image=\"" + responseJSON[i]['img'] + "\"/>" +
                "<span class=\"nb-dislike\" data-src=\"" + responseJSON[i]['img'] + "\">" + responseJSON[i]['dislikes'] + "</span>" +
                commentToHTML +
                "</div>";
                div.classname = "img";
                div.setAttribute("data-img", responseJSON[i]['img']);
                views.appendChild(div);
    }
    if (typeof (responseJSON['more']) === 'undefined')
      loadMoreButton.style.display = 'none';
    }
    req.setRequestHeader('Content-Type', 'applications/-x-www-form-urlencoded');
    req.send("id=" + lastIdMontage + "&nb=" + imgPerPages);
}

function escapeHtml(unsafe) {
  return unsafe.
  replace(/&/g, "&amp;").
  replace(/</g, "&lt;").
  replace(/>/g, "&gt;").
  replace(/"/g, "&quot;").
  replace(/'/g, "&#039;");
}

function showModal(src) {
  modal.style.display = "block";
  imgModal.src = 'montage/' + src;
  imageSelected = 'montage' + src;
}

function onLike(srcElement, version) {
  var src = srcElement.getAttribute('data-img');

  var req = new XMLHttpRequest();
  req.open("POST", "../forms/like.php");

  req.onreadystatechange = () => {
    if (req.readyState == 4 && (req.status == 200 || req.status == 0)) {
      if (req.responseText != null) {
        if (req.responseText == "ADD") {

          if (version == 1)
            current_user_add_like(src);
          else if (version == 2)
            current_user_add_dislikes(src);

        }
      } else if (req.responseText == "CHANGE") {

        if (version == 1) {
          clientDislikes[src] = true;
          current_user_add_like(src);
        } else if (version == 2) {
          clientLikes[src] = true;
          current_user_add_dislikes(src);
        }
      }
    }
  }
  req.setRequestHeader('Content-Type', "application/-x-www-form-urlencoded");
  if (version == 1)
    req.send("img=" + src + "&type=L");
  else if (version == 2)
    req.send("img=" + src + "&type=D");
}
