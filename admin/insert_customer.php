<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php




	$customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
	$customer_name = mysqli_real_escape_string($con,$_POST['customer_name']);
	
	$address = mysqli_real_escape_string($con,$_POST['address']);
	$phone = mysqli_real_escape_string($con,$_POST['phone']);
	$fax = mysqli_real_escape_string($con,$_POST['fax']);
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$customer_type = mysqli_real_escape_string($con,$_POST['customer_type']);
	$remark = mysqli_real_escape_string($con,$_POST['remark']);
	
    $action = mysqli_real_escape_string($con,$_POST['action']);
	$id = mysqli_real_escape_string($con,$_POST['id']);
	
	$customer_level = mysqli_real_escape_string($con,$_POST['customer_level']);
	$route_id = mysqli_real_escape_string($con,$_POST['route_id']);
	
	$village = mysqli_real_escape_string($con,$_POST['village']);
	$district = mysqli_real_escape_string($con,$_POST['district']);
	
	$sr = mysqli_real_escape_string($con,$_POST['sr']);
	$segment = mysqli_real_escape_string($con,$_POST['segment']);
	$grade = mysqli_real_escape_string($con,$_POST['grade']);
	
	$up = mysqli_real_escape_string($con,$_POST['up']);
	$brand = mysqli_real_escape_string($con,$_POST['brand']);
	$class = mysqli_real_escape_string($con,$_POST['class']);
	
	$debit_amt = mysqli_real_escape_string($con,$_POST['debit_amt']);
	 $debit_amt = filter_var($debit_amt,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
if($action=="Add"){

$sql=mysqli_query($con,"INSERT INTO customers(customer_id,customer_name,address, phone, fax, email, customer_type, remark,customer_level,route_id
,village,district,sr,segment,grade,up,brand,class,debit_amt)
values('$customer_id', '$customer_name',  '$address', '$phone', '$fax', '$email', '$customer_type', '$remark','$customer_level','$route_id'
,'$village','$district','$sr','$segment','$grade','$up','$brand','$class','$debit_amt')");


	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:customer_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:customer_list.php");}
		
}
else if($action=="Update"){
	
	  if($customer_id==""){ $gp_id="customer_id=''";}
else{$gp_id="customer_id='$customer_id'";}	

if($customer_name==""){ $g_n=",customer_name=''";}
else{$g_n=",customer_name='$customer_name'";}	



if($address==""){ $v=",address=''";}
else{$v=",address='$address'";}

if($phone==""){ $d=",phone=''";}
else{$d=",phone='$phone'";}

if($fax==""){ $p=",fax=''";}
else{$p=",fax='$fax'";}

if($email==""){ $t=",email=''";}
else{$t=",email='$email'";}

if($customer_type==""){ $tn=",customer_type=''";}
else{$tn=",customer_type='$customer_type'";}

if($remark==""){ $r=",remark=''";}
else{$r=",remark='$remark'";}

if($customer_level==""){ $cll=",customer_level=''";}
else{$cll=",customer_level='$customer_level'";}

if($route_id==""){ $rid=",route_id=''";}
else{$rid=",route_id='$route_id'";}

if($id=="")
{


$sql=mysqli_query($con,"UPDATE customers SET $gp_id $g_n  $v $d $p $t $tn $r $rid $cll

,village='$village',district='$district',sr='$sr',segment='$segment',grade='$grade',up='$up',brand='$brand',class='$class',debit_amt='$debit_amt'
 WHERE customer_id='$customer_id' ");		
	
}
else{

	$sql=mysqli_query($con,"UPDATE customers SET $gp_id $g_n  $v $d $p $t $tn $r $rid $cll

,village='$village',district='$district',sr='$sr',segment='$segment',grade='$grade',up='$up',brand='$brand',class='$class',debit_amt='$debit_amt'
 WHERE id='$id' ");	
	
}

	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:customer_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:customer_list.php");
	}
	
	
	}
else{
	
	
	
	
	}

?>
</html>

 