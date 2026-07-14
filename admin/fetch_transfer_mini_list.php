<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and transfer.t_stock_id='$stock_id'  ";}
		 
       $today=date('Y-m-d');
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="and transfer.transfer_date='$today' ";} 
		  else{ $btw="and transfer.transfer_date between '$from_date' and '$to_date' ";}
		  
 
           @$transfer_id= mysqli_real_escape_string($con,$_POST['transfer_id']);		   
		 if($transfer_id==''){$r_id="";}  else{ $r_id="and  transfer.transfer_id='$transfer_id' ";}
		 
		 

		  
		  @$sp=mysqli_query($con,"
SELECT transfer.*,count(transfer.product_id) as total_item,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,stocks2.stock_name as stock_name2
		   FROM  transfer 
		   left join products on products.Product_ID=transfer.product_id
       left join stocks on stocks.stock_id=transfer.f_stock_id
	   left join stocks as stocks2 on stocks2.stock_id=transfer.t_stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       
       where      transfer.qty>0  $s_id $btw $r_id
	   group by transfer.transfer_id order by transfer.transfer_id
	   
	          ");
		
          
          $output ='
 		<table border="1"   class="table-bordered " >
              <tr>
                <th align="center">ເລກທີ</th>
                <th align="center">ວັນທີ</th>
				<th align="center">ຈາກສາງ</th>
                <th align="center">ຫາສາງ</th>
               
                <th align="center">ຈຳນວນລາຍການ</th>
				 <th align="center">ຫມາຍເຫດ</th>
          <th align="center">ພິມ</th> 
			
		<th align="center">ແກ້ໄຂ</th> 
               
              <!--     
                  <th align="center">ລົບ</th>-->
              </tr>
           ';
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[transfer_date]");
			$output .='	<tr>
			   <td align="center"><input type="button" name="show" id="'. $s["transfer_id"].'" value="'. $s["transfer_id"].'" class="btn show_pro btn-sm" 
			   data-toggle="modal" data-target="#pro_detail" ></td> 
				<td align="center">'.date_format($dd,"d-m-Y").'</td>
				<td>'.$s["f_stock_id"].'&nbsp;'.$s["stock_name"].'</td>
            	<td>'.$s["t_stock_id"].'&nbsp;'.$s["stock_name2"].'</td>
               
            	<td align="center">'. $s["total_item"].'</td>
				<td align="center">'. $s["remark"].'</td>
			<td align="center">
		<a href="print_transfer.php?transfer_id='.$s['transfer_id'].'&transfer_date='.$s['transfer_date'].'" 
          target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button></a></td>	
		  
         <td align="center"><button type="button" class="btn btn-success btn-sm edit_Id" id="'. $s["transfer_id"].'">ແກ້ໄຂ</button></td>
            <!--     <td align="center"><button type="button" class="btn btn-danger btn-sm delete_Id" id="'. $s["transfer_id"].'">ລົບ</button></td>-->
				</tr>
                ';
				
				
				
             } 
       $output .='   </table>';
		  
     
		 


echo 	  $output; 

 
 
 ?>
