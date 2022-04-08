<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<title>Account info</title>
</head>
<body>
		<!-- Navbar -->
	<?php include "adminNavbar.php"; ?>
	<br><br>
	<div class="filler">
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

		<section class="p-5">
			<div class="container">
				<div class="row text-center g-4">
					<div class="col-md">
						<div class="card bg-secondary text-light">
							<div class="card-body text-center" id="k">
								<h3 class="card-title mb-3">You visited these stores:</h3>
								<ul class="list-group" id="k"></ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</div>
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
				<div id="changeUname"></div>
				<div class="modal-body">
					<form>
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
				<div id="changePass"></div>
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

		<!-- Footer -->
	<?php include "footer.php";?>

	<script>

		var changeUname = document.getElementById('changeUname')
		var changePass = document.getElementById('changePass')

		function alert1(message, type) {
			var wrapper = document.createElement('div')
			wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible"role="alert">' + message + '<button type="button" class="btn-close"data-bs-dismiss="alert" aria-label="Close"></button></div>'

			changeUname.append(wrapper)
		}

		function alert2(message, type) {
			var wrapper = document.createElement('div')
			wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible"role="alert">' + message + '<button type="button" class="btn-close"data-bs-dismiss="alert" aria-label="Close"></button></div>'

			changePass.append(wrapper)
		}

		function cName(){
			const newn= document.getElementById("nu").value;

			if(newn==''){
				alert1('Please enter the new Username','danger');
				nu.focus()
			}else{
				let upload = $.ajax({
					url: 'changeUsername.php',
					method: 'POST',
					data: {newUsername: newn}
					,
					success: function(data) {
						console.log(data)
					}
				});
				upload.done(success);
			}

			function success(result){
				if(result == 0){
					alert1('Your Username has been updated successfully','success')
					$('#uname').on('hidden.bs.modal', function () {
						window.location.reload();
					})
				}else{
					alert1('An unexpected error has been occurred','danger')
				}
			}
		}

		function cPass(){
			let old= document.getElementById("op").value;
			let newp= document.getElementById("np").value;
			let cnewp= document.getElementById("cnp").value;

			let strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");


			if(old==''){
				alert2('Please enter your Old Password','danger');
			}else if(newp==''){
				alert2('Please enter the new Password','danger');
			}else if(cnewp==''){
				alert2('Please Confirm Password','danger');
			}else if(!strongRegex.test(newp)){
				alert2 ('Upper case, Lower case, Special character and Numeric letter are required in Password','danger');
			}else if(newp != cnewp){
				alert2 ('Passwords do not Matched','danger');
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
					alert2('Your password has been updated successfully','success')
				}else if(res == 1){
					alert2('Incorrect password','danger')
				}else {
					alert2('An unexpected error has been occurred','danger')
				}
			}
		}

		window.onload = function kati(){

			const ajax =  $.ajax({
				url: 'select1.php',
				method: 'GET',
				dataType: 'json',
				success: function(data){
					// console.log(data)
				}
			})

			ajax.done(episkepsi)

			function episkepsi(result){
				// console.log(result[0]['date'])
				var ul = document.getElementById("k");

				for (let i in result) {
					let visit = []
					visit.push(result[i]['name'])
					visit.push(result[i]['date'])
					let listItem = document.createElement("li");
					listItem.textContent = visit;
					listItem.className = "list-group-item";

					ul.appendChild(listItem);
				}
			}
		}
	</script>
</body>
</html>