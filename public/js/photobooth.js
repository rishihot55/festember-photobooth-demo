var camera = (function(args) {
  var width = args.width || 640;
  var height = args.height || 480;

  var shutterCallback = args.shutterCallback || function() {};

  var canvas = document.getElementById(args.canvasId);
  var hiddenCanvas = document.getElementById(args.hiddenCanvasId);
  var video = document.getElementById(args.videoId);
  var shutter = document.getElementById(args.shutterId);

  var context = canvas.getContext('2d');
  var hiddenContext = hiddenCanvas.getContext('2d');
  var videoObject = { video: true };

  var errorCallback = function(error) {
    console.log('Video capture error: ', error.code);
  };

  var initializeWebcam = function() {
    // Initialized as a singleton
    if (video.src !== '')
      return;
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
    hiddenContext.clearRect(0, 0, width, height);
  };

  // Clicking this button emulates the shutter button
  shutter.addEventListener('click', function() {
    hiddenContext.drawImage(video, 0, 0, width, height);
    context.drawImage(video, 0, 0, width, height);
    shutterCallback();
  });

  // Creates an image object out of the contents of the canvas
  var getImageFromHiddenCanvas = function() {
    var image = new Image();
    image.src = hiddenCanvas.toDataURL('image/png');
    return image;
  };

  var getImageFromCanvas = function() {
    var image = new Image();
    image.src = canvas.toDataURL('image/png');
    return image;
  };

  var applyFilter = function(filterName) {
    context.drawImage(hiddenCanvas, 0, 0, width, height);
    Caman(
      canvas,
      function() {
        this.reloadCanvasData();
        switch (filterName) {
          case 'vintage': {
            this.vintage();
            break;
          }

          case 'lomo': {
            this.lomo();
            break;
          }

          case 'sunrise': {
            this.sunrise();
            break;
          }

          case 'grungy': {
            this.grungy();
            break;
          }

          case 'oldBoot': {
            this.oldBoot();
            break;
          }

          case 'glowingSun': {
            this.glowingSun();
            break;
          }

          case 'concentrate': {
            this.concentrate();
            break;
          }
        }
        this.render();
      }
    );
  };

  return {
    video: video,
    initializeWebcam: initializeWebcam,
    getImageFromCanvas: getImageFromCanvas,
    clearCanvas: clearCanvas,
    applyFilter: applyFilter,
    getImageFromHiddenCanvas: getImageFromHiddenCanvas,
  };
}
)({
  canvasId: 'canvas',
  hiddenCanvasId: 'temp-canvas',
  videoId: 'camera',
  shutterId: 'snap',
  shutterCallback: function() {
    document.getElementById('camera-frame').style.display = 'none';
    document.getElementById('snap-choice').style.display = 'block';
    document.getElementById('photo-frame').style.display = 'block';
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


  document.getElementById('camera-frame').style.display = 'block';
  document.getElementById('photo-frame').style.display = 'none';
  document.getElementById('response-box').style.display = 'none';
}

function rejectImage() {
  camera.clearCanvas();
  document.getElementById('camera-frame').style.display = 'block';
  document.getElementById('photo-frame').style.display = 'none';
  document.getElementById('response-box').style.display = 'none';
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

function initializeFilterButtons() {
  // Names of buttons
  var names = [
    'None',
    'Vintage',
    'Lomo',
    'Sunrise',
    'Grungy',
    'Old Boot',
    'Glowing Sun',
    'Concentrate',
  ];

  var filters = [
    'none',
    'vintage',
    'lomo',
    'sunrise',
    'grungy',
    'oldBoot',
    'glowingSun',
    'concentrate',
  ];

  for (var i = 0; i < names.length; i++) {
    $('#filter-choices').append('<button id="filter-button" onclick="camera.applyFilter(\'' + filters[i] + '\')">' + names[i] + '</button> ');
  }
}

document.getElementById('card-input').addEventListener('keypress', checkSubmission);

document.addEventListener('DOMContentLoaded', function() {
  initializeFilterButtons();
}, false);
