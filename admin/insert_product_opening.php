<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php




	//$Group_ID = mysqli_real_escape_string($con,$_POST['Group_ID']);
	@$product_id = mysqli_real_escape_string($con,$_POST['product_id']);
	@$unit = mysqli_real_escape_string($con,$_POST['unit']);
	@$Product_Name = mysqli_real_escape_string($con,$_POST['ups']);
	$stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	$y = mysqli_real_escape_string($con,$_POST['y']);
	$m = mysqli_real_escape_string($con,$_POST['m']);
	
	@$qty = mysqli_real_escape_string($con,$_POST['qty']);
	@$qty = filter_var($qty, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
	
	@$price = mysqli_real_escape_string($con,$_POST['price']);
	@$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	@$amount = mysqli_real_escape_string($con,$_POST['amount']);
	@$amount = filter_var($amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);



		   $open_date=date($y.'-'.$m.'-'.'01'); 
			
	
	
	
	$action = mysqli_real_escape_string($con,$_POST['action']);
	@$Id = mysqli_real_escape_string($con,$_POST['Id']);

	//$stock_id='0001';
	
	
if($action=="Add"){


$sql_ch=mysqli_query($con,"select * from stock_opening where product_id='$product_id' and stock_id='$stock_id'
                     and month(open_date)='$m' and year(open_date)='$y'  ");
					 
$ch=mysqli_num_rows($sql_ch);
if($ch >0) {  $_SESSION['smg']="<div class='alert alert-danger'><strong>ລາຍການນີ້ມີແລ້ວ</strong> </div>";
		header("location:add_opening.php");    }
else{

$sad=mysqli_query($con,"INSERT INTO stock_opening (open_date,product_id,qty,price,amount,stock_id)
     values('$open_date','$product_id','$qty','$price','$amount','$stock_id')");


	if($sad){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:add_opening.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:add_opening.php");
	}
    }
	
	
	
}
else if($action=="Update"){
	
	   $sad=mysqli_query($con,"Update stock_opening set open_date='$open_date',product_id='$product_id',qty='$qty',price='$price',amount='$amount',stock_id='$stock_id'
	    where Id='$Id'  ");


	if($sad){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ແກ້ໄຂສຳເລັດ!</strong></div>";
		header("location:opening_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ແກ້ໄຂບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:opening_list.php");
	}
	
	
	}
else if($action=="create"){
	
		$sql_ch=mysqli_query($con," select * from stock_opening where open_date='$open_date'   ");
	$ch=mysqli_num_rows($sql_ch);
	if($ch >0) { 
	
	echo "<div class='alert alert-danger'><strong>ເດືອນນີ້ມີລາຍການແລ້ວ</strong> </div>";
	//	header("location:add_opening.php"); 
		   }
    else{
	$sql=mysqli_query($con,"insert into stock_opening ( open_date,product_id,qty,price,amount,stock_id) 
   select '$open_date',product_id,sum(qty) as qty,price,sum(qty)*price as amount,stock_id 
    from stock_product group by product_id,stock_id   ");
	
		}
    }
else if($action=="delete"){
	
		$sql_ch=mysqli_query($con," select * from stock_opening where open_date='$open_date'   ");
	$ch=mysqli_num_rows($sql_ch);
	if($ch >0) { 
	
	
	//	header("location:add_opening.php"); 
	$sql=mysqli_query($con,"delete  from stock_opening where open_date='$open_date'   ");
		   }
    else{
	echo "<div class='alert alert-danger'><strong>ເດືອນນີ້ບໍ່ມີລາຍການຍອດຍົກ</strong> </div>";
	
		}
    }
else{
	
	
	
	
	}

?>
</html>

 