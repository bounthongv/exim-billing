<?php 
include("init.php");



$transfer_id=mysqli_real_escape_string($con,$_GET['transfer_id']);
//$product_id=mysqli_real_escape_string($con,$_GET['product_id']);


if(isset($_GET['transfer_id'])){
	
	
	
	
	
	 $transfer_id = mysqli_real_escape_string($con,$_GET['transfer_id']);
	 
	
	
	
	 
	  $sql_up=mysqli_query($con,"delete from quotation_transfer where transfer_id='$transfer_id'");
		
		unset($_SESSION["quotation_transfer_delete_array"]);
		

	
	     if($sql_up){		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:quotation_transfer_mini_stock_list.php");
			     }
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong> </div>";
		header("location:quotation_transfer_mini_stock_list.php");
                 }
	        }
	header("location:quotation_transfer_mini_stock_list.php");
?>