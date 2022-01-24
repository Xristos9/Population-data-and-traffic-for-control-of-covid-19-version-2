<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Upload</title>
</head>
<body>
	<!-- Navbar -->
	<?php include "adminNavbar.php"; ?>
	<br><br>
	<div class="filler">
		<!-- Showcase -->
	<section
		class="bg-primary text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start">
		<div class="container">
			<div class="d-sm-flex align-items-center justify-content-between">
				<div><br>
				<div class="input-group">
					<input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept=".json" onchange="readFile(this)">
					<button class="btn btn-dark" type="button" id="inputGroupFileAddon04">Submit</button>
				</div><br><br>
				</div>
			</div>
		</div>
	</section>
</div>
		<!-- Footer -->
	<?php include "footer.php";?>
	<script>

		function kati(){

			Swal.fire({
				icon: 'success',
				title: 'File uploaded',
				showConfirmButton: false,
				timer: 2000
			})
		}

		function readFile(input) {
			const file = new FileReader()
			file.readAsText(input.files[0])

			file.onload = function(e) {
				const data = JSON.parse(e.currentTarget.result)
				console.log(data)

				let upload = []


				for(var i in data){
					stuff = {}

					if(data[i].rating == undefined || data[i].rating_n == undefined){
						stuff.rating = 0
						stuff.rating_n = 0
					}else{
						stuff.rating = data[i].rating
						stuff.rating_n = data[i].rating_n
					}

					stuff.day = []
					stuff.data = []
					stuff.id = data[i].id
					stuff.name = data[i].name
					stuff.address = data[i].address
					stuff.lat = data[i].coordinates.lat
					stuff.lng = data[i].coordinates.lng

					stuff.types = data[i].types.toString()

					for (var j in data[i].populartimes){
						stuff.day.push(data[i].populartimes[j].name)
						stuff.data.push(data[i].populartimes[j].data)
					}

					upload.push(stuff)

				}
				console.log(upload)

				document.getElementById("inputGroupFileAddon04").addEventListener("click", function() {
					Swal.fire({
						title: 'File uploading...',
						showConfirmButton: false,
					})
					$.ajax({
						url: "uploadInsert.php",
						type: "POST",
						// dataType: 'json',
						data: {data:JSON.stringify(upload)},
						success: function(data) {
							console.log(data)
							if(data == 1){
								Swal.close()
								Swal.fire({
									icon: 'success',
									title: 'File uploaded',
									showConfirmButton: false,
									timer: 2500
								})
							}
						}
					})
				})
			}

			file.onerror = function() {
				console.log(reader.error);
			};
		}
	</script>
</body>
</html>