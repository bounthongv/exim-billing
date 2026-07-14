<?php 
include("init.php");



$id=mysqli_real_escape_string($con,$_GET['id']);
 $sql_ch=mysqli_query($con," select sum(product_receipt.qty) as qty1,sum(stock_product.qty) as qty2
              from product_receipt 
              left join     stock_product on stock_product.stockin_id=product_receipt.receipt_id
             where receipt_id='$id' ");
			 
	$ct=mysqli_num_rows($sql_ch);
	if($ct>0){
		$ch=mysqli_fetch_array($sql_ch);
		 $qty1= $ch['qty1'];
		 $qty2= $ch['qty2'];
		
if($qty1 == $qty2){


if(isset($_GET['id'])){
	
	$sql_del1=mysqli_query($con," delete  from product_receipt where receipt_id='$id' ");
    $sql_del2=mysqli_query($con," delete  from stock_product where stockin_id='$id' ");
	
	if($sql_del1){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ຂໍ້ມູນຖືກລົບແລ້ວ!</strong></div>";
		header("location:product_receipt_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ລົບບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:product_receipt_list.php");
	}
	
	}
	header("location:product_receipt_list.php");
	
	
	}
else{  // if $qty1 !==  $qty2
		echo	$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສາມາດລົບໄດ້ ເພາະມີການຈ່າຍສິນຄ້າແລ້ວ!</strong> </div>";
		header("location:product_receipt_list.php");
		mysql_close();
	
			}
		
		}
?>