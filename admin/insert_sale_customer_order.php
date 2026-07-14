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
 from product_sale where year(sale_date)='$id_y'   ");
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


  $sale_date_time=date_format($sale_dd_tt,"Y-m-d H:i:s");

     $order_id=mysqli_real_escape_string($con,$_POST['order_id']);
     
     $sale_date=mysqli_real_escape_string($con,$_POST['sale_date']);
	 $sale_time=mysqli_real_escape_string($con,$_POST['sale_time']);
	  
	 $send_date=mysqli_real_escape_string($con,$_POST['send_date']);
	 $send_time=mysqli_real_escape_string($con,$_POST['send_time']);
 //    $staff_id = mysqli_real_escape_string($con,$_POST['staff_id']);  
     $customer_id=mysqli_real_escape_string($con,$_POST['customer_id']);
     $stock_id=mysqli_real_escape_string($con,$_POST['stock_id']);
	 
	  $route_id=mysqli_real_escape_string($con,$_POST['route_id']);
	  
	   $sr=mysqli_real_escape_string($con,$_POST['sr']);
	 
	//$all_dis = mysqli_real_escape_string($con,$_POST['all_dis']);
   // $all_dis = filter_var($all_dis,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$total_all=mysqli_real_escape_string($con,$_POST['total_all']);
    $total_all=filter_var($total_all,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
     
	 
	 $status_payment=mysqli_real_escape_string($con,$_POST['status_payment']);
  
	
	    $sql_ch_order=mysqli_query($con,"SELECT * FROM product_sale  where order_id='$order_id'");
		$num_row_ch=mysqli_num_rows($sql_ch_order);
		if($num_row_ch>0){
			
			
		}else{  /// check order_id
	


if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['list_id']); $i++) {
			
			   $list_id=mysqli_real_escape_string($con,$_POST['list_id'][$i]);
		      $Product_ID=mysqli_real_escape_string($con,$_POST['Product_ID'][$i]);
			  
	          $qty=mysqli_real_escape_string($con,$_POST['QTY'][$i]);
			  $qty=filter_var($qty,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
		      $Price=mysqli_real_escape_string($con,$_POST['Price'][$i]);
			  $Price=filter_var($Price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  $crate_price=mysqli_real_escape_string($con,$_POST['crate_price'][$i]);
			  $crate_price=filter_var($crate_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  $amount=mysqli_real_escape_string($con,$_POST['amount'][$i]);
			  $amount=filter_var($amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  
			  $amount_crate=mysqli_real_escape_string($con,$_POST['amount_crate'][$i]);
			  $amount_crate=filter_var($amount_crate, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  $crate_qty=mysqli_real_escape_string($con,$_POST['crate_qty'][$i]);
			  $crate_qty=filter_var($crate_qty, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  
			   $total_amount_crate=mysqli_real_escape_string($con,$_POST['total_amount_crate'][$i]);
			   $total_amount_crate=filter_var($total_amount_crate, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
			//  $total = $qty * $Price;
			  
	          $qty_limit=mysqli_real_escape_string($con,$_POST['qty_limit'][$i]);
			  $qty_limit=filter_var($qty_limit, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			   $Group_ID=mysqli_real_escape_string($con,$_POST['Group_ID'][$i]);
			  
	 	  
			
			
		if($Group_ID=='001'){	
	
			/*	$sql_in=mysqli_query($con,"INSERT INTO product_sale 
		(list_id,sale_id,sale_date,sale_time,order_id,customer_id,stock_id,product_id
		,price,crate_price,qty,crate_qty,amount,amount_crate,last_amount,total,payment,user_id,bill_size) 
		
		values('$list_id','$sale_id','$sale_date','$sale_time','$order_id','$customer_id','$stock_id','$Product_ID'
		,'$Price','$crate_price','$qty','$crate_qty','$amount'
		,'$amount_crate','$total_amount_crate','$total_all','$payment','$user_id','1') ");*/
		/*	*/  
		 $user_id=$_SESSION['user_id'];
		 
		  
	/*	 if($qty>$qty_limit){ $qty=$qty_limit; 
		$msg2=$_SESSION['smg']="<div class='alert alert-success'><strong>ຈຳການຈ່າຍບາງລາຍການເກີນຈຳນວນໃນສາງ!</strong></div>"; 
		
		header("location:add_sale_customer_order.php");
		   }*/	
	
	
	 $sql_pl=mysqli_query($con,"
           select * from  stock_product where qty >0 and product_id='$Product_ID' and stock_id='$stock_id' order by product_lot_id  ");
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
					
			//$total_1=$x_qty*$Price;
			//$dis1=$dis*$x_qty;
		$x_amount=$x_qty*$Price;
	
		$sql_in=mysqli_query($con,"INSERT INTO product_sale (stockin_id,list_id,sale_id,sale_date,sale_time
		,send_date,send_time,order_id,customer_id,stock_id,product_id,product_lot_id,price,crate_price,qty
		,crate_qty,amount,amount_crate,last_amount,total,payment,remain,user_id,bill_size,status_payment,sr) 
		
		 values('$p[stockin_id]','$list_id','$sale_id','$sale_date','$sale_time','$send_date','$send_date','$order_id'
		 ,'$customer_id','$stock_id','$Product_ID','$p[product_lot_id]','$Price','$crate_price','$x_qty','$crate_qty'
		 ,'$x_amount','$amount_crate','$total_amount_crate','$total_all','0','$total_all','$user_id','1','$status_payment','$sr') ");
		
	
			
		$sql_up2=mysqli_query($con,"update stock_product set qty=qty-$x_qty 
		 where product_lot_id='$p[product_lot_id]'
		 and stock_id='$stock_id' and Id='$p[Id]' ");	
		
					}
					else{
						
				//	echo $qty;
				//$total_2=$qty*$Price;
				//$dis2=$dis*$qty;
		$xx_mount=$qty*$Price;
				
		$sql_in=mysqli_query($con,"INSERT INTO product_sale (stockin_id,list_id,sale_id,sale_date,sale_time
		,send_date,send_time,order_id,customer_id,stock_id,product_id,product_lot_id,price,crate_price,qty
		,crate_qty,amount,amount_crate,last_amount,total,payment,remain,user_id,bill_size,status_payment,sr) 
		
		values('$p[stockin_id]','$list_id','$sale_id','$sale_date','$sale_time','$send_date','$send_date','$order_id'
		,'$customer_id','$stock_id','$Product_ID','$p[product_lot_id]','$Price','$crate_price','$qty','$crate_qty'
		,'$xx_mount','$amount_crate','$total_amount_crate','$total_all','0','$total_all','$user_id','1','$status_payment','$sr') ");
	
	   
			echo $qty;
		$sql_up2=mysqli_query($con,"update stock_product set qty=qty-$qty where
		 product_lot_id='$p[product_lot_id]' and stock_id='$stock_id' and Id='$p[Id]' ");	
		 
	   
						}
				 $qty=$qty-$q;

			        }
					
	
			 
	  } //end while product lot
	  
	}else{// end if group == 001
	
	$amount=$qty*$Price;
			  	
			
	$sql_in=mysqli_query($con,"INSERT INTO product_sale (stockin_id,list_id,sale_id,sale_date,sale_time
		,send_date,send_time,order_id,customer_id,stock_id,product_id,product_lot_id,price,crate_price,qty
		,crate_qty,amount,amount_crate,last_amount,total,payment,remain,user_id,bill_size,status_payment,sr) 
		
		values('','$list_id','$sale_id','$sale_date','$sale_time','$send_date','$send_date','$order_id'
		,'$customer_id','$stock_id','$Product_ID','$Product_ID','$Price','$crate_price','$qty','$crate_qty'
		,'$amount','$amount_crate','$total_amount_crate','$total_all','0','$total_all','$user_id','1','$status_payment','$sr') ");
	}  
	  
}/// end while product lot id
	   
		
	 
}


 if($status_payment=='2'){
	 $sql_up_order=mysqli_query($con,"update product_sale set status='2',payment='$total',remain='0'   where sale_id='$sale_id'  ");
	 
	  $sql_id_auto= mysqli_query($con,"SELECT MAX(payment_id) AS id_max FROM  customer_payment ");
   $ff = mysqli_fetch_array($sql_id_auto);
   $id_number = $ff['id_max']+1;
   $width = 6;
   $auto_id = str_pad((string)$id_number, $width, "0", STR_PAD_LEFT); 
   
   
     $sql_in_pay=mysqli_query($con,"  INSERT INTO customer_payment (payment_id,payment_date,customer_id,sale_id,sale_date,amount,
     total_amount,payment_type,cur_lak,total_lak,user_id,user_date)    
     
     	select '$auto_id',sale_date,customer_id,sale_id,sale_date,sum(product_sale.total_amt) as total_amt
		,sum(product_sale.total_amt) as total_amt,'1',sum(product_sale.total_amt) as total_amt 
		,sum(product_sale.total_amt) as total_amt,user_id,sale_date
	
		 
		from 	  
      (SELECT product_sale.*,sum(product_sale.amount) as total_amt
		
		   FROM  product_sale 
		  
       where 1=1  and product_sale.sale_id='$sale_id'
         group by product_sale.sale_id,product_sale.product_id ) 
       as product_sale
          
	   group by product_sale.sale_id order by product_sale.sale_id desc");
	   
	 }

	 else{
$sql_up_debit=mysqli_query($con,"update customers set total_debit_amt=ifnull(total_debit_amt,0)+$total_all where customer_id='$customer_id'  ");
		 }


		}   ///  end off  check order_id
		
		
		
		
		
			unset($_SESSION["cart_sale_customer_order"]);
		unset($_SESSION["cur"]);
		unset($_SESSION["cur_name"]);
		unset($_SESSION["list_id"]);
		unset($_SESSION["customer_id"]);
		unset($_SESSION["customer_name"]);
		unset($_SESSION["customer_type"]);
		unset($_SESSION["s_order_id"]);
		
		unset($_SESSION["s_route_id"]);
		unset($_SESSION["s_route_name"]);
		
		 unset($_SESSION['s_sr_id']);
		 unset($_SESSION['s_sr_fname']);
		 unset($_SESSION['s_sr_lname']);
			
   if($sql_in){
		
		 $sql_up_order=mysqli_query($con,"update product_customer_order set status_sale='2' where sale_id='$order_id'  ");
		   if(isset($_SESSION['smg'])){    }
		   else{
		       $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				
		       header("location:sale_list.php?sale_id=$sale_id&sale_date=$sale_date&sale_time=$sale_time");
		     }
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	 	header("location:add_sale_customer_order.php");
	    }
			

  



?>
</html>

 
