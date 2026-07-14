<?php

//action.php
include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		/// start 
		if(isset($_SESSION["cart_pre_order"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_pre_order"] as $keys => $values)
			{   
			
				if($_SESSION["cart_pre_order"][$keys]['Product_ID'] == $_POST["Product_ID"])
				{
										
					$is_available++;
					
				
					
					$_SESSION["cart_pre_order"][$keys]['product_quantity'] = $_SESSION["cart_pre_order"][$keys]['product_quantity'] +                      $_POST["product_quantity"];	
					
					$_SESSION["cart_pre_order"][$keys]['product_price'] =   $_POST["product_price"];								 
					
				}
				
			} // edn foreach
			
			
			  		 if($is_available == 0)
			  		{
					$item_array = array(
				    
					'Product_ID'               =>     $_POST["Product_ID"],  
					'product_name'             =>     $_POST["product_name"],  
					'product_price'            =>     $_POST["product_price"],					
					'product_quantity'         =>     $_POST["product_quantity"]
					);
						$_SESSION["cart_pre_order"][] = $item_array;
				
			    	}
					
	  } // end isset  session cart
	else
		{
			
			$item_array = array(
			    
				'Product_ID'               =>     $_POST["Product_ID"],  
				'product_name'             =>     $_POST["product_name"],  
				'product_price'            =>     $_POST["product_price"], 				
				'product_quantity'         =>     $_POST["product_quantity"]
			);
			$_SESSION["cart_pre_order"][] = $item_array;
			
			
		}
		
	}/// end  action = add

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_pre_order"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_pre_order"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'update')
	{
		foreach($_SESSION["cart_pre_order"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			//	unset($_SESSION["cart_product_receipt"][$keys]);
			if($_POST["product_quantity"]>$_SESSION["cart_pre_order"][$keys]['product_quantity'])
			{
				$_SESSION["cart_pre_order"][$keys]['product_quantity']=$_SESSION["cart_pre_order"][$keys]['qty_limit'];
				$_SESSION["cart_pre_order"][$keys]['product_price']=$_POST["product_price"];
				}
				else{
			$_SESSION["cart_pre_order"][$keys]['product_quantity']=$_POST["product_quantity"];			
			$_SESSION["cart_pre_order"][$keys]['product_price']=$_POST["product_price"];
				   }
			}
		}
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_pre_order"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_pre_order"]);
		unset($_SESSION["cur"]);
		unset($_SESSION["cur_name"]);
		header("location:add_pre_order.php");
	}
?>