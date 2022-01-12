<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<title>Account info</title>
</head>
<body>
		<!-- Navbar -->
	<?php include "navbar.php"; ?>
	<br><br>
	<section
		class="bg-primary text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start"
	>
		<div class="container">
		<div class="d-sm-flex align-items-center justify-content-between">
			<div>
			<h1>Hello, <span class="text-warning"><?php echo $_SESSION['username']; ?></span></h1>
			<br>
			<button
				class="btn btn-dark btn-lg"
				data-bs-toggle="modal"
				data-bs-target="#uname"
			>
				Change Username
			</button>
			<button
				class="btn btn-dark btn-lg"
				data-bs-toggle="modal"
				data-bs-target="#pass"
			>
				Change Password
			</button>
		  </div>
		</div><br>
	  </div>
	</section>
		<!-- Modal 1-->
	<div
		class="modal fade"
		id="uname"
		tabindex="-1"
		aria-labelledby="enrollLabel"
		aria-hidden="true"
	>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="enrollLabel">Change Username</h5>
					<button
						type="button"
						class="btn-close"
						data-bs-dismiss="modal"
						aria-label="Close"
					></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label for="first-name" class="col-form-label">
								Old Usermame:
							</label>
							<input type="text" class="form-control" id="ou" />
						</div>
						<div class="mb-3">
							<label for="last-name" class="col-form-label">New Usermame:</label>
							<input type="text" class="form-control" id="nu" />
						</div>
					</form>
				</div>
			<div class="modal-footer">
				<button
					type="button"
					class="btn btn-secondary"
					data-bs-dismiss="modal"
				>
				Close
				</button>
				<button type="button" class="btn btn-primary" onclick="cName()">Submit</button>
			</div>
		</div>
	</div>
	</div>

	<!-- Modal 2-->
	<div
		class="modal fade"
		id="pass"
		tabindex="-1"
		aria-labelledby="enrollLabel"
		aria-hidden="true"
	>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="enrollLabel">Change Password</h5>
					<button
						type="button"
						class="btn-close"
						data-bs-dismiss="modal"
						aria-label="Close"
					></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label class="col-form-label">Old Password:</label>
							<input type="password" class="form-control" id="op" />
						</div>
						<div class="mb-3">
							<label class="col-form-label">New Password:</label>
							<input type="password" class="form-control" id="np" />
						</div>
						<div class="mb-3">
							<label class="col-form-label">Confirm New Password:</label>
							<input type="password" class="form-control" id="cnp"/>
						</div>
					</form>
				</div>
			<div class="modal-footer">
				<button
					type="button"
					class="btn btn-secondary"
					data-bs-dismiss="modal"
				>
				Close
				</button>
				<button type="button" class="btn btn-primary" onclick="cPass()">Submit</button>
			</div>
		</div>
	</div>
	</div>

	<div class="page-wrapper"></div>
			<!-- Footer -->
	<?php include "footer.php";?>

	<script>
		function cName(){
		const oldn= document.getElementById("ou").value;
		const newn= document.getElementById("nu").value;

		if(oldn==''){
			alert('Please enter your Old Username');
			ou.focus()
		}else if(newn==''){
			alert('Please enter the new Username');
			nu.focus()
		}else if(newn == oldn){
			alert ('Usernames should not match');
			ou.focus()
		}else{
			console.log(1)
			let upload = $.ajax({
				url: 'changeUsername.php',
				method: 'POST',
				data: {oldUsername: oldn, newUsername: newn}
				,
				success: function(data) {
					console.log(data)
				}
			});
			upload.done(success);
		}

		function success(result){
			if(result == 0){
				alert('Your Username has been updated successfully')
			}else if(result == 1){
				alert('Incorrect Username')
			}else{
				alert('An unexpected error has been occurred')
			}
		}
	}

	function cPass(){
		let old= document.getElementById("op").value;
		let newp= document.getElementById("np").value;
		let cnewp= document.getElementById("cnp").value;

		let strongRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/


		if(old==''){
			alert('Please enter your Old Password');
		}else if(newp==''){
			alert('Please enter the new Password');
		}else if(cnewp==''){
			alert('Please Confirm Password');
		}else if(!strongRegex.test(newp)){
			alert ('Upper case, Lower case, Special character and Numeric letter are required in Password');
		}else if(newp != cnewp){
			alert ('Passwords do not Matched');
		}else if(newp < 8){
			alert ('Password minimum length is 8');
		}else if(newp > 20){
			alert ('Password max length is 20');
		}else{

			let upload = $.ajax({
				url: 'changePass.php',
				method: 'POST',
				data: {oldPassword: old, newPassword: newp}
				,
				success: function(data) {
					console.log(data)
				}
			});
			upload.done(success);
		}

		function success(res){
			if(res == 0){
				alert('Your password has been updated successfully')
			}else if(res == 1){
				alert('Incorrect password')
			}else {
				alert('An unexpected error has been occurred')
			}
		}
	}
	</script>
</body>
</html>