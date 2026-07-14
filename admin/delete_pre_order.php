<?php 
include("init.php");



$id=mysqli_real_escape_string($con,$_GET['id']);

if(isset($_GET['id'])){
	
	$sql_del1=mysqli_query($con," delete  from pre_orders where receipt_id='$id' ");
  
	
	if($sql_del1){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:pre_order_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:pre_order_list.php");
	}
	
	}
	header("location:pre_order_list.php");
	
	
	

?>