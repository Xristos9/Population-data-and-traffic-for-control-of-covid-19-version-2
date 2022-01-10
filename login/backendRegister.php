<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])
	&& isset($_POST['email']) && isset($_POST['re_password'])){

	function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	
	$re_pass = validate($_POST['re_password']);
	$email = validate($_POST['email']);

	$user_data = 'uname='. $uname. '&email='. $email;

	// Validate password strength
	$uppercase = preg_match('@[A-Z]@', $pass);
	$lowercase = preg_match('@[a-z]@', $pass);
	$number    = preg_match('@[0-9]@', $pass);
	$specialChars = preg_match('@[^\w]@', $pass);
	


	if(empty($uname)){
		header("Location: signup.php?error=User Name is required&$user_data");
		exit();
	}else if(empty($pass)){
		header("Location: signup.php?error=Password is required&$user_data");
		exit();
	}else if(empty($re_pass)){
		header("Location: signup.php?error=Re Password is required&$user_data");
		exit();
	}else if(empty($email)){
		header("Location: signup.php?error=email is required&$user_data");
		exit();
	}else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
		header("Location: signup.php?error=Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character&$user_data");
		exit();
	}else if($pass !== $re_pass){
		header("Location: signup.php?error=The current password does not match&$user_data");
		exit();
	}else { 
		// $pass = crypt($pass,'$5$');

		
		$result = mysqli_query($conn, "SELECT * FROM person WHERE userName='$uname'");
		$result2 = mysqli_query($conn, "SELECT * FROM person WHERE email='$email'");

		if(mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=This username is used, try another one&$user_data");
			exit();
		} elseif(mysqli_num_rows($result2) > 0){
			header("Location: signup.php?error=This email is used, try another one&$user_data");
			exit();
		} else{
			$result3 = mysqli_query($conn, "INSERT INTO person(userName, password, email) VALUES('$uname', '$pass', '$email')"); 

			if($result3) {
				header("Location: signup.php?success=Accound has been created successfully&$user_data");
				exit();
			} else{
				header("Location: signup.php?error=An unexpected error has been occurred&$user_data");
				exit();
			}
		}
	}
	} else {
	header("Location: signup.php");
	exit();
}