<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<title>HAR Analyzer</title>
</head>
<body>
	<form action="login.php" method="post">
		<h2>LOGIN</h2>
		
		<?php if(isset($_GET['error'])) { ?> 
			<p class="error"><?php echo $_GET['error'];?> </p>
		<?php } ?>
		
		<label>User Name</label>
		<input type="text" name="uname" placeholder="Enter user name">
		
		<label>Password</label>
		<input type="password" name="password" placeholder="Enter password">

		<button type="submit">Login</button>
		<a href="signup.php" class="ca">Create an accound</a>
	</form>

</body>
</html>