   <?php 
include("init.php");

?> 
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

   
	$group_id = mysqli_real_escape_string($con,$_POST['group_id']);
	$group_name = mysqli_real_escape_string($con,$_POST['group_name']);	
	
			
if($group_id==""){ $a="";}else{$a="Group_ID='$group_id'";}	
if($group_name==""){ $d="";}else{$d=",Group_Name='$group_name'";}

$sad=mysqli_query($con,"update tb_groups set $a $d WHERE Group_ID='$group_id'");
	if($sad){
		        
				$_SESSION['smg']="<div class='alert alert-success'><strong>ແກ້ໄຂສຳເລັດ!</strong></div>";
		header("location:group_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ແກ້ໄຂບໍ່ສຳເລັດ!</strong> </div>";
		header("location:group_list.php");}

	
?>

 