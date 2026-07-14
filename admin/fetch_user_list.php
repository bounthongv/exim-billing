<?php 
  include("init.php");
    
   
		  @$sp=mysqli_query($con,"SELECT users.*,stocks.stock_name
		   FROM  users 
		   left join stocks on stocks.stock_id=users.stock_id
		    ");
		  if($sp){
          
          ?>
 			<table border="1"  class="table-bordered">
			<thead>
              <tr class="bgtd">
        <td align="center"><strong>ລຳດັບ</strong></td>
    	<td><strong>ຊື່ ຜູ້ໃຊ້ </strong></td>         
       <td><strong>ລະຫັດຜູ້ໃຊ້ </strong></td>     
       
        <td><strong>ສະຖານະ</strong></td>
         <td><strong>ສາງ</strong></td>
         <td><strong>ພະແນກ</strong></td>
		 <td><strong>ແກ້ໄຂ</strong></td>
              </tr>
			  </thead>
           
        <?php    while($f=mysqli_fetch_array($sp)){
            
			?>
		 		<tr>
				<td align="center"><?=$f['User_ID']?></td>
                 <td><?= $f['fname'];?></td>   
    	        <td><?= $f['User_Name'];?></td>   
                <td><?php if($f['status']=='0'){echo "Admin";}else{  echo "User";}?></td>      	
        		<td><?php if($f['stock_id']=='admin'){echo "ທັງຫມົດ";}else{  echo $f['stock_name'];}?></td>
                <td><?php if($f['user_type']=='0'){echo "admin";} 
				elseif($f['user_type']=='1'){ echo "ສາງສິນຄ້າ";}
				elseif($f['user_type']=='2'){ echo "ຊື້";}
				elseif($f['user_type']=='3'){ echo "ຂາຍ";}
				else{  echo $f['user_type'];}?></td>
                
        		
        		
				
				
				
				
				
				<input type="hidden" name="User_Name" id="User_Name<?=$f["Id"];?>"  value="<?=$f["User_Name"];?>" />
                <input type="hidden" name="fname" id="fname<?=$f["Id"];?>"  value="<?=$f["fname"];?>" />
				<input type="hidden" name="stock_id" id="stock_id<?=$f["Id"];?>"  value="<?=$f["stock_id"];?>" />
				<input type="hidden" name="User_ID" id="User_ID<?=$f["Id"];?>"  value="<?=$f["User_ID"];?>" />
				<input type="hidden" name="status" id="status<?=$f["Id"];?>"  value="<?=$f["status"];?>" />
                <input type="hidden" name="user_type" id="user_type<?=$f["Id"];?>"  value="<?=$f["user_type"];?>" />
				
				
				<input type="hidden" name="Id" id="Id<?=$f["Id"];?>"  value="<?=$f["Id"];?>" />
             		<td >
        <button  class="btn btn-success btn-sm edit_supplier" id="<?=$f['Id'];?>"    data-toggle="modal" data-target="#add_stock" data-id="<?php echo $f['User_ID']; ?>">
            ແກ້ໄຂ</button>  </td>
				 
				</tr>
               <?php
            	
             } ?>
       </table>
		  
      <?php } ?>
