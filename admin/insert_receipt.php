<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
 

   $sql_id_auto= mysqli_query($con,"SELECT MAX(payment_id) AS id_max FROM  customer_payment ");
   $ff = mysqli_fetch_array($sql_id_auto);
   $id_number = $ff['id_max']+1;
   $width = 6;
   $auto_id = str_pad((string)$id_number, $width, "0", STR_PAD_LEFT); 

 date_default_timezone_set("Asia/Bangkok");



 $payment_date = mysqli_real_escape_string($con,$_POST['payment_date']);
 $payment_time=date('H:i:s');
 
 $sale_dd_tt=date_create("$payment_date $payment_time");


  $sale_date_time=date_format($sale_dd_tt,"Y-m-d H:i:s");
  
     $user_id=$_SESSION['user_id'];
	 $user_date=date("Y-m-d");
     
     $customer_id=mysqli_real_escape_string($con,$_POST['customer_id']);
	  
	 $payment_name=mysqli_real_escape_string($con,$_POST['payment_name']);
	 $receipt_name=mysqli_real_escape_string($con,$_POST['receipt_name']);     
     $payment_type=mysqli_real_escape_string($con,$_POST['payment_type']);
	 
	  $rate_lak=mysqli_real_escape_string($con,$_POST['rate_lak']);
	  $rate_lak=filter_var($rate_lak,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	  $rate_thb=mysqli_real_escape_string($con,$_POST['rate_thb']);
	  $rate_thb=filter_var($rate_thb,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	  $rate_usd=mysqli_real_escape_string($con,$_POST['rate_usd']);
	  $rate_usd=filter_var($rate_usd,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	  
	  $pay_lak=mysqli_real_escape_string($con,$_POST['pay_lak']);
	  $pay_lak=filter_var($pay_lak,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	  $pay_thb=mysqli_real_escape_string($con,$_POST['pay_thb']);
	  $pay_thb=filter_var($pay_thb,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	  $pay_usd=mysqli_real_escape_string($con,$_POST['pay_usd']);
	  $pay_usd=filter_var($pay_usd,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	  
	  $total_lak=mysqli_real_escape_string($con,$_POST['total_lak']);
	  $total_lak=filter_var($total_lak,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	  
	   
	   $total_all=mysqli_real_escape_string($con,$_POST['total_all']);
	   $total_all=filter_var($total_all,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
//exit();
if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['sale_id']); $i++) {
			
			   $list_id=mysqli_real_escape_string($con,$_POST['list_id'][$i]);
		       $sale_id=mysqli_real_escape_string($con,$_POST['sale_id'][$i]);
			   $sale_date=mysqli_real_escape_string($con,$_POST['sale_date'][$i]);
			  
	          $total=mysqli_real_escape_string($con,$_POST['total'][$i]);
			  $total=filter_var($total,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  $remain=mysqli_real_escape_string($con,$_POST['remain'][$i]);
			 $remain=filter_var($remain,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			
		if($total_lak>0){

			 
	    if($total_lak>$remain){
			 
				 $total_lak=$total_lak-$remain;	         
			   $total_x_pay=$remain;
				
		$sql_in=mysqli_query($con,"INSERT INTO customer_payment (payment_id,payment_date,customer_id,sale_id,sale_date,amount,
     total_amount,payment_type,cur_lak,cur_thb,cur_usd,rate_lak,rate_thb,rate_usd,total_lak,payment_name,receipt_name,user_id,user_date) 
		
		values('$auto_id','$payment_date','$customer_id','$sale_id','$sale_date','$total_x_pay'
		,'$total_all','$payment_type','$pay_lak','$pay_thb','$pay_usd','$rate_lak','$rate_thb','$rate_usd','$total_x_pay','$payment_name'
		,'$receipt_name','$user_id','$user_date') ");
		
		
    $sql_up_order=mysqli_query($con,"update product_sale set payment=payment+$total_x_pay,remain=remain-$total_x_pay   where sale_id='$sale_id'  ");
    $sql_up_order=mysqli_query($con,"update product_sale set status='2'    where sale_id='$sale_id' and remain<1  ");
  
   $sql_up_debit=mysqli_query($con,"update customers set total_debit_amt=ifnull(total_debit_amt,0)-$total_x_pay where customer_id='$customer_id'  ");
			
			}else{
				 
			   $total_xx_pay=$total_lak; 
			
				$sql_in=mysqli_query($con,"INSERT INTO customer_payment (payment_id,payment_date,customer_id,sale_id,sale_date,amount,
     total_amount,payment_type,cur_lak,cur_thb,cur_usd,rate_lak,rate_thb,rate_usd,total_lak,payment_name,receipt_name,user_id,user_date) 
		
		values('$auto_id','$payment_date','$customer_id','$sale_id','$sale_date','$total_xx_pay'
		,'$total_all','$payment_type','$pay_lak','$pay_thb','$pay_usd','$rate_lak','$rate_thb','$rate_usd','$total_xx_pay','$payment_name'
		,'$receipt_name','$user_id','$user_date') ");
		
		
    $sql_up_order=mysqli_query($con,"update product_sale set payment=payment+$total_xx_pay,remain=remain-$total_xx_pay   where sale_id='$sale_id'  ");
    $sql_up_order=mysqli_query($con,"update product_sale set status='2'    where sale_id='$sale_id' and remain<1  ");
  
   $sql_up_debit=mysqli_query($con,"update customers set total_debit_amt=ifnull(total_debit_amt,0)-$total_xx_pay where customer_id='$customer_id'  ");
				 }
			
			
			
			}
			



}
	
	
}



		unset($_SESSION["cart_receipt"]);
		unset($_SESSION["payment_date"]);
		unset($_SESSION["customer_id"]);
		unset($_SESSION["customer_name"]);
		unset($_SESSION["payment_name"]);
		unset($_SESSION["receipt_name"]);
		
		
			
   if($sql_in){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		       $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				
		       header("location:receipt_list.php");
		     }
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	 	header("location:receipt_list.php");
	    }
			

  



?>
</html>

 
