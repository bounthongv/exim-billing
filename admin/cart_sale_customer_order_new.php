<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		/// start 
		if(isset($_SESSION["cart_sale_customer_order"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
			{   
			
				if($_SESSION["cart_sale_customer_order"][$keys]['Product_ID'] == $_POST["Product_ID"])
				{
										
					$is_available++;
					if($_SESSION["cart_sale_customer_order"][$keys]['product_quantity'] == $_POST["qty_limit"])
					{  }
					else{
					
					$_SESSION["cart_sale_customer_order"][$keys]['product_quantity'] = $_SESSION["cart_sale_customer_order"][$keys]['product_quantity'] +                      $_POST["product_quantity"];	
					
					$_SESSION["cart_sale_customer_order"][$keys]['product_price'] =   $_POST["product_price"];								 
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
					'pic'                      =>     $_POST["pic_url"], 					
					'product_quantity'         =>     $_POST["product_quantity"]
					);
						$_SESSION["cart_sale_customer_order"][] = $item_array;
				
			    	}
					
	  } // end isset  session cart
	else
		{
			
			$item_array = array(
			    
				'Product_ID'               =>     $_POST["Product_ID"],  
				'product_name'             =>     $_POST["product_name"],  
				'product_price'            =>     $_POST["product_price"], 
				'qty_limit'                =>     $_POST["qty_limit"],
				'pic'                      =>     $_POST["pic_url"],   
				'product_quantity'         =>     $_POST["product_quantity"]
			);
			$_SESSION["cart_sale_customer_order"][] = $item_array;
			
			
		}
		
	}/// end  action = add

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_sale_customer_order"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'reset')
	{
		unset($_SESSION["cart_sale_customer_order"]);
	}
	if($_POST["action"] == 'update')
	{
		foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
			//	unset($_SESSION["cart_product_receipt"][$keys]);
			if($_POST["product_quantity"]>$_SESSION["cart_sale_customer_order"][$keys]['product_quantity'])
			{
				$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$_SESSION["cart_sale_customer_order"][$keys]['qty_limit'];
				$_SESSION["cart_sale_customer_order"][$keys]['product_price']=$_POST["product_price"];
				}
				else{
			$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$_POST["product_quantity"];			
			$_SESSION["cart_sale_customer_order"][$keys]['product_price']=$_POST["product_price"];
				   }
			}
		}
	}
	if($_POST["action"] == 'update_x1')
	{
		foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
			
			if($_POST["qty"]>$_SESSION["cart_sale_customer_order"][$keys]['qty_limit'])
			{
				//$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$_SESSION["cart_sale_customer_order"][$keys]['qty_limit'];
				$qty = filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			    $_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$qty;
			
				$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
				$_SESSION["cart_sale_customer_order"][$keys]['product_price']=$price;
				}
				else{
			$qty = filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$qty;	
			
			$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);			
			$_SESSION["cart_sale_customer_order"][$keys]['product_price']=$price;
				   }
			}
		}
	}
	if($_POST["action"] == 'select_item')
	{
		//
		/*if(isset($_SESSION["cart_sale_customer_order"]))
		{   		
		unset($_SESSION["cart_sale_customer_order"]);
		}*/
		
		
		$list_id=$_SESSION["list_id"];
		
		if(isset($_POST['item_list'])){
for ($i = 0; $i < count($_POST['item_list']); $i++) {
			
			
			
		       $Product_ID = mysqli_real_escape_string($con,$_POST['item_list'][$i]);
			  
	        	$stock_id=$_SESSION["stock_id"]; 
	 
	     @$price_type= mysqli_real_escape_string($con,$_POST['price_type_item']);		     
		  if($price_type==''){$pp=",products.s3_price as sale_price ";}  
		  elseif($price_type=='001'){ $pp=",products.s1_price  as sale_price";}
		  elseif($price_type=='002'){ $pp=",products.s2_price  as sale_price";}
		  elseif($price_type=='003'){ $pp=",products.s3_price  as sale_price";}
	 
       

           $sql_d=mysqli_query($con,"
			  
			  SELECT products.* $pp,tb_stock_product.stock_qty,tb_product_order.order_qty
		             
		     FROM  products
    left join (select sum(qty) as stock_qty,product_id from stock_product where 1=1 and stock_id='0001' group by product_id ) as tb_stock_product
                 on products.Product_ID=tb_stock_product.product_id
		left join (select sum(qty) as order_qty,product_id from product_customer_order where 1=1 and status_sale='1' group by product_id ) as tb_product_order
                 on products.Product_ID=tb_product_order.product_id
				 
              where    1=1 and RIGHT(products.Product_ID,2)='$Product_ID'  order by products.Group_ID,products.Product_ID 
			    ");		 
		while($f=mysqli_fetch_array($sql_d)){
	       $list_id++;
		   echo $_SESSION["list_id"]=$list_id;
		   $remark=$f["crate_price"];
		   
		  $item_array = array(
			    
				'list_id'                  =>     $list_id,
				'Product_ID'               =>     $f["Product_ID"],  
				'product_name'             =>     $f["Product_Name"],  
				'product_price'            =>     $f["sale_price"],
				'units'                    =>     $f["Unit"], 
				'qty_limit'                =>     $f["stock_qty"],
				'order_qty'                =>     $f["order_qty"],
				'crate_qty'                =>     '',
				'status_free'                =>     '',
				 
				'pic'                      =>     $f["pic_url"],  
				'crate_price'                =>     $f["crate_price"],
				'remark'                    =>     $remark, 
				'product_quantity'         =>     '0'
			);
			$_SESSION["cart_sale_customer_order"][] = $item_array;
	      
		}
	 
	
    
    }
	  header("location:add_sale_customer_order.php");
	
	}else{
		
		header("location:add_sale_customer_order.php");
		}
		
		
	}
	if($_POST["action"] == 'update_free')
	{
		foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
			
							
				//$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
				$_SESSION["cart_sale_customer_order"][$keys]['product_price']='0';
				$_SESSION["cart_sale_customer_order"][$keys]['status_free']='1';
		
			}
		}
	}
	
	/*if($_POST["action"] == 'make_cart')
	{
		
		
		$stock_id=$_SESSION["stock_id"]; 
	 
	     @$price_type= mysqli_real_escape_string($con,$_POST['price_type']);		     
		  if($price_type==''){$pp=",products.s3_price as sale_price ";}  
		  elseif($price_type=='001'){ $pp=",products.s1_price  as sale_price";}
		  elseif($price_type=='002'){ $pp=",products.s2_price  as sale_price";}
		  elseif($price_type=='003'){ $pp=",products.s3_price  as sale_price";}
	 
       

           $sql_d=mysqli_query($con,"
			  
			  SELECT products.* $pp,tb_stock_product.stock_qty,tb_product_order.order_qty
		             
		     FROM  products
    left join (select sum(qty) as stock_qty,product_id from stock_product where 1=1 and stock_id='0001' group by product_id ) as tb_stock_product
                 on products.Product_ID=tb_stock_product.product_id
		left join (select sum(qty) as order_qty,product_id from product_customer_order where 1=1 and status_sale='1' group by product_id ) as tb_product_order
                 on products.Product_ID=tb_product_order.product_id
				 
              where    1=1 and products.Group_ID='001'  order by products.Product_ID 
			    ");
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
				'order_qty'                =>     $f["order_qty"], 
				'pic'                      =>     $f["pic_url"],  
				'crate_price'                =>     $f["crate_price"],
				'remark'                    =>     $remark, 
				'product_quantity'         =>     '0'
			);
			$_SESSION["cart_sale_customer_order"][] = $item_array;
    
	 
		   }
		}
	}*/
	if($_POST["action"] == 'update_plus')
	{
		foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
		
		if($_POST["qty"]=='0'){ $_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=1; }
	else{
	  if($_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$_POST["qty"]){
	
	      
	      $_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']+1;
	
	    }else{
			$qty=filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
		$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$qty;
			}
	
	}
			}
		}
	}
	if($_POST["action"] == 'update_minus')
	{
		foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
			
			if($_SESSION["cart_sale_customer_order"][$keys]['product_quantity']-1<1)
			{
				$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=0;
				
				
				}
				else{
		
			$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']-1;
		
				   }
			}
		}
	}
	if($_POST["action"] == 'update_plus_c')
	{
		foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
			
			
			$_SESSION["cart_sale_customer_order"][$keys]['crate_qty']=$_SESSION["cart_sale_customer_order"][$keys]['crate_qty']+1;
			/*if($_SESSION["cart_sale_customer_order"][$keys]['product_quantity']+1>$_SESSION["cart_sale_customer_order"][$keys]['qty_limit'])
			{
				$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$_SESSION["cart_sale_customer_order"][$keys]['qty_limit'];
				
				
				}
				else{
		
			$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']=$_SESSION["cart_sale_customer_order"][$keys]['product_quantity']+1;
		
				   }*/
			}
		}
	}
	if($_POST["action"] == 'update_minus_c')
	{
		foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
			
			if($_SESSION["cart_sale_customer_order"][$keys]['crate_qty']-1<1)
			{
				$_SESSION["cart_sale_customer_order"][$keys]['crate_qty']=0;
				
				
				}
				else{
		
			$_SESSION["cart_sale_customer_order"][$keys]['crate_qty']=$_SESSION["cart_sale_customer_order"][$keys]['crate_qty']-1;
		
				   }
			}
		}
	}
	
	
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_sale_customer_order"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_sale_customer_order"]);
		unset($_SESSION["cur"]);
		unset($_SESSION["cur_name"]);
		unset($_SESSION["list_id"]);
		unset($_SESSION["customer_id"]);
		unset($_SESSION["customer_name"]);
		unset($_SESSION["customer_type"]);
		unset($_SESSION["s_order_id"]);
		
		unset($_SESSION["s_route_id"]);
		unset($_SESSION["s_route_name"]);
		
		
		header("location:add_sale_customer_order.php");
	}
?>
