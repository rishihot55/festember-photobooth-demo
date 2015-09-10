<!DOCTYPE html>
<html>
	<head>
		<title>Festember Photobooth - Image Viewer</title>
		<link rel="stylesheet" href="/css/bootstrap.min.css">
	</head>
	<body>
    <header>
      <h1 align="center">Image Viewer</h1>
    </header>
    <input type="radio" name="choice" onclick="allImages()">
    <input type="radio" name="choice" onclick="byFID()>">
    <input type="radio" name="choice" onclick="todayImages()">

    <div id="image-viewer">
      <ul id="image-list"></ul>
    </div>
		<script type='text/javascript' src='/js/jquery-1.11.3.js'></script>
		<script type='text/javascript' src='/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='/js/main.js'></script>
	</body>
</html>
