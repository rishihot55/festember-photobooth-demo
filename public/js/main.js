// Camera object defined using a closure. Reduces the number of dependencies
var camera = (function(canvasId, videoId) {
	var width = 640;
	var height = 480;

	var canvas = document.getElementById(canvasId);
	var context = canvas.getContext("2d");
	var video = document.getElementById(videoId);
	var videoObject = { "video": true };

	var errorCallback = function(error) {
		console.log("Video capture error: ", error.code);
	};

	var initializeCamera = function() {
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

	document.getElementById('snap').addEventListener('click', function() {
		context.drawImage(video, 0, 0, width, height);
		document.getElementById('snap-choice').style.display = "block";
	});

	var convertCanvasToImage = function() {
		var image = new Image();
		image.src = canvas.toDataURL('image/png');

		return image;
	};

	var clearCanvas = function() {
		context.clearRect(0, 0, width, height);
	}

	return {
		"canvas": canvas,
		"video": video,
		"initializeCamera": initializeCamera,
		"convertCanvasToImage": convertCanvasToImage,
		"clearCanvas": clearCanvas
	};
})('canvas', 'camera');

function saveImage() {
	console.log("Saving Image.");
	var image = camera.convertCanvasToImage();
	camera.clearCanvas();
	sendSnapshot(image).success(function(data) {
		if (data.image_saved == true) {
			var list_entry = document.createElement("LI");
			list_entry.appendChild(image);
			var slideshow = document.getElementById('slideshow');
			document.getElementById('img-queue').appendChild(list_entry);
			slideshow.style.display = "block";
		}
	});
}

function loadDetails(name, roll_no, festember_id) {
	document.getElementById('student-name').innerHTML = name;
	document.getElementById('roll-number').innerHTML = roll_no;
	document.getElementById('festember-id').innerHTML = festember_id;
	document.getElementById('response-box').style.display = "block";
}

function submit(card) {
	console.log('Submitted!');
	$.ajax({
		method: 'GET',
		url: '/students/' + card
	})
	.success(function(response) {
		console.log(response);
		if (JSON.stringify(response) != '{}') {
			loadDetails(response.name, response.roll_no, response.festember_id);
			camera.initializeCamera();
		}
	})
	.error(function() {
		console.log('Request failed!');
	});
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
	var festember_id = document.getElementById('festember-id').innerHTML;
	var formData = new FormData();
	formData.append("base64image", image.src);
	formData.append("festember_id", festember_id);

	return $.ajax({
		url: "/images/",
		method: "POST",
		data: formData,
		processData: false,
		contentType: false
	});
}

document.getElementById('card-input').addEventListener('keypress', checkSubmission);

// Image downloader
function populateList(data) {
	document.getElementById('image-list').innerHTML = "";
	for (var i = 0 ; i < data.length ; i++)  {
		//Download each image
		var list_entry = document.createElement("LI");
		list_entry.innerHTML= "<image src='/images/" + data[i].image_url + "/download'/>" ;
		document.getElementById('image-list').appendChild(list_entry);
	}
}

function allImages() {
	$.ajax({
		url: "/images",
	})
	.success(function(data) {
		populateList(data);
	});
}

function byFID() {
	var festember_id = prompt("Enter F-Id");
	if (festember_id != null)  {
		$.ajax({
			url: "/images/festember_id/" + festember_id
		})
		.success(function(data) {
			populateList(data);
		});
	}
}

function todayImages() {
	$.ajax({
		url: '/images/today'
	})
	.success(function(data) {
		populateList(data);
	});
}
