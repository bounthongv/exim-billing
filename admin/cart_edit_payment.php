<?php

//action.php

include("init.php");
   $pay_id = mysqli_real_escape_string($con,$_GET['pay_id']);





if($_GET["pay_id"])
	{
		
if(isset($_SESSION["cart_payment_edit"]))
		{   		
		unset($_SESSION["cart_payment_edit"]);
		}






 $sql_d2=mysqli_query($con,"SELECT payment_2.*,tb_bank.Bank_account,tb_bank.Bank_Name FROM payment_2
LEFT JOIN tb_bank ON payment_2.Bank_account = tb_bank.Bank_account
WHERE 1=1 and payment_2.pay_id='$pay_id'
         ");		 
$f2=mysqli_fetch_array($sql_d2);


    $_SESSION['pay_id'] =$f2["pay_id"];
 	$_SESSION['Bank_account'] =$f2["Bank_account"];
	$_SESSION['Bank_Name'] =$f2["Bank_Name"];
    $_SESSION['user_id'] =$f2["user_id"];
    $_SESSION['pay_date'] =$f2["pay_date"];




          $sql_d=mysqli_query($con,"SELECT payment_2.*,tb_bank.Bank_account,tb_bank.Bank_Name FROM payment_2
LEFT JOIN tb_bank ON payment_2.Bank_account = tb_bank.Bank_account
WHERE 1=1 and payment_2.pay_id='$pay_id'");		 


$list_id=0;
    		while($f=mysqli_fetch_array($sql_d)){
$list_id++;
	
		  $item_array = array(
			   
				'list_id'               =>     $list_id,
				'pay_id'                =>     $f["pay_id"],  
                'pay_date'              =>     $f["pay_date"],
                'sale_id'               =>     $f["sale_id"],
				'sale_date'             =>     $f["sale_date"],  
				'amount'                =>     $f["amount"]

		
			);
			$_SESSION["cart_payment_edit"][] = $item_array;
	      
    
	               }
	 
	 header("location:edit_payment.php");
  
	
	}else{
		
	 header("location:payment_list.php");
		}
		
	

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_payment_edit"] as $keys => $values)
		{
			if($values["sale_id"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_payment_edit"][$keys]);
			}
		}
	}




if(isset($_GET["action"]) && $_GET["action"] == 'close_and_clear')
{
    unset($_SESSION["cart_payment_edit"]);
    unset($_SESSION["customer_id"]);
    unset($_SESSION["customer_name"]);
    unset($_SESSION["Bank_account"]);
    unset($_SESSION["Bank_Name"]);
    
    header("location:payment_list.php");
    exit;
}


?>