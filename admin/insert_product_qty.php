<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php




	//$Group_ID = mysqli_real_escape_string($con,$_POST['Group_ID']);
	$product_id = mysqli_real_escape_string($con,$_POST['product_id']);
	$unit = mysqli_real_escape_string($con,$_POST['unit']);
	$Product_Name = mysqli_real_escape_string($con,$_POST['ups']);
	$stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	$expert_date = mysqli_real_escape_string($con,$_POST['expert_date']);
	
	$qty = mysqli_real_escape_string($con,$_POST['qty']);
	$qty = filter_var($qty, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
	
	$price = mysqli_real_escape_string($con,$_POST['price']);
	$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$sell_price = mysqli_real_escape_string($con,$_POST['sell_price']);
	$sell_price = filter_var($sell_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	
	
	
	$action = mysqli_real_escape_string($con,$_POST['action']);
	@$Id = mysqli_real_escape_string($con,$_POST['Id']);

	//$stock_id='0001';
	$stockin_date=date("Y-m-d");
	
if($action=="Add"){


$sql_ch=mysqli_query($con,"select * from stock_product where product_lot_id='$product_id' and stock_id='$stock_id'  ");
$ch=mysqli_num_rows($sql_ch);
if($ch >0) {  $_SESSION['smg']="<div class='alert alert-danger'><strong>ລາຍການນີ້ມີແລ້ວ</strong> </div>";
		header("location:add_product_qty.php");    }
else{

$sad=mysqli_query($con,"INSERT INTO stock_product (product_id,stock_id,stockin_date,qty,price,sell_price,product_lot_id,expert_date)
     values('$product_id','$stock_id','$stockin_date','$qty','$price','$sell_price','$product_id','$expert_date')");


	if($sad){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:add_product_qty.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:add_product_qty.php");
	}
    }
	
	
	
}
else if($action=="Update"){
	
	   $sad=mysqli_query($con,"Update  stock_product set price='$price', sell_price='$sell_price',qty='$qty'
	   ,expert_date='$expert_date',stock_id='$stock_id'
	    where Id='$Id'  ");


	if($sad){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ແກ້ໄຂສຳເລັດ!</strong></div>";
		header("location:product_qty_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ແກ້ໄຂບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:product_qty_list.php");
	}
	
	
	}
else{
	
	
	
	
	}

?>
</html>

 