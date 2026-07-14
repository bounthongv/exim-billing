<?php

//fetch_cart.php

include('init.php');

$total_price = 0;
$total_item = 0;

?>

	<table class="table table-bordered ">
		<tr>  
            <th width="40%" align="center">ລາຍການສິນຄ້າ</th>  
            <th width="10%" align="center">ຈຳນວນ</th>  
            <th width="20%" align="center">ລາຄາ</th>  
            <th width="15%" align="center">ເປັນເງີນ</th>  
            <th width="5%" align="center">ລົບ</th>  
        </tr>
<?php
if(!empty($_SESSION["cart_edit_product_receipt"]))
{
	foreach($_SESSION["cart_edit_product_receipt"] as $keys => $values)
	{
		?>
		<tr>
			<td><?=$values["Product_ID"];?>&nbsp;<?=$values["product_name"];?></td>
			<td>
            <input type="text" name="QTY[]" onkeyup="amount()" style="text-align:center" class="form-control edit_cart" 
                 id="<?=$values["Product_ID"];?>" value="<?=$values["product_quantity"];?>" ></td>	
			<td align="right">
			<input type="text" name="Price[]" onkeyup="amount()" class="form-control edit_cart" 
                 id="Price<?=$values["Product_ID"];?>" style="text-align:right;" value="<?=@number_format($values["product_price"],2);?>" >
			</td>			
			<td align="right"> 
            <input type="text" name="amount[]" class="form-control edit_cart" 
                 id="amount<?=$values["Product_ID"];?>" style="text-align:right;" value="<?=@number_format($values["product_quantity"] * $values["product_price"], 2);?>" readonly="readonly" >
			</td>
			
						
           <input type="hidden" name="Product_ID[]"  value="<?=$values["Product_ID"];?>">
	
	       <input type="hidden" name="e_name<?=$values["Product_ID"];?>" id="e_name<?=$values["Product_ID"];?>" value="<?=$values["product_name"];?>">
			
			<td><input type="button" name="delete"  class="btn btn-danger btn-sm delete_or" id="<?= $values["Product_ID"];?>" value="ລົບ">
			</td>
		</tr>
		<?php
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
		$total_item = $total_item + 1;
	}
	?>
	<tr>  
        <td colspan="3" align="right">ລວມ</td>        
        <td align="right"><strong>
        <input type="text" class="btn btn-sm" readonly="readonly" name="total_all" id="total_all" style="text-align:right;"
         value="<?=number_format($total_price, 2);?>"  />
        </strong></td>
        <td></td>  
    </tr>
	<?php
}
else
{
	?>
    <tr>
    	<td colspan="5" align="center">
    		ບໍ່ມີລາຍການ
    	</td>
    </tr>
    <?php
}
?>  
</table>
