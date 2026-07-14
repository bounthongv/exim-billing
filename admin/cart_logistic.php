<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		/// start 
		
		
		if(isset($_SESSION["cart_logistic"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_logistic"] as $keys => $values)
			{   
			
				if($_SESSION["cart_logistic"][$keys]['sale_id'] == $_POST["sale_id"])
				{
										
					$is_available++;
					
				}
				
			} // edn foreach
			
			
			  		 if($is_available == 0)
			  		{
						
			$_SESSION["cart_name"]=$_SESSION["cart_name"].',"'.$_POST["sale_id"].'"';
			
			 $sql_d=mysqli_query($con,"update product_customer_order set status_logistic='1'  where sale_id='".$_POST['sale_id']."'  ");
					$item_array = array(
				    
									
						'sale_id'         =>     $_POST["sale_id"],
				  'customer_name'         =>     $_POST["customer_name"]
					);
						$_SESSION["cart_logistic"][] = $item_array;
				
			    	}
					
	  } // end isset  session cart
	else
		{
			$_SESSION["cart_name"]=',"'.$_POST["sale_id"].'"';
			 $sql_d=mysqli_query($con,"update product_customer_order set status_logistic='1'  where sale_id='".$_POST['sale_id']."'  ");
			$item_array = array(
			    
				
				'sale_id'         =>     $_POST["sale_id"],
				'customer_name'         =>     $_POST["customer_name"]
			);
			$_SESSION["cart_logistic"][] = $item_array;
			
			
		}
		
	}/// end  action = add

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_logistic"] as $keys => $values)
		{
			
			$_SESSION["cart_name"]=str_replace($_POST["sale_id"],"",$_SESSION["cart_name"]);
			 $sql_d=mysqli_query($con,"update product_customer_order set status_logistic=''  where sale_id='".$_POST['sale_id']."'  ");
			 
			if($values["sale_id"] == $_POST["sale_id"])
			{
				
				unset($_SESSION["cart_logistic"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'update')
	{
		foreach($_SESSION["cart_logistic"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			//	unset($_SESSION["cart_product_receipt"][$keys]);
			if($_POST["qty"]>$_SESSION["cart_logistic"][$keys]['qty'])
			{
				$_SESSION["cart_logistic"][$keys]['qty']=$_SESSION["cart_logistic"][$keys]['qty_limit'];
				$_SESSION["cart_logistic"][$keys]['price']=$_POST["price"];
				}
				else{
			$_SESSION["cart_logistic"][$keys]['qty']=$_POST["qty"];			
			$_SESSION["cart_logistic"][$keys]['price']=$_POST["price"];
				   }
			}
		}
	}
	if($_POST["action"] == 'update_x1')
	{
		foreach($_SESSION["cart_logistic"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			
			if($_POST["qty"]>$_SESSION["cart_logistic"][$keys]['qty_limit'])
			{
				//$_SESSION["cart_logistic"][$keys]['qty']=$_SESSION["cart_logistic"][$keys]['qty_limit'];
				$qty = filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			    $_SESSION["cart_logistic"][$keys]['qty']=$qty;
			
				$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
				$_SESSION["cart_logistic"][$keys]['price']=$price;
				}
				else{
			$qty = filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$_SESSION["cart_logistic"][$keys]['qty']=$qty;	
			
			$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);			
			$_SESSION["cart_logistic"][$keys]['price']=$price;
				   }
			}
		}
	}
	if($_POST["action"] == 'make_cart')
	{
		//
		if(isset($_SESSION["cart_logistic"]))
		{   		
		unset($_SESSION["cart_logistic"]);
		}
		
		
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
				'price'                    =>     $f["sale_price"],
				'units'                    =>     $f["Unit"], 
				'qty_limit'                =>     $f["stock_qty"],
				'order_qty'                =>     $f["order_qty"], 
				'pic'                      =>     $f["pic_url"],  
				'crate_price'                =>     $f["crate_price"],
				'remark'                    =>     $remark, 
				'qty'         =>     '0'
			);
			$_SESSION["cart_logistic"][] = $item_array;
    
	 
		   }
		}
	}
	if($_POST["action"] == 'update_plus')
	{
		foreach($_SESSION["cart_logistic"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			
			
			$_SESSION["cart_logistic"][$keys]['qty']=$_SESSION["cart_logistic"][$keys]['qty']+1;
			/*if($_SESSION["cart_logistic"][$keys]['qty']+1>$_SESSION["cart_logistic"][$keys]['qty_limit'])
			{
				$_SESSION["cart_logistic"][$keys]['qty']=$_SESSION["cart_logistic"][$keys]['qty_limit'];
				
				
				}
				else{
		
			$_SESSION["cart_logistic"][$keys]['qty']=$_SESSION["cart_logistic"][$keys]['qty']+1;
		
				   }*/
			}
		}
	}
	if($_POST["action"] == 'update_minus')
	{
		foreach($_SESSION["cart_logistic"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			
			if($_SESSION["cart_logistic"][$keys]['qty']-1<1)
			{
				$_SESSION["cart_logistic"][$keys]['qty']=1;
				
				
				}
				else{
		
			$_SESSION["cart_logistic"][$keys]['qty']=$_SESSION["cart_logistic"][$keys]['qty']-1;
		
				   }
			}
		}
	}
	
	
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_logistic"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_logistic"]);
		unset($_SESSION["cur"]);
		unset($_SESSION["cur_name"]);
		unset($_SESSION["cart_name"]);
		
		header("location:add_logistic.php");
	}
?>
