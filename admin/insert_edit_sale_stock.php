<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
/*
$sql_max=mysqli_query($con,"select IFNULL(max(SUBSTRING(sale_id,2, 6)),0) as sell_id  from product_sale  ");
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
   else if($max_id<999999){  $s_id='S'.$id2;}*/
   
   $s_id = mysqli_real_escape_string($con,$_POST['sale_id']);
  
date_default_timezone_set("Asia/Bangkok");

 $sale_date = mysqli_real_escape_string($con,$_POST['sale_date']);
 $sale_time=date('H:i:s');
 
 $sale_dd_tt=date_create("$sale_date $sale_time");


  $sale_date_time = date_format($sale_dd_tt,"Y-m-d H:i:s");

 //    $s_id = mysqli_real_escape_string($con,$_POST['s_id']);
     
     $refer_no = mysqli_real_escape_string($con,$_POST['refer_no']);
 //    $staff_id = mysqli_real_escape_string($con,$_POST['staff_id']);  
     $customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
     $stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	 
	$all_dis = mysqli_real_escape_string($con,$_POST['all_dis']);
    $all_dis = filter_var($all_dis,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$total = mysqli_real_escape_string($con,$_POST['total']);
    $total = filter_var($total,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   
  
	
	
	/*$payment_thb = mysqli_real_escape_string($con,$_POST['payment_thb']);
    $payment_thb = filter_var($payment_thb,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$payment_lak = mysqli_real_escape_string($con,$_POST['payment_lak']);
    $payment_lak = filter_var($payment_lak,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$payment_usd = mysqli_real_escape_string($con,$_POST['payment_usd']);
    $payment_usd = filter_var($payment_usd,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	
	$kip_baht = mysqli_real_escape_string($con,$_POST['kip_baht']);
    $kip_baht = filter_var($kip_baht,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$dollar_baht = mysqli_real_escape_string($con,$_POST['dollar_baht']);
    $dollar_baht = filter_var($dollar_baht,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	
	$payment=$payment_thb+($payment_lak/$kip_baht)+($payment_usd*$dollar_baht);
	
	if($payment >$total){ $payment=$total; }

*/
 
	 if(isset($_SESSION["sale_delete_array"]))
		{
			unset($_SESSION["sale_delete_array"]);
		}
	   
	 $sql_q=mysqli_query($con,"select *  from product_sale where sale_id='$s_id' ");	 
	while($p=mysqli_fetch_array($sql_q)){
		
	
		
			$item_array = array(
				'stock_id'               =>     $p['stock_id'], 				
				'product_lot_id'          =>     $p['product_lot_id'],  				
				'qty'                      =>     $p['qty']
			);
			
			$_SESSION["sale_delete_array"][] = $item_array;
	
		}
		
	foreach($_SESSION["sale_delete_array"] as $keys => $values)
	{
		
		     $stock_id = $values["stock_id"]; 		     
	     	 $product_lot_id = $values["product_lot_id"];
		            $qty = $values["qty"];
		 
 $sql_up=mysqli_query($con," update stock_product set qty=qty+$qty where product_lot_id='$product_lot_id' and stock_id='$stock_id'  ");
 //$sql_up=mysqli_query($con," update stock_product set qty=qty-$qty where product_lot_id='$product_lot_id' and stock_id='$t_stock_id' and stockin_id='$transfer_id'  ");



	}
	
	  $sql=mysqli_query($con,"delete from product_sale where sale_id='$s_id'");
	//  $sql=mysqli_query($con,"delete from transfer where transfer_id='$transfer_id'");
		
		unset($_SESSION["sale_delete_array"]);
		
		
		
		
		


if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['Product_ID']); $i++) {
			
			
		       $Product_ID = mysqli_real_escape_string($con,$_POST['Product_ID'][$i]);
			  
	          $qty = mysqli_real_escape_string($con,$_POST['QTY'][$i]);
			  $qty = filter_var($qty,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
		      $Price = mysqli_real_escape_string($con,$_POST['Price'][$i]);
			  $Price = filter_var($Price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  $crate_price = mysqli_real_escape_string($con,$_POST['crate_price'][$i]);
			  $crate_price = filter_var($crate_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  
			  $amount_crate = mysqli_real_escape_string($con,$_POST['amount_crate'][$i]);
			  $amount_crate = filter_var($crate_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  
			   $total_amount_crate = mysqli_real_escape_string($con,$_POST['total_amount_crate'][$i]);
			   $total_amount_crate = filter_var($total_amount_crate, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
			//  $total = $qty * $Price;
			  
	          $qty_limit = mysqli_real_escape_string($con,$_POST['qty_limit'][$i]);
			  $qty_limit = filter_var($qty_limit, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  
			
			  
			  
			  
		 $user_id=$_SESSION['user_id']; 
		 
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
			$dis1=$dis*$x_qty;
	
		$sql_in=mysqli_query($con,"INSERT INTO product_sale 
		(sale_id,sale_date,sale_time,refer_no,customer_id,stock_id,product_id,product_lot_id,price,crate_price,qty
		,amount,amount_crate,last_amount,discount,bill_discount,total
		,payment,thb,lak,usd,user_id,bill_size) 
		values('$s_id','$sale_date','$sale_time','$refer_no','$customer_id','$stock_id','$Product_ID','$p[product_lot_id]','$Price','$crate_price','$x_qty','$total_1','$amount_crate','$total_amount_crate','$dis1','$all_dis','$total','$payment','$payment_thb','$payment_lak','$payment_usd','$user_id','1') ");
		
		$sql_up2=mysqli_query($con,"update stock_product set qty=qty-$x_qty where product_lot_id='$p[product_lot_id]' and stock_id='$stock_id' and Id='$p[Id]' ");	
					}
					else{
						
				//	echo $qty;
				$total_2=$qty*$Price;
				$dis2=$dis*$qty;
				
			$sql_in=mysqli_query($con,"INSERT INTO product_sale 
		(sale_id,sale_date,sale_time,refer_no,customer_id,stock_id,product_id,product_lot_id,price,crate_price,qty
		,amount,amount_crate,last_amount,discount,bill_discount,total,payment
		,thb,lak,usd,user_id,bill_size) 
		values('$s_id','$sale_date','$sale_time','$refer_no','$customer_id','$stock_id','$Product_ID','$p[product_lot_id]','$Price','$crate_price','$qty','$total_2','$amount_crate','$total_amount_crate','$dis2','$all_dis','$total','$payment','$payment_thb','$payment_lak','$payment_usd','$user_id','1') ");
		
		$sql_up2=mysqli_query($con,"update stock_product set qty=qty-$qty where product_lot_id='$p[product_lot_id]' and stock_id='$stock_id' and Id='$p[Id]' ");	
						}
				 $qty=$qty-$q;

			                }
			 
	  } /// end while product lot id
	   
		
}

			unset($_SESSION['cart_edit_sale_stock_mini']);
			
		unset($_SESSION["refer_no"]);
		unset($_SESSION["sale_date"]);
		unset($_SESSION["customer_id"]);
		unset($_SESSION["customer_name"]);
		unset($_SESSION["ct_id"]);
		unset($_SESSION["ct_name"]);
		unset($_SESSION['edit_sale_id']);
		
			
   if($sql_in){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		        $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				
		       header("location:print_invoice_mini.php?sale_id=$s_id&sale_date=$sale_date&sale_time=$sale_time");
		}
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	 	header("location:add_sale_stock_mini.php");
	    }
			

    

}
else{ header('location:add_sale_stock.php'); mysql_close(); }

?>
</html>

 
