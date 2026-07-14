<?php 
include("init.php");
?>
<?php
    
     $_SESSION['customer_id'] = mysqli_real_escape_string($con,$_POST['customer_id']);
	 $_SESSION['customer_name'] = mysqli_real_escape_string($con,$_POST['customer_name']);
	 
	 $_SESSION['price_type'] = mysqli_real_escape_string($con,$_POST['ct_id']);
	 $_SESSION['customer_type'] = mysqli_real_escape_string($con,$_POST['ct_name']);
	 
	  $_SESSION['s_route_id'] = mysqli_real_escape_string($con,$_POST['route_id']);
	  $_SESSION['s_route_name'] = mysqli_real_escape_string($con,$_POST['route_name']);
	 
	 $_SESSION['s_order_id'] = mysqli_real_escape_string($con,$_POST['order_id']);
	 
	 
	 $_SESSION['s_sr_id'] = mysqli_real_escape_string($con,$_POST['sr_id']);
	 $_SESSION['s_sr_fname'] = mysqli_real_escape_string($con,$_POST['sr_fname']);
	 $_SESSION['s_sr_lname'] = mysqli_real_escape_string($con,$_POST['sr_lname']);

	if($_POST["order_id"])
	{
		
		if(isset($_SESSION["cart_sale_customer_order"]))
		{   		
		unset($_SESSION["cart_sale_customer_order"]);
		}
		
		
		$list_id=$_SESSION["list_id"];
		@$price_type= mysqli_real_escape_string($con,$_POST['price_type_item']);		     
		  if($price_type==''){$pp=",products.s3_price as sale_price ";}  
		  elseif($price_type=='001'){ $pp=",products.s1_price  as sale_price";}
		  elseif($price_type=='002'){ $pp=",products.s2_price  as sale_price";}
		  elseif($price_type=='003'){ $pp=",products.s3_price  as sale_price";}
		  elseif($price_type=='004'){ $pp=",products.s4_price  as sale_price";}
		  elseif($price_type=='005'){ $pp=",products.seven_eleven  as sale_price";}
		  elseif($price_type=='006'){ $pp=",products.function  as sale_price";}
		 
			
	
	        	$stock_id=$_SESSION["stock_id"]; 
          $sql_d=mysqli_query($con,"
			  
			   SELECT product_customer_order.*,stocks.stock_name
			   ,products.Product_ID,products.Product_Name,products.size,products.Unit ,tb_groups.Group_Name
			   ,tb_stock_product.stock_qty,products.Group_ID
		   FROM  product_customer_order 
		left join products on products.Product_ID=product_customer_order.product_id
       left join stocks on stocks.stock_id=product_customer_order.stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id  
	   
	   left join (select sum(qty) as stock_qty,product_id from stock_product where 1=1 $s_id  group by product_id ) as tb_stock_product
  on products.Product_ID=tb_stock_product.product_id
  
	   where product_customer_order.sale_id='".$_SESSION['s_order_id']."'
			    ");		 



    		while($f=mysqli_fetch_array($sql_d)){
	       $list_id++;
		   $_SESSION["list_id"]=$list_id;
		   $remark=$f["crate_price"];
		   
		  $item_array = array(
			    
				'list_id'                  =>     $list_id,
				'Product_ID'               =>     $f["Product_ID"],  
				'product_name'             =>     $f["Product_Name"],  
				'product_price'            =>     $f["price"],
				'units'                    =>     $f["Unit"], 
				'qty_limit'                =>     $f["stock_qty"],
				'Group_ID'                 =>     $f["Group_ID"],
	
				'crate_qty'                =>     '',
				'status_free'              =>     '',
				 
				'pic'                      =>     $f["pic_url"],  
				'crate_price'              =>     $f["crate_price"],
				'remark'                   =>     $remark, 
				'product_quantity'         =>     $f["qty"]
			);
			$_SESSION["cart_sale_customer_order"][] = $item_array;
	      
			
	               }
	 
	 // header("location:add_sale_customer_order.php");
  

	}else{
		
		header("location:add_sale_customer_order.php");
		}
		
	
?>
</html>

 
