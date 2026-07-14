<?php 
  include("init.php");
    
   
 
           @$order_id= mysqli_real_escape_string($con,$_POST['order_id']);		   
		 if($order_id==''){$or_id="";}  else{ $or_id="where  product_customer_order.sale_id='$order_id' ";}
if($order_id==''){}else{
		  
		  @$sp=mysqli_query($con,"
       SELECT product_customer_order.*,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit ,tb_groups.Group_Name
		   FROM  product_customer_order 
		left join products on products.Product_ID=product_customer_order.product_id
       left join stocks on stocks.stock_id=product_customer_order.stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id  
	   
	     $or_id  limit 50   ");
		  if($sp){
          
          $output ='
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                	<th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>
                    <th align="center" >ຈຳນວນ</th>
                    <th align="center" >ຫົວຫນ່ວຍ</th>
                    
					<th align="center" >ລາຄາ</th>					
					<th align="center" >ເປັນເງີນ</th>
					
                    
                </tr>
           ';
            while($s=mysqli_fetch_array($sp)){
            
			$output .='	<tr>
			    <td align="center">'. $s["sale_id"].'</td>
				<td align="center">'. $s["sale_date"].'</td>
            	<td align="left">'. $s["Product_ID"].'&nbsp;'.$s["Product_Name"].'</td>
                <td align="center">'.$s["qty"].' </td>
            	<td align="center">'. $s["Unit"].'</td>
				
                <td align="center">'. @number_format($s["price"],0).'</td>
				<td align="right">'. @number_format($s["amount"],0).'</td>
			
				</tr>
                ';
			  @$t_qty+=$s["qty"];
            	@$t_amount+=$s["amount"];
				@$t_amount_crate+=$s["amount_crate"];
				@$t_last_amount+=$s["last_amount"];
             } 

	   
	    $output .='  <tr>
		<td align="right" colspan="3">ລວມ</td>
		<td align="center">'.@number_format($t_qty,0).'</td>
          <td align="right"></td>
		<td align="right"></td>
		<td align="right">'.@number_format($t_amount,0).'</td>
	
		              </tr>';
		    $output .='   </table>';
          } 
		 
}

echo 	  $output; 

 
 
 ?>
