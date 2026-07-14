<?php


include('init.php');

$total_price = 0;
$total_item = 0;

?>
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
	<table class="table table-bordered ">
		<tr>  
		    <th align="center">ລ/ດ</th>
            <th align="center">ເລກບີນຂາຍ</th>
            <th align="center">ວັນທີຂາຍ</th>  
            <th align="center">ຈຳນວນເງີນ</th>
            <th align="center">ຈ່າຍແລ້ວ</th>
            <th align="center">ຍັງເຫຼືອ</th> 
           
            <th align="center">ລົບ</th>  
        </tr>
<?php
if(!empty($_SESSION["cart_receipt"]))
{      
         $e=0;
	foreach($_SESSION["cart_receipt"] as $keys => $values)
	{
		$e++;
		?>
		<tr>
             <td align="center"><?php echo $values["list_id"]; ?></td>
		    <td align="center"><?php echo $values["sale_id"]; ?></td>
			<td align="center"><?php $date_x=$values["sale_date"];
			$date=date_create($date_x);
        echo date_format($date,"d/m/Y");
			 ?></td>
			<td align="center">
  <input type="text" name="total[]" style="text-align:right;"  class="form-control qty_enters number" id="total<?php echo $values["list_id"]; ?>"
    value="<?php echo @number_format($values["total"],0); ?>"   data-Product_ID="<?php echo $values["list_id"]; ?>" readonly="readonly" ></td>	
    
    <td align="center">
  <input type="text" name="payment[]" style="text-align:right;"  class="form-control " id="payment<?php echo $values["list_id"]; ?>"
    value="<?php echo @number_format($values["payment"],0); ?>"   data-Product_ID="<?php echo $values["list_id"]; ?>" readonly="readonly" ></td>	
    <td align="center">
  <input type="text" name="remain[]" style="text-align:right;"  class="form-control " id="remain<?php echo $values["list_id"]; ?>"
    value="<?php echo @number_format($values["remain"],0); ?>"   data-Product_ID="<?php echo $values["list_id"]; ?>" readonly="readonly" ></td>	
   
   <input type="hidden" name="sale_id[]"  id="sale_id<?php echo $values["list_id"]; ?>" value="<?php echo $values["sale_id"]; ?>"  >
   <input type="hidden" name="sale_date[]"  id="sale_date<?php echo $values["list_id"]; ?>" value="<?php echo $values["sale_date"]; ?>"  >		
	
	<td align="center"><button type="button" name="delete"  class="btn btn-danger btn-sm delete_or" id="<?php echo  $values["sale_id"]; ?>" 
	value="<?php echo  $values["sale_id"]; ?>">ລົບ</button>

	
			</td>
		</tr>
		<?php
		@$total_all+= $values["total"];
		@$total_p+= $values["payment"];
		@$total_r+= $values["remain"];
		
	}
	?>
	<tr>  
        <td colspan="3" align="right">ລວມ</td>  
        <td align="right">
    <input type="text" name="total_all" style="text-align:right"  class="form-control " id="total_all" 
    value="<?php echo @number_format($total_all,0); ?>" readonly="readonly"  >
        </td> 
         <td align="right">
    <input type="text" name="total_r" style="text-align:right"  class="form-control " id="total_p" 
    value="<?php echo @number_format($total_p,0); ?>" readonly="readonly"  >
        </td> 
         <td align="right">
    <input type="text" name="total_r" style="text-align:right"  class="form-control " id="total_r" 
    value="<?php echo @number_format($total_r,0); ?>" readonly="readonly"  >
        </td>  
        <td></td>  
    </tr>
	<?php
}
else
{
	?>
    <tr>
    	<td colspan="7" align="center">
    		ບໍ່ມິລາຍການ
    	</td>
    </tr>
    <?php
}
?></table>