<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Chart</title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
	<!-- Navbar -->
	<?php include "adminNavbar.php"; ?>
	<br><br>

	<div class="filler">
		<canvas id="myChart" width="50" height="50"></canvas>
	</div>

		<!-- Footer -->
	<?php include "footer.php";?>

	<script>
		window.onload = function graph(){

			$.ajax({
				url: 'select4.php',
				method: 'GET',
				dataType: 'json',
				success: function(data){
					console.log(data)
	
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
			})
		}
	</script>
</body>
</html>