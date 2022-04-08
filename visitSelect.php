<?php
include "connector.php";

session_start();
$u = $_SESSION["User_id"];

$query = mysqli_query($link, "SELECT `Store_id`,`Name`,`Address`,`lat`,`lng` FROM `stores`");
$array = array();
if (mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_assoc($query)) {
		array_push($array, array('id' => $row['Store_id'],'name' => $row['Name'],'address' => $row['Address'],'lat' => $row['lat'],'lng' => $row['lng']));
	}
}
// print_r($array);
echo json_encode($array,true);