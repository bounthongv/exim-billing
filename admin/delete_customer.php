<?php 
include("init.php");



$Id=mysqli_real_escape_string($con,$_GET['Id']);
$customer_id=mysqli_real_escape_string($con,$_GET['customer_id']);


if(isset($_GET['Id'])){
	
	$sql=mysqli_query($con,"delete from customers where id='$Id'");
	$sql=mysqli_query($con,"delete from customer_import where external_id='$customer_id'");
	
	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:customer_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:customer_list.php");
	}
	
	}
	header("location:customer_list.php");
?>