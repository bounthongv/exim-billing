<?php 
  include("init.php");
    
   
           @$route_id= mysqli_real_escape_string($con,$_POST['route_id']);	
         if($route_id==''){$r_id="";}  else{ $r_id="and logistics.route_id='$route_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and logistics.lg_date between '$from_date' and '$to_date' ";}
		  
 
           @$order_id= mysqli_real_escape_string($con,$_POST['order_id']);		   
		 if($order_id==''){$l_id="";}  else{ $l_id="and  logistics.lg_id='$order_id' ";}
		 
		   @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);		   
		 if($customer_id==''){$ct_id="";}  else{ $ct_id="and  logistics.customer_id='$customer_id' ";}

		  
		  @$sp=mysqli_query($con,"SELECT logistics.*,sum(logistics.qty) as total_row
			
		  ,customers.customer_name,customers.phone ,routes.route_name
		  FROM logistics
		   
		    left join product_customer_order on logistics.order_id=product_customer_order.sale_id
		    left join customers on product_customer_order.customer_id=customers.customer_id
			left join routes on logistics.route_id=routes.route_id
			
		  where 1=1  $btw $r_id $l_id
		  
		  group by logistics.lg_id  order by logistics.lg_id desc limit 100
	   
	          ");
		  if($sp){
          
          $output ='
 		 <table border="1"   class="table-bordered " >
              <tr align="center">
                <th>ເລກທີ</th>
                <th>ວັນທີ</th>
                <th>ສາຍທາງ</th>
				
				<th>ເລກລົດ</th>
				<th>ຜູ້ຂັບ</th>
                <th>ການເງີນ</th>
                
				 <th>ຂົນເຄື່ອງ</th>
				  <th>ຈນ ໃບສັ່ງຊື້</th>
				 <th>ຈນ ເກັດ/ລັງ</th>
                <th>ພິມ</th>
                  <th>ລົບ</th>
              </tr>
           ';
            while($p=mysqli_fetch_array($sp)){
          //  $dd=date_create("$s[transfer_date]");
		  
		  if($p["status_sale"]=='1'){ $status="<button type='button' class='btn btn-warning btn-sm'>ລໍຖ້າ</button>"; }
		  else{ $status="<button type='button' class='btn btn-success btn-sm'>ຂາຍແລ້ວ</button>";}
		  
			$output .='	
			<tr>              
                <td><input type="button" name="show" id="'.$p["lg_id"].'" value="'.$p["lg_id"].'" class="btn show_detail btn-sm"
				data-toggle="modal" data-target="#pro_detail"  ></td>
               	<td align="center">'.$p["lg_date"].'</td>
                <td align="center">'.$p["route_name"].'</td>
				<td align="left">'.$p["regis_id"].'</td>
				<td align="left">'.$p["driver_name"].'</td>
				<td align="left">'.$p["accounting_name"].'</td>
                <td align="center">'.$p["worker_name"].'</td>
				 <td align="right">'. number_format($p['total_row'],0).'</td>
				  <td align="right">'. number_format($p['total_crate'],0).'</td>
               
              <td><button type="button" class="btn btn-warning btn-sm print_Id" id="'.$p["sale_id"].'"><i class="fa fa-print"></i> ພິມ</button></td>
                <td><button type="button" class="btn btn-danger btn-sm delete_Id" id="'.$p["sale_id"].'">ລົບ</button></td>
              </tr>
                ';
				@$t_total_row+=$p["total_row"];
				@$t_total+=$p["total_amount"];
				@$t_amount_crate+=$p["total_amount_crate"];
				@$t_last_amount+=$p["total_last_amount"];
				
             } 
			 
			 $output .='  <tr>
		<td align="right" colspan="7">ລວມ</td>
		<td align="center">'.@number_format($t_total_row,0).'</td>
		<td align="center">'.@number_format($t_total,0).'</td>

		<td align="right" colspan="2"></td>
		              </tr>';
					  
       $output .='   </table>';
		  
          } 
		 


echo 	  @$output; 

 
 
 ?>
