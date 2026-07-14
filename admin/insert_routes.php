<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php




	$route_id = mysqli_real_escape_string($con,$_POST['route_id']);
	$route_name = mysqli_real_escape_string($con,$_POST['route_name']);
	
    $action = mysqli_real_escape_string($con,$_POST['action']);
	$Id = mysqli_real_escape_string($con,$_POST['Id']);
	
if($action=="Add"){

$sad=mysqli_query($con,"INSERT INTO routes (route_id,route_name)
     values('$route_id', '$route_name')");


	if($sad){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:route_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:route_list.php");}
		
}
else if($action=="Update"){
	
	   $sad=mysqli_query($con,"Update  routes set route_id='$route_id',route_name='$route_name' where Id='$Id'  ");


	if($sad){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:route_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:route_list.php");
	}
	
	
	}
else{
	
	
	
	
	}

?>
</html>

 