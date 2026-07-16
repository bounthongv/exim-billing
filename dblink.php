<?php
$con=mysqli_connect("localhost","admin","Sql_admin@#2024","exim_stock");
mysqli_set_charset($con,"utf8");
error_reporting( error_reporting() & ~E_NOTICE );
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