<?php
// Suppress warnings/notices on screen (like Ubuntu production)
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

$con=mysqli_connect("172.17.0.1","admin","Sql_admin@#2024","exim_stock");
mysqli_set_charset($con,"utf8");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
date_default_timezone_set("Asia/Vientiane");

if(isset($_GET)){
	foreach ($_GET as $key => $value) {
  $_GET[$key]=addslashes(strip_tags(trim($value)));
}
	   
extract($_GET);
	}else{
		
	foreach ($_POST as $key => $value) {
  $_POST[$key]=addslashes(strip_tags(trim($value)));
}
	   
extract($_POST); 	
}
?>