<!DOCTYPE html>
<html>
	<head>
		<title>Festember Photobooth</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/custom.css">
		<link href='https://fonts.googleapis.com/css?family=Archivo+Narrow:700,400' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<script
			  src="https://code.jquery.com/jquery-3.1.0.min.js"
			  integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
			  crossorigin="anonymous"></script>

	</head>
	<body style="overflow:hidden;">
		<div class="row">
			<img id="logo" src="logo.png" >
			<h1 align="center" class="heading">Festember Photobooth</h1>
		</div>
		<div class="row">
			<div class='col-md-2 pull-left'>
				<div id="response-box">
					<button id='snap' style="border:3px solid white">SNAP A PHOTO</button>
					<div id="timer">
						<span id='timer-text'></span>
					</div>
				</div>
				<div id="invisible">
				</div>
			</div>

			<div class='col-md-8'>
				<div id="camera-frame">
					<video id='camera' autoplay></video>
				</div>
				<div id='canvas-frame' hidden>
					<canvas id='canvas' width='1280' height='720'></canvas>
				</div>
			</div>
			<div class="col-md-2 pull-right">
				<div class='row' id='photo-frame' hidden >
					<canvas id='temp-canvas' width='1280' height='720' hidden></canvas>
					<div id='filter-choices'></div>
					<div id='snap-choice' hidden>
						<p>What do you think?<p>
						<button onclick='camera.saveImage()' id='positive'>I like it!</button>
						<button onclick='camera.rejectImage()' id='negative'>Nope!</button>
					</div>
				</div>
			</div>
		</div>
		<p id="tag" align="center">Made with <span class="glyphicon glyphicon-heart"></span> by <span style="font-weight:700;font-size:20px;">Spider</span></p>
		<!---For Background-->
		<div style="position: fixed; left: 0; right: 0; top: 0; bottom: 0; z-index:-1;"></div>
		<div>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		</div>
		<script type='text/javascript' src='js/jquery-1.11.3.js'></script>
		<script type='text/javascript' src='js/bootstrap.min.js'></script>
		<script type='text/javascript' src='js/caman.full.js'></script>
		<script type='text/javascript' src='js/watermark.min.js'></script>
		<script type='text/javascript' src='js/photobooth.js'></script>
		<script src="js/geometryangle.js"></script>
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
		  ambient: 'rgba(57,130,227, 1)',
		  diffuse: 'rgba(47,245,241, 1)',
		  background: 'rgb(255, 255, 255)',
		  speed: 0.0002,
		  fluctuationSpeed: 0.5,
		  fluctuationIntensity: 0,
		  onRender: function () {
		  },
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
		  diffuse: 'rgba(113,190,255, 1)',
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
<!--Background end-->

	</body>
</html>
