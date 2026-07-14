<?php

include('init.php');

$total_price = 0;
$total_item = 0;

 
/* if(!empty($_SESSION["cart_sale_customer_order"]))
{      
        
	foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
	{
		@$_SESSION["list_id"]=$values["list_id"]+1;
		
	}
}else{
	 @$list_id=1;
	 
	}*/
	
?><?php //echo $_SESSION["list_id"]; ?>

	<table class="table" align="center" style="max-width:1250px; " >
		<tr align="center" class="bgtd"> 
        <th align="center" >ລ/ດ</th> 
      <th align="center" >ຮູບ</th> 
		<th align="center" >ລາຍການ</th> 
         <th align="center">ຫົວໜ່ວຍ</th>  
            <th align="center">ຈຳນວນ</th> 
         <!--   <th align="center">Empty</th> -->
             <th align="center">ໃນສາງ</th> 
             <th align="center">ສັ່ງຊື້</th> 
            
            <th align="center">ລາຄາ</th>  
            <th align="center">ເປັນເງີນ</th> 
          <!--  <th align="center">ລັງເປົ່າ</th>  -->
            <th align="center">ແຖມ</th> 
       
          <th align="center">ລົບ</th> 
        </tr>
		<?php
if(!empty($_SESSION["cart_sale_customer_order"]))
{      
         $e=1;
	foreach($_SESSION["cart_sale_customer_order"] as $keys => $values)
	{
		
	?>
		<tr>
        <td align="center" ><?=$values["list_id"];?></td>
       <td align="center" ><img src="<?=$values["pic"];?>" height="50" /></td>
		    <td ><?=$values["Product_ID"];?> &nbsp; <?=$values["product_name"];?></td>
            <td align="center"><?=$values["units"];?></td>	
			<td align="center">
        <button type="button" class="btn btn-danger btn-sm qty_minus" data-Product_ID="<?=$values["list_id"];?>">-</button>
 <input type="text" name="QTY[]" style="text-align:center; max-width:40px; "   id="e_qty<?=$values["list_id"];?>"  class="qtu_box qty_enters "
        value="<?=$values["product_quantity"];?>"   data-Product_ID="<?=$values["list_id"];?>"  onkeyup="amount()" >
       <button type="button" class="btn btn-success btn-sm qty_plus" data-Product_ID="<?=$values["list_id"];?>">+</button>
       </td>
       <!-- <button type="button" class="btn btn-danger btn-sm qty_minus_c" data-Product_ID="<?=$values["list_id"];?>">-</button>-->
 <input type="hidden" name="crate_qty[]" style="text-align:center; max-width:40px; "   id="crate_qty<?=$values["list_id"];?>"  class="qtu_box qty_minus_c "
        value="<?=$values["crate_qty"];?>"   data-Product_ID="<?=$values["Product_ID"];?>"  onkeyup="amount()" >
       <!--<button type="button" class="btn btn-success btn-sm qty_plus_c" data-Product_ID="<?=$values["list_id"];?>">+</button>-->
      <!-- <td align="center">
       
       </td>-->
       
       
       	<td align="center"><?=@number_format($values["qty_limit"],0);?></td>	
        <td align="center"><?=@number_format($values["order_qty"],0);?></td>	
	   <td align="right"><?=@number_format($values["product_price"],0);?>
       <input type="hidden" name="Price[]" style="text-align:right; max-width:80px;"  class="form-control  btn-sm price qty_enters" id="e_price<?=$values["list_id"];?>"  value="<?=@number_format($values["product_price"],0);?>" onkeyup="amount()" data-Product_ID="<?=$values["Product_ID"];?>" ></td>	
	   
					
			<td align="right" >
            
            <input type="text" name="amount[]" style="text-align:right;max-width:100px;" class="form-control " id="amount<?=$values["list_id"];?>"  value="<?=@number_format(($values["product_quantity"]+$values["crate_qty"]) * $values["product_price"], 0);   ?>" readonly >
		
			
	<input type="hidden"  name="qty_limit[]" id="qty_limit<?=$values["list_id"];?>"  value="<?=$values["qty_limit"];?>">
    <input type="hidden"  name="Group_ID[]" id="Group_ID<?=$values["list_id"];?>"  value="<?=$values["Group_ID"];?>">			
				
   
	<input type="hidden" name="Product_ID[]" id="Product_ID<?=$values["list_id"];?>"  value="<?=$values["Product_ID"];?>">
    <input type="hidden" name="list_id[]" id="list_id<?=$values["list_id"];?>"  value="<?=$values["list_id"];?>">	
	<input type="hidden" name="e_name[]" id="e_name<?=$values["list_id"];?>" value="<?=$values["product_name"];?>">
    
    <input type="hidden" name="crate_price[]" id="crate_price<?=$values["list_id"];?>" value="<?=$values["crate_price"];?>">
    </td>
  
            
            <input type="hidden" name="amount_crate[]" style="text-align:right;max-width:100px;" class="form-control " id="amount_crate<?=$values["list_id"];?>"  value="<?=@number_format($values["product_quantity"] * $values["crate_price"], 0);   ?>" readonly >
         
   
     <input type="hidden" class=" form-control text_right" name="percent_dis[]" id="percent_dis" value="0" onkeyup="discount_per()"   />    	
	<input type="hidden" class=" form-control text_right"  name="discount[]"  id="discount" value="0" onkeyup="discount_d()" />   
     <input type="hidden" class=" form-control text_right"  name="total_amount[]" id="total_amount" value="<?=@number_format($values["product_quantity"] * $values["product_price"],0);?>" readonly="readonly" />
  			 
     <input type="hidden" name="total_amount_crate[]"id="total_amount_crate<?=$values["list_id"];?>"     
     value="<?=@number_format(($values["product_quantity"] * $values["product_price"])+($values["product_quantity"] * $values["crate_price"]),0); ?>" 
             readonly="readonly"   class="form-control"  style="text-align:right;"  >
             
       
        <td align="center">        
        <?php if($values['status_free']==''){ ?>
       <button type="button" name="free_p"  class="btn btn-sm free_item" id="<?=$values["list_id"];?>" 
	value="<?= $values["list_id"];?>"> <i class="fa fa-check free_item" aria-hidden="true"></i></button>
       
    <?php }else{ ?>
     <button type="button" name="free_p"  class="btn btn-success btn-sm" id="<?= $values["list_id"];?>" 
	value="<?= $values["list_id"];?>"><i class="fa fa-check" aria-hidden="true"></i> </button>
    <?php } ?>
    </td> 
    
    
      
       <td><button type="button" name="delete"  class="btn btn-danger btn-sm delete_or" id="<?= $values["list_id"];?>" 
	value="<?= $values["list_id"];?>"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
		</tr>
		<?php
		@$total_price += $values["product_quantity"] * $values["product_price"];
		$total_item = $total_item + 1;
		@$total_qty+=$values["product_quantity"];
		@$total_crate_price += $values["product_quantity"] * $values["crate_price"];
		
		@$total_qty_order+=$values["order_qty"];
		@$total_qty_limit+=$values["qty_limit"];
		@$total_crate_qty+=$values["crate_qty"];
		$e++;
	}
	?>
	<tr>  
        <td colspan="4" align="right"><strong>ລວມ</strong></td>  
        
        <td align="center"><strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_qty" id="total_qty" 
        value="<?=number_format($total_qty,0);?>" style="text-align:center; max-width:120px;" />
        </strong></td> 
        
       <!-- <td align="center"><strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_crate_qty" id="total_crate_qty" 
        value="<?=number_format($total_crate_qty,0);?>" style="text-align:center; max-width:120px;" />
        </strong></td> -->
       
        <td align="center"><?=@number_format($total_qty_limit,0);?></td>
        <td align="center"><?=@number_format($total_qty_order,0);?></td>
         <td></td>
        <td align="right"><strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_all" id="total_all" value="<?=number_format($total_price,0);?>" style="text-align:right; max-width:120px;" />
      <input type="hidden" class="btn btn-sm" readonly="readonly" name="total_all_amount" id="total_all_amount" value="<?=number_format($total_price,0);?>" />
        </strong></td> 
        
        
         <strong><input type="hidden" class="btn btn-sm" readonly="readonly" name="total_crate_price" id="total_crate_price" value="<?=number_format($total_crate_price,0);?>" style="text-align:right; max-width:120px;" />
      
        </strong>
        
       <strong><input type="hidden" class="btn btn-sm" readonly="readonly" name="last_total" id="last_total" value="<?=@number_format($total_price+$total_crate_price,0);?>" style="text-align:right; max-width:120px;" />
      
        </strong>
        <td></td>
        <td></td>
    </tr>
	<?php
}
else
{
	?>
    <tr>
    	<td colspan="7" align="center">
    	<div>	ບໍ່ມີລາຍການຂາຍ</div>
    	</td>
    </tr>
   <?
}
?>
</table>

