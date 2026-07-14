<?php 
include("init.php");


 @$transfer_id= mysqli_real_escape_string($con,$_GET['transfer_id']);		   
	
if(isset($_GET['transfer_id'])){	
	  
		if(isset($_SESSION["cart_quotation_trnasfer_mini_stock"]))
		{
			unset($_SESSION["cart_quotation_trnasfer_mini_stock"]);
			
			unset($_SESSION["transfer_id"]);
		    unset($_SESSION["transfer_date"]);
		  //  unset($_SESSION["refer_no"]);
		 //   unset($_SESSION["f_stock_id"]);
		    unset($_SESSION["stock_id"]);
		}
		
					$sql_pl=mysqli_query($con,"   SELECT quotation_transfer.*,quotation_transfer.qty as q_qty,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,groups.Group_Name,products.version
		   FROM  quotation_transfer 
		   left join products on products.Product_ID=quotation_transfer.product_id
       left join stocks on stocks.stock_id=quotation_transfer.stock_id	
       left join groups on groups.Group_ID=products.group_id
       
       
       where      quotation_transfer.qty>0   and quotation_transfer.transfer_id='$transfer_id'
	   order by quotation_transfer.product_id  ");
 
 if($num=mysqli_num_rows($sql_pl)>0){
 
		  while($p = mysqli_fetch_array($sql_pl)){

		$_SESSION["transfer_id"]=$p['transfer_id'];
		$_SESSION["transfer_date"]=$p['transfer_date'];
	//	$_SESSION["refer_no"]=$p['refer_no'];
	//	$_SESSION["f_stock_id"]=$p['f_stock_id'];
		$_SESSION["t_stock_id"]=$p['stock_id'];
		$_SESSION["t_stock_name"]=$p['stock_name'];
		
		
       	$item_array = array(
				
				'product_name'       =>     $p['Product_Name'],			 
				'Product_ID'         =>     $p['product_id'],
		//		'product_lot_id'     =>     $p['product_lot_id'],
				'product_price'      =>     $p['price'],
	     		'qty_limit'          =>     '1000',
				'product_quantity'   =>     $p['qty']
				
			);
			$_SESSION["cart_quotation_trnasfer_mini_stock"][] = $item_array;
      }
    
	header("location:add_quotation_transfer_mini_stock_edit.php?a=add");
            
   }
			
			  
}
else{ header("location:add_quotation_transfer_mini_stock_edit.php?a=error"); }
