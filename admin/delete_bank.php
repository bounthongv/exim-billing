<?php 
include("init.php");



$Id=mysqli_real_escape_string($con,$_GET['Id']);



	
	$sql=mysqli_query($con,"DELETE from tb_bank where Id='$Id'");
	
	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:bank.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:bank.php");
	}


?>