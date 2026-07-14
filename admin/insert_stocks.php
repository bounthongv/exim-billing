<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php




	$stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	$stock_name = mysqli_real_escape_string($con,$_POST['stock_name']);
	
    $action = mysqli_real_escape_string($con,$_POST['action']);
	$Id = mysqli_real_escape_string($con,$_POST['Id']);
	
if($action=="Add"){

$sad=mysqli_query($con,"INSERT INTO stocks (stock_id,stock_name)
     values('$stock_id', '$stock_name')");


	if($sad){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:stock_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:stock_list.php");}
		
}
else if($action=="Update"){
	
	   $sad=mysqli_query($con,"Update  stocks set stock_id='$stock_id',stock_name='$stock_name' where Id='$Id'  ");


	if($sad){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:stock_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:stock_list.php");
	}
	
	
	}
else{
	
	
	
	
	}

?>
</html>

 