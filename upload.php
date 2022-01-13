<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Upload</title>
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
					<label class="form-label">Which store did you visit?</label>
					<select id="store" class="form-select" aria-label="Default select example">
					<option selected>Choose store</option>
					</select>
					<br>
					<div class="mb-3">
					<label class="form-label">How many people were in the store?</label>
					<input class="form-control" id="people" type="number" min="0">
					</div>
					<button type="button" id="submit" class="btn btn-dark">Submit</button>
				</div>
			</div><br>
		</div>
	</section>
</div>
		<!-- Footer -->
	<?php include "footer.php";?>
</body>
</html>