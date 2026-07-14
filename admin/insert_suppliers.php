<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php




	$supplier_id = mysqli_real_escape_string($con,$_POST['supplier_id']);
	$supplier_name = mysqli_real_escape_string($con,$_POST['supplier_name']);
	$address = mysqli_real_escape_string($con,$_POST['address']);
	$tel = mysqli_real_escape_string($con,$_POST['tel']);
	$fax = mysqli_real_escape_string($con,$_POST['fax']);
	$emails = mysqli_real_escape_string($con,$_POST['emails']);
	$bank_no = mysqli_real_escape_string($con,$_POST['bank_no']);
	$remark = mysqli_real_escape_string($con,$_POST['remark']);
	
    $action = mysqli_real_escape_string($con,$_POST['action']);
	$spid = mysqli_real_escape_string($con,$_POST['spid']);
	
if($action=="Add"){

$sql=mysqli_query($con,"INSERT INTO suppliers(supplier_id, supplier_name,address, tel, fax, emails, bank_no, remark)values('$supplier_id', '$supplier_name',  '$address', '$tel', '$fax', '$emails', '$bank_no', '$remark')");


	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:supplier_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:supplier_list.php");}
		
}
else if($action=="Update"){
	
	  if($supplier_id==""){ $gp_id="supplier_id=''";}
else{$gp_id="supplier_id='$supplier_id'";}	

if($supplier_name==""){ $g_n=",supplier_name=''";}
else{$g_n=",supplier_name='$supplier_name'";}	



if($address==""){ $v=",address=''";}
else{$v=",address='$address'";}

if($tel==""){ $d=",tel=''";}
else{$d=",tel='$tel'";}

if($fax==""){ $p=",fax=''";}
else{$p=",fax='$fax'";}

if($emails==""){ $t=",emails=''";}
else{$t=",emails='$emails'";}

if($bank_no==""){ $tn=",bank_no=''";}
else{$tn=",bank_no='$bank_no'";}

if($remark==""){ $r=",remark=''";}
else{$r=",remark='$remark'";}

$sql=mysqli_query($con,"UPDATE suppliers SET $gp_id $g_n  $v $d $p $t $tn $r WHERE spid='$spid' ");


	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:supplier_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:supplier_list.php");
	}
	
	
	}
else{
	
	
	
	
	}

?>
</html>

 