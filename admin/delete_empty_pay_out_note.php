<?php 
include("init.php");
$office1=$_SESSION['office'];

//$Id=mysqli_real_escape_string($con,$_GET['Id']);
$no=mysqli_real_escape_string($con,$_GET['no']);



if(isset($_GET['no'])){
	

	$sql=mysqli_query($con,"delete from tbl_empty_pay_out_note where no='$no' and office_id='$office1'");

	$sql1=mysqli_query($con,"delete from tbl_emp_pay_out_no where no='$no' and office_id='$office1'");

	if($sql){
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:empty_pay_out_note.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:empty_pay_out_note.php");
	}



}
	
	header("location:empty_pay_out_note.php");
?>