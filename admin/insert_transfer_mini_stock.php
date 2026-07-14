<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
/*$sql_max=mysqli_query($con,"select IFNULL(max(SUBSTRING(receipt_id, 2, 5)),0) as id from product_receipt");
@$row_max=mysql_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='R0000'.'1';  
 
 $id2=$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $receipt_id=$id1;     }

 else if($max_id<9){  $receipt_id='R0000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $receipt_id='R000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $receipt_id='R00'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $receipt_id='R0'.$id2;} 
  else if($max_id<99999){  $receipt_id='R'. $id2;}
  
  else if($max_id >=99999){   $receipt_id='R'.$id2; }
  
   $receipt_id;*/

     $transfer_id = mysqli_real_escape_string($con,$_POST['transfer_id']);
     $transfer_date = mysqli_real_escape_string($con,$_POST['transfer_date']);
     $refer_no = mysqli_real_escape_string($con,$_POST['refer_no']);
 //    $staff_id = mysqli_real_escape_string($con,$_POST['staff_id']);  
     $f_stock_id = mysqli_real_escape_string($con,$_POST['f_stock_id']);
     $t_stock_id = mysqli_real_escape_string($con,$_POST['t_stock_id']);
	 
	 $remark = mysqli_real_escape_string($con,$_POST['remark']);

$user_id=$_SESSION['user_id'];

      
$sql_max=mysqli_query($con,"   select  max(RIGHT(product_lot_id, 1)) as proid  from stock_product where stockin_date='$transfer_date' ");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 
 
 $id=$max_id+1;

if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['Product_ID']); $i++) {
			
			
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
		
		$product_lot_id=$Product_ID.'.'.$transfer_date.'.'.$id;
		
        $sql=mysqli_query($con,"INSERT INTO stock_product (stockin_id,stockin_date,stock_id,product_id,price,qty,product_lot_id) 
		values('$transfer_id','$transfer_date','$t_stock_id','$Product_ID','$Price','$QTY','$product_lot_id') ");	
		
		$sql=mysqli_query($con,"INSERT INTO transfer (stockin_id,transfer_id,transfer_date,refer_no,f_stock_id
		,t_stock_id,product_id,product_lot_id,qty,price,remark) 
		values('$transfer_id','$transfer_id','$transfer_date','$refer_no','$f_stock_id','$t_stock_id','$Product_ID'
		,'$product_lot_id','$QTY','$Price' ,'$remark')");
		
		  
		  $sql_pl=mysqli_query($con,"
          select * from  stock_product where qty >0 and product_id='$Product_ID' and stock_id='$f_stock_id' order by product_lot_id ");
		  while( $p = mysqli_fetch_array($sql_pl))
	{
		   $p['stockin_id']; 
		   $p['product_lot_id']; 
		   $p['qty'];
			 
			$q=$p['qty']; 
			
			 if($QTY > 0)
			 {	
					 
			 $t_qty=$QTY-$q;           
			 $x_qty=$QTY-$t_qty; 	      
			 
		  
				
				if($QTY >$q){
					
				 $x_qty;
					
			$total_1=$x_qty*$Price;
		
            echo $p['stockin_id'];
		
	
	
		

		
		$sql=mysqli_query($con,"update stock_product set qty=qty-$x_qty where product_lot_id='$p[product_lot_id]'
		                         and stock_id='$f_stock_id' and Id='$p[Id]' ");	
					}
					else{
						
					 $qty;
				$total_2=$QTY*$Price;
			//	echo $QTY;
				echo $p['stockin_id'];
			
		
		
			
		
	
		$sql=mysqli_query($con,"update stock_product set qty=qty-$QTY where product_lot_id='$p[product_lot_id]' and stock_id='$f_stock_id' and Id='$p[Id]' ");	
						}
				 $QTY=$QTY-$q;

			                }
			 
	  }  
		
}

  $sql_up2=mysqli_query($con,"update quotation_transfer set status='0' where transfer_id='$refer_no' ");	
              
			  unset($_SESSION['cart_trnasfer_mini_stock']);
			  
			  unset($_SESSION["transfer_id"]);
	
		      unset($_SESSION["refer_no"]);
	
		      unset($_SESSION["t_stock_id"]);
		      unset($_SESSION["t_stock_name"]);
   
			unset($_SESSION['cart_trnasfer_mini_stock']);
			
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
			
					
   header('location:transfer_mini_stock.php');
     mysql_close();

}else{ header('location:transfer_mini_stock.php'); mysql_close(); }

?>
</html>

 
