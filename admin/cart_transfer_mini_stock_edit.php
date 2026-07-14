<?php 
include("init.php");


      @$transfer_id= mysqli_real_escape_string($con,$_GET['transfer_id']);	
	  
	
	   
	 $sql_q=mysqli_query($con," select transfer.qty,transfer.product_id
     ,stock_product.qty as st_qty,stock_product.product_id
	  from transfer 
	  left join stock_product on stock_product.stockin_id=transfer.transfer_id 
    and stock_product.product_id=transfer.product_id
	  
	 where transfer.transfer_id='$transfer_id'  ");	 
	while($p=mysqli_fetch_array($sql_q)){
		
	
	      $check_tt+=$p['qty']-$p['st_qty'];
			
			
	   }
		
	
	  
 
 
 	  	 
if($check_tt>1){
	
	    if(isset($_SESSION['smg'])){  unset($_SESSION['smg']); 
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສາມາດແກ້ໄຂໄດ້ ເພາະມີການເຄື່ອນໄຫວແລ້ວ!</strong></div>";
		header("location:transfer_mini_stock_list.php?a=add");
		 }
		else{
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສາມາດແກ້ໄຂໄດ້ ເພາະມີການເຄື່ອນໄຫວຈຳນວນແລ້ວ!</strong></div>";
		header("location:transfer_mini_stock_list.php?a=add");
		}
	}
else{
	
	
	
	
	
if(isset($_GET['transfer_id'])){	
	  
		if(isset($_SESSION["cart_edit_transfer_mini_stock"]))
		{
			unset($_SESSION["cart_edit_transfer_mini_stock"]);
			
			unset($_SESSION["transfer_id"]);
		    unset($_SESSION["transfer_date"]);
		    unset($_SESSION["refer_no"]);
		    unset($_SESSION["f_stock_id"]);
		    unset($_SESSION["t_stock_id"]);
			
			
		}
		
					$sql_pl=mysqli_query($con,"      
					
					   select transfer.*,products.Product_Name,stock_products.price 
					,stock_products.qty as qty_limit,sum(transfer.qty) as t_qty
      from  transfer
      
					left join products on products.Product_ID=transfer.product_id
          
				
             
          LEFT JOIN (select sum(qty) as qty ,product_id,price from  stock_product 
		          where 1=1  group by product_id) as stock_products 
      
		             on products.Product_ID=stock_products.product_id
     
         
                      
					 where  transfer_id='$transfer_id'  group by  transfer.product_id order by transfer.Id ");
 
 if($num=mysqli_num_rows($sql_pl)>0){
 
		  while($p = mysqli_fetch_array($sql_pl)){

		$_SESSION["transfer_id"]=$p['transfer_id'];
		$_SESSION["transfer_date"]=$p['transfer_date'];
		$_SESSION["refer_no"]=$p['refer_no'];
		$_SESSION["f_stock_id"]=$p['f_stock_id'];
		$_SESSION["t_stock_id"]=$p['t_stock_id'];
		
	
		
		
       	$item_array = array(
				
				'product_name'       =>     $p['Product_Name'],			 
				'Product_ID'         =>     $p['product_id'],
				'product_lot_id'     =>     $p['product_lot_id'],
				'product_price'      =>     $p['price'],
				'qty_limit'          =>     $p['qty_limit'],
				
				'product_quantity'   =>     $p['t_qty']
				
			);
			$_SESSION["cart_edit_transfer_mini_stock"][] = $item_array;
      }
    
	header("location:transfer_mini_stock_edit.php?a=add");
            
   }
			
			  
}
else{ header("location:edit_stockin.php?a=error"); }
}