const montage = document.getElementByClassName('removable');
const parent = document.getElementById('miniatures');


for (let i = 0; i < montages.length; i++) {
    montage[i].onclick = function (event) {
        const pathToImg = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
        const srcTab = pathToImg.split('/');
        const src = srcTab[srcTab.length - 1];

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText == 'OK') {
                parent.removeChild(event.srcElement || event.target);
            }
            xhr.open("POST", "./forms/removemontage.php", true);
            xhr.setRequestHeader("Content-type", "applications/x-www-form-urlencoded");
            xhr.send("src=" + src);
        };
    }
