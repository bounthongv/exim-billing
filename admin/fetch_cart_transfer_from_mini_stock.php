<?php

//fetch_cart.php

include('init.php');

$total_price = 0;
$total_item = 0;

?>

	<table class="table table-bordered ">
		<tr align="center">  
		<th align="center">ລະຫັດສິນຄ້າ</th>
            <th  align="center">ລາຍການສິນຄ້າ</th>  
            <th align="center">ຈຳນວນ</th>  
            <th   align="center">ລາຄາ</th>  
            <th align="center">ເປັນເງີນ</th>  
            <th align="center">ລົບ</th>  
        </tr>
		<?php
if(!empty($_SESSION["cart_trnasfer_from_mini_stock"]))
{      
         $e=1;
	foreach($_SESSION["cart_trnasfer_from_mini_stock"] as $keys => $values)
	{
		
	?>
		<tr>
		    <td><?=$values["product_lot_id"];?></td>
			<td><?=$values["Product_ID"];?>&nbsp;<?=$values["product_name"];?></td>
			<td>
       <input type="text" name="QTY[]" style="text-align:center" onkeydown="return event.key !='Enter';" class="form-control btn-sm " id="e_qty<?=$e;?>"  value="<?=$values["product_quantity"];?>"    onkeyup="amount()" ></td>	
	   <td>
       <input type="text" name="Price[]" style="text-align:center" onkeydown="return event.key != 'Enter';" class="form-control  btn-sm" id="e_price<?=$e;?>"  value="<?=@number_format($values["product_price"],2);?>" onkeyup="amount()" ></td>	
	   
					
			<td align="right"><input type="text" name="amount[]" style="text-align:center" class="form-control  btn-sm" id="amount<?=$e;?>"  value="<?=@number_format($values["product_quantity"] * $values["product_price"], 2);?>" readonly ></td>
			
			
	<input type="hidden" name="qty_limit[]" id="qty_limit<?=$e;?>"  value="<?=$values["qty_limit"];?>">			
	<input type="hidden" name="product_lot_id[]" id="product_lot_id<?=$e;?>"  value="<?=$values["product_lot_id"];?>">				
   
	<input type="hidden" name="Product_ID[]" id="Product_ID<?=$e;?>"  value="<?=$values["Product_ID"];?>">	
	<input type="hidden" name="e_name<?=$values["Product_ID"];?>" id="e_name<?=$e;?>" value="<?=$values["product_name"];?>">			
	
	<td><button type="button" name="delete"  class="btn btn-danger btn-sm delete_or" id="<?= $values["Product_ID"];?>" 
	value="<?= $values["product_lot_id"];?>">ລົບ</button>
	
	<input type="hidden" name="eee"  class="btn btn-success btn-sm  edit_cart_qty" id="<?=$e;?>" data-toggle="modal" data-target="#edit_cart" value="ແກ້ໄຂ" >
	
			</td>
		</tr>
		<?php
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
		$total_item = $total_item + 1;
		$e++;
	}
	?>
	<tr>  
        <td colspan="4" align="right"><strong>ລວມ</strong></td>  
        <td align="right"><strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_all" id="total_all" value="<?=number_format($total_price, 2);?>"  />
        </strong></td>  
        <td></td>  
    </tr>
	<?php
}
else
{
	?>
    <tr>
    	<td colspan="6" align="center">
    	<div>	ບໍ່ມີລາຍການຂາຍ</div>
    	</td>
    </tr>
   <?
}
?>
</table>
