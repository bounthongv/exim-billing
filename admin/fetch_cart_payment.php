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

           
            <th align="center">ລົບ</th>  
        </tr>
<?php
if(!empty($_SESSION["cart_payment"]))
{      
         $e=0;
	foreach($_SESSION["cart_payment"] as $keys => $values)
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
	

<td align="center"><?php echo @number_format($values["amount"],0); ?></td>

   




   <input type="hidden" name="sale_id[]"  id="sale_id<?php echo $values["list_id"]; ?>" value="<?php echo $values["sale_id"]; ?>"  >
   <input type="hidden" name="sale_date[]"  id="sale_date<?php echo $values["list_id"]; ?>" value="<?php echo $values["sale_date"]; ?>"  >		
   <input type="hidden" name="amount[]"  id="amount<?php echo $values["list_id"]; ?>" value="<?php echo $values["amount"]; ?>"  >	


	<td align="center"><button type="button" name="delete"  class="btn btn-danger btn-sm delete_or" id="<?php echo  $values["sale_id"]; ?>" 
	value="<?php echo  $values["sale_id"]; ?>">ລົບ</button>

	
			</td>
		</tr>
		<?php
		@$total_all+= $values["amount"];
		
	}
	?>
	<tr>  
        <td colspan="3" align="right">ລວມ</td>  
        <td align="center">
    <?php echo @number_format($total_all,0); ?>
        </td> 




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