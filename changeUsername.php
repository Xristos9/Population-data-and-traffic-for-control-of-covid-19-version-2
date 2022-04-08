<?php
include "connector.php";
session_start();

$id = $_SESSION['User_id'];

if(isset($_SESSION['User_id']) && isset($_SESSION['username'])){

	$new = $_POST['newUsername'];

	$result2 = mysqli_query($link,"UPDATE person SET Username='$new' WHERE User_id='$id'");
	$_SESSION['username'] = $new;
	echo 0;

} else{
	echo 4;
	exit();
}