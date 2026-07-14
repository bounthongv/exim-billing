<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
    $year_id=date('y');
      $id_y=date('Y');
	  $id_m=date('m');

$sql_max=mysqli_query($con,"select IFNULL(max(SUBSTRING(sale_id,4, 6)),0) as m_id 
 from product_customer_order where year(sale_date)='$id_y'   ");
@$row_max=mysqli_fetch_array($sql_max);

 $max_id=$row_max['m_id'];
 $id1=$year_id.'.'.'00000'.'1';  
 
 $id2=$max_id+1;
 
 $sale_id='';
if($max_id<1){    $sale_id=$id1;     }

 else if($max_id<9){  $sale_id=$year_id.'.'.'00000'.$id2;}  // 0000.2-0000.9
 else if($max_id<99){  $sale_id=$year_id.'.'.'0000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $sale_id=$year_id.'.'.'000'.$id2;} // 0010-00999  //   0100 - 999

  else if($max_id<9999){  $sale_id=$year_id.'.'.'00'.$id2;} 
  else if($max_id<99999){  $sale_id=$year_id.'.'.'0'.$id2;}
   else if($max_id<999999){  $sale_id=$year_id.'.'.$id2;}
  
date_default_timezone_set("Asia/Bangkok");

 $sale_date = mysqli_real_escape_string($con,$_POST['sale_date']);
 $sale_time=date('H:i:s');
 
 $sale_dd_tt=date_create("$sale_date $sale_time");


  $sale_date_time = date_format($sale_dd_tt,"Y-m-d H:i:s");

  
     
     $sale_date = mysqli_real_escape_string($con,$_POST['sale_date']);
	 $sale_time = mysqli_real_escape_string($con,$_POST['sale_time']);
	  
	 $send_date = mysqli_real_escape_string($con,$_POST['send_date']);
	 $send_time = mysqli_real_escape_string($con,$_POST['send_time']);
 //    $staff_id = mysqli_real_escape_string($con,$_POST['staff_id']);  
     $customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
     $stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	 
	  $route_id = mysqli_real_escape_string($con,$_POST['route_id']);
	  
	  $sr = mysqli_real_escape_string($con,$_POST['sr']);
	  
	  $remark = mysqli_real_escape_string($con,$_POST['remark']);
	 
	//$all_dis = mysqli_real_escape_string($con,$_POST['all_dis']);
   // $all_dis = filter_var($all_dis,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$total_all = mysqli_real_escape_string($con,$_POST['total_all']);
    $total_all = filter_var($total_all,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   
  
	
	


if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['Product_ID']); $i++) {
			
			
		       $Product_ID = mysqli_real_escape_string($con,$_POST['Product_ID'][$i]);
			  
	          $qty = mysqli_real_escape_string($con,$_POST['QTY'][$i]);
			  $qty = filter_var($qty,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
		      $Price = mysqli_real_escape_string($con,$_POST['Price'][$i]);
			  $Price = filter_var($Price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			 $crate_price = mysqli_real_escape_string($con,$_POST['crate_price'][$i]);
			  $crate_price = filter_var($crate_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  $amount = mysqli_real_escape_string($con,$_POST['amount'][$i]);
			  $amount = filter_var($amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  
			  $amount_crate = mysqli_real_escape_string($con,$_POST['amount_crate'][$i]);
			  $amount_crate = filter_var($amount_crate, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  $crate_qty = mysqli_real_escape_string($con,$_POST['crate_qty'][$i]);
			  $crate_qty = filter_var($crate_qty, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  
			   $total_amount_crate = mysqli_real_escape_string($con,$_POST['total_amount_crate'][$i]);
			   $total_amount_crate = filter_var($total_amount_crate, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
			//  $total = $qty * $Price;
			  
	          $qty_limit = mysqli_real_escape_string($con,$_POST['qty_limit'][$i]);
			  $qty_limit = filter_var($qty_limit, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  
			
		  
		
			  
		 $user_id=$_SESSION['user_id']; 
		 
		 $sql_in=mysqli_query($con,"    INSERT INTO product_customer_order 	(sale_id,sale_date,sale_time,send_date,send_time,customer_id
		,stock_id,route_id,product_id,price,crate_price,qty,amount,amount_crate,last_amount,total,user_id,bill_size,status_sale,sr,remark) 
		values('$sale_id','$sale_date','$sale_time','$send_date','$send_time','$customer_id','$stock_id','$route_id'
		,'$Product_ID','$Price','$crate_price','$qty','$amount','$amount_crate','$total_amount_crate','$total','$user_id','1','1','$sr','$remark') ");
		
    	
		
		

	  } /// end while product lot id
	   
		
}

			unset($_SESSION['cart_customer_order']);
			
   if($sql_in){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		       $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				
		       header("location:add_customer_order.php?sale_id=$s_id&sale_date=$sale_date&sale_time=$sale_time");
		}
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	 	header("location:add_customer_order.php");
	    }
			

    



?>
</html>

 
