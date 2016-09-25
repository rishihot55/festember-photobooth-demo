var camera = (function(args) {
  var width = args.width || 640;
  var height = args.height || 480;

  var shutterCallback = args.shutterCallback || function() {};

  var streamObj;

  var canvas = document.getElementById(args.canvasId);
  var hiddenCanvas = document.getElementById(args.hiddenCanvasId);
  var video = document.getElementById(args.videoId);
  var shutter = document.getElementById(args.shutterId);
  var shutterTimer = document.getElementById(args.shutterTimer);

  var context = canvas.getContext('2d');
  var hiddenContext = hiddenCanvas.getContext('2d');
  var videoObject = { video: {mandatory: { minWidth: 1280, minHeight: 720 }}};

  var errorCallback = function(error) {
    console.log('Video capture error: ', error.code);
  };

  var images = [];

  var initializeWebcam = function() {
    navigator.mediaDevices.getUserMedia(videoObject)
    .then(function(mediaStream) {
      streamObj = mediaStream;
      video.src = window.URL.createObjectURL(mediaStream);
      video.play()
      .then(function() {
        console.log("success");
      })
      .catch(errorCallback);
    })
    .catch(errorCallback);
  };

  // Resets the canvas
  var clearCanvas = function() {
    context.clearRect(0, 0, width, height);
    hiddenContext.clearRect(0, 0, width, height);
  };

  // Clicking this button emulates the shutter button
  shutter.addEventListener('click', function() {

    var TIME_DELAY = 7;
    var INTERVAL = 1000;
    var MILLISECOND_DELAY = TIME_DELAY * INTERVAL;
    var countdownInterval = setInterval(function() {
      if (TIME_DELAY == 0) {
        hiddenContext.drawImage(video, 0, 0, width, height);
        context.drawImage(video, 0, 0, width, height);
        shutterCallback();
        clearInterval(countdownInterval);
        shutterTimer.innerHTML = '';
        return;
      }
      shutterTimer.innerHTML = "00:0"+TIME_DELAY;
      TIME_DELAY--;
    }, INTERVAL);
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

  var saveImage = function() {
    var image = getImageFromCanvas();
    clearCanvas();
    args.saveImageCallback();
    uploadImage(image);
  };

  var rejectImage = function() {
    camera.clearCanvas();
    args.rejectImageCallback();
  };

  var applyFilter = function(filterName) {
    context.drawImage(hiddenCanvas, 0, 0, width, height);
    Caman(
      canvas,
      function() {
        this.reloadCanvasData();
        switch (filterName) {
          case 'vintage':
            this.vintage();
            break;
          case 'lomo':
            this.lomo();
            break;
          case 'sunrise':
            this.sunrise();
            break;
          case 'grungy':
            this.grungy();
            break;
          case 'oldBoot':
            this.oldBoot();
            break;
          case 'glowingSun':
            this.glowingSun();
            break;
          case 'concentrate':
            this.concentrate();
            break;
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
    saveImage: saveImage,
    rejectImage: rejectImage,
    images: images,
  };
}
)({
  width: '1280',
  height: '720',
  canvasId: 'canvas',
  hiddenCanvasId: 'temp-canvas',
  videoId: 'camera',
  shutterId: 'snap',
  shutterTimer: 'timer-text',
  shutterCallback: function() {
    document.getElementById('camera-frame').style.display = 'none';
    document.getElementById('canvas-frame').style.display = 'block';
    document.getElementById('snap-choice').style.display = 'block';
    document.getElementById('photo-frame').style.display = 'block';
  },
  saveImageCallback: function() {
    document.getElementById('camera-frame').style.display = 'block';
    document.getElementById('photo-frame').style.display = 'none';
  },
  rejectImageCallback: function() {
    document.getElementById('camera-frame').style.display = 'block';
    document.getElementById('photo-frame').style.display = 'none';
    document.getElementById('canvas-frame').style.display = 'none';
  },
});

function uploadImage(image) {
  watermark([image, 'logo_min.png'])
    .image(watermark.image.lowerRight(1))
    .then(function (img) {
      var formData = new FormData();
      formData.append('base64image', img.src);

      return $.ajax({
        url: '/images/',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
      });
    })
    .catch(function (err) {
      console.log(err);
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
    var buttonString =
      '<button id="filter-button" ' +
        'onclick="camera.applyFilter(\'' + filters[i] + '\')">' +
        names[i] +
      '</button> ';
    $('#filter-choices').append(buttonString);
  }
}

document.addEventListener('DOMContentLoaded', function() {
  camera.initializeWebcam();
  initializeFilterButtons();
}, false);
