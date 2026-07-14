<?php 
  include("init.php");
   
   
         @$route_id= mysqli_real_escape_string($con,$_POST['route_id']);	
         if($route_id==''){$r_id="";}  else{ $r_id="and customers.route_id='$route_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and product_customer_order.sale_date between '$from_date' and '$to_date' ";}
		  
 
           @$order_id= mysqli_real_escape_string($con,$_POST['order_id']);		   
		 if($order_id==''){$s_id="";}  else{ $s_id="and  product_customer_order.sale_id='$order_id' ";}
		 
		  /* @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);		   
		 if($customer_id==''){$ct_id="";}  else{ $ct_id="and  product_customer_order.customer_id='$customer_id' ";}
*/
		  
		  @$sp=mysqli_query($con,"SELECT product_customer_order.*,sum(product_customer_order.qty) as total_row
		  
		  ,sum(product_customer_order.amount) as total_amount	
		  ,sum(product_customer_order.amount_crate) as total_amount_crate
		  ,sum(product_customer_order.last_amount) as total_last_amount		
		  ,customers.customer_name,customers.phone ,routes.route_name
		  FROM product_customer_order
		   
		    left join customers on product_customer_order.customer_id=customers.customer_id
			left join routes on customers.route_id=routes.route_id
			
		  where 1=1  $btw $r_id $ct_id $s_id
		  
		  group by product_customer_order.sale_id  order by product_customer_order.sale_id desc limit 100
	   
	          ");
		  if($sp){
          
         ?>
 		 <table border="1"   class="table-bordered " >
              <tr align="center">
                <th>ເລກທີ</th>
                <th>ວັນທີ</th>
                <th>ສາຍທາງ</th>
				
				<th>ຊື່ລູກຄ້າ</th>
				<th>ໂທ</th>
                <th>ຈຳນວນ</th>
                <th>ຈຳນວນເງີນ</th>
				 <th>ລັງເປົ່າ</th>
				  <th>ລວມມູນຄ່າ</th>
				 <th>ສະຖານະ</th>
                  <th>ເລືອກ<br />&nbsp;</th>
             
              </tr>
           <?PHP
            while($p=mysqli_fetch_array($sp)){
          //  $dd=date_create("$s[transfer_date]");
		  
		  if($p["status_sale"]=='1'){ $status="<button type='button' class='btn btn-warning btn-sm'>ລໍຖ້າ</button>"; }
		  else{ $status="<button type='button' class='btn btn-success btn-sm'>ຂາຍແລ້ວ</button>";}
			?>
			<tr>              
                <td><input type="button" name="show" id="<?php echo$p["sale_id"]; ?>" value="<?php echo$p["sale_id"]; ?>" class="btn show_detail btn-sm"
				data-toggle="modal" data-target="#pro_detail"  ></td>
               	<td align="center"><?php echo $p["sale_date"]; ?></td>
                <td align="center"><?php echo $p["route_name"]; ?></td>
				<td align="left"><?php echo $p["customer_name"]; ?></td>
				<td align="left"><?php echo $p["phone"]; ?></td>
                <td align="center"><?php echo $p["total_row"]; ?></td>
				 <td align="right"><?php echo number_format($p['total_amount'],0); ?></td>
				  <td align="right"><?php echo number_format($p['total_amount_crate'],0); ?></td>
                <td align="right"><?php echo number_format($p['total_last_amount'],0); ?></td>
				<td align="center"><?php echo $status; ?></td>
             <td>
      <?php if($p["status_logistic"]=='2'){?>
		  
	<button type="button" class="btn btn-info btn-sm "  id="<?php echo $p["sale_id"]; ?>" >ສົ່ງແລ້ວ</button>  
		<?php   }
		 else if($p["status_logistic"]=='1'){?>
		  
	<button type="button" class="btn btn-info btn-sm "  id="<?php echo $p["sale_id"]; ?>" >ເລືອກແລ້ວ</button>  
		<?php   } else{ ?>
       <button type="button" class="btn btn-success btn-sm add_pro" data-dismiss="modal" id="<?php echo $p["sale_id"]; ?>" 
       value="<?php echo $p["sale_id"]; ?>" data-customer_name="<?php echo $p["customer_name"]; ?>" >ເລືອກ</button>
       <?php } ?>
       </td>
              </tr>
             <?php  
				@$t_total_row+=$p["total_row"];
				@$t_total+=$p["total_amount"];
				@$t_amount_crate+=$p["total_amount_crate"];
				@$t_last_amount+=$p["total_last_amount"];
				
          } ?>
			  <tr>
		<td align="right" colspan="5">ລວມ</td>
		<td align="center"><?php echo@number_format($t_total_row,0); ?></td>
		<td align="right"><?php echo@number_format($t_total,0); ?></td>
		<td align="right"><?php echo@number_format($t_amount_crate,0); ?></td>
		<td align="right"><?php echo@number_format($t_last_amount,0); ?></td>
		<td align="right" colspan="2"></td>
		              </tr>
					  
         </table><?php
		  
          } 

 
 ?>
