<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		/// start 
		if(isset($_SESSION["cart_sale_stock"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_sale_stock"] as $keys => $values)
			{   
			
				if($_SESSION["cart_sale_stock"][$keys]['Product_ID'] == $_POST["Product_ID"])
				{
										
					$is_available++;
					if($_SESSION["cart_sale_stock"][$keys]['product_quantity'] == $_POST["qty_limit"])
					{  }
					else{
					
					$_SESSION["cart_sale_stock"][$keys]['product_quantity'] = $_SESSION["cart_sale_stock"][$keys]['product_quantity'] +                      $_POST["product_quantity"];	
					
					$_SESSION["cart_sale_stock"][$keys]['product_price'] =   $_POST["product_price"];								 
					}
				}
				
			} // edn foreach
			
			
			  		 if($is_available == 0)
			  		{
					$item_array = array(
				    
					'Product_ID'               =>     $_POST["Product_ID"],  
					'product_name'             =>     $_POST["product_name"],  
					'product_price'            =>     $_POST["product_price"],
					'qty_limit'                =>     $_POST["qty_limit"],  					
					'product_quantity'         =>     $_POST["product_quantity"]
					);
						$_SESSION["cart_sale_stock"][] = $item_array;
				
			    	}
					
	  } // end isset  session cart
	else
		{
			
			$item_array = array(
			    
				'Product_ID'               =>     $_POST["Product_ID"],  
				'product_name'             =>     $_POST["product_name"],  
				'product_price'            =>     $_POST["product_price"], 
				'qty_limit'                =>     $_POST["qty_limit"],  
				'product_quantity'         =>     $_POST["product_quantity"]
			);
			$_SESSION["cart_sale_stock"][] = $item_array;
			
			
		}
		
	}/// end  action = add

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_sale_stock"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_sale_stock"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'update')
	{
		foreach($_SESSION["cart_sale_stock"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			//	unset($_SESSION["cart_product_receipt"][$keys]);
			if($_POST["product_quantity"]>$_SESSION["cart_sale_stock"][$keys]['product_quantity'])
			{
				$_SESSION["cart_sale_stock"][$keys]['product_quantity']=$_SESSION["cart_sale_stock"][$keys]['qty_limit'];
				$_SESSION["cart_sale_stock"][$keys]['product_price']=$_POST["product_price"];
				}
				else{
			$_SESSION["cart_sale_stock"][$keys]['product_quantity']=$_POST["product_quantity"];			
			$_SESSION["cart_sale_stock"][$keys]['product_price']=$_POST["product_price"];
				   }
			}
		}
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_sale_stock"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_sale_stock"]);
		unset($_SESSION["cur"]);
		unset($_SESSION["cur_name"]);
		 unset($_SESSION["customer_id"]);
			unset($_SESSION["customer_name"]);			
			unset($_SESSION["order_id"]);  
		header("location:add_sale_stock.php");
	}
?>
