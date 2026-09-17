<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php


	$Id = mysqli_real_escape_string($con,$_POST['Id']);
	$Bank_Name = mysqli_real_escape_string($con,$_POST['Bank_Name']);
	$Bank_Name_en = mysqli_real_escape_string($con,$_POST['Bank_Name_en']);
$bank_account = mysqli_real_escape_string($con,$_POST['bank_account']);
$note = mysqli_real_escape_string($con,$_POST['note']);

	$action = mysqli_real_escape_string($con,$_POST['action']);
	if($action=="add"){

$sad=mysqli_query($con,"INSERT INTO tb_bank (Id, Bank_Name,Bank_Name_EN,Bank_account,note)values('$Id', '$Bank_Name','$Bank_Name_en','$bank_account','$note')");

	if($sad){		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:bank.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:bank.php");}
	}
	
	
	
	else if($action=="update"){
		
		
		if($Id==""){ $a="";}else{$a="Id='$Id'";}	


$sad=mysqli_query($con,"update tb_bank set $a ,Bank_Name='$Bank_Name',Bank_Name_EN='$Bank_Name_en',bank_account='$bank_account',note='$note' WHERE Id='$Id' ");
	if($sad){
		        
				$_SESSION['smg']="<div class='alert alert-success'><strong>ແກ້ໄຂສຳເລັດ!</strong></div>";
		header("location:bank.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ແກ້ໄຂບໍ່ສຳເລັດ!</strong> </div>";
		header("location:bank.php");}

	}

?>
</html>

 