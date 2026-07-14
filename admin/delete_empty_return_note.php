<?php 
include("init.php");



$no=mysqli_real_escape_string($con,$_GET['no']);



if(isset($_GET['no'])){
	

	
	$sql=mysqli_query($con,"delete from tbl_empty_return_note where no='$no'");

	$sql1=mysqli_query($con,"delete from tbl_emp_no where no='$no'");
	
	if($sql){
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:empty_return_note.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:empty_return_note.php");
	}
}
	
	header("location:empty_return_note.php");
?>