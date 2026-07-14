<?php

include('init.php');

$total_price = 0;
$total_item = 0;

 
	
?>

	<table class="table" align="center" style="max-width:1250px; " >
		<tr align="center" class="bgtd"> 
       
      <th align="center" >ຮູບ</th> 
		<th align="center" >ລາຍການ</th> 
         <th align="center">ຫົວໜ່ວຍ</th>  
            <th align="center">ຈຳນວນ</th>
            <th align="center">ໃນສາງ</th> 
            <th align="center">ລາຄາ</th>  
            
            <th align="center">ມູນຄ່າ</th> 
            
          <!--  <th align="center">ເປັນເງີນ</th> 
            <th align="center">ລັງເປົ່າ</th> -->
             
       
           <!-- <th align="center">ລົບ</th>  -->
        </tr>
		<?php
if(!empty($_SESSION["cart_receipt_crate"]))
{      
         $e=1;
	foreach($_SESSION["cart_receipt_crate"] as $keys => $values)
	{
		
	?>
		<tr>
        
       <td align="center" ><img src="<?php echo $values["pic"];?>" height="60" /></td>
		    <td ><strong><?php echo $values["Product_ID"];?></strong> &nbsp; <?php echo $values["product_name"];?></td>
            <td align="center"><?php echo $values["units"];?></td>	
			<td align="center">
        <button type="button" class="btn btn-danger btn-sm qty_minus" data-Product_ID="<?php echo $values["Product_ID"];?>">-</button>
 <input type="text" name="QTY[]" style="text-align:center; max-width:40px; "   id="e_qty<?php echo $values["Product_ID"];?>"  class="qtu_box qty_enters "
        value="<?php echo $values["product_quantity"];?>"   data-Product_ID="<?php echo $values["Product_ID"];?>"  onkeyup="amount()" >
       <button type="button" class="btn btn-success btn-sm qty_plus" data-Product_ID="<?php echo $values["Product_ID"];?>">+</button>
       </td>
       	
       <td align="center"><?php echo @number_format($values["qty_limit"],0);?></td>	
             
             
	   <td align="right"><?php echo @number_format($values["product_price"],0);?>
       <input type="hidden" name="Price[]" style="text-align:right; max-width:80px;"  class="form-control  btn-sm price qty_enters" id="e_price<?php echo $values["Product_ID"];?>"  value="<?php echo @number_format($values["product_price"],0);?>" onkeyup="amount()" data-Product_ID="<?php echo $values["Product_ID"];?>" ></td>	
	   
		
          <td align="right"> 
           <input type="text" name="amount[]" style="text-align:right;max-width:100px;" class="form-control " id="amount<?php echo $values["Product_ID"];?>"  value="<?php echo @number_format($values["product_quantity"] * $values["product_price"], 0);   ?>" readonly >
           
            </td>
                 			
		
         
         <input type="hidden" class=" form-control text_right"  name="total_amount[]" id="total_amount" value="<?php echo @number_format($values["product_quantity"] * $values["product_price"],0);?>" readonly="readonly" />
           
		 <input type="hidden" name="total_amount_crate[]"id="total_amount_crate<?php echo $values["Product_ID"];?>"
             value="<?php echo @number_format(($values["product_quantity"] * $values["product_price"])+($values["product_quantity"] * $values["crate_price"]),0); ?>" 
             readonly="readonly"   class="form-control"  style="text-align:right;"  >
			
	<input type="hidden"  name="qty_limit[]" id="qty_limit<?php echo $values["Product_ID"];?>"  value="<?php echo $values["qty_limit"];?>">			
				
   
	<input type="hidden" name="Product_ID[]" id="Product_ID<?php echo $values["Product_ID"];?>"  value="<?php echo $values["Product_ID"];?>">	
	<input type="hidden" name="e_name<?php echo $values["Product_ID"];?>" id="e_name<?php echo $values["Product_ID"];?>" value="<?php echo $values["product_name"];?>">
    
    <input type="hidden" name="crate_price[]" id="crate_price<?php echo $values["Product_ID"];?>" value="<?php echo $values["crate_price"];?>">
   
            
            <input type="hidden" name="amount_crate[]" style="text-align:right;max-width:100px;" class="form-control " id="amount_crate<?php echo $values["Product_ID"];?>"  value="<?php echo @number_format($values["product_quantity"] * $values["crate_price"], 0);   ?>" readonly >
           
   
     <input type="hidden" class=" form-control text_right" name="percent_dis[]" id="percent_dis" value="0" onkeyup="discount_per()"   />
    
     	
	<input type="hidden" class=" form-control text_right"  name="discount[]"  id="discount" value="0" onkeyup="discount_d()" />		
   
     
     
     
   
	
				
		</tr>
		<?php
		@$total_price += $values["product_quantity"] * $values["product_price"];
		$total_item = $total_item + 1;
		@$total_qty+=$values["product_quantity"];
		@$total_crate_price += $values["product_quantity"] * $values["crate_price"];
		$e++;
		
		@$total_qty_limit+=$values["qty_limit"];
	}
	?>
	<tr>  
        <td colspan="3" align="right"><strong>ລວມ</strong></td>  
        
        <td align="center"><strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_qty" id="total_qty" 
        value="<?php echo @number_format($total_qty,0);?>" style="text-align:center; max-width:120px;" />
        </strong></td> 
        <td align="center"><?php echo @number_format($total_qty_limit,0); ?></td>
         <td></td>
            <td align="right"><strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_all" id="total_all" value="<?php echo number_format($total_price,0);?>" style="text-align:right; max-width:120px;" />
      <input type="hidden" class="btn btn-sm" readonly="readonly" name="total_all_amount" id="total_all_amount" value="<?php echo number_format($total_price,0);?>" />
        </strong></td> 
        
        
          <strong><input type="hidden" class="btn btn-sm" readonly="readonly" name="last_total" id="last_total" value="<?php echo @number_format($total_price+$total_crate_price,0);?>" style="text-align:right; max-width:120px;" />
      
        </strong><strong><input type="hidden" class="btn btn-sm" readonly="readonly" name="total_crate_price" id="total_crate_price" value="<?php echo number_format($total_crate_price,0);?>" style="text-align:right; max-width:120px;" />
      
        </strong>
        
     
        
    </tr>
	<?php
}
else
{
	?>
    <tr>
    	<td colspan="5" align="center">
    	<div>	ບໍ່ມີລາຍການຂາຍ</div>
    	</td>
    </tr>
   <?
}
?>
</table>

