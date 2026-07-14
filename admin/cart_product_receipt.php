<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		/// start 
		if(isset($_SESSION["cart_product_receipt"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_product_receipt"] as $keys => $values)
			{
				if($_SESSION["cart_product_receipt"][$keys]['Product_ID'] == $_POST["Product_ID"])
				{
					$is_available++;
					$_SESSION["cart_product_receipt"][$keys]['product_quantity'] = $_SESSION["cart_product_receipt"][$keys]['product_quantity'] + $_POST["product_quantity"];
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
				$_SESSION["cart_product_receipt"][] = $item_array;
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
			$_SESSION["cart_product_receipt"][] = $item_array;
		}
		/// end 
	}

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_product_receipt"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_product_receipt"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'update_key_enter')
	{
		foreach($_SESSION["cart_product_receipt"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
				
			$qty = filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$_SESSION["cart_product_receipt"][$keys]['qty']=$qty;
			
			$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$_SESSION["cart_product_receipt"][$keys]['s1_price']=$price;
			
			$_SESSION["cart_product_receipt"][$keys]['remark']=$_POST["remark"];
			}
		}
	}
	if($_POST["action"] == 'make_cart')
	{
		
		if(isset($_SESSION["cart_product_receipt"])){  	unset($_SESSION["cart_product_receipt"]);		}
		
		
		
		$sql_d=mysqli_query($con,"SELECT products.*  FROM  products
       
              where    1=1 and products.Group_ID='001'  order by products.Product_ID asc   ");
		   $ch=mysqli_num_rows($sql_d);
		if($ch>0){
		   while($f=mysqli_fetch_array($sql_d)){
	        $cp=@number_format($f['crate_price'],0);
	       $item_array = array(
			    
				'Product_ID'               =>     $f["Product_ID"],  
				'product_name'             =>     $f["Product_Name"],  
				's1_price'                 =>     $f["s1_price"],
				'crate_price'              =>     $f["crate_price"],
				'units'                    =>     $f["Unit"],
				'barcode'                    =>     $f["Bar_Code"], 
				
				'pic'                      =>     $f["pic"],
				'pic_url'                  =>     $f["pic_url"], 
				'remark'                  =>      $cp,
				'qty'                      =>     '0'
			);
			$_SESSION["cart_product_receipt"][] = $item_array;
    
	 
		   }
		 }
		
		
		
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_product_receipt"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_product_receipt"]);
		header("location:product_receipt.php");
	}

?>
