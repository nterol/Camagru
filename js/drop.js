var montage = document.getElementByClassName("removable");
var parent = document.getElementById("miniatures");


for (var i = 0; i < montages.length, i++) {
  montage[i].onclick = function(event) {
    var pathToImg = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
    var srcTab = pathToImg.split('/');
    var src = srcTab[srcTab.length - 1];

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText == "OK") {
        parent.removeChild(event.srcElement || event.target);
      }
    };
    xhr.open("POST", './forms/removemontage.php', true);
    xhr.setRequestHeader('Content-type', "applications/x-www-form-urlencoded");
    xhr.send("src=" + src);
  }
}
