
<?php


include("init.php");
	
	$customer_id_old=mysqli_real_escape_string($con,$_POST['customer_id_old']);
    $customer_id_new=mysqli_real_escape_string($con,$_POST['customer_id_new']);
 

$Result=mysqli_query($con,"SELECT * FROM customers WHERE customer_id='".$customer_id_new."'") or die (mysqli_error());
$Num_Rows=mysqli_num_rows($Result);

if($Num_Rows==0){

	$sad=mysqli_query($con,"update customers set customer_id='$customer_id_new' where customer_id='$customer_id_old'");
	
	$sad1=mysqli_query($con,"update product_sale set customer_id='$customer_id_new' where customer_id='$customer_id_old'");
	
	$sad2=mysqli_query($con,"update customer_payment set customer_id='$customer_id_new' where customer_id='$customer_id_old'");
	
	$sad3=mysqli_query($con,"update product_customer_order set customer_id='$customer_id_new' where customer_id='$customer_id_old'");
	
	
   if($sad and $sad1 and $sad2 and $sad3){

				echo "<script>alert('ສຳເລັດ');window.location='new_code_customer.php';</script>";}

		else{echo "<script>alert('ບໍ່ສຳເລັດ');window.location='new_code_customer.php';</script>";}
}else{

	echo "<script>alert('ລະຫັດລູກຄ້າຊໍ້າກັນແລ້ວ');window.location='new_code_customer.php';</script>";
}
	
	  
?>


