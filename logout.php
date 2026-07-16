<?php
session_start();
session_unset();
session_destroy();
ob_start();
unset($_SESSION['menu']);
header("location:index.php");
ob_end_flush(); 
session_destroy();
exit();

	

?>