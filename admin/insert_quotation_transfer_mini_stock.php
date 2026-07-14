<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php


     $transfer_id = mysqli_real_escape_string($con,$_POST['transfer_id']);
     $transfer_date = mysqli_real_escape_string($con,$_POST['transfer_date']);
    // $refer_no = mysqli_real_escape_string($con,$_POST['refer_no']);
 //    $staff_id = mysqli_real_escape_string($con,$_POST['staff_id']);  
     $stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
 //    $t_stock_id = mysqli_real_escape_string($con,$_POST['t_stock_id']);





if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['Product_ID']); $i++) {
			
			//  $product_lot_id = mysqli_real_escape_string($con,$_POST['product_lot_id'][$i]);
			  $Product_ID = mysqli_real_escape_string($con,$_POST['Product_ID'][$i]);
			  
	          $QTY = mysqli_real_escape_string($con,$_POST['QTY'][$i]);
			  $QTY = filter_var($QTY,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
		      $Price = mysqli_real_escape_string($con,$_POST['Price'][$i]);
			  $Price = filter_var($Price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			  $total = $QTY * $Price;
	          $qty_limit = mysqli_real_escape_string($con,$_POST['qty_limit'][$i]);
			  $qty_limit = filter_var($qty_limit, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		  
		if($QTY>$qty_limit){ $QTY=$qty_limit; 
		$msg2=$_SESSION['smg']="<div class='alert alert-success'><strong>ຈຳການຈ່າຍບາງລາຍການເກີນຈຳນວນໃນສາງ!</strong></div>"; 
		}	

		
		$sql=mysqli_query($con,"INSERT INTO quotation_transfer (transfer_id,transfer_date,stock_id,product_id,qty,price,status) 
		values('$transfer_id','$transfer_date','$stock_id','$Product_ID','$QTY','$Price','1') ");	
		

		  
		 

  
}
   
			unset($_SESSION['cart_quotation_trnasfer_mini_stock']);
			
if($sql){
		
		if(isset($_SESSION['smg'])){    }
		else{
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		}
	//	header("location:transfer_mini_stock.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	//	header("location:transfer_mini_stock.php");
	}
			
					
   header('location:add_quotation_transfer_mini_stock.php');
     mysql_close();
	 
}
if(isset($_POST['update'])){
	
	$sql_del=mysqli_query($con,"delete from quotation_transfer where transfer_id='$transfer_id'");
	
for ($i = 0; $i < count($_POST['Product_ID']); $i++) {
			
			//  $product_lot_id = mysqli_real_escape_string($con,$_POST['product_lot_id'][$i]);
			  $Product_ID = mysqli_real_escape_string($con,$_POST['Product_ID'][$i]);
			  
	          $QTY = mysqli_real_escape_string($con,$_POST['QTY'][$i]);
			  $QTY = filter_var($QTY,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			  	
		      $Price = mysqli_real_escape_string($con,$_POST['Price'][$i]);
			  $Price = filter_var($Price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			  $total = $QTY * $Price;
	          $qty_limit = mysqli_real_escape_string($con,$_POST['qty_limit'][$i]);
			  $qty_limit = filter_var($qty_limit, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		  
		if($QTY>$qty_limit){ $QTY=$qty_limit; 
		$msg2=$_SESSION['smg']="<div class='alert alert-success'><strong>ຈຳການຈ່າຍບາງລາຍການເກີນຈຳນວນໃນສາງ!</strong></div>"; 
		}	

		
		$sql=mysqli_query($con,"INSERT INTO quotation_transfer (transfer_id,transfer_date,stock_id,product_id,qty,price,status) 
		values('$transfer_id','$transfer_date','$stock_id','$Product_ID','$QTY','$Price','1') ");	
		

		  
		 

  
}
   
			unset($_SESSION['cart_quotation_trnasfer_mini_stock']);
			
if($sql){
		
		if(isset($_SESSION['smg'])){    }
		else{
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		}
	//	header("location:transfer_mini_stock.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	//	header("location:transfer_mini_stock.php");
	}
			
					
   header('location:add_quotation_transfer_mini_stock.php');
     mysql_close();

}else{ header('location:add_quotation_transfer_mini_stock.php'); mysql_close(); }

?>
</html>

 
