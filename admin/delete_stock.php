<?php 
include("init.php");



$Id=mysqli_real_escape_string($con,$_GET['Id']);



if(isset($_GET['Id'])){
	
	$sql=mysqli_query($con,"delete from stocks where Id='$Id'");
	
	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:stock_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:stock_list.php");
	}
	
	}
	header("location:stock_list.php");
?>