



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
                        $sql = mysql_query("
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

                       $i_p3=$start;
					   
			$count_row3=mysqli_num_rows($sql);
                while($f = mysqli_fetch_array($sql)){    
				
				 @$t_amount = $t_amount + $f['amount'];
				 @$t_discount = $t_discount + $f['discount'];
				    ?>
  <tr>
    <td align="center"><?php echo $i_p3+1; ?></td>
    <td align="left"><?php echo $f['Product_Name'];?></td>
    <td align="center"><?php echo $f['t_qty'];?></td>
    <td align="center"><?php echo $f['Unit'];?></td>
    <td align="right"><?php echo $f['price'];?></td>
    <td align="right"><?php echo $f['discount'];?></td>
    <td align="right"><?php echo number_format($f['amount'],2);?></td>
  </tr>
  <?php  $i_p3++; } ?>
    <?php 
   $max=20;
   $count_row3;
   $row_avirable=$max-$count_row3;
   
   for ($x3 = 0; $x3 <= $row_avirable; $x3++) {
   
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
   
   <?php 
   // }
   
    ?>
   
  <tr>
    <td colspan="2" valign="top" ><div style="text-justify:auto"><?php echo $ff['remark']; ?></div></td>
    <td colspan="5">
    
  <table border="0" width="100%">
  <tr>
    <td width="25%">ລວມຈຳນວນສີນຄ້າ:</td>
    <td width="24%">ລວມເງີນ</td>
    <td width="21%" >&nbsp;</td>
    
    <td width="30%" colspan="2" align="right"><?php echo @number_format($t_amount,2);?></td>
  </tr>
  <tr>
    <td>ຈຳນວນ &nbsp; &nbsp; <?php echo $lis_pro; ?></td>
    <td>ສ່ວນລົດທ້າຍບີນ</td>
    <td align="right" ><?php echo @number_format(($ff['bill_discount']/$t_amount)*100,2);?> %</td>    
    <td align="right" colspan="2"><?php echo @number_format($ff['bill_discount'],2);?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>ມູນຄ່າເພີ່ມ</td>
    
    <td  align="right" >%</td>
    <td  align="right" colspan="2">0.00</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>ລວມເງີນທັງໝົດ</td>
    <td>&nbsp;</td>
    
    <td  align="right" colspan="2"><?php echo @number_format($t_amount-$ff['bill_discount'],2);?></td>
  </tr>
</table>

    
    </td>
  </tr>
  <tr>
    <td colspan="7" valign="top" align="center">
    <input type="hidden" name="read_total" id="read_total" value="<?php echo @$t_amount-$ff['bill_discount'];?>">
    &nbsp;<div id="write_here"></div></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
    ຜູ້ຮັບສີນຄ້າ...................................
    <br />
    <br />
    <br />
    <br />
    (ຜູ້ຈ່າຍເງີນ)..................................
    </td>
    <td colspan="3" valign="top">
    ຜູ້ສົ່ງສີນຄ້າ...................................
    <br />
    <br />
    <br />
    <br />
    (ຜູ້ຮັບເງີນ)..................................
    </td>
    <td colspan="2" valign="top">
    <br />
    <br />
    <br />
    <br />    
    (ຜູ້ອະນຸມັດ)..................................
    </td>
  </tr>
</table>
<script src="read_number_laos.js" type="text/javascript" charset="utf-8"></script>
<script language="javascript">
number_lao();
function number_lao(){
	//alert("kkkk");
			var amt = document.getElementById("read_total").value;
			var thaibath = ArabicNumberToText(amt);
			// alert(thaibath);
			$("#write_here").html(thaibath);
		}
</script>