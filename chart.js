// const ctx = document.getElementById('myChart').getContext('2d');

const ajax =  $.ajax({
	url: 'select1.php',
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

ajax.done(leadros)

function leadros(res){
	const ctx = document.getElementById('myChart').getContext('2d');
	const myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ['# of Visits', '# of Covid Cases', '# of infectious visits'],
			datasets: [{
				// label: '# of Visits',
				data: res,
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
				],
				borderWidth: 1
			}]
		},
		options: {
			label:{
				display: false
			},
			legend:{
				display: false
			},
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
	
}