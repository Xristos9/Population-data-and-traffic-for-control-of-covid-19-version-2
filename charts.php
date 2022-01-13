<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Covid Declaration</title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
	<!-- Navbar -->
	<?php include "adminNavbar.php"; ?>
	<br><br>

	<div class="page-wrapper">
		<!-- Showcase -->
		<section
			class="bg-primary text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start">
			<div class="container">
				<div class="d-sm-flex align-items-center justify-content-between">
					<div>
					<label class="form-label">When did you test positive for covid?</label>
					<input class="form-control" type="date" id="covidDate" min="2021-10-01" max="2022-12-31" required>
					<br><br>
					<button type="button" id="submit" class="btn btn-dark" onclick="onSubmit()">Submit</button>
					</div>
				</div><br>
			</div>
		</section>

	</div>

		<!-- Footer -->
	<?php include "footer.php";?>
<script>

</script>
</body>
</html>