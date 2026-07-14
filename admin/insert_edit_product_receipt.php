<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

     $receipt_id = mysqli_real_escape_string($con,$_POST['receipt_id']);
     $receipt_date = mysqli_real_escape_string($con,$_POST['receipt_date']);
     $refer_no = mysqli_real_escape_string($con,$_POST['refer_no']);
     $staff_id = mysqli_real_escape_string($con,$_POST['staff_id']);  
     $supplier_id = mysqli_real_escape_string($con,$_POST['supplier_id']);
     $stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	 
	 
$sql_del1=mysqli_query($con," delete  from product_receipt where receipt_id='$receipt_id' ");
$sql_del2=mysqli_query($con," delete  from stock_product where stockin_id='$receipt_id' ");

$sql_max=mysqli_query($con," select  max(RIGHT(product_lot_id, 1)) as proid  from stock_product where stockin_date='$receipt_date' ");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 
 
 $id=$max_id+1;


if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['Product_ID']); $i++) {
				
			  $Product_ID = mysqli_real_escape_string($con,$_POST['Product_ID'][$i]);
			  $Product_ID = filter_var($Product_ID,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
	          $QTY = mysqli_real_escape_string($con,$_POST['QTY'][$i]);
			  $QTY = filter_var($QTY,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
		      $Price = mysqli_real_escape_string($con,$_POST['Price'][$i]);
			  $Price = filter_var($Price,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  
			 $total_all = mysqli_real_escape_string($con,$_POST['total_all']);
  		     $total_all = filter_var($total_all,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); 
			  
			  $total = $QTY * $Price;
			  
			   $product_lot_id=$Product_ID.'.'.$receipt_date.'.'.$id;

		$sql=mysqli_query($con,"INSERT INTO product_receipt (receipt_id,refer_no,receipt_date,stock_id,product_id,price,qty,supplier_id,staff_id,product_lot_id,amount,total_all) 
		values('$receipt_id','$refer_no','$receipt_date','$stock_id','$Product_ID','$Price','$QTY','$supplier_id','$staff_id','$product_lot_id','$total','$total_all') ");
		
		
			$sql=mysqli_query($con,"INSERT INTO stock_product (stockin_id,stockin_date,stock_id,product_id,price,qty,supplier_id,staff_id,product_lot_id) 
		values('$receipt_id','$receipt_date','$stock_id','$Product_ID','$Price','$QTY','$supplier_id','$staff_id','$product_lot_id') ");
			
    //    $sql=mysqli_query($con,"UPDATE products SET QTY=QTY+$QTY where Product_ID='$Product_ID'");
			}

  
   
   
				unset($_SESSION['cart_edit_product_receipt']);
			
if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:product_receipt_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:product_receipt_list.php");
	}
			
					
  // header('location:product_receipt.php');
    mysql_close();

}else{ header('location:product_receipt_list.php'); mysql_close(); }

?>
</html>

 
