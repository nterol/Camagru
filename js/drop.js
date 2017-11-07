var montage = document.getElementByClassName("removable");
var parent = document.getElementById("miniatures");

for (let i = 0; i < montage.length; i++) {
  montage[i].onclick = event => {
    var pathToImg = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
    console.log(pathToImg);
    var srcTab = pathToImg.split('/');
    var img = srcTab[srcTab.length - 1];

    var req = new XMLHttpRequest();
    req.open("POST", "./forms/removemontage.php", true);
    req.onreadystatechange = () => {
      if (req.readyState == 4 && (req.status == 200 || req.status == 0) && req.responseText == "OK")
        parent.removeChild(event.srcElement || event.target);
    };
    req.setRequestHeader("Content-Type", "application/-x-www-form-urlencoded");
    req.send("src=" + img);
  }
}
