<?php 
include("init.php");



$receipt_id=mysqli_real_escape_string($con,$_GET['receipt_id']);
//$product_id=mysqli_real_escape_string($con,$_GET['product_id']);


if(isset($_GET['receipt_id'])){
	
	
	
	
	
	
	 
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
	echo	 $product_lot_id = $values["product_lot_id"];
		            $qty = $values["qty"];
		 
 //$sql_up=mysqli_query($con," update stock_product set qty=qty+$qty where product_lot_id='$product_lot_id' and stock_id='$stock_id'  ");
 //$sql_up=mysqli_query($con," update stock_product set qty=qty-$qty where product_lot_id='$product_lot_id' ");



	}
	
	  $sql=mysqli_query($con,"delete from product_receipt_crate where receipt_id='$receipt_id'");
	  $sql=mysqli_query($con,"delete from stock_product where stockin_id='$receipt_id'");
	//  $sql=mysqli_query($con,"delete from transfer where transfer_id='$transfer_id'");
		
		unset($_SESSION["sale_delete_array"]);
		

	
	     if($sql_up){		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:receipt_crate_list.php");
			     }
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong> </div>";
		header("location:receipt_crate_list.php");
                 }
	        }
	header("location:receipt_crate_list.php");
?>