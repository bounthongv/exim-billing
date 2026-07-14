<?php 
  include("init.php");
    
	
	     
         @$email= mysqli_real_escape_string($con,$_POST['email']);	
         if($email==''){$e="";}  else{ $e="and emails like '%$email%'  ";}
		 

		  @$product_id= mysqli_real_escape_string($con,$_POST['product_id']);		   
		  if($product_id==''){$p_id="";}  else{ $p_id="and supplier_id like '%$product_id%' ";}
		  
		  		  @$product_name= mysqli_real_escape_string($con,$_POST['product_name']);		   
		  if($product_name==''){$name="";}  else{ $name="and supplier_name like '%$product_name%' ";}
		  
		  
   
		  @$sp=mysqli_query($con,"SELECT * FROM  suppliers  where 1=1  $e $p_id $name  ");
		  if($sp){
          
          $output ='
 			<table border="1"  class="table-bordered">
              <tr class="bgtd">
        <td align="center"><strong>ລະຫັດຜູ້ສະໜອງ</strong></td>
    	<td><strong>ຊື່ ຜູ້ສະໜອງ </strong></td>         
        <td><strong>ທີ່ຢູ່</strong></td>
        <td><strong>ເບີໂທລະສັບ</strong></td>
        <td><strong>ແຟັກ</strong></td>
        <td><strong>ອີເມວ</strong></td>
        <td><strong>ເລກບັນຊີທະນາຄານ</strong></td>
        <td><strong>ໜາຍເຫດ</strong></td>
		 <td><strong>ແກ້ໄຂ</strong></td>
		  <td><strong>ລົບ</strong></td>
              </tr>
           ';
            while($f=mysqli_fetch_array($sp)){
            
			$output .='
		 		<tr>
				<td align="center">'.$f['supplier_id'].'</td>
    	        <td>'. $f['supplier_name'].'</td>         	
        		<td>'. $f['address'].'</td>
        		<td>'. $f['tel'].'</td>
        		<td>'. $f['fax'].'</td>
        		<td>'. $f['emails'].'</td>
        		<td>'. $f['bank_no'].'</td>
        		<td>'. $f['remark'].'</td>
				
				
				
				
				
				<input type="hidden" name="supplier_name" id="supplier_name'. $f["supplier_id"].'"  value="'. $f["supplier_name"].'" />
				<input type="hidden" name="address" id="address'.$f["supplier_id"].'"  value="'. $f["address"].'" />
				<input type="hidden" name="tel" id="tel'.$f["supplier_id"].'"  value="'.$f["tel"].'" />
				<input type="hidden" name="fax" id="fax'.$f["supplier_id"].'"  value="'.$f["fax"].'" />
				<input type="hidden" name="emails" id="emails'.$f["supplier_id"].'"  value="'.$f["emails"].'" />
				<input type="hidden" name="bank_no" id="bank_no'.$f["supplier_id"].'"  value="'.$f["bank_no"].'" />
				<input type="hidden" name="remark" id="remark'.$f["supplier_id"].'"  value="'.$f["remark"].'" />
				
				<input type="hidden" name="spid" id="spid'.$f["supplier_id"].'"  value="'. $f["spid"].'" />
              	<td ><button class="btn btn-success btn-sm edit_supplier" id="'.$f['supplier_id'].'"  data-toggle="modal" data-target="#add_stock">
                ແກ້ໄຂ</button></td>
				<td ><button class="btn btn-danger btn-sm delete_Id"  id="'. $f["spid"].'">ລົບ</button></td>
				</tr>
                ';
            	
             } 
       $output .='   </table>';
		  
          } 
		
		
		
		


echo 	  $output; 

 
 
 ?>
