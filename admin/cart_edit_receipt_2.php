<?php

//action.php

include("init.php");
   $sale_id = mysqli_real_escape_string($con,$_GET['sale_id']);
   $payment_id = mysqli_real_escape_string($con,$_GET['payment_id']);
   $_SESSION['sale_id']=$sale_id;




if($_GET["sale_id"])
	{
		
if(isset($_SESSION["cart_receipt_edit"]))
		{   		
		unset($_SESSION["cart_receipt_edit"]);
		}






 $sql_d2=mysqli_query($con,"SELECT customer_payment.* ,customers.customer_name
		 from  customer_payment
		 left join customers on customer_payment.customer_id=customers.customer_id
		 
		 where customer_payment.sale_id='$sale_id' and customer_payment.payment_id='$payment_id'");		 
$f2=mysqli_fetch_array($sql_d2);





    $_SESSION['payment_id'] =$f2["payment_id"];
		$_SESSION['payment_date'] =$f2["payment_date"];
		$_SESSION['payment_name'] =$f2["payment_name"];
        $_SESSION['customer_name'] =$f2["customer_name"];
        $_SESSION['receipt_name'] =$f2["receipt_name"];

	  $_SESSION['pay_lak'] =$f2["cur_lak"];

      $_SESSION['pay_thb'] =$f2["cur_thb"];

      $_SESSION['pay_usd'] =$f2["cur_usd"];

	$_SESSION['total_lak'] =$f2["total_lak"];

    $_SESSION['payment_type'] =$f2["payment_type"];

/*
          $sql_d=mysqli_query($con,"SELECT customer_payment.* ,customers.customer_name,
product_sale.total,
product_sale.payment,
product_sale.remain

		 from  customer_payment
		 left join customers on customer_payment.customer_id=customers.customer_id
		 left join product_sale on customer_payment.sale_id=product_sale.sale_id


		 where customer_payment.sale_id='$sale_id' and customer_payment.payment_id='$payment_id'");	
*/

          $sql_d=mysqli_query($con,"SELECT sale_id,sale_date,
		  sum(total) as total,
		  payment,remain from product_sale where product_sale.sale_id='$sale_id' group by sale_id");		 


$list_id=0;
    		while($f=mysqli_fetch_array($sql_d)){
$list_id++;
	
		  $item_array = array(
			   
				'list_id'               =>     $list_id,
				'sale_id'               =>     $f["sale_id"],  
				'sale_date'             =>     $f["sale_date"],  
				'total'                 =>     $f["total"],
				'payment'               =>     $f["payment"], 
                'remain'               =>      $f["remain"]

		
			);
			$_SESSION["cart_receipt_edit"][] = $item_array;
	      
    
	               }
	 
	 header("location:edit_receipt.php");
  
	
	}else{
		
	 header("location:receipt_list.php");
		}
		
	
?>