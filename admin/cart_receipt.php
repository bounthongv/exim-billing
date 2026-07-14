<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'select_item')
	{
		//
		if(isset($_SESSION["cart_receipt"]))
		{   		
		unset($_SESSION["cart_receipt"]);
		}
		
		
		if(isset($_POST['item_list'])){
			$e_list=0;
for ($i = 0; $i < count($_POST['item_list']); $i++) {
			
			
		       $sale_id=mysqli_real_escape_string($con,$_POST['item_list'][$i]);
			  
       

           $sql_d=mysqli_query($con,"
		  select product_sale.* from (    
      SELECT product_sale.sale_id,product_sale.sale_date,sum(product_sale.amount) as total_amt,sum(product_sale.qty) as total_qty
   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
	  ,customers.customer_name
    ,product_sale.total,product_sale.payment,product_sale.remain
			

		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
	   
       where 1=1   and  product_sale.sale_id='$sale_id'  and (product_sale.status is null or product_sale.status='' 
       or product_sale.status='0')
         group by product_sale.sale_id,product_sale.product_id 
       ) as product_sale
          
	   group by product_sale.sale_id order by product_sale.sale_id desc
			    ");		 
		$f=mysqli_fetch_array($sql_d);
	       
		   $e_list++;
		  echo $e_list;
	       $item_array = array(
			    
				'list_id'               =>     $e_list,
				'sale_id'               =>     $f["sale_id"],  
				'sale_date'             =>     $f["sale_date"],  
				'total'                 =>     $f["total"],
				'payment'               =>     $f["payment"], 
				'remain'                =>     $f["remain"]
			);
			$_SESSION["cart_receipt"][] = $item_array;
    
	 
	
    
    }
	  header("location:add_receipt.php");
	
	}else{
		
		header("location:add_receipt.php");
		}
		
		
	}
    if($_POST["action"] == 'update_x1')
	{
		foreach($_SESSION["cart_receipt"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
				
			 $total=mysqli_real_escape_string($con,$_POST['total']);
			 $total=filter_var($total, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			 
		     $_SESSION["cart_receipt"][$keys]['total']=$total;
	
			}
		}
	}
	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_receipt"] as $keys => $values)
		{
			if($values["sale_id"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_receipt"][$keys]);
			}
		}
	}
	
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_receipt"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_receipt"]);
		header("location:add_receipt.php");
	}

?>