<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php


       $transfer_id = mysqli_real_escape_string($con,$_POST['transfer_id']);
     $transfer_date = mysqli_real_escape_string($con,$_POST['transfer_date']);
          $refer_no = mysqli_real_escape_string($con,$_POST['refer_no']);
        $f_stock_id = mysqli_real_escape_string($con,$_POST['f_stock_id']);
        $t_stock_id = mysqli_real_escape_string($con,$_POST['t_stock_id']);

         $remark = mysqli_real_escape_string($con,$_POST['remark']);
		 
		 
 
              
	 $sql_max=mysqli_query($con,"   select max(SUBSTRING(transfer_id, 2, 6)) as id from transfer");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='R0000'.'1';  
 
 $id2=$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $auto_id=$id1;     }

 else if($max_id<9){  $auto_id='R0000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $auto_id='R000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $auto_id='R00'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $auto_id='R0'.$id2;} 
  else if($max_id<99999){  $auto_id='R'. $id2;}
  
  else if($max_id >=99999){   $auto_id='R'.$id2; }
  
   $auto_id;
   
   

  
  	 $sql_q=mysqli_query($con," insert into stock_product (stockin_id,stockin_date,stock_id,product_id,product_lot_id,price
         ,sell_price,qty,supplier_id,staff_id,expert_date)
         
         select '$auto_id',stockin_date,'$f_stock_id',product_id,product_lot_id,price
         ,sell_price,qty,supplier_id,staff_id,expert_date from stock_product where stockin_id='$transfer_id' ");	
  
 
	  $sql=mysqli_query($con,"delete from stock_product where stockin_id='$transfer_id'");
	  $sql=mysqli_query($con,"delete from transfer where transfer_id='$transfer_id'");
	  
	 
		
	
		
		//end dell


$sql_max=mysqli_query($con,"   select  max(RIGHT(product_lot_id, 1)) as proid  from stock_product where stockin_date='$transfer_date' ");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 
 
 $id=$max_id+1;

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
		  $p['product_lot_id']; 
		// echo "=";
		   $p['qty'];
		//	 echo "<br>";
			$q=$p['qty']; 
			
			 if($QTY > 0)
			 {	
					 
			 $t_qty=$QTY-$q;           
			 $x_qty=$QTY-$t_qty; 	           
				
				if($QTY >$q){
					
				//	echo $x_qty;
					
			$total_1=$x_qty*$Price;
		


		

		
		$sql_up2=mysqli_query($con,"update stock_product set qty=qty-$x_qty where product_lot_id='$p[product_lot_id]' and stock_id='$f_stock_id' and Id='$p[Id]' ");	
					}
					else{
						
				//	echo $qty;
				$total_2=$QTY*$Price;
				


		

		$sql_up2=mysqli_query($con,"update stock_product set qty=qty-$QTY where product_lot_id='$p[product_lot_id]' and stock_id='$f_stock_id' and Id='$p[Id]' ");	
						}
				 $QTY=$QTY-$q;

			                }
			 
	  }  
		
}


  
   

			unset($_SESSION["cart_edit_transfer_mini_stock"]);
			
			unset($_SESSION["transfer_id"]);
		    unset($_SESSION["transfer_date"]);
		    unset($_SESSION["refer_no"]);
		    unset($_SESSION["f_stock_id"]);
		    unset($_SESSION["t_stock_id"]);
			
if($sql){
		
		if(isset($_SESSION['smg'])){    }
		else{
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		}
		header("location:transfer_mini_stock_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:transfer_mini_stock_list.php");
	}
			
					
   header('location:transfer_mini_stock_list.php');
     mysql_close();

}else{ header('location:transfer_mini_stock_list.php'); mysql_close(); }


?>
</html>

 
