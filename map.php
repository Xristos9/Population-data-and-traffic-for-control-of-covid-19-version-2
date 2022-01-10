<!DOCTYPE html>
<html>

<head>
	<title>Map</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
		integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
		crossorigin="" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="Leaflet.AnimatedSearchBox.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
		integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
		crossorigin=""></script>
	<script src="https://cdn.jsdelivr.net/npm/fuse.js@5.0.10-beta/dist/fuse.min.js"></script>
	<script src="Leaflet.AnimatedSearchBox.js"></script>
</head>

<body>

	<div id="map"></div>


	<script>
		//topiki wra
		var currentdate = new Date();
		var day = currentdate.toLocaleString('en-us', {
			weekday: 'long'
		});

		// eisagwgi xarti
		var map = L.map('map', {
			zoomControl: false
		}).setView([51.505, -0.09], 5);

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		// HTML Geolocation API
		window.onload = function getLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.watchPosition(showMarker);
			} else {
				alert("Geolocation is not supported by this browser.")
			}
		}

		// eisagwgi tis topothesias to xristi
		function showMarker(p) {
			// console.log(p.coords.latitude, p.coords.longitude)
			var userPosition = L.marker([p.coords.latitude, p.coords.longitude]).addTo(map)
			userPosition.bindPopup("lat: " + p.coords.latitude + "<br>lng: " + p.coords.longitude);
			map.setView([p.coords.latitude, p.coords.longitude], 13)
		}


		const icon1 = L.icon({
			iconUrl: 'icons/icon1.png',
			iconSize: [38, 38],
			iconAnchor: [20, 0]
		});

		const icon2 = L.icon({
			iconUrl: 'icons/icon2.png',
			iconSize: [38, 38],
			iconAnchor: [20, 0]
		});

		const icon3 = L.icon({
			iconUrl: 'icons/icon3.png',
			iconSize: [38, 38],
			iconAnchor: [20, 0]
		});

		const stores = $.ajax({
			url: 'mapBack.php',
			method: 'GET',
			dataType: 'json',
			success: function(data){
				// console.log(data)
			}
		})

		stores.done(searchResult)

		function searchResult(res){
			// kouti anazitisis
			storeNames = []
			for(let i=0; i<res.length; i=i+7){
				storeNames.push(res[i].name)
			}
			// console.log(storeNames)

			var searchbox = L.control.searchbox({
				position: 'topright',
				expand: 'left',
				width: '450px',
				autocompleteFeatures: ['setValueOnClick']
			}).addTo(map)


			var fuse = new Fuse(storeNames, {
				shouldSort: true,
				threshold: 0.6,
				location: 0,
				distance: 100,
				minMatchCharLength: 1
			});

			searchbox.onInput("keyup", function (e) {
				if (e.keyCode == 13) {
					search();
				} else {
					var value = searchbox.getValue();
					if (value != "") {
						var results = fuse.search(value);
						searchbox.setItems(results.map(res => res.item).slice(0, 5));
					} else {
						searchbox.clearItems();
					}
				}
			});

			searchbox.onButton("click", search);

			function search() {
				var value = searchbox.getValue();

				var info = []

				for(var i in res){
					if(res[i].name == value && res[i].day == day){
						info.push(res[i])
						console.log(value)
					}
				}
				// console.log(info)

				pop = round(info[0].populartimes)

				if (pop >= 0 && pop <= 32) {
					var marker = L.marker(L.latLng(info[0].lat, info[0].lng), {icon: icon1}).addTo(map)
				} else if (pop >= 33 && pop <= 65) {
					var marker = L.marker(L.latLng(info[0].lat, info[0].lng), {icon: icon2}).addTo(map)
				} else if (pop >= 66) {
					var marker = L.marker(L.latLng(info[0].lat, info[0].lng), {icon: icon3}).addTo(map)
				} else {
					var marker = L.marker(L.latLng(info[0].lat, info[0].lng)).addTo(map)
				}

				marker.bindPopup("Name: '" + info[0].name + "'<br> Address: " + info[0].address + "<br>Traffic: " + Math.round(round(info[0].populartimes)));
				map.setView([info[0].lat, info[0].lng], 20);


				function round(data){
					let estimate = [];
					estimate.push(parseInt(data[currentdate.getHours()]), parseInt(data[currentdate.getHours() + 1]), parseInt(data[currentdate.getHours() + 2]));
					return estimate.reduce((a, b) => a + b)/3
				}

				setTimeout(function () {
					searchbox.hide();
					searchbox.clear();
				}, 600);
			}
		}

	</script>
</body>

</html>