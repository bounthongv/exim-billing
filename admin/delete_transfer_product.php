<?php 
include("init.php");



$transfer_id=mysqli_real_escape_string($con,$_GET['transfer_id']);
//$product_id=mysqli_real_escape_string($con,$_GET['product_id']);


if(isset($_GET['transfer_id'])){
	
	
	
	
	
	 $transfer_id = mysqli_real_escape_string($con,$_GET['transfer_id']);
	 
	 if(isset($_SESSION["transfer_delete_array"]))
		{
			unset($_SESSION["transfer_delete_array"]);
		}
	   
	   
	   
	   
	   
	 $sql_q=mysqli_query($con,"select *  from transfer where transfer_id='$transfer_id' ");	 
	while($p=mysqli_fetch_array($sql_q)){
		
	
		
			$item_array = array(
			    'stockin_id'               =>     $p['stockin_id'],
				'f_stock_id'               =>     $p['f_stock_id'],  
				't_stock_id'               =>     $p['t_stock_id'],  
				'product_lot_id'          =>     $p['product_lot_id'],  				
				'qty'                      =>     $p['qty']
			);
			
			$_SESSION["transfer_delete_array"][] = $item_array;
	
		}
		
		
		
		
		
		
	foreach($_SESSION["transfer_delete_array"] as $keys => $values)
	{
		      $stockin_id = $values["stockin_id"]; 
		     $f_stock_id = $values["f_stock_id"]; 
		     $t_stock_id = $values["t_stock_id"];
      	 $product_lot_id = $values["product_lot_id"];
	             $qty = $values["qty"];
			
	
	
		 
 $sql_up1=mysqli_query($con," update stock_product set qty=qty+$qty where product_lot_id='$product_lot_id' 
 and stock_id='$f_stock_id' and stockin_id='$stockin_id'  ");
 
/*  $sql_up=mysqli_query($con," update stock_product set qty=qty-$qty where product_lot_id='$product_lot_id' and stock_id='$t_stock_id' 
 and stockin_id='$transfer_id'  ");
*/


	}
	
	

	
	
	  $sql=mysqli_query($con,"delete from stock_product where stockin_id='$transfer_id'");
	  $sql=mysqli_query($con,"delete from transfer where transfer_id='$transfer_id'");
		
		unset($_SESSION["transfer_delete_array"]);
		

	
	     if($sql){		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:transfer_mini_stock_list.php");
			     }
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong> </div>";
		header("location:transfer_mini_stock_list.php");
                 }
	        }
	header("location:transfer_mini_stock_list.php");
?>