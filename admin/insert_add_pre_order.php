<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
$sql_max=mysqli_query($con,"select max(SUBSTRING(receipt_id, 3, 6)) as id from pre_orders");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='PO0000'.'1';  
 
 $id2=$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $receipt_id=$id1;     }

 else if($max_id<9){  $receipt_id='PO0000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $receipt_id='PO000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $receipt_id='PO00'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $receipt_id='PO0'.$id2;} 
  else if($max_id<99999){  $receipt_id='PO'. $id2;}
  
  else if($max_id >=99999){   $receipt_id='PO'.$id2; }
  
   $receipt_id;

   //  $receipt_id = mysqli_real_escape_string($con,$_POST['receipt_id']);
     $receipt_date = mysqli_real_escape_string($con,$_POST['receipt_date']);
     $refer_no = mysqli_real_escape_string($con,$_POST['refer_no']);
     $staff_id = mysqli_real_escape_string($con,$_POST['staff_id']);  
     $supplier_id = mysqli_real_escape_string($con,$_POST['supplier_id']);
     $stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);


$sql_max=mysqli_query($con," select max(SUBSTRING(product_lot_id,20, 1)) as proid  from stock_product where stockin_date='$receipt_date' ");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 
 
 $id=$max_id+1;


if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['Product_ID']); $i++) {
				
			  $Product_ID = mysqli_real_escape_string($con,$_POST['Product_ID'][$i]);
	  
	
	     $QTY = mysqli_real_escape_string($con,$_POST['QTY'][$i]);
	    	  $QTY = filter_var($QTY,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		      $Price = mysqli_real_escape_string($con,$_POST['Price'][$i]);
	     	  $Price = filter_var($Price,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
	
	
			  $total = $QTY * $Price;
	
	
	$remark = mysqli_real_escape_string($con,$_POST['remark'][$i]);
	     	  $remark = filter_var($remark,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
	
	$amount_crate = mysqli_real_escape_string($con,$_POST['amount_crate'][$i]);
	     	  $amount_crate = filter_var($amount_crate,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
	
			  
			   $product_lot_id=$Product_ID.'.'.$receipt_date.'.'.$id;




		$sql=mysqli_query($con,"INSERT INTO pre_orders (receipt_id,refer_no,receipt_date,stock_id,product_id,price,qty,supplier_id,staff_id,product_lot_id,amount,remark,amount_crate) 
		values('$receipt_id','$refer_no','$receipt_date','$stock_id','$Product_ID','$Price','$QTY','$supplier_id','$staff_id','$product_lot_id','$total','$remark','$amount_crate') ");
		
		
			
			
    //    $sql=mysqli_query($con,"UPDATE products SET QTY=QTY+$QTY where Product_ID='$Product_ID'");
			}

  
   
   
				unset($_SESSION['cart_pre_order']);
			
if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:add_pre_order.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:add_pre_order.php");
	}
			
					
  // header('location:add_pre_order.php');
    mysql_close();

}else{ header('location:add_pre_order.php'); mysql_close(); }

?>
</html>

 
