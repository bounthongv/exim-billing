<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{/// start

	
	for ($i = 0; $i < count($_POST['check_box']); $i++) {	
	
	
			
			 $product_lot_id = $_POST['check_box'][$i];
			 $Product_ID = $_POST['Product_ID'][$i];
	
		 
		if(isset($_SESSION["cart_trnasfer_from_mini_stock"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_trnasfer_from_mini_stock"] as $keys => $values)
			{   
			
				if($_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_lot_id'] == $product_lot_id)
				{
										
					$is_available++;
					if($_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_quantity']== $_POST["qty_limit"][$i])
					{  }
					else{
					
			$_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_quantity'] = $_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_quantity'] +                      $_POST["product_quantity"][$i];	
							header("location:transfer_from_mini_stock.php?3");				 
					}
				}
				
			} // edn foreach
			
			
			  		 if($is_available == 0)
			  		{
					$item_array = array(
				    'product_lot_id'           =>     $product_lot_id,
					'Product_ID'               =>     $_POST["Product_ID"][$i],  
					'product_name'             =>     $_POST["product_name"][$i],  
					'product_price'            =>     $_POST["product_price"][$i],
					'qty_limit'                =>     $_POST["qty_limit"][$i],  					
					'product_quantity'         =>     $_POST["product_quantity"][$i]
					);
						$_SESSION["cart_trnasfer_from_mini_stock"][] = $item_array;
						header("location:transfer_from_mini_stock.php?2");
				
			    	}
					
	  } // end isset  session cart
	else
		{
			
			$item_array = array(
			    'product_lot_id'           =>     $product_lot_id,
				'Product_ID'               =>     $_POST["Product_ID"][$i],  
				'product_name'             =>     $_POST["product_name"][$i],  
				'product_price'            =>     $_POST["product_price"][$i], 
				'qty_limit'                =>     $_POST["qty_limit"][$i],  
				'product_quantity'         =>     $_POST["product_quantity"][$i]
			);
			$_SESSION["cart_trnasfer_from_mini_stock"][] = $item_array;
			header("location:transfer_from_mini_stock.php?1");
		}
		
	
		
	}//end for
	
	
		
	}/// end  action = add

}
if($_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_trnasfer_from_mini_stock"]);
		header("location:transfer_from_mini_stock.php");
	}
?>
