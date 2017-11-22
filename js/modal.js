// Retrieve values from views.php

var modal = document.getElementById('modal');
var montage = document.getElementsByClassName('icon');
var span = document.getElementsByClassName('close');
var imgModal = document.getElementById('img-modal');
var send = document.getElementById('send-comment');
var comment = document.getElementById('comment');

var imageSelected = null;

for (let i = 0; i < montage.length; i++) {
  montage[i].onclick = showModal;
}

function showModal(event) {
  modal.style.display = "block";
  imgModal.src = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
  imageSelected = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
}

montage.onclick = () => (modal.style.display = "block");

span.onclick = () => (modal.style.display = "none");

window.onclick = event => {
  if (event.target == modal)
    modal.style.display = "none";
}

send.onclick = event => {
  var com = comment.value;
  if (com == null || com == "")
    return;

  var tmp = imageSelected.split('/');
  var imagePath = tmp[tmp.length - 1];

  var req = new XMLHttpRequest();
  req.open("POST", "../forms/comment.php");
  req.onreadystatechange = () => {
    if (req.readyState == 4 && (req.status == 200 || req.status == 0) &&
      req.responseText != null && req.responseText != "") {
      comment.value = "";
      modal.style.display = "none";
      var div = document.querySelectorAll("[data-img='" + imagePath + "']")[0];
      var span = document.createElement('span');
      span.innerHTML = req.responseText + ": " + escapeHtml(com);
      span.setAttribute("class", "comment");
      div.appendChild(span);
    }
  };
  req.setRequestHeader("Content-type", "application/-x-www-form-urlencoded");
  req.send("img=" + imagePath + "&comment=" + com);
}

function escapeHtml(unsafe) {
  return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}