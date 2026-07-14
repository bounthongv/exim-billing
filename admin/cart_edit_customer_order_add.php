<?php

//action.php

include("init.php");
    $sale_id = mysqli_real_escape_string($con,$_GET['order_id']);
   $_SESSION['edit_sale_order_id']=$sale_id;
	if($_GET["order_id"])
	{
		
		if(isset($_SESSION["cart_edit_customer_order"]))
		{   		
		unset($_SESSION["cart_edit_customer_order"]);
		
		 unset($_SESSION['od_sale_id']);
	     unset($_SESSION['od_sale_date']);
	     unset($_SESSION['od_sale_time']);
	  
	     unset($_SESSION['od_send_date']);
	     unset($_SESSION['od_send_time']);
		 
		 unset($_SESSION['od_sr_id']);
		 unset($_SESSION['od_sr_fname']);
		 unset($_SESSION['od_sr_lname']);
		
		 unset($_SESSION['customer_id']);
	     unset($_SESSION['customer_name']);
	 
	     unset($_SESSION['price_type']);
	     unset($_SESSION['customer_type']);
	 
	     unset($_SESSION['s_route_id'] );
	     unset($_SESSION['s_route_name']);
	    unset($_SESSION['s_remark']);
		
	  
	 
	    
	  
		}
		
		
		  $list_id=$_SESSION["list_id"];
		
		
		/*@$price_type= mysqli_real_escape_string($con,$_POST['price_type_item']);		     
		  if($price_type==''){$pp=",products.s3_price as sale_price ";}  
		  elseif($price_type=='001'){ $pp=",products.s1_price  as sale_price";}
		  elseif($price_type=='002'){ $pp=",products.s2_price  as sale_price";}
		  elseif($price_type=='003'){ $pp=",products.s3_price  as sale_price";}*/
	 
		
		
			
			
	        	$stock_id=$_SESSION["stock_id"]; 
          $sql_d=mysqli_query($con,"
			  
			  SELECT product_customer_order.*,stocks.stock_name
			  ,sum(product_customer_order.qty) as t_qty
			   ,products.Product_ID,products.Product_Name,products.size,products.Unit 
			   ,tb_groups.Group_Name,products.pic,products.pic_url
			   ,customers.customer_id,customers.customer_name
			   ,customer_type.ct_id,customer_type.ct_name,routes.route_id,routes.route_name
			   ,sr_list.sr_fname,sr_list.sr_lname
			    ,stock_products.qty as total_qty
			   
		   FROM  product_customer_order 
		left join products on products.Product_ID=product_customer_order.product_id
		left join customers on product_customer_order.customer_id=customers.customer_id
		left join customer_type on customers.customer_type=customer_type.ct_id
		left join routes on customers.route_id=routes.route_id
		
       left join stocks on stocks.stock_id=product_customer_order.stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id  
	   left join sr_list on product_customer_order.sr=sr_list.sr_id
	   
	   LEFT JOIN (select sum(qty) as qty ,product_id,price from  stock_product 
		          where 1=1  group by product_id) as stock_products       
		             on products.Product_ID=stock_products.product_id
	   
	   where product_customer_order.sale_id='".$sale_id."' group by product_customer_order.product_id
	     order by products.Group_ID,product_customer_order.product_id
			    ");		 

    		while($f=mysqli_fetch_array($sql_d)){
				
	    $_SESSION['od_sale_id'] =$f["sale_id"]; 
	    $_SESSION['od_sale_date'] =$f["sale_date"];
		$_SESSION['od_sale_time'] =$f["sale_time"];
		
		$_SESSION['od_send_date'] =$f["send_date"];
		$_SESSION['od_send_time'] =$f["send_time"];
		
		$_SESSION['od_sr_id'] =$f["sr"];
	    $_SESSION['od_sr_fname'] =$f["sr_fname"];
	    $_SESSION['od_sr_lname'] =$f["sr_lname"];
	
	 $_SESSION['customer_id'] = $f["customer_id"];
	 $_SESSION['customer_name'] = $f["customer_name"];
	 
	 $_SESSION['price_type'] = $f["ct_id"];
	 $_SESSION['customer_type'] =$f["ct_name"];
	 
	  $_SESSION['s_route_id'] =$f["route_id"];
	  $_SESSION['s_route_name'] =$f["route_name"];
	  $_SESSION['s_remark'] =$f["remark"];
	 
	 
	  
	
		
	  
	 
	  
	  
	
	 	
				
	       $list_id= $f["list_id"];
		   $_SESSION["list_id"]=$list_id;
		   $remark=$f["crate_price"];
		   
		  $item_array = array(
			    
				'list_id'                  =>     $list_id,
				'Product_ID'               =>     $f["Product_ID"],  
				'product_name'             =>     $f["Product_Name"],  
				'product_price'            =>     $f["price"],
				'units'                    =>     $f["Unit"], 
				'qty_limit'                =>     $f["total_qty"],
	
				'crate_qty'                =>     '',
				'status_free'              =>     '',
				 
				'pic'                      =>     $f["pic_url"],  
				'crate_price'              =>     $f["crate_price"],
				'remark'                   =>     $remark, 
				'product_quantity'         =>     $f["t_qty"]
			);
			$_SESSION["cart_edit_customer_order"][] = $item_array;
	      
    
	               }
	 
	  header("location:edit_customer_order.php");
  
	
	}else{
		
		header("location:edit_customer_order.php");
		}
		
	
?>