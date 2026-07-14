<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and pre_orders.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and pre_orders.receipt_date between '$from_date' and '$to_date' ";}
		  
 
           @$receipt_id= mysqli_real_escape_string($con,$_POST['receipt_id']);		   
		 if($receipt_id==''){$r_id="";}  else{ $r_id="and  pre_orders.receipt_id='$receipt_id' ";}
		 
		 

		  
		  @$sp=mysqli_query($con,"SELECT pre_orders.*,sum(pre_orders.qty) as qty,sum(pre_orders.qty*pre_orders.price) as total,
		  stocks.stock_name		 
		  FROM pre_orders
		   left join stocks on stocks.stock_id=pre_orders.stock_id
		  where 1=1 $s_id $btw $r_id group by receipt_id 
	   
	          ");
		  if($sp){
          
          $output ='
 		 <table border="1"   class="table-bordered " >
              <tr align="center">
                <th>ເລກທີຮັບເຂົ້າ</th>
                <th>ວັນທີ</th>
                <th>ສາງ</th>
                <th>ຈຳນວນສິນຄ້າ</th>
                <th>ຈຳນວນເງີນ</th>
                 <th>ແກ້ໄຂ</th>
                  <th>ລົບ</th>
			   <th>ພິມ</th>
              </tr>
           ';
            while($p=mysqli_fetch_array($sp)){
          //  $dd=date_create("$s[transfer_date]");
			$output .='	
			<tr>              
                <td><input type="button" name="show" id="'.$p["receipt_id"].'" value="'.$p["receipt_id"].'" class="btn show btn-sm"
				data-toggle="modal" data-target="#pro_detail"  ></td>
               	<td>'.$p["receipt_date"].'</td>
                <td>'.$p["stock_id"].'&nbsp;'.$p["stock_name"].'</td>
                <td>'.$p["qty"].'</td>
                <td>'. number_format($p['total'],2).'</td>
                <td><button type="button" class="btn btn-success btn-sm edit_Id" id="'.$p["receipt_id"].'" >ແກ້ໄຂ</button></td>
                <td><button type="button" class="btn btn-danger btn-sm delete_Id" id="'.$p["receipt_id"].'">ລົບ</button></td>
			 <td><button type="button" class="btn btn-warning btn-sm print_Id" id="'.$p["receipt_id"].'"><i class="fa fa-print"></i> ພິມ</button></td>
              </tr>
                ';
				
				
				
             } 
       $output .='   </table>';
		  
          } 
		 


echo 	  $output; 

 
 
 ?>
