window.onload = function() {

	var baseLayer = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
		maxZoom: 18,
	})
	var map = new L.Map('map', {
		center: new L.LatLng(38.246361, 21.734966),
		zoom: 15,
		layers: [baseLayer]
	})
	var stores = new L.layerGroup();
	map.addLayer(stores);
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError)
	} else {
		alert("Geolocation is not supported by this browser.")
	}


	function showError(error) {
		switch(error.code) {
			case error.PERMISSION_DENIED:
				alert("User denied the request for Geolocation.")
				break;
			case error.POSITION_UNAVAILABLE:
				alert("Location information is unavailable.")
				break;
			case error.TIMEOUT:
				alert("The request to get user location timed out.")
				break;
			case error.UNKNOWN_ERROR:
				alert("An unknown error occurred.")
				break;
		}
	}

	function showPosition(position) {
		// console.log(position);
		var ClLock = L.marker([position.coords.latitude, position.coords.longitude]);
		ClLock.bindPopup("lat: " + position.coords.latitude + "<br>lng: " + position.coords.longitude);
		stores.addLayer(ClLock);
		map.setView([position.coords.latitude, position.coords.longitude], 15)

		const ajax =  $.ajax({
			url: 'visitSelect.php',
			method: 'GET',
			dataType: 'json',
			success: function(data){
				console.log(data)
			},error: function (xhr, exception) {
				var msg = "";
				if (xhr.status === 0) {
					msg = "Not connect.\n Verify Network." + xhr.responseText;
				} else if (xhr.status == 404) {
					msg = "Requested page not found. [404]" + xhr.responseText;
				} else if (xhr.status == 500) {
					msg = "Internal Server Error [500]." +  xhr.responseText;
				} else if (exception === "parsererror") {
					msg = "Requested JSON parse failed.";
				} else if (exception === "timeout") {
					msg = "Time out error." + xhr.responseText;
				} else if (exception === "abort") {
					msg = "Ajax request aborted.";
				} else {
					msg = "Error:" + xhr.status + " " + xhr.responseText;
				}
				console.log(msg)
			}
		})

		ajax.done(leandros)

		function leandros(res){
			for (let i in res) {
				if (getDistance(position.coords.latitude, position.coords.longitude, res[i].lat, res[i].lng) <= 200000) {

					marker = L.marker([res[i].lat, res[i].lng]);

					var container = $('<div />');
					container.html(`<p for="name">Name: ${res[i].name}</p>
					<p for="address">Address: ${res[i].address}</p>
					<label>How many people were at the store:</label>
					<input id="people" type="number" min="0"/>
					<button class="submit">Upload</button>`);

					container.on('click', '.submit', function(){
						people = $('#people').val();
						// console.log(res[i])
						user_confirm(res, i, people);
					});

					marker.bindPopup(container[0]);
					stores.addLayer(marker);
				}
			}
		}
	}



	function user_confirm(res, i, num) {
		// console.log(i)
		var text = {};
		text.lat = res[i].lat;
		text.lng = res[i].lng;
		text.name = res[i].name;
		text.address = res[i].address;
		text.id = res[i].id;
		text.estimate = parseInt(num);
		console.log(text)
		$.ajax({
			url: 'visitBE.php',
			method: 'POST',
			data: {
				key: text
			},
			success: function(data) {
				console.log(data)
				map.closePopup()
			},error: function (xhr, exception) {
				var msg = "";
				if (xhr.status === 0) {
					msg = "Not connect.\n Verify Network." + xhr.responseText;
				} else if (xhr.status == 404) {
					msg = "Requested page not found. [404]" + xhr.responseText;
				} else if (xhr.status == 500) {
					msg = "Internal Server Error [500]." +  xhr.responseText;
				} else if (exception === "parsererror") {
					msg = "Requested JSON parse failed.";
				} else if (exception === "timeout") {
					msg = "Time out error." + xhr.responseText;
				} else if (exception === "abort") {
					msg = "Ajax request aborted.";
				} else {
					msg = "Error:" + xhr.status + " " + xhr.responseText;
				}
				console.log(msg)
			}
		});
		event.preventDefault()

	}


	//Function to calculate distance between coordinates
	function getDistance(lat1, lon1, lat2, lon2) {
		var R = 6371; // Radius of the earth in km
		var dLat = deg2rad(lat2 - lat1); // deg2rad below
		var dLon = deg2rad(lon2 - lon1);
		var a =
			Math.sin(dLat / 2) * Math.sin(dLat / 2) +
			Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
			Math.sin(dLon / 2) * Math.sin(dLon / 2);
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
		var d = R * c; // Distance in km
		return parseInt(d * 1000);
	}

	function deg2rad(deg) {
		return deg * (Math.PI / 180)
	}
}