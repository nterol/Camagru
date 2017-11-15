var video = document.querySelector("#webcam");
var canvas = document.getElementById('canvas');
var button = document.getElementById('pickImage');
var miniatures = document.getElementById('miniatures');
var inputFile = document.getElementById('takePicture');
var pickFile = document.getElementById('pickFile');
var notAvailable = document.getElementById('camera-not-available');

var diademe = document.getElementById('diademe');
var lunettes = document.getElementById('lunettes');
var illuminati = document.getElementById('illuminati');
var barbe = document.getElementById('barbe');
var cameraAvailable = false;

var promiseOldGUM = function (constraints) {

    var getUserMedia = (navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.oGetUserMedia ||
        navigator.msGetUserMedia);

    if (!getUserMedia) {
        return Promise.reject(new Error('getUserMedia is not implemented on this browser'));
    }

    return new Promise(function (resolve, reject) {
        getUserMedia.call(navigator, constraints, resolve, reject);
    });
};

if (navigator.mediaDevices === undefined) {
    navigator.mediaDevices = {};
}

if (navigator.mediaDevices.getUserMedia === undefined) {
    navigator.mediaDevices.getUserMedia = promiseOldGUM;
}

var constraints = {
    video: true
};

navigator.mediaDevices.getUserMedia(constraints).then(handleVideo).catch(videoError);

function handleVideo(stream) {
    video.src = window.URL.createObjectURL(stream);
    cameraAvailable = true;
    video.style.display = "block";
    notAvailable.style.display = "none";
    button.onclick = () => {
        var image = new Image();
        canvas.style.display = "none";
        pickFile.style.display = "none";

        image.addEventListener("load", () => {
            if (file === "diademe.png") {
                canvas.getContext('2d').drawImage(image, 0, 0, 1024, 768, 0, 0, 640, 480);
            } else if (file === "lunettes.png") {
                canvas.getContext('2d').drawImage(image, 0, 0, 1024, 768, 0, 0, 640, 480);
            } else if (file === "illuminati.png") {
                canvas.getContext('2d').drawImage(image, 0, 0, 1024, 768, 0, 0, 640, 480);
            } else {
                canvas.getContext('2d').drawImage(image, 0, 0, 1024, 768, 0, 0, 640, 480);
            }
        }, false);

        image.src = document.querySelector('input[name="img"]:checked').value;
        var split = image.src.split("/");
        var file = split[split.length - 1];
        canvas.getContext("2d").drawImage(video, 0, 0, 640, 480, 0, 0, 640, 480);
        var img = canvas.toDataURL("image/png");

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "") {
                var newImg = document.createElement("IMG");
                newImg.className = "icon removable";
                newImg.src = "montage/" + xhr.responseText;

                newImg.onclick = event => {
                    var pathToImg = event.srcElement.src;
                    var srcTab = pathToImg.split('/');
                    var src = srcTab[srcTab.length - 1];

                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = () => {
                        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText == "OK") {
                            miniatures.removeChild(event.srcElement);
                        }
                    };
                    xhr.open("POST", "./forms/removemontage.php", true);
                    xhr.setRequestHeader("Content-type", "applications/x-www-form-urlencoded");
                    xhr.send("src=" + src);
                }
                miniatures.appendChild(newImg);
            }
        };
        xhr.open("POST", "forms/montage.php", true);
        xhr.setRequestHeader("Content-type", "applications/x-www-form-urlencoded");
        xhr.send("img=" + "../img/" + file + "&f=" + img);
    };
}

function videoError() {
    cameraAvailable = false;
    video.style.display = "none";
    notAvailable.style.display = "block";
}

function onBoxChecked(box) {
    if (cameraAvailable) {
        button.style.display = "block";
        if (box.id === "diademe.png") {
            diademe.style.display = "block";
            lunettes.style.display = "none";
            illuminati.style.display = "none";
            barbe.style.display = "none";
        } else if (box.id === "lunettes.png") {
            diademe.style.display = "none";
            lunettes.style.display = "block";
            illuminati.style.display = "none";
            barbe.style.display = "none";
        } else if (box.id === "illuminati.png") {
            diademe.style.display = "none";
            lunettes.style.display = "none";
            illuminati.style.display = "block";
            barbe.style.display = "none";
        } else if (box.id === "barbe.png") {
            diademe.style.display = "none";
            lunettes.style.display = "none";
            illuminati.style.display = "none";
            barbe.style.display = "block";
        }
    }
    inputFile.style.display = "block";
    if (inputFile.files.length) {
        var image = new Image();
        var img = new Image();
        image.addEventListener("load", () => {
            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
            canvas.getContext("2d").drawImage(image, 0, 0, image.width, image.height, 0, 0, 640, 480);
            var data64img = canvas.toDataURL(image.type);
            window.URL.revokeObjectURL(file);

            img.src = document.querySelector('input[name="img"]:checked').value;
            var split = img.src.split("/");
            var file = split[split.length - 1];

            if (file === "diademe.png")
                canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 100, 300, 240, 180);
            else if (file === "lunettes.png")
                canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 100, 200, 240, 180);
            else if (file === "illuminati.png")
                canvas.getContext("2d").drawImage(img, 0, 0, 1064, 768, 100, 250, 540, 540);
            else if (file === "barbe.png")
                canvas.getContext("2d").drawImage(img, 0, 0, 1064, 768, 100, 300, 512, 512);
            pickFile.onclick = () => sendMontage(data64img, file);
        }, false);
        image.src = window.URL.createObjectURL(inputFile.files[0]);
    }
}

function sendMontage(imgData64, filterImg) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null || xhr.responseText != "") {
            var newImg = document.createElement("IMG");
            newImg.className = "icon removable";
            newImg.src = "montage/" + xhr.responseText;
            newImg.onclick = function (event) {
                var pathToImg = event.srcElement.src;
                var srcTab = pathToImg.split('/');
                var src = srcTab[srcTab.length - 1];

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText == "OK") {
                        miniatures.removeChild(event.srcElement);
                    }
                };
                xhr.open("POST", './forms/removemontage.php', true);
                xhr.setRequestHeader('Content-type', "applications/x-www-form-urlencoded");
                xhr.send("src=" + src);
            }
            miniatures.appendChild(newImg);
        }
    };
    xhr.open("POST", './forms/montage.php', true);
    xhr.setRequestHeader('Content-type', "applications/x-www-form-urlencoded");
    xhr.send("img=" + "../img/" + filterImg + "&f=" + imgData64);
}
