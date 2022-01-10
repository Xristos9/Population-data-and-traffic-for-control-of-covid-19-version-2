<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<title>Sing Up</title>
</head>
<body>
	<form action="signup-check.php" method="post">
		<h2>SIGN UP</h2>
		
		<?php if(isset($_GET['error'])) { ?> 
			<p class="error"><?php echo $_GET['error'];?> </p>
		<?php } ?>

		<?php if(isset($_GET['success'])) { ?> 
			<p class="success"><?php echo $_GET['success'];?> </p>
		<?php } ?>

		<label>User Name</label>
		<?php if(isset($_GET['uname'])) { ?> 
			<input type="text" name="uname" placeholder="Enter user name" value="<?php echo $_GET['uname']; ?>">
		<?php } else{ ?>
			<input type="text" name="uname" placeholder="Enter user name"><?php }?>

		<label>Email</label>
		<?php if(isset($_GET['email'])) { ?> 
			<input type="text" name="email" placeholder="Enter email" value="<?php echo $_GET['email']; ?>">
		<?php } else{ ?>
			<input type="text" name="email" placeholder="Enter email"> <?php }?>
		
		<label>Password</label>
		<input type="password" name="password" placeholder="Enter password">

		<label>Re Password</label>
		<input type="password" name="re_password" placeholder="Enter password again">

		<button type="submit">Sign Up</button>
		<a href="index.php" class="ca">Already have an accound?</a>
	</form>
	<br>
	<br>
	<br>

	<footer>&copy;&nbsp;C.E.I.D. UoP | Designed by XSD Development crew</footer>
</body>
</html>