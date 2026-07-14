<?php 
  include("init.php");
  
  /*
		  $c_id= mysqli_real_escape_string($con,$_POST['c_id']);		   
		  if($c_id==''){ $p_id="";}
		  else{ $p_id="and (customers.customer_id like '$c_id%' or customers.customer_id like '%$c_id%') ";}
*/
$c_id= mysqli_real_escape_string($con,$_POST['c_id']);		   
		  if($c_id==''){ $p_id="";}
		  else{ $p_id="and (customer_id like '$c_id%' or customer_id like '%$c_id%') ";}


/*
		  @$c_name= mysqli_real_escape_string($con,$_POST['c_name']);		   
		  if($c_name==''){$s_name="";}
		  else{ $s_name="and (customers.customer_name like '$c_name%' or customers.customer_name like '%$c_name%') ";}
		  */
@$c_name= mysqli_real_escape_string($con,$_POST['c_name']);		   
		  if($c_name==''){$s_name="";}
		  else{ $s_name="and (customer_name like '$c_name%' or customer_name like '%$c_name%') ";}


		 
		   @$c_type= mysqli_real_escape_string($con,$_POST['c_type']);	
         if($c_type==''){$ct="";}
		 else{ $ct="and customer_type like '$c_type%'";}
		 
		 
		  @$c_village= mysqli_real_escape_string($con,$_POST['c_v']);	
         if($c_village==''){$cv="";}
		 else{ $cv="and (village like '$c_village%'  or village like '%$c_village%' )";}
		 
		 
		  @$c_district= mysqli_real_escape_string($con,$_POST['c_d']);	
         if($c_district==''){$cd="";}
		 else{ $cd="and (district like '$c_district%'  or district like '%$c_district%' )";}
		 
		 
		 @$limit_row= mysqli_real_escape_string($con,$_POST['limit_row']);	
         if($limit_row==''){$lmr="limit 500";}
		else{ $lmr="limit $limit_row";}
		 
    
		
          
         ?>
         
 			<table id="example" border="1"  class="table table-bordered" >
			 <thead>
              <tr class="bgtd">
		<td align="center"><strong>No</strong></td>
        <td align="center"><strong>Code</strong></td>
    	<td><strong>ຊື່ ລູກຄ້າ </strong></td>     
		<td><strong>ປະເພດ</strong></td>       
        <td><strong>ບ້ານ</strong></td>
		<td><strong>ເມືອງ</strong></td>
        <td><strong>Tel</strong></td>
        <td><strong>sr</strong></td>
        <td><strong>segment</strong></td>
		 <td><strong>Grade</strong></td>
		  <td><strong>UP</strong></td>
		  <td><strong>Brand</strong></td>
		  <td><strong>Class</strong></td>
     
	  <td><strong>ເສັ້ນທາງ</strong></td> 
       <td><strong>ເພດານໜີ້</strong></td> 
        <td><strong>ຍອດໜີ້</strong></td> 
       
		 <td><strong>ແກ້ໄຂ</strong></td>
		  <td><strong>ລົບ</strong></td>
              </tr>
			   </thead>
			   <tbody>
          <?php
		   
		   $row_list=0;
		   
   
 "SELECT customers.*,customer_type.ct_id,customer_type.ct_name,routes.route_name
		  ,sr_list.sr_fname,sr_list.sr_lname
		   FROM  customers 
		   left join customer_type on customer_type.ct_id=customers.customer_type
		   left join routes on customers.route_id=routes.route_id
		   
		     left join sr_list on customers.sr=sr_list.sr_id
		   
		   
		   where 1=1 $s_name $p_id $ct $cv $cd order by customers.customer_id $lmr
		    ";




		  @$sp=mysqli_query($con,"SELECT * FROM
		  (
		  SELECT 
		  external_id as customer_id,
		  outlet_name as customer_name,
		  phone_number as phone,
		  village as village,
		  district as district
		  FROM customer_import
		  ) as customer_import
		  WHERE 1=1
		  $p_id $s_name $cv $cd order by customer_id $lmr
		  ");
            while($f=mysqli_fetch_array($sp)){
            $row_list++;
			?>
		 		<tr>
				<td align="center"><?php echo $row_list; ?></td>
				<td align="center"><?php echo $f['customer_id']; ?></td>
    	        <td><?php echo  $f['customer_name']; ?></td>     
				<td><?php echo  $f['ct_name']; ?></td>      	
        		<td><?php echo  $f['village']; ?></td>
				<td><?php echo  $f['district']; ?></td>
        		<td><?php echo  $f['phone']; ?></td>
        		<td><?php echo  $f['sr_fname']; ?> <?php echo  $f['sr_lname']; ?></td>
        		<td><?php echo  $f['segment']; ?></td>
				<td><?php echo  $f['grade']; ?></td>
				<td><?php echo  $f['up']; ?></td>
				<td><?php echo  $f['brand']; ?></td>
				<td><?php echo  $f['class']; ?></td>
				
        		
				<td><?php echo  $f['route_name']; ?></td> 
        		<td align="right"><?php echo  @number_format($f['debit_amt'],0); ?></td> 
                <td align="right"><?php echo  @number_format($f['total_debit_amt'],0); ?></td> 
				
				
				
				
				
			<input type="hidden" name="customer_name" id="customer_name<?php echo  $f["customer_id"]; ?>"  value="<?php echo  $f["customer_name"]; ?>" />
			<input type="hidden" name="customer_type" id="customer_type<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["customer_type"]; ?>" />
				
			<input type="hidden" name="address" id="address<?php echo $f["customer_id"]; ?>"  value="<?php echo  $f["address"]; ?>" />
			<input type="hidden" name="phone" id="phone<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["phone"]; ?>" />
			<input type="hidden" name="fax" id="fax<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["fax"]; ?>" />
			<input type="hidden" name="email" id="email<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["email"]; ?>" />		
			<input type="hidden" name="remark" id="remark<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["remark"]; ?>" />
			<input type="hidden" name="customer_level" id="customer_level<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["customer_level"]; ?>" />	
			 
			 
			 <input type="hidden" name="route_id" id="route_id<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["route_id"]; ?>" />
			 
			 <input type="hidden" name="e_village" id="e_village<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["village"]; ?>" />
			 <input type="hidden" name="e_district" id="e_district<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["district"]; ?>" />
			 <input type="hidden" name="e_sr" id="e_sr<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["sr"]; ?>" />
			 <input type="hidden" name="e_segment" id="e_segment<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["segment"]; ?>" />
			 <input type="hidden" name="e_grade" id="e_grade<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["grade"]; ?>" />
			 
			 <input type="hidden" name="e_up" id="e_up<?php echo $f["up"]; ?>"  value="<?php echo $f["up"]; ?>" />
			 <input type="hidden" name="e_brand" id="e_brand<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["brand"]; ?>" />
			 <input type="hidden" name="e_class" id="e_class<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["class"]; ?>" />
             
     <input type="hidden" name="e_debit_amt" id="e_debit_amt<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["debit_amt"]; ?>" />
      <input type="hidden" name="e_total_debit_amt" id="e_total_debit_amt<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["total_debit_amt"]; ?>" />
			 
			 
			 
			 
		 <input type="hidden" name="id" id="id<?php echo $f["customer_id"]; ?>"  value="<?php echo  $f["id"]; ?>" />
				
				
         <td ><button class="btn btn-success btn-sm edit_supplier" id="<?php echo $f['customer_id']; ?>"  data-toggle="modal" data-target="#add_stock">
                ແກ້ໄຂ</button></td>
		 <td ><button class="btn btn-danger btn-sm delete_Id"  id="<?php echo  $f["id"]; ?>">ລົບ</button></td>
				</tr>
             <?php
            	
             } 
       ?>   <tbody> 
       
       </table>
		  
   
