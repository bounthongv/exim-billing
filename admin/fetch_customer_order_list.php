<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_customer_order.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and product_customer_order.sale_date between '$from_date' and '$to_date' ";}
		  
 
           @$order_id= mysqli_real_escape_string($con,$_POST['order_id']);		   
		 if($order_id==''){$r_id="";}  else{ $r_id="and  product_customer_order.sale_id='$order_id' ";}
		 
		   @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);		   
		 if($customer_id==''){$ct_id="";}  else{ $ct_id="and  product_customer_order.customer_id='$customer_id' ";}

		  
		  @$sp=mysqli_query($con,"SELECT product_customer_order.*,custoemr_order.qty_p as total_row
		  
		  ,sum(product_customer_order.amount) as total_amount	
		  ,sum(product_customer_order.amount_crate) as total_amount_crate
		  ,sum(product_customer_order.last_amount) as total_last_amount		
		  ,customers.customer_name,customers.phone ,routes.route_name
		  ,sr_list.sr_fname,sr_list.sr_lname ,users.fname
		  ,custoemr_order.qty_p
		 
		  FROM product_customer_order
		   
		    left join customers on product_customer_order.customer_id=customers.customer_id
			left join routes on customers.route_id=routes.route_id
			
			  left join sr_list on product_customer_order.sr=sr_list.sr_id
			left join users on product_customer_order.user_id=users.user_id
			
			LEFT JOIN (select sum(product_customer_order.qty) as qty_p ,product_customer_order.sale_id
           from  product_customer_order 
     	        left join products on products.Product_ID=product_customer_order.product_id
		          left join tb_groups on tb_groups.Group_ID=products.group_id
              where 1=1 and tb_groups.Group_ID='001'  $btw $r_id $ct_id group by sale_id) as custoemr_order       
		             on product_customer_order.sale_id=custoemr_order.sale_id
			
		  where 1=1  $btw $r_id $ct_id
		  
		  group by product_customer_order.sale_id  order by product_customer_order.sale_id desc limit 100
	   
	          ");
		  if($sp){
          
          $output ='
 		 <table border="1"   class="table-bordered " width="100%" >
              <tr align="center">
                <th>ເລກທີ</th>
                <th>ວັນທີ</th>
				<th>ວັນທີສົ່ງ</th>
                <th>ສາຍທາງ</th>
				
				<th>ຊື່ລູກຄ້າ</th>
				<th>ໂທ</th>
				<th>ພະນັກງານຂາຍ</th>
                <th>ຈຳນວນ</th>
                <th>ຈຳນວນເງີນ</th>
				
				 <th>ສະຖານະ</th>
                <th>ພິມ</th>
				<th>ແກ້ໄຂ</th>
                  <th>ລົບ</th>
				  <th>User name</th>
				  <th>Remark</th>
              </tr>
           ';
            while($p=mysqli_fetch_array($sp)){
          
		  
          
		    $dd=date_create("$p[sale_date]");
		 $datex=date_format($dd,"d/m/Y");
		 
		  $dd2=date_create("$p[send_date]");
		 $datex2=date_format($dd2,"d/m/Y");
		  
		  if($p["status_sale"]=='1'){ $status="<button type='button' class='btn btn-warning btn-sm'>ລໍຖ້າ</button>"; }
		  else{ $status="<button type='button' class='btn btn-success btn-sm'>ຂາຍແລ້ວ</button>";}
			$output .='	
			<tr>              
               ';
			
			if($p["status_sale"]=='1'){   $output .='  
			    <td><input type="button" name="show" id="'.$p["sale_id"].'" value="'.$p["sale_id"].'" class="btn btn-warning  show_detail btn-sm"
				data-toggle="modal" data-target="#pro_detail"  ></td>';
				
			}else{
				
				$output .='  
			    <td><input type="button" name="show" id="'.$p["sale_id"].'" value="'.$p["sale_id"].'" class="btn btn-success show_detail btn-sm"
				data-toggle="modal" data-target="#pro_detail"  ></td>';
				
				
				}
				
				
				
               $output .='<td align="center">'.$datex.'</td>
			   <td align="center">'.$datex2.'&nbsp;'.$p["send_time"].'</td>
                <td align="left">'.$p["route_name"].'</td>
				<td align="left">'.$p["customer_name"].'</td>
				<td align="left">'.$p["phone"].'</td>
				<td align="left">'.$p["sr_fname"].'&nbsp;'.$p["sr_lname"].'</td>
                <td align="center">'.$p["total_row"].'</td>
				 <td align="right">'. number_format($p['total_amount'],0).'</td>
				
				<td align="center">'.$status.'</td>
              <td><button type="button" class="btn btn-warning btn-sm print_Id" id="'.$p["sale_id"].'"><i class="fa fa-print"></i> ພິມ</button></td>
			    
         ';  
		 
		 if($p["status_sale"]=='1'){ 
		  $output .='
		  <td><button type="button" class="btn btn-success btn-sm edit_Id" id="'.$p["sale_id"].'">Edit</button></td> 
		  <td><button type="button" class="btn btn-danger btn-sm delete_Id" id="'.$p["sale_id"].'"><i class="fa fa-trash" aria-hidden="true"></i></button></td> 
		        <td align="center">'.$p["fname"].'</td>
				<td align="center">'.$p["remark"].'</td>
				  ';
		 }else{ $output .='
		                    <td></td>
		                   <td></td>
		                   <td align="center">'.$p["fname"].'</td>
						   <td align="center">'.$p["remark"].'</td>';  }
		  $output .='	</tr>           ';
				@$t_total_row+=$p["total_row"];
				@$t_total+=$p["total_amount"];
				@$t_amount_crate+=$p["total_amount_crate"];
				@$t_last_amount+=$p["total_last_amount"];
				
             } 
			 
			 $output .='  <tr>
		<td align="right" colspan="6">ລວມ</td>
		<td align="center">'.@number_format($t_total_row,0).'</td>
		<td align="right">'.@number_format($t_total,0).'</td>
	
		<td align="right" colspan="7"></td>
		              </tr>';
					  
       $output .='   </table>';
		  
          } 
		 


echo 	  @$output; 

 
 
 ?>
