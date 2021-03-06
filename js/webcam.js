var video = document.querySelector("#webcam");
var canvas = document.getElementById('canvas');
var button = document.getElementById('capture-button');
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

        // image.addEventListener("load", () => {
        //     if (file === "diademe.png") {
        //         canvas.getContext('2d').drawImage(image, 0, 0, 1024, 768, 206, 30, 500, 250);
        //     } else if (file === "lunettes.png") {
        //         canvas.getContext('2d').drawImage(image, 0, 0, 1024, 768, 240, 0, 500, 250);
        //     } else if (file === "illuminati.png") {
        //         canvas.getContext('2d').drawImage(image, 0, 0, 1024, 768, 206, 0, 240, 180);
        //     } else {
        //         canvas.getContext('2d').drawImage(image, 0, 0, 1024, 768, 140, 200, 240, 180);
        //     }
        // }, false);

        image.src = document.querySelector('input[name="img"]:checked').value;
        var split = image.src.split("/");
        var file = split[split.length - 1];
        canvas.getContext("2d").drawImage(video, 0, 0, 640, 480, 0, 0, 640, 480);
        var img = canvas.toDataURL("image/png");

        var req = new XMLHttpRequest();
        req.onreadystatechange = function () {
            if (req.readyState == 4 && (req.status == 200 || req.status == 0) && req.responseText != null && req.responseText == "") {
                var newImg = document.createElement("IMG");
                newImg.className = "icon-removable";
                newImg.src = "montage/" + req.responseText;
                console.log(newImg);

                newImg.onclick = event => {
                    console.log("on y passe");
                    var pathToImg = event.srcElement.src;
                    var srcTab = pathToImg.split('/');
                    var src = srcTab[srcTab.length - 1];

                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = () => {
                        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText == "OK") {
                            console.log("ca devrait partir");
                            miniatures.removeChild(event.srcElement);
                        }
                    };
                    xhr.open("POST", "./forms/removemontage.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.send("src=" + src);
                }
                miniatures.appendChild(newImg);
            }
        };
        req.open("POST", "./forms/montage.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send(encodeURI("img=" + "../img/" + file) + encodeURI("&f=" + img));
    };
}

function videoError() {
    cameraAvailable = false;
    video.style.display = "none";
    notAvailable.style.display = "block";
}

function onBoxChecked(box) {
    document.getElementById('submit_file').disabled = false;
    if (cameraAvailable) {
        button.style.display = "block";
        if (box.id === "diademe.png") {
            document.getElementById('file_filter').value = "diademe.png";
            diademe.style.display = "block";
            lunettes.style.display = "none";
            illuminati.style.display = "none";
            barbe.style.display = "none";
        } else if (box.id === "lunettes.png") {
            document.getElementById('file_filter').value = "lunettes.png";
            diademe.style.display = "none";
            lunettes.style.display = "block";
            illuminati.style.display = "none";
            barbe.style.display = "none";
        } else if (box.id === "illuminati.png") {
            document.getElementById('file_filter').value = "illuminati.png";
            diademe.style.display = "none";
            lunettes.style.display = "none";
            illuminati.style.display = "block";
            barbe.style.display = "none";
        } else if (box.id === "barbe.png") {
            document.getElementById('file_filter').value = "barbe.png";
            diademe.style.display = "none";
            lunettes.style.display = "none";
            illuminati.style.display = "none";
            barbe.style.display = "block";
        }
    }
    inputFile.style.display = "block";
    // if (inputFile.files.length) {
    //     var image = new Image();
    //     var img = new Image();
    //     image.addEventListener("load", () => {
    //         canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
    //         canvas.getContext("2d").drawImage(image, 0, 0, image.width, image.height, 0, 0, 640, 480);
    //         var data64img = canvas.toDataURL(image.type);
    //         window.URL.revokeObjectURL(file);

    //         img.src = document.querySelector('input[name="img"]:checked').value;
    //         var split = img.src.split("/");
    //         var file = split[split.length - 1];
    //         console.log("hello");
    //         // if (file === "diademe.png")
    //         //     canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 180, 0, 240, 180);
    //         // else if (file === "lunettes.png")
    //         //     canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 240, 0, 240, 180);
    //         // else if (file === "illuminati.png")
    //         //     canvas.getContext("2d").drawImage(img, 0, 0, 1064, 768, 206, 0, 240, 180);
    //         // else if (file === "barbe.png")
    //         //     canvas.getContext("2d").drawImage(img, 0, 0, 1064, 768, 140, 200, 330, 250);
    //         pickFile.onclick = () => sendMontage(data64img, file);
    //     }, false);
    //     image.src = window.URL.createObjectURL(inputFile.files[0]);
    // }
}

function sendMontage(imgData64, filterImg) {
    console.log("Bonjour");
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null || xhr.responseText != "") {
            var newImg = document.createElement("IMG");
            console.log(xhr.responseText)
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
                xhr.setRequestHeader('Content-type', "application/x-www-form-urlencoded");
                xhr.send("src=" + src);
            }
            miniatures.appendChild(newImg);
        }
    };
    xhr.open("POST", './forms/montage.php', true);
    xhr.setRequestHeader('Content-type', "application/x-www-form-urlencoded");
    xhr.send("img=" + "../img/" + filterImg + "&f=" + imgData64);
}