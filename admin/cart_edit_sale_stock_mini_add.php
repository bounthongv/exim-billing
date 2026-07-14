<?php

//action.php

include("init.php");

if($_GET["action"] == 'make_cart_edit')
	{
		 @$sale_id= mysqli_real_escape_string($con,$_GET['sale_id']);
		
		//
		if(isset($_SESSION["cart_edit_sale_stock_mini"]))
		{   		
		unset($_SESSION["cart_edit_sale_stock_mini"]);
		}
		
		$sql_h=mysqli_query($con,"select product_sale.* ,products.Product_Name,products.Unit,customers.customer_name
		,customers.customer_type,customer_type.ct_name
	
		from product_sale 
    left join products on product_sale.product_id=products.Product_ID
    left join customers on product_sale.customer_id=customers.customer_id
	left join customer_type on customers.customer_type=customer_type.ct_id
    
    where sale_id='$sale_id' ");
		$ff=mysqli_fetch_array($sql_h);
		
		$_SESSION["refer_no"]=$ff["refer_no"];
		$_SESSION["sale_date"]=$ff["sale_date"];
		$_SESSION["customer_id"]=$ff["customer_id"];
		$_SESSION["customer_name"]=$ff["customer_name"];
		$_SESSION["ct_id"]=$ff["customer_type"];
		$_SESSION["ct_name"]=$ff["ct_name"];
		$_SESSION['edit_sale_id']=$sale_id;
		
		
		
		$stock_id=$_SESSION["stock_id"]; 
	 
	   /*  @$price_type=$ff['customer_type'];	
		 	     
		  if($price_type==''){$pp=",products.s3_price as sale_price ";}  
		  elseif($price_type=='001'){ $pp=",products.s1_price  as sale_price";}
		  elseif($price_type=='002'){ $pp=",products.s2_price  as sale_price";}
		  elseif($price_type=='003'){ $pp=",products.s3_price  as sale_price";}
	 
       */

           $sql_d=mysqli_query($con,"select product_sale.* ,products.Product_Name,products.Product_ID
		   ,products.Unit,customers.customer_name,customers.customer_type,products.pic,products.pic_url
	
		from product_sale 
    left join products on product_sale.product_id=products.Product_ID
    left join customers on product_sale.customer_id=customers.customer_id
    
    where sale_id='$sale_id'  ");
		   $ch=mysqli_num_rows($sql_d);
		if($ch>0){
		   while($f=mysqli_fetch_array($sql_d)){
	       
		   
		   $remark=$f["crate_price"];
	       $item_array = array(
			    
				'Product_ID'               =>     $f["Product_ID"],  
				'product_name'             =>     $f["Product_Name"],  
				'product_price'            =>     $f["price"],
				'units'                    =>     $f["Unit"], 
				'qty_limit'                =>     100000, 
				'pic'                      =>     $f["pic_url"],  
				'crate_price'                =>     $f["crate_price"],
				'remark'                    =>     $remark, 
				'product_quantity'         =>     $f["qty"]
			);
			$_SESSION["cart_edit_sale_stock_mini"][] = $item_array;
    
	 
		   }
		}
		
		header("location:edit_sale_stock_mini.php");
		
	}
?>
