<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'select_item')
	{
		//
		if(isset($_SESSION["cart_payment"]))
		{   		
		unset($_SESSION["cart_payment"]);
		}
		



$Bank_info_2=mysqli_real_escape_string($con,$_POST['Bank_info_2']);

if (isset($_POST['Bank_info_2'])) {
    // แยกค่าด้วยตัวระบุ |
    $bank_data = explode('|', $_POST['Bank_info_2']);
    
    $_SESSION['Bank_account'] = $Bank_account = $bank_data[0]; // ได้เลขบัญชี
    $_SESSION['Bank_Name'] = $Bank_name    = $bank_data[1]; // ได้ชื่อธนาคาร
}




		
		if(isset($_POST['item_list'])){
			$e_list=0;
for ($i = 0; $i < count($_POST['item_list']); $i++) {
			
			
	$sale_id=mysqli_real_escape_string($con,$_POST['item_list'][$i]);
			  
    


           $sql_d=mysqli_query($con,"SELECT customer_payment.* ,customers.customer_name,
  customers.TIN,
  tb_bank.Bank_Name
		 from  customer_payment
		 left join customers on customer_payment.customer_id=customers.customer_id
		 left join tb_bank on customer_payment.Bank_account=tb_bank.Bank_account
		 where 1=1 and customer_payment.payment_type='1' and customer_payment.sale_id='$sale_id' order by payment_date asc

			    ");		 
		$f=mysqli_fetch_array($sql_d);
	       
		   $e_list++;
		  echo $e_list;
	       $item_array = array(
			    
				'list_id'               =>     $e_list,
				'sale_id'               =>     $f["sale_id"],  
				'sale_date'             =>     $f["sale_date"],  
				'amount'                =>     $f["amount"]
			);
			$_SESSION["cart_payment"][] = $item_array;
    
	 
	
    
    }
	  header("location:add_payment.php");
	
	}else{
		
		header("location:add_payment.php");
		}
		
		
	}








    if($_POST["action"] == 'update_x1')
	{
		foreach($_SESSION["cart_payment"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
				
			 $total=mysqli_real_escape_string($con,$_POST['total']);
			 $total=filter_var($total, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			 
		     $_SESSION["cart_payment"][$keys]['total']=$total;
	
			}
		}
	}
	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_payment"] as $keys => $values)
		{
			if($values["sale_id"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_payment"][$keys]);
			}
		}
	}
	
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_payment"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_payment"]);
		header("location:add_payment.php");
	}




if(isset($_GET["action"]) && $_GET["action"] == 'close_and_clear')
{
    unset($_SESSION["cart_payment"]);
    unset($_SESSION["customer_id"]);
    unset($_SESSION["customer_name"]);
    unset($_SESSION["Bank_account"]);
    unset($_SESSION["Bank_Name"]);
    
    header("location:payment_list.php");
    exit;
}




?>