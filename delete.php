<?php

	session_start();
	include "connector.php";

	if(isset($_POST['boolval'])){

		$query = "DELETE FROM `stores`";

		if ($link->query($query) === TRUE) {
			echo 1;
		} else {
			echo 3;
			echo "Error deleting record: " . $link->error;
		}

		$query2 = "DELETE FROM `populartimes`";

		if ($link->query($query2) === TRUE) {
			echo 1;
		} else {
			echo 3;
			echo "Error deleting record: " . $link->error;
		}

	}else {
		echo 2;
	}
?>