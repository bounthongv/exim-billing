<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		/// start 
		if(isset($_SESSION["cart_trnasfer_from_mini_stock"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_trnasfer_from_mini_stock"] as $keys => $values)
			{   
			
				if($_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_lot_id'] == $_POST["product_lot_id"])
				{
										
					$is_available++;
					if($_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_quantity'] == $_POST["qty_limit"])
					{  }
					else{
					
					$_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_quantity'] = $_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_quantity'] +                      $_POST["product_quantity"];								 
					}
				}
				
			} // edn foreach
			
			
			  		 if($is_available == 0)
			  		{
						
					$item_array = array(
				    'product_lot_id'           =>     $_POST["product_lot_id"],
					'Product_ID'               =>     $_POST["Product_ID"],  
					'product_name'             =>     $_POST["product_name"],  
					'product_price'            =>     $_POST["product_price"],
					'qty_limit'                =>     $_POST["qty_limit"],  					
					'product_quantity'         =>     $_POST["product_quantity"]
					);
						$_SESSION["cart_trnasfer_from_mini_stock"][] = $item_array;
				echo 2;
			    	}
					
	  } // end isset  session cart
	else
		{
		
			$item_array = array(
			    'product_lot_id'           =>     $_POST["product_lot_id"],
				'Product_ID'               =>     $_POST["Product_ID"],  
				'product_name'             =>     $_POST["product_name"],  
				'product_price'            =>     $_POST["product_price"], 
				'qty_limit'                =>     $_POST["qty_limit"],  
				'product_quantity'         =>     $_POST["product_quantity"]
			);
			$_SESSION["cart_trnasfer_from_mini_stock"][] = $item_array;
			
			
			
		}
		
	}/// end  action = add

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_trnasfer_from_mini_stock"] as $keys => $values)
		{
			if($values["product_lot_id"] == $_POST["product_lot_id"])
			{
				unset($_SESSION["cart_trnasfer_from_mini_stock"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'update')
	{
		foreach($_SESSION["cart_trnasfer_from_mini_stock"] as $keys => $values)
		{
			if($values["product_lot_id"] == $_POST["product_lot_id"])
			{
			//	unset($_SESSION["cart_product_receipt"][$keys]);
			if($_POST["product_quantity"]>$_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_quantity'])
			{
				$_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_quantity']=$_SESSION["cart_trnasfer_from_mini_stock"][$keys]['qty_limit'];
				$_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_price']=$_POST["product_price"];
				}
				else{
			$_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_quantity']=$_POST["product_quantity"];			
			$_SESSION["cart_trnasfer_from_mini_stock"][$keys]['product_price']=$_POST["product_price"];
				   }
			}
		}
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_trnasfer_from_mini_stock"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_trnasfer_from_mini_stock"]);
		header("location:transfer_from_mini_stock.php");
	}
?>
