<?php
$hostname = 'localhost'; // specify host domain or IP, i.e. 'localhost' or '127.0.0.1' or server IP 'xxx.xxxx.xxx.xxx'
$database = 'project 2'; // specify database name
$db_user = 'root'; // specify username
$db_pass = ''; // specify password


$link = mysqli_connect("$hostname" , "$db_user" , "$db_pass", "$database");

// Check connection
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Print host information
// echo "Connect Successfully. Host info: " . mysqli_get_host_info($link);
?>