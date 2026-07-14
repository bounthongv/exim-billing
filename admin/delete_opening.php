<?php 
include("init.php");



$Id=mysqli_real_escape_string($con,$_GET['Id']);
 $stock_id=mysqli_real_escape_string($con,$_GET['stock_id']);
 $product_id=mysqli_real_escape_string($con,$_GET['product_id']);

if(isset($_GET['Id'])){
	
	


	
	$sql=mysqli_query($con,"delete from stock_opening where Id='$Id'");
	
	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:opening_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:opening_list.php");
	           }

	}
	header("location:opening_list.php");
?>