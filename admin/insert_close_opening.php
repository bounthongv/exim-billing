<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php




	//$Group_ID = mysqli_real_escape_string($con,$_POST['Group_ID']);
	@$product_id = mysqli_real_escape_string($con,$_POST['product_id']);
	@$unit = mysqli_real_escape_string($con,$_POST['unit']);
	@$Product_Name = mysqli_real_escape_string($con,$_POST['ups']);
	$stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	$y = mysqli_real_escape_string($con,$_POST['y']);
	$m = mysqli_real_escape_string($con,$_POST['m']);
	if($m=='12'){
		$m_next='1';
		$y_next=$y+1;
		}else{
	$m_next=$m+1;
	$y_next=$y;
		}
	@$qty = mysqli_real_escape_string($con,$_POST['qty']);
	@$qty = filter_var($qty, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
	
	@$price = mysqli_real_escape_string($con,$_POST['price']);
	@$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	@$amount = mysqli_real_escape_string($con,$_POST['amount']);
	@$amount = filter_var($amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);


           $close_date=date($y.'-'.$m.'-'.'01'); 
		   $open_date=date($y_next.'-'.$m_next.'-'.'01'); 
			
	
	 if($stock_id==''){$s_id=""; }
		  else{ $s_id="and stock_id='$stock_id'  "; }	 
	
	$action = mysqli_real_escape_string($con,$_POST['action']);
	@$Id = mysqli_real_escape_string($con,$_POST['Id']);

	//$stock_id='0001';
	
	

if($action=="create"){
	
		$sql_ch=mysqli_query($con," select * from stock_opening where open_date='$open_date' $s_id  ");
	$ch=mysqli_num_rows($sql_ch);
	if($ch >0) { 
	
	echo "<div class='alert alert-danger'><strong>ເດືອນນີ້ມີການປິດບັນຊີແລ້ວ</strong> </div>";
	//	header("location:add_opening.php"); 
		   }
    else{
		  @$sql_p=mysqli_query($con," select * from products where 1=1 ");
		  
		while($p=mysqli_fetch_array($sql_p)){
			
	$sql=mysqli_query($con,"insert into stock_opening ( open_date,product_id,qty,price,amount,stock_id) 
  
  select 
     '$open_date',products.Product_ID,sum(tb_open.open_qty)+sum(tb_receipt.r_qty+tb_receipt_t.r_qty)-sum(tb_sale.s_qty+tb_sale_t.s_qty) as total_qty 
     ,products.s1_price as pprice ,(sum(tb_open.open_qty)+sum(tb_receipt.r_qty+tb_receipt_t.r_qty)-sum(tb_sale.s_qty+tb_sale_t.s_qty))*(s1_price) as amount ,'$stock_id'     
    
 from  products  
 
 left join (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as open_qty,sum(amount) as open_amt from stock_opening  where product_id='$p[Product_ID]'  
 and  year(open_date)='$y' and month(open_date)='$m' $s_id) as tb_open   on   products.Product_ID=tb_open.product_id 
 
  left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as r_qty,sum(amount) as r_amt from product_receipt  where product_id='$p[Product_ID]' 
and  year(receipt_date)='$y' and month(receipt_date)='$m' $s_id) as tb_receipt on  products.Product_ID=tb_receipt.product_id 

 left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as r_qty,sum(qty*price) as r_amt from transfer  where product_id='$p[Product_ID]' 
and year(transfer_date)='$y' and month(transfer_date)='$m'  $s_id_t ) as tb_receipt_t on  products.Product_ID=tb_receipt_t.product_id 

 
 
  left join  (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as s_qty,sum(amount) as s_amt  from product_sale  where product_id='$p[Product_ID]' 
and  year(sale_date)='$y' and month(sale_date)='$m' $s_id) as tb_sale  on   products.Product_ID=tb_sale.product_id 

 left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as s_qty,sum(qty*price) as s_amt from transfer  where product_id='$p[Product_ID]' 
and year(transfer_date)='$y' and month(transfer_date)='$m'  $s_id_f ) as tb_sale_t on  products.Product_ID=tb_sale_t.product_id
 
 where    products.Product_ID='$p[Product_ID]'
 
 
 
  ");
		}
		}
		echo "<script>alert('ສຳເລັດ');</script>";
		$sql_del=mysqli_query($con," delete from stock_opening where qty='0' ");
  //  header("location:close_opening_list.php");
		
    }
else if($action=="delete"){
	
		$sql_ch=mysqli_query($con," select * from stock_opening where open_date='$open_date'   ");
	$ch=mysqli_num_rows($sql_ch);
	if($ch >0) { 
	
	
	//	header("location:add_opening.php"); 
	$sql=mysqli_query($con,"delete  from stock_opening where open_date='$open_date'   ");
		   }
    else{
	echo "<div class='alert alert-danger'><strong>ເດືອນນີ້ບໍ່ມີລາຍການຍອດຍົກ</strong> </div>";
	
		}
    }
else{
	
	
	
	
	}

?>
</html>

 