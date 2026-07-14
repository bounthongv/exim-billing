


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

                        

    $sql = mysqli_query($con,"
				 select product_sale.*,sum(product_sale.qty) as t_qty,sum(product_sale.amount) as amount,products.Product_Name,customers.customer_name,products.Unit 
				 from product_sale 
LEFT JOIN products ON products.Product_ID = product_sale.product_id 
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id 
where product_sale.sale_id='$sale_id'  group by product_sale.product_id limit $start,$perpage ");

                       $i_p2=$start+1;
					   
			$count_row2=mysqli_num_rows($sql);
                while($f = mysqli_fetch_array($sql)){    
				
				 @$t_amount = $t_amount + $f['amount'];
				 @$t_discount = $t_discount + $f['discount'];
				    ?>
  <tr>
    <td align="center"><?php echo $i_p2; ?></td>
    <td align="left"><?php echo $f['Product_Name'];?></td>
    <td align="center"><?php echo $f['t_qty'];?></td>
    <td align="center"><?php echo $f['Unit'];?></td>
    <td align="right"><?php echo $f['price'];?></td>
    <td align="right"><?php echo $f['discount'];?></td>
    <td align="right"><?php echo number_format($f['amount'],2);?></td>
  </tr>
  <?php  $i_p2++; } ?>
    <?php 
   $max=33;
   $count_row2;
   $row_avirable=$max-$count_row2;
   
   for ($x2 = 0; $x2 <= $row_avirable; $x2++) {
   
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
   
   

  </tr>
</table>
