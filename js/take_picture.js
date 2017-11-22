(function() {

  document.getElementById('filter_input').disabled = false;
  document.getElementById('filter_input2').disabled = false;
  document.getElementById('filter_input3').disabled = false;
    
      var streaming = false,
          video        = document.querySelector('#webcam'),
          cover        = document.querySelector('#cover'),
          canvas       = document.querySelector('#canvas'),
          startbutton  = document.querySelector('#startbutton'),
          uploadbutton = document.querySelector('#uploadbutton');
          data = undefined,
          width = 1080,
          height = 0;
    
          navigator.getMedia = ( navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia ||
            navigator.msGetUserMedia);

        navigator.getMedia(
        {
        video: true,
        audio: false
        },
        function(stream) {
          if (navigator.mozGetUserMedia) {
            video.mozSrcObject = stream;
          } else {
            var vendorURL = window.URL || window.webkitURL;
              video.src = vendorURL.createObjectURL(stream);
          }
          video.play();
        },
        function(err) {
          console.log("An error occured! " + err);
        }
      );
      
      video.addEventListener('canplay', function(ev){
        if (!streaming) {
          height = video.videoHeight / (video.videoWidth/width);
          video.setAttribute('width', width);
          video.setAttribute('height', height);
          canvas.setAttribute('width', width);
          canvas.setAttribute('height', height);
          streaming = true;
          canvas.width = width;
          canvas.height = height;

        }
      }, false);

      function takepicture() {
        var filter = undefined;
        var data = undefined;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);

        data = canvas.toDataURL('image/png');

        if(document.getElementById('diademe.png').checked)
          filter = "diademe";
        else if(document.getElementById('lunettes.png').checked)
          filter = "lunettes";
        else if(document.getElementById('illuminati.png').checked)
          filter = "illuminati";
        else if(document.getElementById('barbe.png').checked)
          filter = "barbe";
        loadXMLDoc(data, filter);
      }

      function draw() {
        var ctx=canvas.getContext("2d");
        var img=document.getElementById("masque");
        ctx.drawImage(img,0,0);
    };

      startbutton.addEventListener('click', function(ev){
          takepicture();
        ev.preventDefault();
      }, false);
    
      function loadXMLDoc(data, filter) {
        var xhr = new XMLHttpRequest();
    
        xhr.onreadystatechange = function () {
          var DONE = 4; // readyState 4 means the request is done.
          var OK = 200; // status 200 is a successful return.
          if (xhr.readyState === DONE) {
            if (xhr.status !== OK){
              console.log('Error: ' + xhr.status); // An error occurred during the request.
            }
          }
        };
        
        xhr.open('POST', 'functions/f_photomontage.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=iso-8859-1');
        xhr.send(encodeURI('data=' + data)+  encodeURI('&filter=' + filter));
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
                  canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 180, 0, 240, 180);
              else if (file === "lunettes.png")
                  canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 240, 0, 240, 180);
              else if (file === "illuminati.png")
                  canvas.getContext("2d").drawImage(img, 0, 0, 1064, 768, 206, 0, 240, 180);
              else if (file === "barbe.png")
                  canvas.getContext("2d").drawImage(img, 0, 0, 1064, 768, 140, 200, 330, 250);
              pickFile.onclick = () => sendMontage(data64img, file);
          }, false);
          image.src = window.URL.createObjectURL(inputFile.files[0]);
      }
  }

    })();