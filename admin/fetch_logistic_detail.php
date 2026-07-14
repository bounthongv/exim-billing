<?php 
  include("init.php");
    
   
 
           @$order_id= mysqli_real_escape_string($con,$_POST['order_id']);		   
		 if($order_id==''){$or_id="";}  else{ $or_id="where  product_customer_order.sale_id='$order_id' ";}
if($order_id==''){}else{
		  
		  @$sp=mysqli_query($con,"
       SELECT logistics.*,sum(logistics.qty) as total_row
			
		  ,customers.customer_name,customers.phone ,routes.route_name
		  FROM logistics
		   
		    left join product_customer_order on logistics.order_id=product_customer_order.sale_id
		    left join customers on product_customer_order.customer_id=customers.customer_id
			left join routes on logistics.route_id=routes.route_id
			
		  where 1=1   $or_id 
		  
		   desc limit 100  ");
		  if($sp){
          
         ?>
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                	<th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>
                    <th align="center" >ຈຳນວນ</th>
                    <th align="center" >ຫົວຫນ່ວຍ</th>
                    
					<th align="center" >ລາຄາ</th>					
					<th align="center" >ເປັນເງີນ</th>
					<th align="center" >ລັງເປົ່າ</th>
					<th align="center" >ລວມມູນຄ່າ</th>
                    
                </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            
			?>	<tr>
			    <td align="center"><?php echo  $s["sale_id"]; ?></td>
				<td align="center"><?php echo  $s["sale_date"]; ?></td>
            	<td align="left"><?php echo  $s["Product_ID"]; ?>&nbsp;<?php echo $s["Product_Name"]; ?></td>
                <td align="center"><?php echo $s["qty"]; ?> </td>
            	<td align="center"><?php echo  $s["Unit"]; ?></td>
				
                <td align="center"><?php echo  @number_format($s["price"],0); ?></td>
				<td align="right"><?php echo  @number_format($s["amount"],0); ?></td>
				<td align="right"><?php echo  @number_format($s["amount_crate"],0); ?></td>
				<td align="right"><?php echo  @number_format($s["last_amount"],0); ?></td>
				</tr>
               <?php
            	@$t_amount+=$s["amount"];
				@$t_amount_crate+=$s["amount_crate"];
				@$t_last_amount+=$s["last_amount"];
             } 

	   
	    ?>  <tr>
		<td align="right" colspan="6">ລວມ</td>
		<td align="right"><?php echo @number_format($t_amount,0); ?></td>
		<td align="right"><?php echo @number_format($t_amount_crate,0); ?></td>
		<td align="right"><?php echo @number_format($t_last_amount,0); ?></td>
		              </tr>';
		      </table><?php
          } 
		 
}



 
 
 ?>
