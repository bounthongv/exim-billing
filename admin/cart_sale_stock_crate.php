<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")	
	{
		/// start 
		if(isset($_SESSION["cart_sale_stock_crate"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_sale_stock_crate"] as $keys => $values)
			{   
			
				if($_SESSION["cart_sale_stock_crate"][$keys]['Product_ID'] == $_POST["Product_ID"])
				{
										
					$is_available++;
					if($_SESSION["cart_sale_stock_crate"][$keys]['product_quantity'] == $_POST["qty_limit"])
					{  }
					else{
					
					$_SESSION["cart_sale_stock_crate"][$keys]['product_quantity'] = $_SESSION["cart_sale_stock_crate"][$keys]['product_quantity'] +                      $_POST["product_quantity"];	
					
					$_SESSION["cart_sale_stock_crate"][$keys]['product_price'] =   $_POST["product_price"];								 
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
					'status'                   =>     '', 
					'dis_per'                  =>     '0',
				    'dis_amount'               =>     '0',    					
					'product_quantity'         =>     $_POST["product_quantity"]
					);
						$_SESSION["cart_sale_stock_crate"][] = $item_array;
				
			    	}
					
	  } // end isset  session cart
	else
		{
			
			$item_array = array(
			    
				'Product_ID'               =>     $_POST["Product_ID"],  
				'product_name'             =>     $_POST["product_name"],  
				'product_price'            =>     $_POST["product_price"], 
				'qty_limit'                =>     $_POST["qty_limit"],
				'status'                   =>     '', 
				'dis_per'                  =>     '0',
				'dis_amount'               =>    '0',    
				'product_quantity'         =>     $_POST["product_quantity"]
			);
			$_SESSION["cart_sale_stock_crate"][] = $item_array;
			
			
		}
		
	}/// end  action = add

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_sale_stock_crate"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_sale_stock_crate"][$keys]);
			}
		}
	}
	
	
	if($_POST["action"] == 'update_x1')
	{
		foreach($_SESSION["cart_sale_stock_crate"] as $keys => $values)
		{
      if($values["Product_ID"] == $_POST["Product_ID"]  )
			{

			$qty = filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$_SESSION["cart_sale_stock_crate"][$keys]['product_quantity']=$qty;
			
			$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);		
			$_SESSION["cart_sale_stock_crate"][$keys]['product_price']=$price;
			
			$dis_per = filter_var($_POST["dis_per"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$_SESSION["cart_sale_stock_crate"][$keys]['dis_per']=$dis_per;	
			
			$dis_amount=($dis_per*($qty*$price)/100);
			//$dis_amount = filter_var($_POST["dis_amount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$_SESSION["cart_sale_stock_crate"][$keys]['dis_amount']=$dis_amount;
			
			$_SESSION["cart_sale_stock_crate"][$keys]['status']=$_POST["status"];
				
			}
		}
	}
		if($_POST["action"] == 'update_x2')
	{
		foreach($_SESSION["cart_sale_stock_crate"] as $keys => $values)
		{
      if($values["Product_ID"] == $_POST["Product_ID"]  )
			{

			$qty = filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$_SESSION["cart_sale_stock_crate"][$keys]['product_quantity']=$qty;
			
			$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);		
			$_SESSION["cart_sale_stock_crate"][$keys]['product_price']=$price;
			
			
			
			
			$dis_amount = filter_var($_POST["dis_amount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$_SESSION["cart_sale_stock_crate"][$keys]['dis_amount']=$dis_amount;
			
			 $dis_per=$dis_amount/($qty*$price)*100;
			$_SESSION["cart_sale_stock_crate"][$keys]['dis_per']=$dis_per;	
			
			
			
			$_SESSION["cart_sale_stock_crate"][$keys]['status']=$_POST["status"];
			
				
			}
		}
	}
	
	if($_POST["action"] == 'update')
	{
		foreach($_SESSION["cart_sale_stock_crate"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			//	unset($_SESSION["cart_product_receipt"][$keys]);
			if($_POST["product_quantity"]>$_SESSION["cart_sale_stock_crate"][$keys]['product_quantity'])
			{
				$_SESSION["cart_sale_stock_crate"][$keys]['product_quantity']=$_SESSION["cart_sale_stock_crate"][$keys]['qty_limit'];
				$_SESSION["cart_sale_stock_crate"][$keys]['product_price']=$_POST["product_price"];
				}
				else{
			$_SESSION["cart_sale_stock_crate"][$keys]['product_quantity']=$_POST["product_quantity"];			
			$_SESSION["cart_sale_stock_crate"][$keys]['product_price']=$_POST["product_price"];
				   }
			}
		}
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_sale_stock_crate"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_sale_stock_crate"]);
		unset($_SESSION["cur"]);
		unset($_SESSION["cur_name"]);
	    unset($_SESSION["customer_id"]);
		unset($_SESSION["customer_name"]);			
		unset($_SESSION["order_id"]);
		
		unset($_SESSION["all_per"]);
		unset($_SESSION["all_dis"]);
		unset($_SESSION["total"]);  
		
		
		header("location:add_sale_stock_crate.php");
	}
?>