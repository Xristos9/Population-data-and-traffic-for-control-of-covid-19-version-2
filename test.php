<!DOCTYPE html>
<html>

<head>
	<title>MAP</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
		integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
		crossorigin="" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="Leaflet.AnimatedSearchBox.css">
	<style>
		html {
			width: 100%;
			height: 100%;
		}

		body {
			display: block;
			position: absolute;
			height: auto;
			bottom: 0;
			top: 0;
			left: 0;
			right: 0;
			margin: 20px;
		}

		#map {
			width: 100%;
			height: 100%;
		}
	</style>

	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
		integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
		crossorigin=""></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.2/leaflet-search.src.js" integrity="sha512-V+GL/y/SDxveIQvxnw71JKEPqV2N+RYrUlf6os3Ru31Yhnv2giUsPadRuFtgmIipiXFBc+nCGMHPUJQc6uxxOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
	
	<div id="map"></div>
	<script>
//Get local datetime
var currentdate = new Date();
var current_day = currentdate.toLocaleString('en-us', {
	weekday: 'long'
});


//Initialize map and markers Layer
var markers = new L.layerGroup();
var map = new L.Map('map', {
	zoom: 14,
	center: new L.latLng([38.246639, 21.734573])
});
map.addLayer(new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'));

if (!navigator.geolocation) {
	console.log('Geolocation API not supported by this browser.');
} else {
	console.log('Checking location...');
	navigator.geolocation.getCurrentPosition(success, error);
	console.log(navigator.geolocation.getCurrentPosition);

	function success(position) {
		console.log(position);
		var marker = L.marker([position.coords.latitude, position.coords.longitude]);
		marker.bindPopup("I am Here:<br>lat: " + position.coords.latitude + "<br>lng: " + position.coords.longitude);
		markers.addLayer(marker);
		map.setView([position.coords.latitude, position.coords.longitude], 13)
	}
}

//Initialize search bar
var searchControl = new L.control.search({
	url:'POI_backend.php?q={s}',
	sourceData: searchByAjax,
	propertyName: 'name',
	textPlaceholder: 'Search...',
	position: "topright",
	autoType: false,
	moveToLocation: function(latLng, title, map){
		map.setView([latLng.lat,latLng.lng], 20);
	},
	delayType:500,
	collapsed:false
});

map.addControl(searchControl);
map.addLayer(markers);

searchControl.on('search:locationfound', () => {
	map.on('popupclose', function(){
		markers.clearLayers();
	})
});




function searchByAjax(text, callResponse) {
	// console.log(text);
	return $.ajax({
		url: 'POI_backend.php',
		method: 'POST',
		dataType: 'json',
		data: {
			q: text
		},
		success: function(data) {
			//callResponse(data);
			console.log(data); //Here i can take the unique data so I create less markers, but it works also now.
			callResponse(data);
			let name, lat, lng, address, id;

			for (let i = 0; i < data.length; i++) {
				let next_Two_Hours = [];
				lat = data[i].loc[0];
				lng = data[i].loc[1];
				name = data[i].name;
				address = data[i].address;

				if (data[i].day == current_day) {
					next_Two_Hours.push(parseInt(data[i].popular_times[currentdate.getHours()]), parseInt(data[i].popular_times[currentdate.getHours() + 1]), parseInt(data[i].popular_times[currentdate.getHours() + 2]));

					const markerHtmlStyles = `
						background-color: ${determineColor(calculate(next_Two_Hours))};
						width: 3rem;
						height: 3rem;
						display: block;
						left: -1.5rem;
						top: -1.5rem;
						position: relative;
						border-radius: 3rem 3rem 0;
						transform: rotate(45deg);
						border: 1px solid #FFFFFF`

					const icon = L.divIcon({
						html: `<span style="${markerHtmlStyles}" />`
					})

					var marker = L.marker(L.latLng(lat, lng), {icon: icon}, {id:data[i].id});

					marker.bindPopup("Name:'" + name + "'<br> Street:" + address + "<br>Traffic:" + Math.round(calculate(next_Two_Hours)));

					markers.addLayer(marker);

				}
			}
		}
	});
}


function calculate(array) {
	return array.reduce((a, b) => a + b) / array.length;
}

function determineColor(popularity) {
	if (popularity >= 0 && popularity <= 32) {
		return 'green';
	} else if (popularity >= 33 && popularity <= 65) {
		return 'orange';
	} else if (popularity >= 66) {
		return 'red';
	} else {
		return 'blue';
	}
}

function error() {
	console.log('Geolocation error!');
}

	</script>
</body>

</html>