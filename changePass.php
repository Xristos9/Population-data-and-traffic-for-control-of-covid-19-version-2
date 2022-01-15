<?php
include "connector.php";
session_start();

$id = $_SESSION['User_id'];

if(isset($_SESSION['User_id']) && isset($_SESSION['username'])){

	$old = $_POST['oldPassword'];
	$new = $_POST['newPassword'];

	$result = mysqli_query($link,"SELECT Password FROM person WHERE User_id='$id' AND Password='$old'");

	if(mysqli_num_rows($result) === 1){
		$result2 = mysqli_query($link,"UPDATE person SET Password='$new' WHERE User_id='$id'");

		echo 0;
	} else{
		echo 1;
		exit();
	}

} else{
	echo 3;
	exit();
}