<?php 
include("init.php");



$id=mysqli_real_escape_string($con,$_GET['order_id']);

if(isset($_GET['order_id'])){
	
	$sql_del1=mysqli_query($con," delete  from seller_orders where order_id='$id' ");
  
	
	if($sql_del1){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:seller_order_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:seller_order_list.php");
	}
	
	}
	//exit();
	header("location:seller_order_list.php");
	
	
	

?>