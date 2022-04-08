<?php

	include "connector.php";
	session_start();

	$u = $_SESSION["userID"];
	$k = $_POST["key"];
	$lat = $k['lat'];
	$lng = $k['lng'];
	$name = $k['name'];
	$address = $k['address'];
	$id = $k['id'];
	$estimate = $k['estimate'];

	// print_r($k);

	$sql = "INSERT INTO `visits`(`User_id`, `Store_id`,  `Name`,`Address`, `lat`, `lng`, `Estimation`) VALUES ('$u','$id','$address','$name','$lat','$lng','$estimate')";

	if (mysqli_query($link, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . mysqli_error($link);
	}