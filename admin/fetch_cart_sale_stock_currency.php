<?php



include('init.php');

$total_price = 0;
$total_item = 0;


if(isset($_SESSION['cur'])){
	  $cur=$_SESSION['cur'];
	  $cur_name=$_SESSION['cur_name'];
	   }
else{ 
	  $cur='1';
	  $cur_name='LAK';
	} 
	
?>

	<table class="table table-bordered ">
		<tr align="center" class="bgtd">  
		<th align="center" >ລະຫັດ</th>
            <th  align="center">ລາຍການ</th>  
            <th align="center">ຈຳນວນ</th>  
            <th   align="center">ລາຄາ</th>  
            <th align="center">ເປັນເງີນ</th>  
            <th align="center">%ສ່ວນຫຼຸດ</th> 
            <th align="center">#ສ່ວນຫຼຸດ</th> 
            <th align="center">ມູນຄ່າສູດທິ</th> 
            <th align="center">ລົບ</th>  
        </tr>
		<?php
if(!empty($_SESSION["cart_sale_stock"]))
{      
         $e=1;
	foreach($_SESSION["cart_sale_stock"] as $keys => $values)
	{
		
	?>
		<tr>
		    <td><?=$values["Product_ID"];?></td>
			<td><?=$values["product_name"];?></td>
			<td>
       <input type="text" name="QTY[]" style="text-align:center" onkeydown="return event.key != 'Enter';" class="form-control btn-sm " id="e_qty<?=$e;?>"  value="<?=$values["product_quantity"];?>"    onkeyup="amount()" ></td>	
	   <td>
       <input type="text" name="Price[]" style="text-align:center" onkeydown="return event.key != 'Enter';" class="form-control  btn-sm" id="e_price<?=$e;?>"  value="<?=@number_format($values["product_price"],2);?>" onkeyup="amount()" ></td>	
	   
					
			<td align="right">
            <div class="input-group input-group-sm">
            <input type="text" name="amount[]" style="text-align:right" class="form-control text_right btn-sm" id="amount<?=$e;?>"  value="<?=@number_format(($values["product_quantity"] * $values["product_price"])/$cur, 2);   ?>" readonly >
			<span class="input-group-addon"><?php echo $cur_name;?></span>   
    </div>
			
	<input type="hidden"  name="qty_limit[]" id="qty_limit<?=$e;?>"  value="<?=$values["qty_limit"];?>">			
				
   
	<input type="hidden" name="Product_ID[]" id="Product_ID<?=$e;?>"  value="<?=$values["Product_ID"];?>">	
	<input type="hidden" name="e_name<?=$values["Product_ID"];?>" id="e_name<?=$e;?>" value="<?=$values["product_name"];?>">
    </td>
     <td>
     <div class="input-group input-group-sm">
     <input type="text" class=" form-control text_right" name="percent_dis[]" onkeydown="return event.key != 'Enter';" id="percent_dis" value="0" onkeyup="discount_per()"   />
     <span class="input-group-addon">%</span>   
    </div>
     </td>	
	 <td><input type="text" class=" form-control text_right" onkeydown="return event.key != 'Enter';"  name="discount[]"  id="discount" value="0" onkeyup="discount_d()" /></td>		
     <td>
     
     <input type="text" class=" form-control text_right"  name="total_amount[]" onkeydown="return event.key != 'Enter';" id="total_amount" value="<?=@number_format($values["product_quantity"] * $values["product_price"]/$cur, 2);?>" readonly="readonly" />
     
     </td>		
	<td><button type="button" name="delete"  class="btn btn-danger btn-sm delete_or" onkeydown="return event.key != 'Enter';" id="<?= $values["Product_ID"];?>" 
	value="<?= $values["Product_ID"];?>">ລົບ</button>
	
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
        <td align="right"><strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_all" id="total_all" value="<?=number_format($total_price/$cur, 2);?>"  />
        </strong></td>  
        <td align="right" colspan="2"><strong>ມູນຄ່າລວມສຸດທິ</strong></td> 
        <td align="right"><strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_all_amount" id="total_all_amount" value="<?=number_format($total_price/$cur, 2);?>" />
        </strong></td> 
        <td></td>  
    </tr>
	<?php
}
else
{
	?>
    <tr>
    	<td colspan="9" align="center">
    	<div>	ບໍ່ມີລາຍການຂາຍ</div>
    	</td>
    </tr>
   <?
}
?>
</table>

