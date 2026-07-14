<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php


  
date_default_timezone_set("Asia/Bangkok");

 $order_date = mysqli_real_escape_string($con,$_POST['order_date']);
 $sale_time=date('H:i:s');
 
 $sale_dd_tt=date_create("$order_date $sale_time");


  $sale_date_time = date_format($sale_dd_tt,"Y-m-d H:i:s");

    $order_id = mysqli_real_escape_string($con,$_POST['order_id']);
     
  //   $refer_no = mysqli_real_escape_string($con,$_POST['refer_no']);
 //    $staff_id = mysqli_real_escape_string($con,$_POST['staff_id']);  
     $customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
     $stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	 
	
	$user_id=$_SESSION['user_id'];
	
  $total_all_amount = mysqli_real_escape_string($con,$_POST['total_all_amount']);
  $total_all_amount = filter_var($total_all_amount,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);


if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['Product_ID']); $i++) {
			
			
			  $Product_ID = mysqli_real_escape_string($con,$_POST['Product_ID'][$i]);
			  
	          $qty = mysqli_real_escape_string($con,$_POST['QTY'][$i]);
			  $qty = filter_var($qty,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
		      $Price = mysqli_real_escape_string($con,$_POST['Price'][$i]);
			  $Price = filter_var($Price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
			//  $total = $qty * $Price;
			  
	          $qty_limit = mysqli_real_escape_string($con,$_POST['qty_limit'][$i]);
			  $qty_limit = filter_var($qty_limit, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  $discount = mysqli_real_escape_string($con,$_POST['discount'][$i]);
			  $discount = filter_var($discount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
		  
		if($qty>$qty_limit){ $qty=$qty_limit; 
		$msg2=$_SESSION['smg']="<div class='alert alert-success'><strong>ຈຳການຈ່າຍບາງລາຍການເກີນຈຳນວນໃນສາງ!</strong></div>"; 
		}	

      $amount=$qty*$Price;
      @$total=$total_all_amount;
			
	////////////////////////////////////////////////////////////////////////
	
	
                   	$sql_in=mysqli_query($con,"INSERT INTO seller_orders 
					
  (order_id,order_date,customer_id,stock_id,product_id,price,qty,amount,discount,total,staff_id,status) 
        values
('$order_id','$order_date','$customer_id','$stock_id','$Product_ID','$Price','$qty','$amount','$discount','$total','$user_id','1') ");
	   
		
}

  
   
   
			unset($_SESSION['cart_seller_order']);
			
   if($sql_in){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		        $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				
		       header("location:add_seller_order.php?order_id=$order_id&order_date=$order_date&sale_time=$sale_time");
		}
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:add_seller_order.php");
	    }
			
					
 
     mysql_close();

}
else{ header('location:add_seller_order.php'); mysql_close(); }

?>
</html>

 
