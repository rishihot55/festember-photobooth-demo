<!DOCTYPE html>
<html>
	<head>
		<title>Festember Photobooth</title>

		<!-- Styling -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/custom.css">
		<!-- Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Archivo+Narrow:700,400' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	</head>

	<body style="overflow:hidden;">

		<div class="row">
			<!-- Heading -->
			<img id="logo" src="logo.png">
			<h1 align="center" class="heading">Festember Photobooth</h1>
		</div>

		<div id='card-input-box' class='row'>
			<!-- Card number input -->
			<div align='center'>
				<label for='card'>Please scan the card</label>
				<input type='password' id='card-input' name='card' autofocus>
			</div>
		</div>

		<div class="row">
			<!-- Photo snapping page: hidden initially -->
			<div class='col-md-3 pull-left'>
				<!-- Photo snap controls and timer -->
				<div id="response-box" hidden>
					<p>Hello,<br> <strong><span id='student-name' style="font-size:18px"></span></strong>!</p><br>
					<p>Just to confirm, your Roll Number is<br> <strong><span id='roll-number' style="font-size:18px"></span></strong></p><br>
					<p>Your F-ID is <br> <strong><span id='festember-id' style="font-size:18px"></span></strong></p>
					<button id='snap' style="border:3px solid white">SNAP A PHOTO</button>
					<div id="timer">
						<span id='timer-text'></span>
					</div>
					<button id='end'>END PHOTOBOOTH</button>
				</div>
				<div id="invisible">
				</div>
			</div>

			<div class="col-md-6" id="camera-frame">
				<!-- Camera frame -->
				<video id='camera' width='640' height='480' autoplay></video>
			</div>

			<div class="col-md-3 pull-right">
				<div class='row' id='photo-frame' hidden >
					<!-- Photo preview -->
					<canvas id='temp-canvas' width='640' height='480' hidden></canvas>
					<div id='filter-choices'></div>
					<canvas id='canvas' width='640' height='480'></canvas>
					<div id='snap-choice' hidden>
						<p>What do you think?<p>
						<button onclick='camera.saveImage()' id='positive'>I like it!</button>
						<button onclick='camera.rejectImage()' id='negative'>Nope!</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer text -->
		<p id="tag" align="center">Made with <span class="glyphicon glyphicon-heart"></span> by <span style="font-weight:700;font-size:20px;">Spider</span></p>

		<!---For Background-->
		<div style="position: fixed; left: 0; right: 0; top: 0; bottom: 0; z-index:-1;"></div>
		<div>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		</div>

		<!-- JS Libraries -->
		<script type='text/javascript' src='js/jquery-1.11.3.js'></script>
		<script type='text/javascript' src='js/bootstrap.min.js'></script>
		<script type='text/javascript' src='js/caman.full.js'></script>
		<script src="js/geometryangle.min.js"></script>

		<!-- Photobooth scripts -->
		<script type='text/javascript' src='js/photobooth.js'></script>

		<script>
		$(document).ready(function(){
			$('body').Geometryangle({
				// handle transparent colors
				mesh:{
					width: 1.2,
					height: 1.2,

					// How far should the mesh vary into z-space.
					depth: 10,

					// Number of columns for the mesh.
					columns: undefined,

					columns_auto: true,

					// Number of rows for the mesh.
					rows: undefined,

					rows_auto: true,
					zoom: 1,
					xRange: 0.8,
					yRange: 0.1,
					zRange: 1.0,
					ambient: 'rgba(85, 85, 85, 1)',
					diffuse: 'rgba(255, 255, 255, 1)',
					background: 'rgb(255, 255, 255)',
					speed: 0.0002,
					fluctuationSpeed: 0.5,
					fluctuationIntensity: 0,
					onRender: function () {},
					floorPosition: false,
					draw: true
				},

				lights: {
					// How many light sources belong to this light.
					count: 1,

					xyScalar: 1,

					// Position of light source.
					zOffset: 100,

					ambient: 'rgba(255,0,102, 1)',
					diffuse: 'rgba(255,136,0, 1)',
					speed: 0.010,
					gravity: 1200,

					// Dampening of light's movements.
					dampening: 0.95,

					minLimit: 10,
					maxLimit: null,
					minDistance: 20,
					maxDistance: 400,
					autopilot: false,
					draw: false, //show circle
					bounds: FSS.Vector3.create(),
					step: FSS.Vector3.create(
						Math.randomInRange(0.2, 1.0),
						Math.randomInRange(0.2, 1.0),
						Math.randomInRange(0.2, 1.0)
					)
				},

				// specify the thickness, color, stroke, etc.
				line: {
					fill: "rgba(0, 0, 0, 0)",
					thickness: 1,
					fluctuationIntensity: 0,
					fluctuationSpeed: 0.5,
					draw: false
				},

				// Set the point attributes for the vertex.
				vertex: {
					// Radius of vertice circle.
					radius: 0,

					fill: "rgba(0, 0, 0, 0)",

					// Fluctuates opacity of vertex.
					fluctuationSpeed: 0.5,

					fluctuationIntensity: 0,
					strokeWidth: 0,
					strokeColor: "rgba(0, 0, 0, 0)",

					// Instead of setting alpha channel to zero
					// Set draw to false to avoid computing.
					draw: false
				}
			});
		});
		</script>

	</body>
</html>
