<?php
//fetch_cart.php

include('init.php');

$total_price = 0;
$total_item = 0;

$output = '

	<table class="table table-bordered ">
		<tr>  
		<th align="center">ລະຫັດສິນຄ້າ</th>
            <th  align="center">ລາຍການສິນຄ້າ</th>  
            <th align="center">ຈຳນວນ</th>  
            <th   align="center">ລາຄາ</th>  
            <th align="center">ເປັນເງີນ</th>  
            <th align="center">ລົບ</th>  
        </tr>
';
if(!empty($_SESSION["cart_edit_transfer_mini_stock"]))
{      
        
	foreach($_SESSION["cart_edit_transfer_mini_stock"] as $keys => $values)
	{
		
		$output .= '
		<tr>
		    <td>'.$values["Product_ID"].'</td>
			<td>'.$values["product_name"].'</td>
			<td>
       <input type="text" name="QTY[]" style="text-align:center" onkeydown="return event.key !=Enter" class="form-control btn-sm " id="e_qty'.$values["Product_ID"].'"  value="'.$values["product_quantity"].'"    onkeyup="amount()" ></td>	
	   <td>
       <input type="text" name="Price[]" style="text-align:center" onkeydown="return event.key !=Enter" class="form-control  btn-sm" id="e_price'.$values["Product_ID"].'"  value="'.@number_format($values["product_price"],2).'" onkeyup="amount()" readonly="readonly"></td>	
	   
					
			<td align="right"><input type="text" name="amount[]" style="text-align:center" class="form-control  btn-sm" id="amount'.$values["Product_ID"].'"  value="'.@number_format($values["product_quantity"] * $values["product_price"], 2).'" readonly ></td>
			
			
	<input type="hidden" name="qty_limit[]" id="qty_limit'.$values["Product_ID"].'"  value="'.@$values["qty_limit"].'">			
			
   
	<input type="hidden" name="Product_ID[]" id="Product_ID'.$values["Product_ID"].'"  value="'.$values["Product_ID"].'">	
	<input type="hidden" name="e_name'.$values["Product_ID"].'" id="e_name'.$values["Product_ID"].'" value="'.$values["product_name"].'">			
	
	<td><button type="button" name="delete"  class="btn btn-danger btn-sm delete_or" id="'. $values["Product_ID"].'" 
	value="'. $values["Product_ID"].'">ລົບ</button>
	
	<input type="hidden" name="eee"  class="btn btn-success btn-sm  edit_cart_qty" id="'.$values["Product_ID"].'" data-toggle="modal" data-target="#edit_cart" value="ແກ້ໄຂ" >
	
			</td>
		</tr>
		';
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
		$total_item = $total_item + 1;
		
	}
	$output .= '
	<tr>  
        <td colspan="4" align="right">ລວມ</td>  
        <td align="right">'.number_format($total_price, 2).'</td>  
        <td></td>  
    </tr>
	';
}
else
{
	$output .= '
    <tr>
    	<td colspan="6" align="center">
    		ລາຍການຫວ່າງ
    	</td>
    </tr>
    ';
}
$output .= '</table>';


echo $output;

?>