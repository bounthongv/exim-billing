<?php 
  include("init.php");
    
   
         @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and quotation_transfer.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and quotation_transfer.transfer_date between '$from_date' and '$to_date' ";}
		  
 
           @$transfer_id= mysqli_real_escape_string($con,$_POST['transfer_id']);		   
		 if($transfer_id==''){$r_id="";}  else{ $r_id="and  quotation_transfer.transfer_id='$transfer_id' ";}
		 
		 

		  
		  @$sp=mysqli_query($con,"
      SELECT quotation_transfer.*,quotation_transfer.qty as q_qty,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version
		   FROM  quotation_transfer 
		   left join products on products.Product_ID=quotation_transfer.product_id
       left join stocks on stocks.stock_id=quotation_transfer.stock_id	
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       
       where      quotation_transfer.qty>0   $r_id
	   order by quotation_transfer.product_id 
	   
	          ");
		  if($sp){
          
          $output ='
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                	<th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
					<th align="center">ສາງ</th>
					<th align="center">ລະຫັດສິນຄ້າ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>  
					 <th align="center" >ຫົວຫນ່ວຍ</th>
                    <th align="center" >ຂະຫນາດບັນຈຸ</th>
                    <th align="center" >ຈຳນວນ</th>
					
                
                    
                </tr>
           ';
            while($s=mysqli_fetch_array($sp)){
            
			$output .='	<tr>
			    <td>'. $s["transfer_id"].'</td>
				<td>'. $s["transfer_date"].'</td>
				<td>'. $s["stock_id"].'</td>
            	<td>'. $s["Product_ID"].'</td>
                <td>'.$s["Product_Name"].'</td>
            	<td align="center">'. $s["Unit"].'</td>				
                <td align="center">'. $s["qty"].'</td>
				<td align="right">'.@number_format($s["q_qty"],2).' </td>
				
				</tr>
                ';
           @$t_qty+=$s["qty"]; 
		   
		   @$tt+=$s["qty"]*$s["price"];	
             } 
			 
			$output .='<tr>
			<td align="right" colspan="7">ລວມ</td>
            <td align="right">'. @number_format($t_qty,2).'</td>
           
			</tr> '; 
			
       $output .='   </table>';
		  
          } 
		 


echo 	  $output; 

 
 
 ?>
 
            
 
