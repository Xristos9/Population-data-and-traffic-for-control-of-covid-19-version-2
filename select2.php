<?php
	include "connector.php";
	session_start();

	$id = $_SESSION["User_id"];

	if($_SERVER["REQUEST_METHOD"] == "GET"){

		$result = mysqli_query($link, "SELECT `Date` FROM `cases` WHERE `User_id`= '$id'");
		$dates = array();
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				array_push($dates,  $row['Date']);
			}
		}

		echo json_encode($dates,true);
	}

?>