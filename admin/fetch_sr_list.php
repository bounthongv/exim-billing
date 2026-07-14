<?php 
  include("init.php");
    
   
		  @$sp=mysqli_query($con,"SELECT sr_list.*
		   FROM  sr_list 
		  
		    ");
		  if($sp){
          
          ?>
 			<table border="1"  class="table-bordered">
			<thead>
              <tr class="bgtd">
        <td align="center"><strong>ລະຫັດ</strong></td>
    	<td><strong>ຊື່</strong></td>         
       <td><strong>ນາມສະກຸນ</strong></td>     
       
        <td><strong>Tel</strong></td>
         <td><strong>Email</strong></td>
       
		 <td><strong>ແກ້ໄຂ</strong></td>
          <td><strong>ລົບ</strong></td>
              </tr>
			  </thead>
           
        <?php    while($f=mysqli_fetch_array($sp)){
            
			?>
		 		<tr>
				<td align="center"><?=$f['sr_id']?></td>
                 <td><?=$f['sr_fname'];?></td>   
    	         <td><?=$f['sr_lname'];?></td> 
                 <td><?=$f['sr_phone'];?></td> 
                 <td><?=$f['sr_email'];?></td>   			
				
				<input type="hidden" name="e_sr_id" id="e_sr_id<?=$f["Id"];?>"  value="<?=$f["sr_id"];?>" />
                <input type="hidden" name="e_sr_fname" id="e_sr_fname<?=$f["Id"];?>"  value="<?=$f["sr_fname"];?>" />
				<input type="hidden" name="e_sr_lname" id="e_sr_lname<?=$f["Id"];?>"  value="<?=$f["sr_lname"];?>" />
				<input type="hidden" name="e_sr_phone" id="e_sr_phone<?=$f["Id"];?>"  value="<?=$f["sr_phone"];?>" />
				<input type="hidden" name="e_sr_email" id="e_sr_email<?=$f["Id"];?>"  value="<?=$f["sr_email"];?>" />
                
				
				
				<input type="hidden" name="Id" id="Id<?=$f["Id"];?>"  value="<?=$f["Id"];?>" />
             		<td >
        <button  class="btn btn-success btn-sm edit_list" id="<?=$f['Id'];?>"    data-toggle="modal" data-target="#add_stock" data-id="<?php echo $f['User_ID']; ?>">
            ແກ້ໄຂ</button>  </td>
            
      <td ><a href="del_sr_list.php?Id=<?php echo $f['Id'];?>" onclick="return  confirm('ທ່ານຕ້ອງການບລົບແທ້ບໍ່');"><button  class="btn btn-danger btn-sm " id="<?=$f['Id'];?>" >ລົບ</button> </a></td>
				 
				</tr>
               <?php
            	
             } ?>
       </table>
		  
      <?php } ?>
