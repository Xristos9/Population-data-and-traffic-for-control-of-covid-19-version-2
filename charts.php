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
		<section class="p-5">
			<div class="container">
				<div class="row text-center g-4">
					<div class="col-md">
						<div class="card bg-light text-light">
							<div class="card-body text-center">
								<canvas id="myChart" width="300" height="300"></canvas>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="card bg-light text-light">
							<div class="card-body text-center">
								<canvas id="myChart2" width="300" height="300"></canvas>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="card bg-light text-light">
							<div class="card-body text-center">
								<canvas id="myChart3" width="300" height="300"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

		<!-- Footer -->
	<?php include "footer.php";?>

	<script>
		window.onload = function graph(){

			$.ajax({
				url: 'select(a,b,c).php',
				method: 'GET',
				dataType: 'json',
				success: function(data){
					// console.log(data)

					const ctx = document.getElementById('myChart').getContext('2d');
					const myChart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: ['# of Visits', '# of Covid Cases', '# of infectious visits'],
							datasets: [{
								label: 'a,b,c',
								data: data,
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
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});

				}
			})

			const ajax = $.ajax({
				url: 'select(d).php',
				method: 'GET',
				dataType: 'json',
				success: function(data){
					// console.log(data)
				}
			})

			ajax.done(findDates)

			function findDates(result){
				// console.log(result)
				let array = []
				let array2 = []

				for(let i in result){
					array.push(result[i].split(','))
				}

				for(let i in array){
					for(let j in array[i]){
						array2.push(array[i][j])
					}
				}

				// console.log(array2)

				let duplicates = array2.reduce(function(acc, el, i, arr) {
				if (arr.indexOf(el) !== i && acc.indexOf(el) < 0) acc.push(el); return acc;
				}, []);

				// console.log(duplicates);

				let counts = {};
				array2.forEach((x) => {
					counts[x] = (counts[x] || 0) + 1;
				});

				// console.log(counts)

				const ctx2 = document.getElementById('myChart2').getContext('2d');
				const myChart2 = new Chart(ctx2, {
					type: 'bar',
					data: {
						labels: duplicates,
						datasets: [{
							label: 'd',
							data: counts,
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
								'rgba(255, 99, 132, 1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							y: {
								beginAtZero: true
							}
						}
					}
				});
			}

			const ajax2 = $.ajax({
				url: 'select(e).php',
				method: 'GET',
				dataType: 'json',
				success: function(data){
					// console.log(data)
				}
			})

			ajax2.done(ere)

			function ere(result){
				// console.log(result)
					let array = []
					let array2 = []
					for(let i in result){
						array.push(result[i].split(','))
					}

					for(let i in array){
						for(let j in array[i]){
							array2.push(array[i][j])
						}
					}

					// console.log(array2)

					let duplicates = array2.reduce(function(acc, el, i, arr) {
					if (arr.indexOf(el) !== i && acc.indexOf(el) < 0) acc.push(el); return acc;
					}, []);

					// console.log(duplicates);

					let counts = {};
					array2.forEach((x) => {
						counts[x] = (counts[x] || 0) + 1;
					});


					// console.log(counts)
					const ctx3 = document.getElementById('myChart3').getContext('2d');
					const myChart3 = new Chart(ctx3, {
						type: 'bar',
						data: {
							labels: duplicates,
							datasets: [{
								label: 'e',
								data: counts,
								backgroundColor: [
									'rgba(255, 99, 132, 0.2)',
									'rgba(54, 162, 235, 0.2)',
									'rgba(255, 206, 86, 0.2)',
									'rgba(75, 192, 192, 0.2)',
									'rgba(153, 102, 255, 0.2)',
									'rgba(255, 159, 64, 0.2)'
								],
								borderColor: [
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)'
								],
								borderWidth: 1
							}]
						},
						options: {
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});
			}
		}
	</script>
</body>
</html>