<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
/*$sql_max=mysqli_query($con,"select max(SUBSTRING(pay_id, 1, 5)) as id from payment ");
@$row_max=mysql_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='0000'.'1';  
 
 $id2=$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $receipt_id=$id1;     }

 else if($max_id<9){  $receipt_id='0000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $receipt_id='000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $receipt_id='00'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $receipt_id='0'.$id2;} 
  else if($max_id<99999){  $receipt_id=$id2;}
  
  else if($max_id >=99999){   $receipt_id=$id2; }
  
   $receipt_id;*/
   
   
   
   foreach ($_POST as $key => $value) {
  $_POST[$key]=addslashes(strip_tags(trim($value)));
}

/*if ($_GET['sale_id'] !='') {
	   $sale_id=(string) $_GET['sale_id']; 
	    }*/
extract($_POST);	   
 
   

   //  $receipt_id = mysqli_real_escape_string($con,$_POST['receipt_id']);
   
     $pay_id = mysqli_real_escape_string($con,$_POST['pay_id']);
     $pay_date = mysqli_real_escape_string($con,$_POST['pay_date']);
	 
     $receipt_id = mysqli_real_escape_string($con,$_POST['receipt_id']);
     $receipt_date = mysqli_real_escape_string($con,$_POST['receipt_date']);  
	 
	 $supplier_id = mysqli_real_escape_string($con,$_POST['supplier_id']); 
	 
     $pay_lak = mysqli_real_escape_string($con,$_POST['payment_lak']);
     $pay_thb = mysqli_real_escape_string($con,$_POST['payment_thb']);
	 $pay_usd = mysqli_real_escape_string($con,$_POST['payment_usd']);
	 
	 $change_lak = mysqli_real_escape_string($con,$_POST['change_lak']);
     $change_thb = mysqli_real_escape_string($con,$_POST['change_thb']);
	 $change_usd = mysqli_real_escape_string($con,$_POST['change_usd']);
	 
	 $totals = mysqli_real_escape_string($con,$_POST['totals']);
	 $payment = mysqli_real_escape_string($con,$_POST['payment']);
	 $all_dis = mysqli_real_escape_string($con,$_POST['all_dis']);
	 
     
	 
	 $c_thb='1';
	 $c_lak= mysqli_real_escape_string($con,$_POST['kip_baht']);
	 $c_usd= mysqli_real_escape_string($con,$_POST['dollar_baht']);
	 
	 
	 $tt_lak=$pay_lak/$c_lak;
	 $tt_usd=$pay_usd*$c_usd;
	 
	 
	 $tt_change_thb=$change_thb;
	 $tt_change_lak=$change_lak/$c_lak;
	 $tt_change_usd=$change_usd*$c_usd;
	 $total_change=$tt_change_thb+$tt_change_thb+$tt_change_usd;
	 
	 $total=$pay_thb+$tt_lak+$tt_usd;
	 
	 $time=date('h:i:s');

   //  if($totals<($total+$payment)){ $total=$totals; }


if(isset($_POST['save'])){

if($change_thb>0){
	
	$sql=mysqli_query($con,"INSERT INTO payment (pay_id,pay_date,receipt_date,time,receipt_id,supplier_id,pay_lak,pay_thb,pay_usd,total,c_lak,c_thb,c_usd) 
		values('$pay_id','$pay_date','$receipt_date','$time','$receipt_id','$supplier_id','$pay_lak','$pay_thb','$pay_usd','$total','$c_lak','$c_thb','$c_usd') ");
		
		
$sql_up=mysqli_query($con,"update product_receipt set payment=payment+$total-$change_thb  where receipt_id='$receipt_id'");
			

	
	}
else{
	
	
	$sql=mysqli_query($con,"INSERT INTO payment (pay_id,pay_date,receipt_date,time,receipt_id,supplier_id,pay_lak,pay_thb,pay_usd,total,c_lak,c_thb,c_usd) 
		values('$pay_id','$pay_date','$receipt_date','$time','$receipt_id','$supplier_id','$pay_lak','$pay_thb','$pay_usd','$total','$c_lak','$c_thb','$c_usd') ");
		
		
$sql_up=mysqli_query($con,"update product_receipt set payment=payment+$total  where receipt_id='$receipt_id'");
	
	}


			
if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:product_receipt.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:product_receipt.php");
	}
			
					
   header('location:product_receipt.php');
    mysql_close();

}else{ 
          header('location:product_receipt.php'); 

          mysql_close(); 
		  }

?>
</html>

 
