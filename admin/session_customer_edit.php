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
	 
		
		
			
			
	        	$stock_id=$_SESSION["stock_id"]; 
          $sql_d=mysqli_query($con,"
			  
			   SELECT product_customer_order.*,stocks.stock_name
			   ,products.Product_ID,products.Product_Name,products.size,products.Unit ,tb_groups.Group_Name
			   ,products.Group_ID
		   FROM  product_customer_order 
		left join products on products.Product_ID=product_customer_order.product_id
       left join stocks on stocks.stock_id=product_customer_order.stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id  
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
			$_SESSION["cart_edit_sale_customer_order"][] = $item_array;
	      
    
	               }
	 
	 // header("location:add_sale_customer_order.php");
  
	
	}else{
		
		header("location:add_sale_customer_order.php");
		}
		
	
?>
</html>

 
