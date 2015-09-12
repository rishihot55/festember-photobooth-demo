function populateList(data) {
  document.getElementById('image-list').innerHTML = '';
  for (var i = 0; i < data.length; i++) {
    //Download each image
    var listEntry = document.createElement('LI');
    var imageTag = '<image src="/images/' + data[i].image_url + '/download" download/>';
    var linkTag = '<a href="/images/' + data[i].image_url + '/download" download>' + imageTag + '</a>';
    listEntry.innerHTML = linkTag;
    document.getElementById('image-list').appendChild(listEntry);
  }
}

function allImages() {
  $.ajax({
    url: '/images',
  }).success(
		function(data) {
			populateList(data);
		}
	);
}

function byFID() {
  var festemberId = prompt('Enter F-Id');
  if (festemberId != null)  {
    $.ajax({
      url: '/images/festember_id/' + festemberId,
    })
		.success(
			function(data) {
				populateList(data);
      }
    );
  }
}

function todayImages() {
  $.ajax({
    url: '/images/today',
  }).success(
		function(data) {
      populateList(data);
		}
	);
}
