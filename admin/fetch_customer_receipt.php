<?php 
  include("init.php");
  
  
       
		 

		  @$c_id= mysqli_real_escape_string($con,$_POST['customer_id']);		   
		  if($customer_id==''){$p_id="";}  else{ $p_id="and (customers.customer_id like '$c_id%' or customers.customer_id like '%$customer_id%') ";}
		  
		  		  @$customer_name= mysqli_real_escape_string($con,$_POST['customer_name']);		   
		  if($customer_name==''){$s_name="";}  else{ $s_name="and (customers.customer_name like '$customer_name%' or customers.customer_name like '%$customer_name%') ";}
		  
		 
		   @$c_type= mysqli_real_escape_string($con,$_POST['c_type']);	
         if($c_type==''){$ct="";}  else{ $ct="and customer_type like '$c_type%'  ";}
		 
		  @$c_village= mysqli_real_escape_string($con,$_POST['c_v']);	
         if($c_village==''){$cv="";}  else{ $cv="and (village like '$c_village%'  or village like '%$c_village%' )";}
		 
		 
		  @$c_district= mysqli_real_escape_string($con,$_POST['c_d']);	
         if($c_district==''){$cd="";}  else{ $cd="and (district like '$c_district%'  or district like '%$c_district%' )";}
		 
		 
		 @$limit_row= mysqli_real_escape_string($con,$_POST['limit_row']);	
         if($limit_row==''){$lmr="limit 50";}  else{ $lmr="limit $limit_row";}
		 
    
		
          
         ?>
         
 			<table id="example" border="1"  class="table table-bordered" >
			 <thead>
              <tr class="bgtd">
        <td align="center"><strong>ເລືອກ</strong></td>
		<td align="center"><strong>No</strong></td>
        <td align="center"><strong>Code</strong></td>
    	<td><strong>ຊື່ ລູກຄ້າ </strong></td>     
		<td><strong>ປະເພດ</strong></td>       
        <td><strong>ບ້ານ</strong></td>
		<td><strong>ເມືອງ</strong></td>
        <td><strong>Tel</strong></td>
      
     
	    <td><strong>ເສັ້ນທາງ</strong></td> 
      
        <td><strong>ຍອດໜີ້</strong></td> 
       
		
              </tr>
			   </thead>
			   <tbody>
          <?php
		   
		   $row_list=0;
		   
   
		  @$sp=mysqli_query($con,"  SELECT customers.*,customer_type.ct_id,customer_type.ct_name,routes.route_name
		  ,sr_list.sr_fname,sr_list.sr_lname
		   FROM  customers 
		   left join customer_type on customer_type.ct_id=customers.customer_type
		   left join routes on customers.route_id=routes.route_id
		   
		     left join sr_list on customers.sr=sr_list.sr_id
		   
		   
		   where 1=1 $s_name $p_id $ct $cv $cd order by customers.customer_id $lmr
		    ");
            while($f=mysqli_fetch_array($sp)){
            $row_list++;
			?>
		 		<tr>
                <td><button type="button" class="btn btn-sm btn-success add_customer" id="<?php echo $f['customer_id']; ?>" 
                data-customer_name="<?php echo $f['customer_name']; ?>" data-dismiss="modal">ເລືອກ</button></td>
				<td align="center"><?php echo $row_list; ?></td>
				<td align="center">
			<?php echo $f['customer_id']; ?></td>
    	        <td><?php echo  $f['customer_name']; ?></td>     
				<td><?php echo  $f['ct_name']; ?></td>      	
        		<td><?php echo  $f['village']; ?></td>
				<td><?php echo  $f['district']; ?></td>
        		<td><?php echo  $f['phone']; ?></td>
        		
        	
				
        		
				<td><?php echo  $f['route_name']; ?></td> 
        		
                <td align="right"><?php echo  @number_format($f['total_debit_amt'],0); ?></td> 
				

				</tr>
             <?php
            	
             } 
       ?>   <tbody> 
       
       </table>
		  
   
		

