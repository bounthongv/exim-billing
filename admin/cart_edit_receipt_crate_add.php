<?php

//action.php

include("init.php");

if($_GET["action"] == 'make_cart_edit')
	{
		
		 @$receipt_id= mysqli_real_escape_string($con,$_GET['receipt_id']);
		@$s_stock_id=$_SESSION['stock_id'];
		//
		if(isset($_SESSION["cart_edit_receipt_crate"]))
		{   		
		unset($_SESSION["cart_edit_receipt_crate"]);
		}
		
		
		
       

           $sql_d=mysqli_query($con," SELECT products.* ,tb_product_receipt_crate.qty,tb_product_receipt_crate.sale_price
		   ,tb_stock_product.stock_qty,tb_product_receipt_crate.customer_id,tb_product_receipt_crate.customer_name
		   ,tb_product_receipt_crate.receipt_date
		             
		     FROM  products
			 
    left join (select sum(product_receipt_crate.qty) as qty,product_receipt_crate.product_id,product_receipt_crate.price as sale_price
	      ,product_receipt_crate.customer_id ,customers.customer_name,product_receipt_crate.receipt_date
		 from product_receipt_crate
		 left join customers on product_receipt_crate.customer_id=customers.customer_id
		  where  receipt_id='$receipt_id' group by product_id 
		 
		 
		 ) as tb_product_receipt_crate
        on products.Product_ID=tb_product_receipt_crate.product_id
  
  left join (select sum(qty) as stock_qty,product_id from stock_product where stock_id='$s_stock_id' group by product_id ) as tb_stock_product
        on products.Product_ID=tb_stock_product.product_id
		
              where    1=1 and products.Group_ID='002'  order by products.Product_ID   ");
			  
		 
		   while($f=mysqli_fetch_array($sql_d)){
	        
		        $_SESSION["receipt_id"]=$receipt_id; 
			  if($f["customer_id"]!=''){
				  
		    
			  $_SESSION["receipt_date"]=$f["receipt_date"];
			 $_SESSION["customer_name"]=$f["customer_name"];
			   $_SESSION["customer_id"]=$f["customer_id"];
			  }
		  
		   $remark=$f["crate_price"];
	       $item_array = array(
			    
				'Product_ID'               =>     $f["Product_ID"],  
				'product_name'             =>     $f["Product_Name"],  
				'product_price'            =>     $f["sale_price"],
				'units'                    =>     $f["Unit"], 
				'qty_limit'                =>     $f["stock_qty"], 
				'pic'                      =>     $f["pic_url"],  
				'crate_price'                =>   $f["crate_price"],
				'remark'                    =>    $remark, 
				'product_quantity'         =>     $f["qty"]
			);
			$_SESSION["cart_edit_receipt_crate"][] = $item_array;
    
	 
		  
		   
		}
		header("location:edit_receipt_crate.php");
		
	}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_edit_receipt_crate"]);
		unset($_SESSION["cur"]);
		unset($_SESSION["cur_name"]);
		header("location:add_receipt_crate.php");
	}
?>
