<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and seller_orders.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and seller_orders.order_date between '$from_date' and '$to_date' ";}
		  
 
           @$order_id= mysqli_real_escape_string($con,$_POST['order_id']);		   
		 if($order_id==''){$r_id="";}  else{ $r_id="and  seller_orders.order_id='$order_id' ";}
		 
		   @$staff_id= mysqli_real_escape_string($con,$_POST['staff_id']);		   
		 if($staff_id==''){$st_id="";}  else{ $st_id="and  seller_orders.staff_id='$staff_id' ";}

		  
		  @$sp=mysqli_query($con,"SELECT seller_orders.*,count(seller_orders.qty) as total_row,stocks.stock_name		 
		  FROM seller_orders
		   left join stocks on stocks.stock_id=seller_orders.stock_id
		  where 1=1 $s_id $btw $r_id $st_id group by order_id 
	   
	          ");
		  if($sp){
          
          $output ='
 		 <table border="1"   class="table-bordered " >
              <tr align="center">
                <th>ເລກທີ</th>
                <th>ວັນທີ</th>
                <th>ສາງ</th>
                <th>ຈຳນວນສິນຄ້າ</th>
                <th>ຈຳນວນເງີນ</th>
				 <th>ສະຖານະ</th>
                
                  <th>ລົບ</th>
              </tr>
           ';
            while($p=mysqli_fetch_array($sp)){
          //  $dd=date_create("$s[transfer_date]");
		  
		  if($p["status"]=='1'){ $status="<button type='button' class='btn btn-warning btn-sm'>ລໍຖ້າ</button>"; }
		  else{ $status="<button type='button' class='btn btn-success btn-sm'>ຂາຍແລ້ວ</button>";}
			$output .='	
			<tr>              
                <td><input type="button" name="show" id="'.$p["order_id"].'" value="'.$p["order_id"].'" class="btn show btn-sm"
				data-toggle="modal" data-target="#pro_detail"  ></td>
               	<td align="center">'.$p["order_date"].'</td>
                <td align="center">'.$p["stock_id"].'&nbsp;'.$p["stock_name"].'</td>
                <td align="center">'.$p["total_row"].'</td>
                <td align="right">'. number_format($p['total'],2).'</td>
				<td align="center">'.$status.'</td>
              
                <td><button type="button" class="btn btn-danger btn-sm delete_Id" id="'.$p["order_id"].'">ລົບ</button></td>
              </tr>
                ';
				
				@$t_total+=$p["total"];
				
             } 
			 
			 $output .='  <tr>
		<td align="right" colspan="4">ລວມ</td>
		<td align="right">'.@number_format($t_total,2).'</td>
		<td align="right" colspan="2"></td>
		              </tr>';
					  
       $output .='   </table>';
		  
          } 
		 


echo 	  @$output; 

 
 
 ?>
