<?php 
  include("init.php");
  
 
        @$action= mysqli_real_escape_string($con,$_POST['action']);	
		
		@$order_id= mysqli_real_escape_string($con,$_POST['order_id']);
	    @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);
	    @$customer_name= mysqli_real_escape_string($con,$_POST['customer_name']);
		@$customer_phone= mysqli_real_escape_string($con,$_POST['customer_phone']);	
		
				
        
		 if($order_id==''){$or_id="";}  else{ $or_id="and (product_customer_order.sale_id like '$order_id%' or product_customer_order.sale_id like '%$order_id%') ";}	   
		  if($customer_id==''){$c_id="";}  else{ $c_id="and (product_customer_order.customer_id like '$customer_id%' or product_customer_order.customer_id like '%$customer_id%') ";}
		  if($customer_name==''){$name="";}  else{ $name="and (customers.customer_name like '$customer_name%' or customers.customer_name like '%$customer_name%') ";}
		  if($customer_phone==''){$phone="";}  else{ $phone="and (customers.tel like '$customer_phone%' or customers.tel like '%$customer_phone%') ";}
		  
	
		  @$sp=mysqli_query($con,"SELECT product_customer_order.*,sum(product_customer_order.qty) as total_row
		  
		  ,sum(product_customer_order.amount) as total_amount	
		  ,sum(product_customer_order.amount_crate) as total_amount_crate
		  ,sum(product_customer_order.last_amount) as total_last_amount		
		  ,customers.customer_name,customers.customer_type,customers.phone ,routes.route_name,routes.route_id as route_ids
		  
		 ,customer_type.ct_name,routes.route_name
		 ,sr_list.sr_fname,sr_list.sr_lname
		  
		  FROM product_customer_order
		   
		    left join customers on product_customer_order.customer_id=customers.customer_id
			left join routes on customers.route_id=routes.route_id
			left join customer_type on customers.customer_type=customer_type.ct_id
			 left join sr_list on product_customer_order.sr=sr_list.sr_id
		  where 1=1 and product_customer_order.status_sale='1' $c_id $or_id $name $phone
		  
		  group by product_customer_order.sale_id  order by product_customer_order.sale_id desc limit 100
	   
	          ");
		 
          
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
              
              </tr>
          <?php
            while($p=mysqli_fetch_array($sp)){
          //  $dd=date_create("$s[transfer_date]");
		  
		  if($p["status_sale"]=='1'){ $status="<button type='button' class='btn btn-warning btn-sm'>ລໍຖ້າ</button>"; }
		  else{ $status="<button type='button' class='btn btn-success btn-sm'>ຂາຍແລ້ວ</button>";}
			?>
			<tr>              
  <td><input type="button" name="show" id="<?php echo $p["sale_id"]; ?>" value="<?php echo $p["sale_id"]; ?>" class="btn btn-success add_order btn-sm"
			data-customer_id="<?php echo $p['customer_id'];?>" data-customer_name="<?php echo $p['customer_name'];?>" data-customer_phone="<?php echo $p['phone'];?>" data-customer_address="<?php echo $p['address'];?>" 
          data-ct_id="<?php echo $p['customer_type'];?>" data-ct_name="<?php echo $p['ct_name'];?>"  data-route_id="<?php echo $p['route_ids'];?>" 
          data-route_name="<?php echo $p['route_name'];?>"
          data-sr_id="<?php echo $p['sr'];?>" data-sr_fname="<?php echo $p['sr_fname'];?>" data-sr_lname="<?php echo $p['sr_lname'];?>" 
          
           	data-toggle="modal" data-target="#pro_detail" data-dismiss="modal"  ></td>
               	<td align="center"><?php echo $p["sale_date"]; ?></td>
                <td align="center"><?php echo $p["route_name"]; ?></td>
				<td align="left"><?php echo $p["customer_name"]; ?></td>
				<td align="left"><?php echo $p["phone"]; ?></td>
                <td align="center"><?php echo $p["total_row"]; ?></td>
				 <td align="right"><?php echo  number_format($p['total_amount'],0); ?></td>
				  <td align="right"><?php echo  number_format($p['total_amount_crate'],0); ?></td>
                <td align="right"><?php echo  number_format($p['total_last_amount'],0); ?></td>
				<td align="center"><?php echo $status; ?></td>
             
              </tr>
               <?php
				@$t_total_row+=$p["total_row"];
				@$t_total+=$p["total_amount"];
				@$t_amount_crate+=$p["total_amount_crate"];
				@$t_last_amount+=$p["total_last_amount"];
				
             } 
			 
			?> <tr>
		<td align="right" colspan="5">ລວມ</td>
		<td align="center"><?php echo @number_format($t_total_row,0); ?></td>
		<td align="right"><?php echo @number_format($t_total,0); ?></td>
		<td align="right"><?php echo @number_format($t_amount_crate,0); ?></td>
		<td align="right"><?php echo @number_format($t_last_amount,0); ?></td>
		<td align="right" colspan="1"></td>
		              </tr>
					  
        </table>
     
		 