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
<td><strong>external_id</strong></td>
<td><strong>outlet_name</strong></td>
<td><strong>outlet_name_la</strong></td>
<td><strong>phone_number</strong></td>
<td><strong>Province</strong></td>
<td><strong>district</strong></td>
<td><strong>village</strong></td>
<td><strong>region_LA</strong></td>
<td><strong>Province_LA</strong></td>
<td><strong>Village_LA</strong></td>
<td><strong>latitude</strong></td>
<td><strong>longitude</strong></td>
<td><strong>business_segment_code</strong></td>
<td><strong>channel_code</strong></td>
<td><strong>sub_channel_full</strong></td>
<td><strong>classification_code</strong></td>
<td><strong>Sale_Id</strong></td>
<td><strong>Sale_full_name</strong></td>
<td><strong>credit</strong></td>
<td><strong>Debt_collection</strong></td>
<td><strong>Number_of_days_overdue</strong></td>
<td><strong>Contract_expiration_date</strong></td>
       
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
/*
"SELECT * FROM
		  (
		  SELECT 
		  external_id as customer_id,
		  outlet_name as customer_name,
		  phone_number as phone,
		  village as village,
		  district as district,
		  credit,
		  Debt_collection,
		  Number_of_days_overdue,
		  Contract_expiration_date
		  FROM customer_import
		  ) as customer_import
		  WHERE 1=1
		  $p_id $s_name $cv $cd order by customer_id $lmr
		  "
*/

		  @$sp=mysqli_query($con,"SELECT customer_import.*,customer_import.external_id as customer_id,
		  customer_import.outlet_name as customer_name
			FROM  customers 
		   left join customer_type on customer_type.ct_id=customers.customer_type
		   left join routes on customers.route_id=routes.route_id
		   left join sr_list on customers.sr=sr_list.sr_id
		   left join customer_import on customers.customer_id=customer_import.external_id


		  WHERE 1=1
		  $p_id $s_name $cv $cd order by external_id $lmr
		  ");
            while($f=mysqli_fetch_array($sp)){
            $row_list++;
			?>
		 		<tr>
				<td align="center"><?php echo $row_list; ?></td>
				<td align="center"><?php echo $f['external_id']; ?></td>
    	        <td><?php echo  $f['outlet_name']; ?></td>     
				<td><?php echo  $f['outlet_name_la']; ?></td>      	
        		<td><?php echo  $f['phone_number']; ?></td>
				<td><?php echo  $f['Province']; ?></td>
        		<td><?php echo  $f['district']; ?></td>
        		<td><?php echo  $f['village']; ?></td>
        		<td><?php echo  $f['region_LA']; ?></td>
				<td><?php echo  $f['Province_LA']; ?></td>
				<td><?php echo  $f['Village_LA']; ?></td>
				<td><?php echo  $f['latitude']; ?></td>
				<td><?php echo  $f['longitude']; ?></td>
				
        		
				<td><?php echo  $f['business_segment_code']; ?></td> 
				<td><?php echo  $f['channel_code']; ?></td>
				<td><?php echo  $f['sub_channel_full']; ?></td>
				<td><?php echo  $f['classification_code']; ?></td>
				<td><?php echo  $f['Sale_Id']; ?></td>

				<td><?php echo  $f['Sale_full_name']; ?></td> 
				<td><?php echo  $f['credit']; ?></td>
				<td><?php echo  $f['Debt_collection']; ?></td>
				<td><?php echo  $f['Number_of_days_overdue']; ?></td>
				<td><?php echo  $f['Contract_expiration_date']; ?></td>




				
			<input type="hidden" name="e_customer_name" id="e_customer_name<?php echo  $f["customer_id"]; ?>"  value="<?php echo  $f["customer_name"]; ?>" />
				
			 <input type="hidden" name="e_outlet_name_la" id="e_outlet_name_la<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["outlet_name_la"]; ?>" />
			 <input type="hidden" name="e_phone_number" id="e_phone_number<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["phone_number"]; ?>" />
			 <input type="hidden" name="e_Province" id="e_Province<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["Province"]; ?>" />
			 <input type="hidden" name="e_district" id="e_district<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["district"]; ?>" />


<input type="hidden" name="e_village" id="e_village<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["village"]; ?>" />
<input type="hidden" name="e_region_LA" id="e_region_LA<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["region_LA"]; ?>" />
<input type="hidden" name="e_Province_LA" id="e_Province_LA<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["Province_LA"]; ?>" />
<input type="hidden" name="e_Village_LA" id="e_Village_LA<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["Village_LA"]; ?>" />
<input type="hidden" name="e_latitude" id="e_latitude<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["latitude"]; ?>" />


<input type="hidden" name="e_longitude" id="e_longitude<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["longitude"]; ?>" />
<input type="hidden" name="e_business_segment_code" id="e_business_segment_code<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["business_segment_code"]; ?>" />
<input type="hidden" name="e_channel_code" id="e_channel_code<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["channel_code"]; ?>" />
<input type="hidden" name="e_sub_channel_full" id="e_sub_channel_full<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["sub_channel_full"]; ?>" />
<input type="hidden" name="e_classification_code" id="e_classification_code<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["classification_code"]; ?>" />


<input type="hidden" name="e_Sale_Id" id="e_Sale_Id<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["Sale_Id"]; ?>" />
<input type="hidden" name="e_Sale_full_name" id="e_Sale_full_name<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["Sale_full_name"]; ?>" />


			 
	<input type="hidden" name="e_credit" id="e_credit<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["credit"]; ?>" />
    <input type="hidden" name="e_Debt_collection" id="e_Debt_collection<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["Debt_collection"]; ?>" />
    <input type="hidden" name="e_Number_of_days_overdue" id="e_Number_of_days_overdue<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["Number_of_days_overdue"]; ?>" />
	<input type="hidden" name="e_Contract_expiration_date" id="e_Contract_expiration_date<?php echo $f["customer_id"]; ?>"  value="<?php echo $f["Contract_expiration_date"]; ?>" />




			 
		 <input type="hidden" name="id" id="id<?php echo $f["customer_id"]; ?>"  value="<?php echo  $f["id"]; ?>" />
				
				
         <td ><button class="btn btn-success btn-sm edit_supplier" id="<?php echo $f['customer_id']; ?>"  data-toggle="modal" data-target="#add_stock">
                ແກ້ໄຂ</button></td>
		 <td ><button class="btn btn-danger btn-sm delete_Id"  id="<?php echo  $f["id"]; ?>">ລົບ</button></td>
				</tr>
             <?php
            	
             } 
       ?>   <tbody> 
       
       </table>
		  
   
