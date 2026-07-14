<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php


  
date_default_timezone_set("Asia/Bangkok");

 $sale_date = mysqli_real_escape_string($con,$_POST['sale_date']);
 $sale_time=date('H:i:s');
 
 $sale_dd_tt=date_create("$sale_date $sale_time");


  $sale_date_time = date_format($sale_dd_tt,"Y-m-d H:i:s");

    $s_id = mysqli_real_escape_string($con,$_POST['sale_id']);
     
     $refer_no = mysqli_real_escape_string($con,$_POST['refer_no']);
 //    $staff_id = mysqli_real_escape_string($con,$_POST['staff_id']);  
     $customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
     $stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	 
	$all_dis = mysqli_real_escape_string($con,$_POST['all_dis']);
    $all_dis = filter_var($all_dis,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$total = mysqli_real_escape_string($con,$_POST['total']);
    $total = filter_var($total,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   
  	
	$payment_thb = mysqli_real_escape_string($con,$_POST['payment_thb']);
    $payment_thb = filter_var($payment_thb,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$payment_lak = mysqli_real_escape_string($con,$_POST['payment_lak']);
    $payment_lak = filter_var($payment_lak,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$payment_usd = mysqli_real_escape_string($con,$_POST['payment_usd']);
    $payment_usd = filter_var($payment_usd,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	
	$kip_baht = mysqli_real_escape_string($con,$_POST['kip_baht']);
    $kip_baht = filter_var($kip_baht,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$dollar_baht = mysqli_real_escape_string($con,$_POST['dollar_baht']);
    $dollar_baht = filter_var($dollar_baht,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$user_id=$_SESSION['user_id'];
	
	
	$payment=$payment_thb+($payment_lak/$kip_baht)+($payment_usd*$dollar_baht);
	
	if($payment >$total){ $payment=$total; }



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

      
			
	////////////////////////////////////////////////////////////////////////
	
	
	 $sql_pl=mysqli_query($con,"
          select * from  stock_product where qty >0 and product_id='$Product_ID' and stock_id='$stock_id' order by product_lot_id ");
		  while( $p = mysqli_fetch_array($sql_pl))
	{
		   $p['product_lot_id']; 
		   $p['qty'];
			 
			$q=$p['qty']; 
			
			 if($qty > 0)
			 {	
					 
			 $t_qty=$qty-$q;           
			 $x_qty=$qty-$t_qty; 	           
				
				if($qty >$q){
					
				//	echo $x_qty;
					
			$total_1=$x_qty*$Price;
			
		
		$sql_in=mysqli_query($con,"INSERT INTO orders 
		(sale_id,sale_date,sale_time,refer_no,customer_id,stock_id,product_id,product_lot_id,price,qty,amount,bill_discount,total,payment,thb,lak,usd,kip_baht,dollar_baht,user_id) 
		values('$s_id','$sale_date','$sale_time','$refer_no','$customer_id','$stock_id','$Product_ID','$p[product_lot_id]','$Price','$x_qty','$total_1','$all_dis','$total','$payment','$payment_thb','$payment_lak','$payment_usd','$kip_baht','$dollar_baht','$user_id') ");
		
		
					}
					else{
						
				//	echo $qty;
				$total_2=$qty*$Price;
				
				
			$sql_in=mysqli_query($con,"INSERT INTO orders 
		(sale_id,sale_date,sale_time,refer_no,customer_id,stock_id,product_id,product_lot_id,price,qty,amount,bill_discount,total,payment,thb,lak,usd,kip_baht,dollar_baht,user_id) 
		values('$s_id','$sale_date','$sale_time','$refer_no','$customer_id','$stock_id','$Product_ID','$p[product_lot_id]','$Price','$qty','$total_2','$all_dis','$total','$payment','$payment_thb','$payment_lak','$payment_usd','$kip_baht','$dollar_baht','$user_id') ");
		
			
						}
				 $qty=$qty-$q;

			                }
			 
	  } /// end while product lot id
	   
		
}

  
   
   
			unset($_SESSION['cart_sale_stock']);
			
   if($sql_in){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		        $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				
		       header("location:pre_order_list.php?sale_id=$s_id&sale_date=$sale_date&sale_time=$sale_time");
		}
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	//	header("location:add_sale_stock.php");
	    }
			
					
 
     mysql_close();

}
else{ header('location:add_order.php'); mysql_close(); }

?>
</html>

 
