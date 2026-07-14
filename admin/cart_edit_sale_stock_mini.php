<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		/// start 
		if(isset($_SESSION["cart_edit_sale_stock_mini"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_edit_sale_stock_mini"] as $keys => $values)
			{   
			
				if($_SESSION["cart_edit_sale_stock_mini"][$keys]['Product_ID'] == $_POST["Product_ID"])
				{
										
					$is_available++;
					if($_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity'] == $_POST["qty_limit"])
					{  }
					else{
					
					$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity'] = $_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity'] +                      $_POST["product_quantity"];	
					
					$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_price'] =   $_POST["product_price"];								 
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
						$_SESSION["cart_edit_sale_stock_mini"][] = $item_array;
				
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
			$_SESSION["cart_edit_sale_stock_mini"][] = $item_array;
			
			
		}
		
	}/// end  action = add

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_edit_sale_stock_mini"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_edit_sale_stock_mini"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'update')
	{
		foreach($_SESSION["cart_edit_sale_stock_mini"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			//	unset($_SESSION["cart_product_receipt"][$keys]);
			if($_POST["product_quantity"]>$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity'])
			{
				$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']=$_SESSION["cart_edit_sale_stock_mini"][$keys]['qty_limit'];
				$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_price']=$_POST["product_price"];
				}
				else{
			$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']=$_POST["product_quantity"];			
			$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_price']=$_POST["product_price"];
				   }
			}
		}
	}
	if($_POST["action"] == 'update_x1')
	{
		foreach($_SESSION["cart_edit_sale_stock_mini"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			
			if($_POST["qty"]>$_SESSION["cart_edit_sale_stock_mini"][$keys]['qty_limit'])
			{
				//$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']=$_SESSION["cart_edit_sale_stock_mini"][$keys]['qty_limit'];
				$qty = filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			    $_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']=$qty;
			
				$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
				$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_price']=$price;
				}
				else{
			$qty = filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']=$qty;	
			
			$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);			
			$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_price']=$price;
				   }
			}
		}
	}
	if($_POST["action"] == 'make_cart')
	{
		//
		if(isset($_SESSION["cart_edit_sale_stock_mini"]))
		{   		
		unset($_SESSION["cart_edit_sale_stock_mini"]);
		}
		
		
		$stock_id=$_SESSION["stock_id"]; 
	 
	     @$price_type= mysqli_real_escape_string($con,$_POST['price_type']);		     
		  if($price_type==''){$pp=",products.s3_price as sale_price ";}  
		  elseif($price_type=='001'){ $pp=",products.s1_price  as sale_price";}
		  elseif($price_type=='002'){ $pp=",products.s2_price  as sale_price";}
		  elseif($price_type=='003'){ $pp=",products.s3_price  as sale_price";}
	 
       

           $sql_d=mysqli_query($con,"SELECT products.* $pp,tb_stock_product.stock_qty
		             
		     FROM  products
        left join (select sum(qty) as stock_qty,product_id from stock_product where stock_id='$stock_id' group by product_id ) as tb_stock_product
  on products.Product_ID=tb_stock_product.product_id
              where    1=1 and products.Group_ID='001'  order by products.Product_ID   ");
		   $ch=mysqli_num_rows($sql_d);
		if($ch>0){
		   while($f=mysqli_fetch_array($sql_d)){
	       
		   
		   $remark=$f["crate_price"];
	       $item_array = array(
			    
				'Product_ID'               =>     $f["Product_ID"],  
				'product_name'             =>     $f["Product_Name"],  
				'product_price'            =>     $f["sale_price"],
				'units'                    =>     $f["Unit"], 
				'qty_limit'                =>     $f["stock_qty"], 
				'pic'                      =>     $f["pic_url"],  
				'crate_price'                =>     $f["crate_price"],
				'remark'                    =>     $remark, 
				'product_quantity'         =>     '0'
			);
			$_SESSION["cart_edit_sale_stock_mini"][] = $item_array;
    
	 
		   }
		}
	}
	if($_POST["action"] == 'update_plus')
	{
		foreach($_SESSION["cart_edit_sale_stock_mini"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			
			
			$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']=$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']+1;
			/*if($_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']+1>$_SESSION["cart_edit_sale_stock_mini"][$keys]['qty_limit'])
			{
				$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']=$_SESSION["cart_edit_sale_stock_mini"][$keys]['qty_limit'];
				
				
				}
				else{
		
			$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']=$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']+1;
		
				   }*/
			}
		}
	}
	if($_POST["action"] == 'update_minus')
	{
		foreach($_SESSION["cart_edit_sale_stock_mini"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			
			if($_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']-1<1)
			{
				$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']=1;
				
				
				}
				else{
		
			$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']=$_SESSION["cart_edit_sale_stock_mini"][$keys]['product_quantity']-1;
		
				   }
			}
		}
	}
	
	
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_edit_sale_stock_mini"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_edit_sale_stock_mini"]);
		unset($_SESSION["cur"]);
		unset($_SESSION["cur_name"]);
		header("location:add_sale_stock_mini.php");
	}
?>
