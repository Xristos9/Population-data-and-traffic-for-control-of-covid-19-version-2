<?php
include "connector.php";
session_start();

if(isset($_SESSION['User_id']) && isset($_SESSION['username'])){

	$old = $_POST['oldUsername'];
	$new = $_POST['newUsername'];

	$id = $_SESSION['User_id'];

	$result = mysqli_query($link,"SELECT Username FROM person WHERE User_id=$id AND Username='$old'");

	if(mysqli_num_rows($result) === 1){
		$result2 = mysqli_query($link,"UPDATE person SET Username='$new' WHERE User_id='$id'");
		$_SESSION['username'] = $new;
		echo 0;
	} else {
		echo 1;
		exit();
	}

} else{
	echo 4;
	exit();
}