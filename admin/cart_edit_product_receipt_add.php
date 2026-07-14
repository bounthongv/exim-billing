<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		/// start 
		if(isset($_SESSION["cart_edit_product_receipt"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_edit_product_receipt"] as $keys => $values)
			{
				if($_SESSION["cart_edit_product_receipt"][$keys]['Product_ID'] == $_POST["Product_ID"])
				{
					$is_available++;
					$_SESSION["cart_edit_product_receipt"][$keys]['product_quantity'] = $_SESSION["cart_edit_product_receipt"][$keys]['product_quantity'] + $_POST["product_quantity"];
				}
			}
			if($is_available == 0)
			{
				$item_array = array(
					'Product_ID'               =>     $_POST["Product_ID"],  
					'product_name'             =>     $_POST["product_name"],  
					'product_price'            =>     $_POST["product_price"],  
					'product_quantity'         =>     $_POST["product_quantity"]
				);
				$_SESSION["cart_edit_product_receipt"][] = $item_array;
			}
		}
		else
		{
			$item_array = array(
				'Product_ID'               =>     $_POST["Product_ID"],  
				'product_name'             =>     $_POST["product_name"],  
				'product_price'            =>     $_POST["product_price"],  
				'product_quantity'         =>     $_POST["product_quantity"]
			);
			$_SESSION["cart_edit_product_receipt"][] = $item_array;
		}
		/// end 
	}

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_edit_product_receipt"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_edit_product_receipt"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'update')
	{
		foreach($_SESSION["cart_edit_product_receipt"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			//	unset($_SESSION["cart_edit_product_receipt"][$keys]);
			$_SESSION["cart_edit_product_receipt"][$keys]['product_quantity']=$_POST["product_quantity"];
			$_SESSION["cart_edit_product_receipt"][$keys]['product_price']=$_POST["product_price"];
			}
		}
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_edit_product_receipt"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_edit_product_receipt"]);
		header("location:product_receipt_list.php");
	}

?>
