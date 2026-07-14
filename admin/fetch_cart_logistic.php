<?php

include('init.php');

$total_price = 0;
$total_item = 0;

 
	
?>

	<table class="table" align="center" style="max-width:1250px; " >
		<tr align="center" class="bgtd"> 
        
        <th align="center" >ລ/ດ</th> 
        <th align="center" >ເລກທີໃບສັ່ງຊື້</th> 
		<th align="center" >ຊື່ລູກຄ້າ</th> 
      		<?php
       $sql=mysqli_query($con,"select * from products where Group_ID='001' order by Product_ID");
	   while($p=mysqli_fetch_array($sql)){
	?>  
         <th align="center"><?php echo $p['Product_ID']; ?></th>  
         <?php } ?>   
    
           <th align="center">ລົບ</th> 
        </tr>
		<?php
if(!empty($_SESSION["cart_logistic"]))
{      
         $e=1;
	foreach($_SESSION["cart_logistic"] as $keys => $values)
	{
		
		//echo $values["sale_id"];
		
		
	?>
		<tr>
        <td align="center" ><?=$e;?></td>
     <input type="hidden" name="sale_id[]" value="<?=$values["sale_id"];?>"  />
     <input type="hidden" name="sale_date[]" value="<?=$values["sale_date"];?>"  />
		    <td ><?=$values["sale_id"];?></td>
            <td align="center"><?=$values["customer_name"];?></td>	
            
		<?php
       $sql=mysqli_query($con," select products.Product_ID,products.Product_Name ,tb_product_order.order_qty
      
      from products 
      left join (select sum(qty) as order_qty,product_id from product_customer_order 
      where 1=1 and sale_id='".$values["sale_id"]."' group by product_id ) as tb_product_order
                 on products.Product_ID=tb_product_order.product_id
      
      where Group_ID='001' order by Product_ID  ");
	   while($f=mysqli_fetch_array($sql)){
	?>  
         
         
       	<td align="center"><?=@number_format($f["order_qty"],0);?></td>	
    
   <?php
   
     //   @$total_ordre_qty+=$f["order_qty"];
    } ?>
        <td align="center"><button type="button" name="delete"  class="btn btn-danger btn-sm delete_or" id="<?= $values["sale_id"];?>" 
	value="<?= $values["sale_id"];?>">ລົບ</button></td>	
		</tr>
		<?php
		
		$e++;
	}
	?>
	<tr>  
        <td colspan="3" align="right"><strong>ລວມ</strong></td>  
        
    <?php
	    //echo $_SESSION['cart_name'];
       $select='select products.Product_ID,products.Product_Name ,tb_product_order.order_qty
      
      from products 
      left join (select sum(qty) as order_qty,product_id from product_customer_order 
      where 1=1 and sale_id in (""'.$_SESSION["cart_name"].' ) group by product_id ) as tb_product_order
                 on products.Product_ID=tb_product_order.product_id
      
      where Group_ID="001" order by Product_ID ';
	  
	  $sql=mysqli_query($con,$select);
	   while($f=mysqli_fetch_array($sql)){
	?>  
         
         
       	<td align="center"><?=@number_format($f["order_qty"],0);?></td>	
    
   
         <?php } ?>  

      
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

