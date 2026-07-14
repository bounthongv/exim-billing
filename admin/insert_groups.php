<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php


	$group_id = mysqli_real_escape_string($con,$_POST['group_id']);
	$group_name = mysqli_real_escape_string($con,$_POST['group_name']);
	$group_name_en = mysqli_real_escape_string($con,$_POST['group_name_en']);

	$action = mysqli_real_escape_string($con,$_POST['action']);
	if($action=="add"){

$sad=mysqli_query($con,"INSERT INTO tb_groups (Group_ID, Group_Name,Group_Name_EN)values('$group_id', '$group_name','$group_name_en')");

	if($sad){		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:group_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:group_list.php");}
	}
	
	
	
	else if($action=="update"){
		
		
		if($group_id==""){ $a="";}else{$a="Group_ID='$group_id'";}	


$sad=mysqli_query($con,"update tb_groups set $a ,Group_Name='$group_name',Group_Name_EN='$group_name_en' WHERE Group_ID='$group_id' ");
	if($sad){
		        
				$_SESSION['smg']="<div class='alert alert-success'><strong>ແກ້ໄຂສຳເລັດ!</strong></div>";
		header("location:group_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ແກ້ໄຂບໍ່ສຳເລັດ!</strong> </div>";
		header("location:group_list.php");}

	}

?>
</html>

 