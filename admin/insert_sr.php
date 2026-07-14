<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

    


	$insert1 = mysqli_real_escape_string($con,$_POST['sr_id']);
	$insert2 = mysqli_real_escape_string($con,$_POST['sr_fname']);
	$insert3 = mysqli_real_escape_string($con,$_POST['sr_lname']);
	$insert4 = mysqli_real_escape_string($con,$_POST['sr_phone']);
	$insert5 = mysqli_real_escape_string($con,$_POST['sr_email']);

	
    $action = mysqli_real_escape_string($con,$_POST['action']);
	$id = mysqli_real_escape_string($con,$_POST['id']);
	
	
	

	
if($action=="Add"){

$sql=mysqli_query($con,"INSERT INTO sr_list(sr_id, sr_fname,sr_lname, sr_phone,sr_email)
values('$insert1', '$insert2',  '$insert3', '$insert4', '$insert5')");


	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:sr_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:sr_list.php");}
		
}
else if($action=="Update"){
	



$sql=mysqli_query($con,"UPDATE sr_list SET sr_id='$insert1', sr_fname='$insert2',sr_lname='$insert3'
, sr_phone='$insert4',sr_email='$insert5'
  WHERE id='$id' ");


	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:sr_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:sr_list.php");
	}
	
	
	}
else{
	
	
	
	
	}

?>
</html>

 