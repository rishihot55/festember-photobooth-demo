<!DOCTYPE html>
<html>
	<head>
		<title>Festember Photobooth</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/custom.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<link href="http://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header>
				<h1 align="center">Festember Photobooth</h1>
				<img id="logo" src="logo.png">
		</header>
		<div id='card-input-box' class='row'>
			<div align='center'>
				<label for='card'>Please scan the card</label>
				<input type='password' id='card-input' name='card' autofocus>
			</div>
		</div>
		<div id='response-box' hidden class='row'>
			<div class='col-md-4 col-md-offset-4'>
				<div>Hello <strong><span id='student-name'></span></strong>!</div>
				<div>Just to confirm, your Roll Number is: <strong><span id='roll-number'></span></strong></div>
				<div>Your F-ID is: <strong><span id='festember-id'></span></strong></div>
			</div>
		</div>
		<div class='row' id='camera-frame'>
			<div class='col-md-6 col-md-offset-3 text-center'>
				<video id='camera' width='640' height='480' autoplay></video>
				<br>
				<img id='snap' hidden src="camera.png" >
			</div>
		</div>
		<div class='row' id='photo-frame' hidden >
			<div class='col-md-6 col-md-offset-3'>
					<canvas id='temp-canvas' width='640' height='480' hidden></canvas>
					<canvas id='canvas' width='640' height='480'></canvas>
					<div id='filter-choices'></div>
					<div id='snap-choice' hidden>
						What do you think?
						<button onclick='saveImage()' class='btn btn-success btn-lg'>I like it!</button>
						<button onclick='rejectImage()' class='btn btn-danger btn-lg'>Nope!</button>
					</div>
			</div>
		</div>
		<div id='slideshow' hidden>
			<p>Photos taken so far:</p>
			<ul id='img-queue'></ul>
		</div>

		<!---For Background-->
		<div style="position: fixed; left: 0; right: 0; top: 0; bottom: 0;"></div>
			<div>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			</div>

		<script type='text/javascript' src='js/jquery-1.11.3.js'></script>
		<script type='text/javascript' src='js/bootstrap.min.js'></script>
		<script type='text/javascript' src='js/caman.full.js'></script>
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
		  ambient: 'rgba(85, 85, 85, 1)',
		  diffuse: 'rgba(255, 255, 255, 1)',
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
<!--Background end-->
	
	</body>
</html>
