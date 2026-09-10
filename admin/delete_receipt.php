<?php 
include("init.php");




 $sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);
 $payment_id=mysqli_real_escape_string($con,$_GET['payment_id']);


 $sql_up=mysqli_query($con,"DELETE FROM customer_payment WHERE payment_id='$payment_id' and sale_id='$sale_id'");



  if($sql_up){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		       $_SESSION['smg']="<div class='alert alert-success'><strong>ລຶບສຳເລັດ!</strong></div>";
		        }
				
		       header("location:receipt_list.php");
		     }



?>