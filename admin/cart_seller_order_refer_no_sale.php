<?php 
include("init.php");


 @$order_id= mysqli_real_escape_string($con,$_GET['order_id']);		   
	
if(isset($_GET['order_id'])){	
	  
		if(isset($_SESSION["cart_sale_stock"]))
		{
			unset($_SESSION["cart_sale_stock"]);
			
			unset($_SESSION["customer_id"]);
			unset($_SESSION["customer_name"]);
			
			unset($_SESSION["order_id"]);

		
		}
		
					$sql_pl=mysql_query("   SELECT seller_orders.*,
					stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,groups.Group_Name,products.version,customers.customer_name,customers.customer_id,sum(stock_product.qty) as qty_limit
		   FROM  seller_orders 
	   left join stock_product on stock_product.product_id=seller_orders.product_id
	   left join products on products.Product_ID=seller_orders.product_id
	   left join customers on customers.customer_id=seller_orders.customer_id
       left join stocks on stocks.stock_id=seller_orders.stock_id	
       left join groups on groups.Group_ID=products.group_id
       
       
       where      seller_orders.order_id='$order_id'
	   group by      seller_orders.product_id 
	  order by seller_orders.product_id    ");
 
 if($num=mysql_num_rows($sql_pl)>0){
 
		  while($p = mysql_fetch_array($sql_pl)){

		$_SESSION["order_id"]=$p['order_id'];
		$_SESSION["customer_id"]=$p['customer_id'];
		$_SESSION["customer_name"]=$p['customer_name'];
	
		
       	$item_array = array(
								
						 
				'Product_ID'         =>     $p['product_id'],
				'product_name'       =>     $p['Product_Name'],	
				'product_price'      =>     $p['price'],
				'qty_limit'          =>     $p['qty_limit'],
				'product_quantity'   =>     $p['qty']
				
			);
			$_SESSION["cart_sale_stock"][] = $item_array;
      }
    
	header("location:add_sale_stock.php?a=add");
            
   }
			
			  
}
else{ header("location:add_sale_stock.php?a=error"); }
