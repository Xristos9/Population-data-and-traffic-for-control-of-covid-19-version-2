<?php

	include "connector.php";
	session_start();

	$array = array();
	$query = mysqli_num_rows(mysqli_query($link, "SELECT `Store_id` FROM `visits`"));
	$query2 = mysqli_num_rows(mysqli_query($link, "SELECT `Case_id` FROM `cases`"));

	$query3 = mysqli_query($link, "SELECT `User_id`,`Date` FROM `cases` ORDER BY `cases`.`Date` DESC");
	$array1 = array();
	if (mysqli_num_rows($query3) > 0) {
		while($row = mysqli_fetch_assoc($query3)) {
			array_push($array1, array('id' =>  $row['User_id'], 'date' => $row['Date']));
		}
	}

	$array2 = array();
	for($i=0; $i<count($array1); $i++){
		$u = $array1[$i]['id'];
		$date = date($array1[$i]['date']);
		$date2 = date('Y-m-d', strtotime('-7 day', strtotime($date)));
		$date3 = date('Y-m-d', strtotime('+14 day', strtotime($date)));
		$query4 = mysqli_query($link, "SELECT `Visit_id` FROM `visits` WHERE `User_id`= $u AND `Date` BETWEEN DATE('$date2') AND DATE('$date3')");
		if (mysqli_num_rows($query4) > 0) {
			while($row = mysqli_fetch_assoc($query4)) {
				array_push($array2,$row['Visit_id']);
			}
		}
	}
	// print_r($query2);
	$unique = count(array_unique($array2));
	// print_r($unique);

	array_push($array, $query,$query2,$unique);
	echo json_encode($array,true);