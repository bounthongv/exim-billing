<?php 
include("init.php");


 @$sale_id= mysqli_real_escape_string($con,$_GET['sale_id']);		   
	
if(isset($_GET['sale_id'])){	
	  
		if(isset($_SESSION["cart_edit_sale"]))
		{
			unset($_SESSION["cart_edit_sale"]);
			
			unset($_SESSION["sale_id"]);
		    unset($_SESSION["sale_date"]);
		    unset($_SESSION["refer_no"]);
		    unset($_SESSION["customer_id"]);
			unset($_SESSION["customer_name"]);
			unset($_SESSION["customer_type"]);
		    unset($_SESSION["stock_id"]);
			unset($_SESSION["payment"]);
			
			unset($_SESSION["pay_lak"]);
			unset($_SESSION["pay_thb"]);
			unset($_SESSION["pay_usd"]);
			
			unset($_SESSION["remark"]);
			unset($_SESSION["plan_date"]);
			
		}
		
					$sql_pl=mysqli_query($con,"  select product_sale.*,sum(product_sale.qty) as qty,products.Product_Name,customers.customer_name
					,customers.customer_type
					,sum(stock_product.qty+product_sale.qty) as qty_limit
      from  product_sale
					left join products on products.Product_ID=product_sale.product_id
					left join customers on customers.customer_id=product_sale.customer_id
					left join stock_product on stock_product.product_lot_id=product_sale.product_lot_id         
                       and    stock_product.stock_id=product_sale.stock_id
         
                      
					 where  sale_id='$sale_id'  group by product_sale.product_id   order by product_sale.Id ");
 
 if($num=mysqli_num_rows($sql_pl)>0){
 
		  while($p = mysqli_fetch_array($sql_pl)){

		$_SESSION["sale_id"]=$p['sale_id'];
		$_SESSION["sale_date"]=$p['sale_date'];
		$_SESSION["refer_no"]=$p['refer_no'];
		$_SESSION["customer_id"]=$p['customer_id'];
		$_SESSION["customer_name"]=$p['customer_name'];
		$_SESSION["customer_type"]=$p['customer_type'];
		$_SESSION["stock_id"]=$p['stock_id'];
		$_SESSION["payment"]=$p['payment'];
		
		$_SESSION["pay_lak"]=$p['lak'];
		$_SESSION["pay_usd"]=$p['usd'];
		$_SESSION["pay_thb"]=$p['thb'];
		
		$_SESSION["plan_date"]=$p['plan_date'];
		$_SESSION["remark"]=$p['remark'];
		
		
       	$item_array = array(
				
				'product_name'       =>     $p['Product_Name'],			 
				'Product_ID'         =>     $p['product_id'],
				'product_lot_id'     =>     $p['product_lot_id'],
				'product_price'      =>     $p['price'],
				'qty_limit'          =>     $p['qty_limit'],
				'product_quantity'   =>     $p['qty']
				
			);
			$_SESSION["cart_edit_sale"][] = $item_array;
      }
    
	header("location:add_sale_edit.php?a=add");
            
   }
			
			  
}
else{ header("location:add_sale_edit.php?a=error"); }
