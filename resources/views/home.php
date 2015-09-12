<!DOCTYPE html>
<html>
	<head>
		<title>Festember Photobooth</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<header>
				<h1 align="center">Festember Photobooth</h1>
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
		<div class='row'>
			<div class='col-md-6'>
				<video id='camera' width='640' height='480' autoplay></video>
				<br>
				<button id='snap'>Snap Photo</button>
			</div>
			<div clas='col-md-6'>
					<canvas id='temp-canvas' width='640' height='480' hidden></canvas>
					<canvas id='canvas' width='640' height='480'></canvas>
					<div id='filter-choices'>
						<button onclick='camera.applyFilter("none")'>None</button>
						<button onclick='camera.applyFilter("vintage")'>Vintage</button>
						<button onclick='camera.applyFilter("lomo")'>Lomo</button>
						<button onclick='camera.applyFilter("sunrise")'>Sunrise</button>
						<button onclick='camera.applyFilter("grungy")'>Grungy</button>
						<button onclick='camera.applyFilter("oldBoot")'>Old Boot</button>
						<button onclick='camera.applyFilter("glowingSun")'>Glowing Sun</button>
						<button onclick='camera.applyFilter("concentrate")'>Concentrate</button>
					</div>
					<div id='snap-choice' hidden>
						What do you think?
						<button onclick='saveImage()'>I like it!</button>
						<button onclick='rejectImage()'>Nope!</button>
					</div>
			</div>
		</div>
		<div id='slideshow' hidden>
			<p>Photos taken so far:</p>
			<ul id='img-queue'></ul>
		</div>

		<script type='text/javascript' src='js/jquery-1.11.3.js'></script>
		<script type='text/javascript' src='js/bootstrap.min.js'></script>
		<script type='text/javascript' src='js/caman.full.js'></script>
		<script type='text/javascript' src='js/photobooth.js'></script>
	</body>
</html>
