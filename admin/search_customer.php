<?php 
  include("init.php");
  
 
        @$action= mysqli_real_escape_string($con,$_POST['action']);	
	    @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);
	    @$customer_name= mysqli_real_escape_string($con,$_POST['customer_name']);
		@$customer_phone= mysqli_real_escape_string($con,$_POST['customer_phone']);	
		
				
        
		 		   
		  if($customer_id==''){$c_id="";}  else{ $c_id="and (customer_id like '$customer_id%' or customer_id like '%$customer_id%') ";}
		  if($customer_name==''){$name="";}  else{ $name="and (customer_name like '$customer_name%' or customer_name like '%$customer_name%') ";}
		  if($customer_phone==''){$phone="";}  else{ $phone="and (tel like '$customer_phone%' or tel like '%$customer_phone%') ";}
		  
		
    ?>
  
	<table class="table-bordered" >
        <tr align="center">
        
         <th>ເລືອກ</th>
         <th>ລະຫັດ</th>
         <th>ຊື່ລູກຄ້າ</th>
         <th>ເບີໂທ</th>
         <th>ປະເພດ</th>
          <th>ສາຍທາງ</th>
           <th>ບ້ານ</th>
            <th>ເມືອງ</th>
        
        </tr>
        
        <?php
echo "";
		@$sp=mysqli_query($con,"  SELECT customers.*,customer_type.ct_name,routes.route_name
		 ,sr_list.sr_fname,sr_list.sr_lname
     ,customer_import.Province
     ,customer_import.district
     ,customer_import.village

		   FROM  customers 
		 left join routes on customers.route_id=routes.route_id
		 left join customer_type on customers.customer_type=customer_type.ct_id
		 left join sr_list on customers.sr=sr_list.sr_id
		 
    left join customer_import on customers.customer_id=customer_import.external_id


		   where 1=1 $c_id $name $phone limit 100
		    ");
		   while($f=mysqli_fetch_array($sp)){
		?>
        <tr>  
        
        <td><button type="button" name="cc" class="btn btn-sm btn-success add_customer" id="<?php echo $f['customer_id'];?>" data-customer_name="<?php echo $f['customer_name'];?>" data-customer_phone="<?php echo $f['phone'];?>" data-customer_address="<?php echo $f['address'];?>" 
          data-ct_id="<?php echo $f['customer_type'];?>" data-ct_name="<?php echo $f['ct_name'];?>"  data-route_id="<?php echo $f['route_id'];?>"data-sr_id="<?php echo $f['sr'];?>" data-sr_fname="<?php echo $f['sr_fname'];?>" data-sr_lname="<?php echo $f['sr_lname'];?>" 
          data-village="<?php echo $f['village'];?>"
          data-district="<?php echo $f['district'];?>"
          data-Province="<?php echo $f['Province'];?>"
          
          data-dismiss="modal" >ເລືອກ</button></td>        
         <td><?php echo $f['customer_id'];?></td>
         <td><?php echo $f['customer_name'];?></td>
         <td><?php echo $f['phone'];?></td>
         <td><?php echo $f['ct_name'];?></td>
          <td><?php echo $f['route_name'];?></td>
           <td><?php echo $f['village'];?></td>
            <td><?php echo $f['district'];?></td>
         
        </tr>
        <?php } ?>
        
       
         </table> 