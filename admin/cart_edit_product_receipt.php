<?php 
include("init.php");


 @$id= mysqli_real_escape_string($con,$_GET['id']);	
 
 
 $sql_ch=mysqli_query($con," select sum(product_receipt.qty) as qty1,sum(stock_product.qty) as qty2
              from product_receipt 
              left join     stock_product on stock_product.stockin_id=product_receipt.receipt_id
             where receipt_id='$id' ");
			 
	$ct=mysqli_num_rows($sql_ch);
	if($ct>0){
		$ch=mysqli_fetch_array($sql_ch);
		 $qty1= $ch['qty1'];
		 $qty2= $ch['qty2'];
		
if($qty1 ==  $qty2){
			
			
		
  
  
	
if(isset($_GET['id'])){	
	  
		if(isset($_SESSION["cart_edit_product_receipt"]))
		{
			unset($_SESSION["cart_edit_product_receipt"]);
			
			unset($_SESSION["receipt_id"]);
		    unset($_SESSION["receipt_date"]);
		    unset($_SESSION["refer_no"]);
		    unset($_SESSION["staff_id"]);
			unset($_SESSION["supplier_name"]);
			unset($_SESSION["supplier_id"]);
		    unset($_SESSION["stock_id"]);
		//	unset($_SESSION["payment"]);
			
		}
		
					$sql_pl=mysqli_query($con," select product_receipt.*,sum(product_receipt.qty) as qty,products.Product_Name,suppliers.supplier_name
				
					
      from  product_receipt
					left join products on products.Product_ID=product_receipt.product_id
					left join suppliers on suppliers.supplier_id=product_receipt.supplier_id
					left join stock_product on stock_product.product_lot_id=product_receipt.product_lot_id         
                       and    stock_product.stock_id=product_receipt.stock_id
         
                      
					 where  receipt_id='$id'  group by product_receipt.product_id   order by product_receipt.Id ");
 
 if($num=mysqli_num_rows($sql_pl)>0){
 
		  while($p = mysqli_fetch_array($sql_pl)){

		$_SESSION["receipt_id"]=$p['receipt_id'];
		$_SESSION["receipt_date"]=$p['receipt_date'];
		$_SESSION["refer_no"]=$p['refer_no'];
		$_SESSION["staff_id"]=$p['staff_id'];
		$_SESSION["supplier_name"]=$p['supplier_name'];
		$_SESSION["supplier_id"]=$p['supplier_id'];
		$_SESSION["stock_id"]=$p['stock_id'];
	//	$_SESSION["payment"]=$p['payment'];
		
		
       	$item_array = array(
				
				'product_name'       =>     $p['Product_Name'],			 
				'Product_ID'         =>     $p['product_id'],
				'product_lot_id'     =>     $p['product_lot_id'],
				'product_price'      =>     $p['price'],
				
				'product_quantity'   =>     $p['qty']
				
			);
			$_SESSION["cart_edit_product_receipt"][] = $item_array;
      }
    
	header("location:edit_product_receipt.php?a=add");
            
   }
			
			  
}
else{ header("location:edit_product_receipt.php?a=error"); }


}
else{  // if $qty1 !==  $qty2
		echo	$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສາມາດແກ້ໄຂລາຍການນີ້ໄດ້ ເພາະມີການຈ່າຍສິນຄ້າແລ້ວ!</strong> </div>";
		header("location:product_receipt_list.php");
		mysql_close();
	
			}
		
		}
?>