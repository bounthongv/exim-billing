<?php 
include("init.php");




 $payment_id=mysqli_real_escape_string($con,$_POST['payment_id']);

 $payment_date=mysqli_real_escape_string($con,$_POST['payment_date']);
 $payment_type=mysqli_real_escape_string($con,$_POST['payment_type']);
 $Bank_account=mysqli_real_escape_string($con,$_POST['Bank_account']);


 $sql_up=mysqli_query($con,"UPDATE customer_payment set payment_date='$payment_date',payment_type='$payment_type',Bank_account='$Bank_account' 
 where payment_id='$payment_id' ");




  if($sql_up){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		       $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				

		       header("location:receipt_list_2.php");
			



		     }


?>