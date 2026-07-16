<?php 
include("init.php");


$sale_id = mysqli_real_escape_string($con,$_POST['sale_id']);
$selectedValue = mysqli_real_escape_string($con,$_POST['selectedValue']);



mysqli_query($con,"UPDATE product_sale
SET status_payment = '$selectedValue', `status` = '$selectedValue'
WHERE sale_id='$sale_id'");	




?>