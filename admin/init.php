<?php
ob_start();
session_start(); 
if(!isset($_SESSION['username']) || !isset($_SESSION['user_id'])  || !isset($_SESSION['status']) and ($_SESSION['status'] !='1' || $_SESSION['status'] !='0') ){ 
header("location:../index.php?msg=Please%20login%20to%20access%20admin%20area%20!&type=error"); // Re-direct to index.php
session_destroy();
}
date_default_timezone_set("Asia/Bangkok");
include("../dblink.php");





?>