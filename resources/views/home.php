<!DOCTYPE html>
<html>
	<head>
		
	</head>
	<body>
		<h1>Festember Photobooth</h1>
		<div id='card-input-box'>
			<label for='card'>Please scan the card</label>
			<input type='password' id='card-input' name='card' autofocus>
		</div>
		<div id='response-box' hidden>
			<div>Hello <strong><span id='student-name'></span></strong>!</div>
			<div>Just to confirm, your Roll Number is: <strong><span id='roll-number'></span></strong></div>
			<div>Your F-ID is: <strong><span id='festember-id'></span></strong>
			<div>
				<video id='camera' width='640' height='480' autoplay></video>
				<br>
				<button id='snap'>Snap Photo</button>
			</div>
			<div id='snap-view'>
				<div>
					<canvas id='canvas' width='640' height='480'></canvas>
				</div>
				<div id='snap-choice' hidden>
					<p>What do you think?</p>
					<p>
						<button onclick='saveImage()'>I like it!</button>
						<button onclick='rejectImage()'>Nope!</button>
					</p>
				</div>
				<div hidden>
					<form id='image-upload-form'>
						<input type='text' id='form-festember-id' name='festember_id'>
						<input type='file' id='form-image' name='image'>
					</form>
				</div>
			</div>
		</div>
		<div id='slideshow' hidden>
			<p>Photos taken so far:</p>
			<ul id='img-queue'></ul>
		</div>
		<script type='text/javascript' src='https://code.jquery.com/jquery-2.1.4.min.js'></script>
		<script type='text/javascript' src='js/main.js'></script>
	</body>
</html>