 <?php
 // include("init.php");

foreach ($_GET as $key => $value) {
  $_GET[$key]=addslashes(strip_tags(trim($value)));
}

if (@$_GET['sale_id'] !='') {
	   $s_id=(string) $_GET['sale_id']; 
	    }
	   
extract($_GET); 





 @$sql_d = mysqli_query($con,"
				 select product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,products.Product_Name,customers.customer_name ,customers.phone,stocks.stock_name
				 from product_sale 
LEFT JOIN products ON products.Product_ID = product_sale.product_id 
LEFT JOIN stocks ON product_sale.stock_id = stocks.stock_id 
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id 
where product_sale.sale_id='$sale_id'  group by product_sale.product_id ");

 $ff = mysqli_fetch_array($sql_d);
 $lis_pro = mysqli_num_rows($sql_d);
?>
<body> 
<table border="0" width="100%" align="center" >
  <tr>
    <td align="center"><h3>ບໍລິສັດ ສີເພັດດາ ການຄ້າ ຂາອອກ - ຂາເຂົ້າ</h3></td>
  </tr>
  <tr>
    <td align="center"><h4>ທີຢູ່: ບ້ານທົ່ງຕູມ, ເມືອງ ຈັນທະບູລີ, ນະຄອນຫງລວງວຽງຈັນ</h4></td>
  </tr>
  <tr>
    <td align="center"><h4>TEL: 020 59000080, 020 59000070</h4></td>
  </tr>
  <tr>
    <td align="center"><h4>ໃບຂາຍສີນຄ້າ/ໃບຮຽກເກັບເງີນ</h4></td>
  </tr>
</table>
<table width="100%" border="0" align="center">
  <tr>
    <td width="50%">
    <div class="q">
    <table border="0" width="100%">
  	<tr>
      <td>ລູກຄ້າ: <?php echo $ff['customer_id']; ?><br />Customer <?php echo $ff['customer_name']; ?></td>
      <td>&nbsp;</td>
  	  <td>ສາງສີນຄ້າ <?php echo $ff['stock_name']; ?><br />(Stock) <?php echo $ff['stock_id']; ?></td>
  	  <td>&nbsp;</td>
	  </tr>
  	<tr>
  	  <td>ເບີໂທ: <?php echo $ff['phone']; ?><br />Phone</td>
  	  <td>&nbsp;</td>
  	  <td>ພະນັກງານຂາຍ<br />(Salesman)</td>
  	  <td>&nbsp;</td>
	  </tr>
	</table>
	</div>
    
    </td>
    <td width="50%">
    <div class="q">
    <table border="0" width="100%">
  	<tr>
        <td valign="top">ເລກທີບີນ <?php echo $ff['sale_id']; ?><br />(Bill No)</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">ວັນທີ  <?php  $dd=date_create($ff['sale_date']); echo date_format($dd,"d-m-Y");?><br />(Date)</td>
        <td valign="top">&nbsp;</td>
  	</tr>
    <tr>
        <td valign="top">ສະກຸນເງີນ &nbsp; &nbsp; THB<br />(Cuurency)</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">ວັນທີນັດຈ່າຍ <?php  $ddd=date_create($ff['plan_date']); echo date_format($ddd,"d-m-Y");?><br />(Paid Date)</td>
        <td valign="top">&nbsp;</td>
  	</tr>
	</table>
	</div>
    
    </td>
  </tr>
</table>

<table width="100%" class="table-bordered" border="0">
  <tr>
    <td width="4%" align="center">ລຳດັບ<br />No</td>
    <td width="38%" align="center">ລາຍການສີນຄ້າ<br />Description</td>
    <td width="8%" align="center">ຈຳນວນ<br />QTY</td>
    <td width="8%" align="center">ຫົວໝ່ວຍ<br />Unit</td>
    <td width="12%" align="center">ລາຄາ/ຫົວໝ່ວຍ<br />Unit Price</td>
    <td width="12%" align="center">ສ່ວນຫລຸດ<br />Discount</td>
    <td width="18%" align="center">ລວມເງີນ<br />Sub Total</td>
  </tr>
  
  


   <?php 

                        
            /*            
                        $sql = mysqli_query($con,"
				 select product_sale.*,sum(product_sale.qty) as t_qty,sum(product_sale.amount) as amount,products.Product_Name,customers.customer_name,products.Unit 
				 from product_sale 
LEFT JOIN products ON products.Product_ID = product_sale.product_id 
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id 
where product_sale.sale_id='$sale_id'  group by product_sale.product_id   Limit $start,$perpage ");*/

    $sql = mysqli_query($con,"
				 select product_sale.*,sum(product_sale.qty) as t_qty,sum(product_sale.amount) as amount,products.Product_Name,customers.customer_name,products.Unit 
				 from product_sale 
LEFT JOIN products ON products.Product_ID = product_sale.product_id 
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id 
where product_sale.sale_id='$sale_id'  group by product_sale.product_id limit $start,$perpage ");

                       $i_p12=$start+1;
					   
			$count_row12=mysqli_num_rows($sql);
                while($f = mysqli_fetch_array($sql)){    
				
				 @$t_amount = $t_amount + $f['amount'];
				 @$t_discount = $t_discount + $f['discount'];
				    ?>
  <tr>
    <td align="center"><?php echo $i_p12; ?></td>
    <td align="left"><?php echo $f['Product_Name'];?></td>
    <td align="center"><?php echo $f['t_qty'];?></td>
    <td align="center"><?php echo $f['Unit'];?></td>
    <td align="right"><?php echo $f['price'];?></td>
    <td align="right"><?php echo $f['discount'];?></td>
    <td align="right"><?php echo number_format($f['amount'],2);?></td>
  </tr>
  <?php  $i_p12++; } ?>
    <?php 
   $max=25;
   $count_row12;
   $row_avirable=$max-$count_row12;
   
   for ($x12 = 0; $x12 <= $row_avirable; $x12++) {
   
   ?>
   <tr  class="hide_button">
   	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   
   <?php  } ?>
   
 
 
</table>
