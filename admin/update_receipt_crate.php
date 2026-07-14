<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

    $year_id=date('y');
      $id_y=date('Y');
	  $id_m=date('m');
/*
$sql_max=mysqli_query($con,"select IFNULL(max(SUBSTRING(receipt_id,4, 6)),0) as m_id 
 from product_receipt_crate where year(receipt_date)='$id_y'   ");
@$row_max=mysqli_fetch_array($sql_max);

 $max_id=$row_max['m_id'];
 $id1=$year_id.'.'.'00000'.'1';  
 
 $id2=$max_id+1;
 
 $receipt_id='';
if($max_id<1){    $receipt_id=$id1;     }

 else if($max_id<9){  $receipt_id=$year_id.'.'.'00000'.$id2;}  // 0000.2-0000.9
 else if($max_id<99){  $receipt_id=$year_id.'.'.'0000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $receipt_id=$year_id.'.'.'000'.$id2;} // 0010-00999  //   0100 - 999

  else if($max_id<9999){  $receipt_id=$year_id.'.'.'00'.$id2;} 
  else if($max_id<99999){  $receipt_id=$year_id.'.'.'0'.$id2;}
   else if($max_id<999999){  $receipt_id=$year_id.'.'.$id2;}*/
   
  
       date_default_timezone_set("Asia/Bangkok");
	   
	   
	     $receipt_id = mysqli_real_escape_string($con,$_POST['receipt_id']);
       $receipt_date = mysqli_real_escape_string($con,$_POST['receipt_date']);
      
   
   
   
   
   //////////////  start del
   
   	 if(isset($_SESSION["sale_delete_array"]))
		{
			unset($_SESSION["sale_delete_array"]);
		}
	   
	 $sql_q=mysqli_query($con,"select *  from product_receipt_crate where receipt_id='$receipt_id' ");	 
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
 



	}
	
	  $sql=mysqli_query($con,"delete from product_receipt_crate where receipt_id='$receipt_id'");
	
		
		unset($_SESSION["sale_delete_array"]);
   /////////////// end del
   
   
   
    $receipt_time=date('H:i:s');
 
       $sale_dd_tt=date_create("$receipt_date $receipt_time");
       $sale_date_time = date_format($sale_dd_tt,"Y-m-d H:i:s");
    
     $customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
     $stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	 
	
	
	 $total_all = mysqli_real_escape_string($con,$_POST['total_all']);
     $total_all = filter_var($total_all,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	 
	 
  
	$sql_max=mysqli_query($con," select max(SUBSTRING(product_lot_id,20, 1)) as proid  from stock_product where stockin_date='$receipt_date' ");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 
 
 $id=$max_id+1;
	

if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['Product_ID']); $i++) {
			
		
	
		      $Product_ID = mysqli_real_escape_string($con,$_POST['Product_ID'][$i]);
			  
	          $qty = mysqli_real_escape_string($con,$_POST['QTY'][$i]);
			  $qty = filter_var($qty,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
		      $Price = mysqli_real_escape_string($con,$_POST['Price'][$i]);
			  $Price = filter_var($Price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			 
			  
			  
			  $amount = mysqli_real_escape_string($con,$_POST['amount'][$i]);
			  $amount = filter_var($amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			  
			  
			
			  
		     
			   $product_lot_id=$Product_ID.'.'.$receipt_date.'.'.$id;
			   
			if($qty>0){

		$sql1=mysqli_query($con,"INSERT INTO product_receipt_crate            
		(receipt_id,receipt_date,stock_id,product_id,price,qty,customer_id,staff_id,product_lot_id,amount,total_all) 
		values('$receipt_id','$receipt_date','$stock_id','$Product_ID','$Price','$qty','$customer_id','$staff_id','$product_lot_id','$amount','$total_all') ");
		
		
			$sql2=mysqli_query($con,"INSERT INTO stock_product (stockin_id,stockin_date,stock_id,product_id,price,qty,staff_id,product_lot_id) 
		values('$receipt_id','$receipt_date','$stock_id','$Product_ID','$Price','$qty','$staff_id','$product_lot_id') ");
		
    //    $sql=mysqli_query($con,"UPDATE products SET QTY=QTY+$QTY where Product_ID='$Product_ID'");
			}

  
       }
   
			unset($_SESSION['cart_receipt_crate']);
			
   if($sql1){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		        $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				
		      header("location:print_invoice_receipt_crate.php?receipt_id=$receipt_id&receipt_date=$receipt_date");
		          }
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	 	header("location:receipt_crate_list.php");
	    }
			

    

}
else{ header('location:add_receipt_crate.php'); mysql_close(); }

?>
</html>

 
