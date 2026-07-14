<?php 
include("init.php");



  $sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);
   // $stock_id=mysqli_real_escape_string($con,$_GET['stock_id']);
  


     if(isset($_GET['sale_id'])){
	

	 $sale_id = mysqli_real_escape_string($con,$_GET['sale_id']);
	 
	 if(isset($_SESSION["sale_delete_array"]))
		{
			unset($_SESSION["sale_delete_array"]);
		}
	   
	 $sql_q=mysqli_query($con,"select product_sale.*,products.Group_ID
	   from product_sale
	 left join products on product_sale.product_id=products.product_id
	 
	  where product_sale.sale_id='$sale_id' ");	 
	while($p=mysqli_fetch_array($sql_q)){
		
	$p['product_lot_id'];
	
	
	 $sql=mysqli_query($con,"update product_customer_order set status_sale='1' where sale_id='".$p['order_id']."'");
		
			$item_array = array(
			
			  'stockin_id'               =>     $p['stockin_id'], 
				'stock_id'               =>     $p['stock_id'], 				
				'product_lot_id'          =>     $p['product_lot_id'], 
				'Group_ID'          =>     $p['Group_ID'],  				
				'qty'                      =>     $p['qty']
			);
			
			$_SESSION["sale_delete_array"][] = $item_array;
	
		}
		
	foreach($_SESSION["sale_delete_array"] as $keys => $values)
	{
		   $stockin_id = $values["stockin_id"];
		     $stock_id = $values["stock_id"]; 		     
	  	  $product_lot_id = $values["product_lot_id"];
		          $qty = $values["qty"];
		  if($values["Group_ID"]=='001'){
 $sql_up=mysqli_query($con," update stock_product set qty=qty+$qty where product_lot_id='$product_lot_id'
          and stock_id='$stock_id'  and stockin_id='$stockin_id' ");
		  }else{}


	}
	
        $sql_del=mysqli_query($con,"delete from product_sale where sale_id='$sale_id'");
		$sql=mysqli_query($con,"delete from customer_payment where sale_id='$sale_id'");
	   
	
		
		unset($_SESSION["sale_delete_array"]);
		

	
	     if($sql_del){		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:sale_list.php");
			     }
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong> </div>";
		header("location:sale_list.php");
                 }
	        }
	header("location:sale_list.php");
?>