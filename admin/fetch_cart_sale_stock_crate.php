<?php
include('init.php');

$total_price = 0;
$total_item = 0;

?>
	<table class="table table-bordered " >
		    <tr align="center" class="bgtd">  
            
		    <td align="center" ><strong>ລະຫັດ</strong></td>
            <td  align="center"><strong>ລາຍການ</strong></td>  
            <td align="center"><strong>ຈຳນວນ</strong></td>  
            <td   align="center"><strong>ລາຄາ</strong></td>  
            <td align="center"><strong>ເປັນເງີນ</strong></td>  
            <td align="center"><strong>%ສ່ວນຫຼຸດ</strong></td> 
            <td align="center"><strong>#ສ່ວນຫຼຸດ</strong></td> 
            <td align="center"><strong>ມູນຄ່າສູດທິ</strong></td>
           
            <td align="center">ລົບ</td>  
        </tr>
		<?php
if(!empty($_SESSION["cart_sale_stock_crate"]))
{      
         $e=1;
	foreach($_SESSION["cart_sale_stock_crate"] as $keys => $values)
	{
		
	?>
		<tr>
		    <td><?=$values["Product_ID"];?></td>
			<td><?=$values["product_name"];?></td>
			<td>
       <input type="text" name="QTY[]" style="text-align:center"  class="form-control btn-sm number qty_enters" id="e_qty<?=$values["Product_ID"];?>" data-Product_ID="<?=$values["Product_ID"];?>"   value="<?=$values["product_quantity"];?>"     ></td>	
	   <td>
       <input type="text" name="Price[]" style="text-align:right; width:110px;"  class="form-control  btn-sm number qty_enters" id="e_price<?=$values["Product_ID"];?>"  data-Product_ID="<?=$values["Product_ID"];?>"  value="<?=@number_format($values["product_price"],2);?>" onkeyup="amount()" ></td>	
	   
					
			<td align="right">
            
            <input type="text" name="amount[]" style="text-align:right"  class="form-control text_right btn-sm" id="amount<?=$values["Product_ID"];?>"  value="<?=@number_format($values["product_quantity"] * $values["product_price"], 2);   ?>" readonly >
		
			
	<input type="hidden"  name="qty_limit[]" id="qty_limit<?=$values["Product_ID"];?>"  value="<?=$values["qty_limit"];?>">			
				
   
	<input type="hidden" name="Product_ID[]" id="Product_ID<?=$values["Product_ID"];?>"  value="<?=$values["Product_ID"];?>">	
	<input type="hidden" name="e_name<?=$values["Product_ID"];?>" id="e_name<?=$values["Product_ID"];?>" value="<?=$values["product_name"];?>">
    </td>
     <td >
  
     <input type="text" class=" form-control number qty_enters" style="text-align:right;" name="percent_dis[]"  id="percent_dis<?=$values["Product_ID"];?>" data-Product_ID="<?=$values["Product_ID"];?>"  value="<?php echo @number_format($values['dis_per'],2);?>" onkeyup="discount_per()"   />
    
     </td>	
	 <td align="right"><input type="text" class=" form-control number discount_enter" style="text-align:right; width:110px;"  name="discount[]"   id="discount<?=$values["Product_ID"];?>" data-Product_ID="<?=$values["Product_ID"];?>"  value="<?php echo @number_format($values['dis_amount'],2);?>" onkeyup="discount_d()" /></td>		
     <td align="right">
     
     <input type="text" class=" form-control" style="text-align:right; width:auto;"  name="total_amount[]" id="total_amount" value="<?=@number_format(($values["product_quantity"] * $values["product_price"])-$values['dis_amount'], 2);?>" readonly="readonly" />
     
     </td>	
     	
	<td align="right"><button type="button" name="delete"  class="btn btn-danger btn-sm delete_or" id="<?= $values["Product_ID"];?>" 
	value="<?= $values["Product_ID"];?>">ລົບ</button>
	
	<input type="hidden" name="eee"  class="btn btn-success btn-sm  edit_cart_qty" id="<?=$values["Product_ID"];?>" data-toggle="modal" data-target="#edit_cart" value="ແກ້ໄຂ" >
	
			</td>
		</tr>
		<?php
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
	   @$total_all_amount = $total_all_amount + ($values["product_quantity"] * $values["product_price"]-$values['dis_amount']);
	   
		$total_item = $total_item + 1;
		
		@$total_all_dis+=$values['dis_amount'];
		$e++;
	}
	?>
	<tr>  
        <td colspan="4" align="right"><strong>ລວມ</strong></td>  
        <td align="right"><strong>
  <input type="text" class="btn btn-sm" style="text-align:right;" readonly="readonly" name="total_all" id="total_all" value="<?=number_format(@$total_price, 2);?>"  />
        </strong></td>  
        <td align="right" colspan="1"><strong>ລວມສຸດທິ</strong></td> 
        <td align="right"><strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_all_dis" id="total_all_dis" value="<?=@number_format( @$total_all_dis, 2);?>" style="text-align:right; width:110px;" />
        </strong></td>
        <td align="right"><strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_all_amount" id="total_all_amount" value="<?=@number_format(@$_SESSION['total_all_amount']=$total_all_amount, 2);?>"  style="text-align:right" />
        </strong></td> 
        <td colspan="2"></td>  
    </tr>
	<?php
	
	 @$_SESSION['total']=$total_all_amount-$_SESSION['all_dis'];
}
else
{
	?>
    <tr>
    	<td colspan="10" align="center">
    	<div>	ບໍ່ມີລາຍການຂາຍ</div>
    	</td>
    </tr>
   <?
}
?>
</table>
<script>
 $('input.number').keyup(function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
 $(this).val(function(index, value) {
      value = value.replace(/,/g,''); // remove commas from existing input
      return numberWithCommas(value); // add commas back in
  });
});

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
</script>
