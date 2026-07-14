<?php


include('init.php');

  
			
   $_SESSION['payment_date']=mysqli_real_escape_string($con,$_POST['payment_date']);
   $_SESSION['customer_id']=mysqli_real_escape_string($con,$_POST['customer_id']);
   $_SESSION['customer_name']=mysqli_real_escape_string($con,$_POST['customer_name']);
   $_SESSION['payment_name']=mysqli_real_escape_string($con,$_POST['payment_name']);
   $_SESSION['receipt_name']=mysqli_real_escape_string($con,$_POST['receipt_name']);



?>