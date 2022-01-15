<?php
session_start();
include "connector.php";

if (isset($_POST['email']) && isset($_POST['password'])){

	$email = $_POST['email'];
	$pass = $_POST['password'];

	$result = mysqli_query($link, "SELECT * FROM person WHERE Email='$email' AND Password='$pass' ");

	if(mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['Admin'] = $row['Admin'];
		$_SESSION['username'] = $row['Username'];
		$_SESSION['User_id'] = $row['User_id'];

		if($row['Admin']){
			echo 1;
			exit();
		} else{
			echo 0;
			exit();
		}

	} else{
		echo 2;
		exit();
	}

} else{
	echo 3;
	exit();
}