var camera = (function(args) {
  var width = args.width || 640;
  var height = args.height || 480;
  var shutterCallback = args.shutterCallback || function() {};

  var canvas = document.getElementById(args.canvasId);
  var video = document.getElementById(args.videoId);
  var shutter = document.getElementById(args.shutterId);

  var context = canvas.getContext('2d');
  var videoObject = { video: true };

  var errorCallback = function(error) {
    console.log('Video capture error: ', error.code);
  };

  var initializeWebcam = function() {
    if (navigator.getUserMedia) {
      navigator.getUserMedia(videoObject, function(stream) {
        video.src = stream;
        video.play();
      }, errorCallback);
    } else if (navigator.webkitGetUserMedia) {
      navigator.webkitGetUserMedia(videoObject, function(stream) {
        video.src = window.URL.createObjectURL(stream);
        video.play();
      }, errorCallback);
    } else if (navigator.mozGetUserMedia) {
      navigator.mozGetUserMedia(videoObject, function(stream) {
        video.src = window.URL.createObjectURL(stream);
        video.play();
      }, errorCallback);
    }
  };

  // Resets the canvas
  var clearCanvas = function() {
    context.clearRect(0, 0, width, height);
  };

  // Clicking this button emulates the shutter button
  shutter.addEventListener('click', function() {
    context.drawImage(video, 0, 0, width, height);
    Caman(
      args.canvasId,
      function() {
        this.reloadCanvasData();
        this.vintage();
        this.render();
      }
    );
    shutterCallback();
  });

  // Creates an image object out of the contents of the canvas
  var getImageFromCanvas = function() {
    var image = new Image();
    image.src = canvas.toDataURL('image/png');
    return image;
  };

  return {
    video: video,
    initializeWebcam: initializeWebcam,
    getImageFromCanvas: getImageFromCanvas,
    clearCanvas: clearCanvas,
  };
}
)({
  canvasId: 'canvas',
  videoId: 'camera',
  shutterId: 'snap',
  shutterCallback: function() {
    document.getElementById('snap-choice').style.display = 'block';
  },
});

function saveImage() {
  console.log('Saving Image.');
  var image = camera.getImageFromCanvas();

  camera.clearCanvas();
  sendSnapshot(image)
  .done(function(data) {
    if (data.image_saved == true) {
      var slideshow = document.getElementById('slideshow');
      var listEntry = document.createElement('LI');

      listEntry.appendChild(image);
      document.getElementById('img-queue').appendChild(listEntry);
      slideshow.style.display = 'block';
    }
  });
}

function loadDetails(name, rollNo, festemberId) {
  document.getElementById('student-name').innerHTML = name;
  document.getElementById('roll-number').innerHTML = rollNo;
  document.getElementById('festember-id').innerHTML = festemberId;
  document.getElementById('response-box').style.display = 'block';
}

function submit(card) {
  console.log('Submitted!');
  $.ajax({
    method: 'GET',
    url: '/students/' + card,
  })
  .success(
    function(response) {
      console.log(response);
      if (JSON.stringify(response) != '{}') {
        loadDetails(response.name, response.roll_no, response.festember_id);
        camera.initializeWebcam();
      }
    }
  )
  .error(
      function() {
        console.log('Request failed!');
      }
    );
}

//Event handling for onkeydown
function checkSubmission(event) {
  var key = event.which || event.keyCode;
  if (key == 13) {
    var card = document.getElementById('card-input').value;
    console.log(card);
    if (typeof card != undefined) {
      submit(card);
    }
  }
}

function sendSnapshot(image) {
  var festemberId = document.getElementById('festember-id').innerHTML;
  var formData = new FormData();
  formData.append('base64image', image.src);
  formData.append('festember_id', festemberId);

  return $.ajax({
    url: '/images/',
    method: 'POST',
    data: formData,
    processData: false,
    contentType: false,
  });
}

document.getElementById('card-input').addEventListener('keypress', checkSubmission);
