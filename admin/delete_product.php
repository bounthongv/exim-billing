<?php 
include("init.php");



        $Id=mysqli_real_escape_string($con,$_GET['Id']);
$product_id=mysqli_real_escape_string($con,$_GET['product_id']);


if(isset($_GET['Id'])){
	
	 $sql_ch=mysqli_query("select *  from stock_product where product_id='$product_id' ");
	$ch=mysqli_num_rows($sql_ch);
if($ch>0){
	
	$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສາມາດລົບໄດ້ ສິນຄ້າມີການເຄື່່ອນໄຫວແລ້ວ!</strong> </div>";
		header("location:product_list.php");
	}
else{ 
	$sql=mysqli_query($con,"delete from products where Id='$Id'");
	
	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:product_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong> </div>";
		header("location:product_list.php");
	}
}
	}
	header("location:product_list.php");
?>