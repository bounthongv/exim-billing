<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php


 $pay_id=mysqli_real_escape_string($con,$_POST['pay_id']);
 $pay_date=mysqli_real_escape_string($con,$_POST['pay_date']);

 $user_id=mysqli_real_escape_string($con,$_POST['user_id']);

 $Bank_account=mysqli_real_escape_string($con,$_POST['Bank_account']);

if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['sale_id']); $i++) {

$list_id=mysqli_real_escape_string($con,$_POST['list_id'][$i]);
$sale_id=mysqli_real_escape_string($con,$_POST['sale_id'][$i]);
$sale_date=mysqli_real_escape_string($con,$_POST['sale_date'][$i]);
			  
$amount=mysqli_real_escape_string($con,$_POST['amount'][$i]);
$amount=filter_var($amount,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);






$sql=mysqli_query($con,"INSERT INTO payment_2 (pay_id,pay_date,user_id,Bank_account,sale_id,sale_date,amount)
values('$pay_id','$pay_date','$user_id','$Bank_account','$sale_id','$sale_date','$amount')
");



}
}


	    unset($_SESSION["cart_receipt"]);
		unset($_SESSION["payment_date"]);
		unset($_SESSION["cart_payment"]);
		

			
   if($sql_in){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		       $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				
		       header("location:payment_list.php");
		     }
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	 	header("location:payment_list.php");
	    }


?>
</html>