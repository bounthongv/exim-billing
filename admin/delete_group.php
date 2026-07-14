<?php 
include("init.php");



$Id=mysqli_real_escape_string($con,$_GET['Id']);
 $group_id=mysqli_real_escape_string($con,$_GET['group_id']);


if(isset($_GET['Id'])){
	
	
	 $sql_ch=mysqli_query($con,"select *  from products where Group_ID='$group_id' ");
	$ch=mysqli_num_rows($sql_ch);
if($ch>0){
	
	$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສາມາດລົບໄດ້ ຫມວດສິນຄ້າມີການເຄື່່ອນໄຫວແລ້ວ!</strong> </div>";
		header("location:product_list.php");
	}
else{ 
	
	$sql=mysqli_query($con,"delete from tb_groups where Id='$Id'");
	
	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:group_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:group_list.php");
	}
}
	}
	header("location:group_list.php");
?>