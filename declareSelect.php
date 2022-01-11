<?php
	include "connector.php";
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "GET"){

		// $id = $_SESSION["User_id"];
	
		$sql = mysqli_query($link, "SELECT `Date` FROM `cases` WHERE `User_id` = '7' ORDER BY `cases`.`Date` DESC");
		$dates = array();
		if (mysqli_num_rows($sql) > 0) {
			while($row = mysqli_fetch_assoc($sql)) {
				array_push($dates,$row['Date']);
			}
		}
		// print_r($dates);
		echo json_encode($dates,true);
	}

?>