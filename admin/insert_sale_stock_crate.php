<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
$sql_max=mysqli_query($con,"select IFNULL(max(SUBSTRING(sale_id,2, 6)),0) as sell_id  from product_crate  ");
@$row_max=mysqli_fetch_array($sql_max);

 $max_id=$row_max['sell_id'];
 $id1='S'.'00000'.'1';  
 
 $id2=$max_id+1;
 
 $s_id='';
if($max_id<1){    $s_id=$id1;     }

 else if($max_id<9){  $s_id='S'.'00000'.$id2;}  // 0000.2-0000.9
 else if($max_id<99){  $s_id='S'.'0000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $s_id='S'.'000'.$id2;} // 0010-00999  //   0100 - 999

  else if($max_id<9999){  $s_id='S'.'00'.$id2;} 
  else if($max_id<99999){  $s_id='S'.'0'.$id2;}
   else if($max_id<999999){  $s_id='S'.$id2;}
  
date_default_timezone_set("Asia/Bangkok");

 $sale_date = mysqli_real_escape_string($con,$_POST['sale_date']);
 $sale_time=date('H:i:s');
 
 $sale_dd_tt=date_create("$sale_date $sale_time");


  $sale_date_time = date_format($sale_dd_tt,"Y-m-d H:i:s");

   $user_id=$_SESSION['user_id'];
     
     $refer_no = mysqli_real_escape_string($con,$_POST['refer_no']);

     $customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);

	 
	 
	$total_all = mysqli_real_escape_string($con,$_POST['total_all']);
    $total_all = filter_var($total_all,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	 
	$total_all_dis = mysqli_real_escape_string($con,$_POST['total_all_dis']);
    $total_all_dis = filter_var($total_all_dis,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$total_all_amount = mysqli_real_escape_string($con,$_POST['total_all_amount']);
    $total_all_amount = filter_var($total_all_amount,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   
  


if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['Product_ID']); $i++) {
			
			
			 $Product_ID = mysqli_real_escape_string($con,$_POST['Product_ID'][$i]);
			  
	          $qty = mysqli_real_escape_string($con,$_POST['QTY'][$i]);
			  $qty = filter_var($qty,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
		      $Price = mysqli_real_escape_string($con,$_POST['Price'][$i]);
			  $Price = filter_var($Price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  $percent_dis = mysqli_real_escape_string($con,$_POST['percent_dis'][$i]);
			  $percent_dis = filter_var($percent_dis, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  $discount = mysqli_real_escape_string($con,$_POST['discount'][$i]);
			  $discount = filter_var($discount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			  
			  
			  $total_amount = mysqli_real_escape_string($con,$_POST['total_amount'][$i]);
			  $total_amount = filter_var($total_amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			  
			
			  
			  
			  
			$sql_in=mysqli_query($con,"INSERT INTO product_crate
		(sale_id,sale_date,sale_time,refer_no,customer_id,product_id,price,qty,amount,discount,total,user_id ) 
		
		values('$s_id','$sale_date','$sale_time','$refer_no','$customer_id','$Product_ID','$Price'
		,'$qty','$total_amount','$discount','$total_all_amount','$user_id') ");
		

			 
	  } /// end while product lot id
	   
		

		unset($_SESSION['cart_sale_stock']);
			
   if($sql_in){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		        $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				
		       header("location:print_invoice_sale_crate.php?sale_id=$s_id&sale_date=$sale_date&sale_time=$sale_time");
		}
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:add_sale_stock_crate.php");
	    }
			
					
 
     @mysqli_close();

}
else{ // header('location:add_sale_stock_mini.php');
 mysqli_close(); }

?>
</html>

 
