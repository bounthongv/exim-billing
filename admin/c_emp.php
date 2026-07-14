<?php

//action.php

include("init.php");



if(isset($_POST["action"]))
{


	if($_POST["action"] == "add")
	{
		/// start 
		if(isset($_SESSION["emp"]))
		{
			$is_available = 0;
			foreach($_SESSION["emp"] as $keys => $values)
			{   
			
				//if($_SESSION["emp"][$keys]['account_id'] == $_POST["account_id"])

				if($_SESSION["emp"][$keys]['fomu_id'] == $_POST["fomu_id"])
				{
							

					$is_available++;

/*
					if($_SESSION["emp"][$keys]['product_quantity'] == $_POST["qty_limit"])
					{  }
					else{
										
					$_SESSION["emp"][$keys]['product_price'] =   $_POST["product_price"];								 
					}
*/

				}
				
			} // edn foreach
		

				if($is_available == 0)
				{
			  $item_array = array(
				  'fomu_id'           =>     $_POST["fomu_id"], 
				  'Description'    =>     $_POST["Description"],  
				  'Item_number'              =>     $_POST["Item_number"],
				  'UOM'            =>     $_POST["UOM"],
				  'Customer_Count'           =>     $_POST["Customer_Count"],
				  'Driver_Count'             =>     $_POST["Driver_Count"],
				  'Driver_Count_in_WareHouse'              =>     $_POST["Driver_Count_in_WareHouse"],
				  'Storekeeper_Count'            =>     $_POST["Storekeeper_Count"],
				  'Detall_of_Information'           =>     $_POST["Detall_of_Information"]


			  );
				  $_SESSION["emp"][] = $item_array;
		  
			  }
				


	  } // end isset  session cart
	else
		{
		
			if($is_available == 0)
				{
			  $item_array = array(
				'fomu_id'           =>     $_POST["fomu_id"], 
				'Description'    =>     $_POST["Description"],  
				'Item_number'              =>     $_POST["Item_number"],
				'UOM'            =>     $_POST["UOM"],
				'Customer_Count'           =>     $_POST["Customer_Count"],
				'Driver_Count'             =>     $_POST["Driver_Count"],
				'Driver_Count_in_WareHouse'              =>     $_POST["Driver_Count_in_WareHouse"],
				'Storekeeper_Count'            =>     $_POST["Storekeeper_Count"],
				'Detall_of_Information'           =>     $_POST["Detall_of_Information"]
			  );
				  $_SESSION["emp"][] = $item_array;
		  
			  }

		}
		
	}/// end  action = add






	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["emp"] as $keys => $values)
		{
			if($values["fomu_id"] == $_POST["fomu_id"])
			{
				unset($_SESSION["emp"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'update')
	{
		foreach($_SESSION["emp"] as $keys => $values)
		{
			if($values["account_id"] == $_POST["account_id"])
			{
			//	unset($_SESSION["cart_product_receipt"][$keys]);
			if($_POST["product_quantity"]>$_SESSION["emp"][$keys]['product_quantity'])
			{
				//$_SESSION["emp"][$keys]['product_quantity']=$_SESSION["emp"][$keys]['qty_limit'];
				//$_SESSION["emp"][$keys]['product_price']=$_POST["product_price"];
			}
				else{
			//$_SESSION["emp"][$keys]['product_quantity']=$_POST["product_quantity"];			
			//$_SESSION["emp"][$keys]['product_price']=$_POST["product_price"];
				   }
			}
		}
	}


	if(@$_POST["action"] == 'empty')
	{

		unset($_SESSION["emp"]);

	}
}


if(@$_GET["action"] == 'empty')
{

	
		unset($_SESSION["emp"]);
		unset($_SESSION["fomu_id"]);
	

		header("location:add_Disbursement_proposal.php");
	}




?>
