<?php 
include("init.php");



$Id=mysqli_real_escape_string($con,$_GET['Id']);



if(isset($_GET['Id'])){
	
	$sql=mysqli_query($con,"delete from exchang where eid='$Id'");
	
	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:exchange_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:exchange_list.php");
	}
	
	}
	header("location:exchange_list.php");
?>