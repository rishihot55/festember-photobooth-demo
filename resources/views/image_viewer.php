<!DOCTYPE html>
<html>
	<head>
		<title>Photobooth - Image Viewer</title>
		<link rel="stylesheet" href="/css/bootstrap.min.css">
        <style type="text/css">
        @font-face {
            font-family: CorbelLocal;
            src: url(/fonts/corbel.ttf);
        }

        body {
            margin-right: 10%;
            margin-left: 10%;
            background-color: purple;
            color: white;
            font-family: CorbelLocal;
        }
        </style>
	</head>
	<body>
    <header>
      <h1 align="center">Image Viewer</h1>
    </header>
    <input type="radio" name="choice" onclick="allImages()"> All Images
    <input type="radio" name="choice" onclick="byFID()"> By ID
    <input type="radio" name="choice" onclick="todayImages()"> Today's Images
    <div id="image-viewer">
      <ul id="image-list"></ul>
    </div>
		<script type='text/javascript' src='/js/jquery-1.11.3.js'></script>
		<script type='text/javascript' src='/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='/js/image_viewer.js'></script>
	</body>
</html>
