<?php
	include "connector.php";
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id = $_SESSION["User_id"];
		$date = $_POST["date"];
		$date = new Datetime($date);
		$date = $date->format('Y-m-d');

		// print_r($date1);

		$sql = "INSERT INTO `cases`(`User_id`, `Date`) VALUES ('$id','$date')";

		if(mysqli_query($link, $sql)){
			echo "Records inserted successfully.";
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
	}
?>