<?php 
  include("init.php");
  
  
         @$phone= mysqli_real_escape_string($con,$_POST['phone']);	
         if($phone==''){$p="";}  else{ $p="and (tel like '$phone%' or tel like '%$phone%') ";}
		 

		  @$product_id= mysqli_real_escape_string($con,$_POST['product_id']);		   
		  if($product_id==''){$p_id="";}  else{ $p_id="and (supplier_id like '$product_id%' or supplier_id like '%$product_id%') ";}
		  
		  		  @$product_name= mysqli_real_escape_string($con,$_POST['product_name']);		   
		  if($product_name==''){$name="";}  else{ $name="and (supplier_name like '$product_name%' or supplier_name like '%$product_name%') ";}
		  
		  
    ?>
   
		 
        <table class="table-bordered" >
        <tr align="center">
         <th>ລະຫັດ</th>
         <th>ຊື່ຜູ້ສະໜອງ</th>
         <th>ເບີໂທ</th>
      
         <th>ເລືອກ</th>
        </tr>
        
        <?php
		
		@$sp=mysqli_query($con,"  SELECT * from suppliers where 1=1  $p $p_id $name   ");
		   while($f=mysqli_fetch_array($sp)){
		?>
        <tr>         
         <td><?php echo $f['supplier_id'];?></td>
         <td><?php echo $f['supplier_name'];?></td>
         <td><?php echo $f['tel'];?></td>
        
         <td>
      <button type="button" name="cc" class="btn btn-sm btn-success add_supplier" id="<?=$f['supplier_id'];?>" data-dismiss="modal"
       data-supplier_name="<?=$f['supplier_name'];?>" >ເລືອກ</button></td>
        </tr>
        <?php } ?>
        
       
         </table> 
