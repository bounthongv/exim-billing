<?php



include('init.php');

$total_price = 0;
$total_item = 0;

?>

	<table class="table table-bordered ">
		<tr align="center">  
        
            <th  align="center">No.</th> 
            <th align="center">Inventory <br />Code</th> 
            <th width="20%" align="center">ລາຍການສັ່ງຊື້ <br />Item Description</th>  
            <th  align="center">ຫົວໜ່ວຍ<br />UOM</th> 
            <th width="5%" align="center">ປະລິມານສັ່ງຊື້<br />Quantity</th>  
            <th  align="center">ລາຄາ/ຫົວໜ່ວຍ<br />Unit Price</th>  
            <th  align="center">ມູນຄ່າ<br />Amount</th>
            <th  align="center">ລັງເປົ່າ<br />Empties</th>  
            <th  align="center">ໝາຍເຫດ<br />Remark</th>  
        </tr>
<?php
if(!empty($_SESSION["cart_product_receipt"]))
{
	$e=0;
	
	foreach($_SESSION["cart_product_receipt"] as $keys => $values)
	{
		$e++;
		?>
		<tr>
            <td><?=$e;?></td>
            <td align="center"><?=$values["barcode"];?></td>
			<td><?=$values["Product_ID"];?>&nbsp;<?=$values["product_name"];?></td>
            <td align="center"><?=$values["units"];?></td>
			<td>
     <input type="text" name="QTY[]" onkeyup="amount()" style="text-align:center"  class="form-control enter_cal" 
                 id="qty<?=$values["Product_ID"];?>" value="<?=$values["qty"];?>" data-Product_ID="<?=$values["Product_ID"];?>" ></td>	
			<td align="right">
			<input type="text" name="Price[]" onkeyup="amount()" class="form-control enter_cal"  data-Product_ID="<?=$values["Product_ID"];?>"
                 id="Price<?=$values["Product_ID"];?>" style="text-align:right;" value="<?=@number_format($values["s1_price"],0);?>" >
			</td>			
			<td align="right"> 
            <input type="text" name="amount[]" class="form-control " 
                 id="amount<?=$values["Product_ID"];?>" style="text-align:right;" value="<?=@number_format($values["qty"] * $values["s1_price"],0);?>" readonly="readonly" >
			</td>
			
						
           <input type="hidden" name="Product_ID[]"   value="<?=$values["Product_ID"];?>">
	       <input type="hidden" name="crate_price[]" id="crate_price<?=$values["Product_ID"];?>" value="<?=$values["crate_price"];?>" >
	       <input type="hidden" name="e_name<?=$values["Product_ID"];?>" id="e_name<?=$values["Product_ID"];?>" value="<?=$values["product_name"];?>">
				<td align="right"> 
          
            <input type="text" name="amount_crate[]" class="form-control " 
                 id="amount_crate<?=$values["Product_ID"];?>" style="text-align:right;" value="<?=@number_format($values["qty"] * $values["crate_price"],0);?>" readonly="readonly" >
			</td>
			<td>
         <input type="text" name="remark[]"  style="text-align:right;" class="form-control enter_cal" id="remark<?=$values["Product_ID"];?>" value="<?=$values["remark"];?>" data-Product_ID="<?=$values["Product_ID"];?>" >
           <!-- <input type="button" name="delete"  class="btn btn-danger btn-sm delete_or" id="<?= $values["Product_ID"];?>" value="ລົບ">-->
			</td>
		</tr>
		<?php
		@$total_qty +=$values["qty"];
		@$total_price +=$values["qty"] * $values["s1_price"];
		@$total_crate_price +=$values["qty"] * $values["crate_price"];
		@$total_item = $total_item + 1;
	}
	?>
	<tr>  
        <td colspan="4" align="center">ລວມມູນຄ່າ <br />Grand Total</td>      
        <td align="center"><strong>
        <input type="text" class="btn btn-sm" readonly="readonly" name="total_qty" id="total_qty" style="text-align:center;"
         value="<?=@number_format($total_qty,0);?>"  />
        </strong></td>
          
        <td align="right"><strong>
        <input type="text" class="btn btn-sm" readonly="readonly" name="ddd" id="ddd" style="text-align:right;"  />
        </strong></td>
         <td align="right"><strong>
        <input type="text" class="btn btn-sm" readonly="readonly" name="total_all" id="total_all" style="text-align:right;"
         value="<?=@number_format($total_price,0);?>"  />
        </strong></td>
          
        <td align="right"><strong>
        <input type="text" class="btn btn-sm" readonly="readonly" name="total_crate_price" id="total_crate_price" style="text-align:right;"
         value="<?=@number_format($total_crate_price,0);?>"  />
        </strong></td>
         <td align="right"><strong>
        <input type="text" class="btn btn-sm" readonly="readonly" name="last_total" id="last_total" style="text-align:right;"
         value="<?=@number_format($total_price+$total_crate_price,0);?>"  />
        </strong></td> 
    </tr>
	<?php
}
else
{
	?>
    <tr>
    	<td colspan="9" align="center">
    		ບໍ່ມີລາຍການ
    	</td>
    </tr>
    <?php
}
?>  
</table>