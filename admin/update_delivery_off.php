<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

       $sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);
	  
	   $sql_upt=mysqli_query($con,"update product_sale set status_off='0' where sale_id='$sale_id'  ");
	   
	   
	    $sql_in2=mysqli_query($con,"insert into stock_product (stockin_id,stockin_date,stock_id,product_id,product_lot_id,price,qty) 
       
       select product_sale.sale_id,product_sale.sale_date,product_sale.stock_id,product_sale.product_id
       ,product_sale.product_lot_id,product_sale.price,sum(product_sale.qty) as qty    
       
       from product_sale
       left join products on products.Product_ID=product_sale.product_id
        where product_sale.sale_id='$sale_id'  and products.Group_ID='003'
        group by product_sale.product_id  ");
		
		$sql_in3=mysqli_query($con,"  insert into product_receipt_crate (receipt_id,receipt_date,stock_id,product_id,product_lot_id,price,qty,amount,customer_id) 
       
       select product_sale.sale_id,product_sale.sale_date,product_sale.stock_id,product_sale.product_id
       ,product_sale.product_lot_id,product_sale.price,sum(product_sale.qty) as qty  
       ,sum(product_sale.amount) as amount,customer_id  
       
       from product_sale
       left join products on products.Product_ID=product_sale.product_id
        where product_sale.sale_id='$sale_id'  and products.Group_ID='003'
        group by product_sale.product_id  ");
			
   if($sql_upt){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		       $_SESSION['smg']="<div class='alert alert-success'><strong>ສຳເລັດ!</strong></div>";
		        }
				
		       header("location:sale_list.php");
		     }
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	 	header("location:add_sale_customer_order.php");
	    }
			

  



?>
</html>

 
