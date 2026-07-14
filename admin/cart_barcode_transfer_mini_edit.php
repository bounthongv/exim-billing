<?php

//fetch_cart.php

include('init.php');
  //  $stock_id=$_SESSION["stock_id"]; 
  $barcode=mysqli_real_escape_string($con,$_POST['barcode']);   

           $sql=mysqli_query($con,"SELECT products.Product_ID,products.Product_Name,stock_product.product_lot_id ,stock_product.price ,stock_product.qty            
		   FROM  products
		   left join stock_product on products.Product_ID=stock_product.product_id
      
          
       where    1=1 and  stock_product.qty >0    and products.Bar_Code='$barcode'  and stock_product.stock_id='$stock_id'
       group by products.Product_ID  order by products.Product_ID , stock_product.product_lot_id ");
		   $ch=mysqli_num_rows($sql);
		if($ch>0){
		   $r=mysqli_fetch_array($sql);
	 
	// $product_lot_id=$r['product_lot_id'];
     $product_id=$r['Product_ID'];
     $product_name=$r['Product_Name'];
	 $qty_limit=$r['qty'];
     $price=$r['price'];
	 $qty=1;
	 
if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		/// start 
		if(isset($_SESSION["cart_edit_transfer_mini_stock"]))
		{
			$is_available = 0;
			foreach($_SESSION["cart_edit_transfer_mini_stock"] as $keys => $values)
			{
				if($_SESSION["cart_edit_transfer_mini_stock"][$keys]['Product_ID'] == $product_id)
				{
					$is_available++;
					
				if($_SESSION["cart_edit_transfer_mini_stock"][$keys]['product_quantity'] == $qty_limit)
					{   header("location:transfer_mini_stock_edit.php?qty=$qty_limit");   }
					else{	
			$_SESSION["cart_edit_transfer_mini_stock"][$keys]['product_quantity'] = $_SESSION["cart_edit_transfer_mini_stock"][$keys]['product_quantity'] + $qty;			
			    header("location:transfer_mini_stock_edit.php?qty=$qty_limit");
					}
				}
			}
			if($is_available == 0)
			{
				$item_array = array(
				 
					'Product_ID'               =>     $product_id,  
					'product_name'             =>     $product_name,  
					'product_price'            =>     $price, 
					'qty_limit'                =>     $qty_limit,  
					'product_quantity'         =>     $qty
				);
				$_SESSION["cart_edit_transfer_mini_stock"][] = $item_array;
				header("location:transfer_mini_stock_edit.php");
			}
		}
		else
		{
			$item_array = array(
			   
				'Product_ID'               =>     $product_id,  
				'product_name'             =>     $product_name,  
				'product_price'            =>     $price,  
				'qty_limit'                =>     $qty_limit, 
				'product_quantity'         =>     $qty
			);
			$_SESSION["cart_edit_transfer_mini_stock"][] = $item_array;
			header("location:transfer_mini_stock_edit.php");
		}
		/// end 
	}

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_edit_transfer_mini_stock"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_edit_transfer_mini_stock"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'update')
	{
		foreach($_SESSION["cart_edit_transfer_mini_stock"] as $keys => $values)
		{
			if($values["Product_ID"] == $_POST["Product_ID"])
			{
			//	unset($_SESSION["cart_edit_transfer_mini_stock"][$keys]);
			$_SESSION["cart_edit_transfer_mini_stock"][$keys]['product_quantity']=$_POST["product_quantity"];
			$_SESSION["cart_edit_transfer_mini_stock"][$keys]['product_price']=$_POST["product_price"];
			}
		}
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_edit_transfer_mini_stock"]);
	}
}
}
else{
	
	$_SESSION['smg']="<div class='alert alert-danger'><strong>ກະລຸນາກວດລະຫັດບາໂຄດຄືນ!</strong> </div>";
		header("location:transfer_mini_stock_edit.php");
	}
?>