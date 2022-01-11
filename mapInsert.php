<?php

	include "connector.php";
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		// $id = $_SESSION["User_id"];
	
		$k = $_POST["key"];
		$estimation = $_POST["estimation"];
		$id = $k["id"];
		$name = $k["name"];
		$address = $k["address"];
		$lat = $k["lat"];
		$lng = $k["lng"];
	
		$sql = "INSERT INTO `visits`(`User_id`, `Store_id`, `Name`, `Address`, `lat`, `lng`, `Estimation`) VALUES ('7','$id','$name','$address','$lat','$lng','$estimation')";
	
		if(mysqli_query($link, $sql)){
			echo "Records inserted successfully.";
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
	}

?>