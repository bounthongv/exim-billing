<?php 
  include("init.php");
  
  
         @$phone= mysqli_real_escape_string($con,$_POST['phone']);	
         if($phone==''){$p="";}  else{ $p="and phone like '%$phone%'  ";}
		 

		  @$product_id= mysqli_real_escape_string($con,$_POST['product_id']);		   
		  if($product_id==''){$p_id="";}  else{ $p_id="and customer_id like '%$product_id%' ";}
		  
		  		  @$product_name= mysqli_real_escape_string($con,$_POST['product_name']);		   
		  if($product_name==''){$name="";}  else{ $name="and customer_name like '%$product_name%' ";}
		  
		  
    
   
		  @$sp=mysqli_query($con,"  SELECT customers.*,customer_type.ct_id,customer_type.ct_name
		   FROM  customers 
		   left join customer_type on customer_type.ct_id=customers.customer_type
		   where 1=1 $p $p_id $name limit 100
		    ");
		?>
        
              <table class="table-bordered" >
        <tr align="center">
         <th>ລະຫັດ</th>
         <th>ຊື່ລູກຄ້າ</th>
         <th>ເບີໂທ</th>
         <th>ປະເພດ</th>
         <th>ເລືອກ</th>
        </tr>
        <?php
         
            while($f=mysqli_fetch_array($sp)){
            ?>
			 <tr>         
         <td><?php echo "$f[customer_id]";?></td>
         <td><?php echo "$f[customer_name]";?></td>
         <td><?php echo "$f[phone]";?></td>
         <td><?php echo "$f[ct_name]";?></td>
         <td><a href="add_seller_order.php?c_id=<?=$f['customer_id'];?>&c_name=<?=$f['customer_name'];?>&c_t=<?=$f['customer_type'];?>"><button type="button" name="cc" class="btn btn-sm btn-success" >ເລືອກ</button></a></td>
        </tr>
        <?php } ?>
		
		</table>
