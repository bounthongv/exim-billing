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
   SELECT quotation_transfer.*,
         sum(quotation_transfer.qty) as q_qty,
         stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version
		   FROM  quotation_transfer 
		   left join products on products.Product_ID=quotation_transfer.product_id
       left join stocks on stocks.stock_id=quotation_transfer.stock_id	
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       
       where      quotation_transfer.qty>0  $btw $r_id $s_id
	    group by  products.Product_ID
	   order by quotation_transfer.product_id  

	          ");
		  if($sp){
          
          ?>
 		<table border="1"   class="table-bordered " >
              <tr>
                 <th align="center">ລ/ດ</th>
			       <th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
					<th align="center">ສາງ</th>
					<th align="center">ລະຫັດສິນຄ້າ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>  
					 <th align="center" >ຫົວຫນ່ວຍ</th>
                   
                    <th align="center" >ຈຳນວນ</th>
              </tr>
           <?php
		   $i=1;
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[transfer_date]");
			?>
            
            
            	<tr>
			
			  <td align="center"><?php echo $i; ?></td>
			 <td><?php echo $s["transfer_id"]; ?></td>
				<td><?php echo $s["transfer_date"]; ?></td>
				<td><?php echo $s["stock_id"]; ?></td>
            	<td><?php echo $s["Product_ID"]; ?></td>
                <td><?php echo$s["Product_Name"]; ?></td>
            	<td align="center"><?php echo $s["Unit"]; ?></td>				
               
				<td align="right"><?php echo $s["q_qty"]; ?> </td>
				</tr>
               <?php
			$i++;	
				
				
             } 
       ?>  </table><?php
		  
          } 

 
 ?>
