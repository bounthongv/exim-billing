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
SELECT quotation_transfer.*,count(quotation_transfer.product_id) as total_item,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version
		   FROM  quotation_transfer 
		   left join products on products.Product_ID=quotation_transfer.product_id
       left join stocks on stocks.stock_id=quotation_transfer.stock_id	
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       
       where      quotation_transfer.qty>0  $s_id $btw $r_id
	   group by quotation_transfer.transfer_id order by quotation_transfer.product_id
	   
	          ");
		  if($sp){
          
          ?>
 		<table border="1"   class="table-bordered " >
              <tr>
			     <th align="center">ລ/ດ</th>
                <th align="center">ເລກທີ</th>
                <th align="center">ວັນທີ</th>
				<th align="center">ສາງ</th>
               
               
                <th align="center">ຈຳນວນລາຍການ</th>
              
               <th align="center">ສະຖານະ</th>
                <th align="center">ແກ້ໄຂ</th>
                  <th align="center">ລົບ</th>
              </tr>
           <?php
		   $i=1;
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[transfer_date]");
			?>
            
            
            	<tr>
			
			  <td align="center"><?php echo $i; ?></td>
			   <td align="center"><input type="button" name="show" id="<?php echo  $s["transfer_id"]; ?>" value="<?php echo  $s["transfer_id"]; ?>" class="btn show btn-sm" 
			   data-toggle="modal" data-target="#pro_detail" ></td> 
				<td align="center"><?php echo date_format($dd,"d-m-Y"); ?></td>
				<td><?php echo $s["stock_id"]; ?>&nbsp;<?php echo $s["stock_name"]; ?></td>
            	
               
            	<td align="center"><?php echo  $s["total_item"]; ?></td>
				<td align="center">
  <?php if($s["status"]=='1'){ ?>              
    <button type="button" class="btn btn-warning btn-sm transfer_now" id="<?php echo  $s["transfer_id"]; ?>">ລໍຖ້າ</button>
    <?php }elseif($s["status"]=='0'){ ?>
	<button type="button" class="btn btn-success btn-sm " id="<?php echo  $s["transfer_id"]; ?>">ໂອນແລ້ວ</button>	
		<?php } ?>               
                </td>
              <td align="center"><button type="button" class="btn btn-success btn-sm edit_Id" id="<?php echo  $s["transfer_id"]; ?>">ແກ້ໄຂ</button></td>
                <td align="center"><button type="button" class="btn btn-danger btn-sm delete_Id" id="<?php echo  $s["transfer_id"]; ?>">ລົບ</button></td>
				</tr>
               <?php
			$i++;	
				
				
             } 
       ?>  </table><?php
		  
          } 

 
 ?>
