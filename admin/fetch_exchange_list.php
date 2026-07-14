<?php 
  include("init.php");
  
  
         @$start_date= mysqli_real_escape_string($con,$_POST['start_date']);	
         @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		 
         $today = date('Y-m-d');
		 
		  if($start_date=='' or $to_date==''){$btw="";}  
		  else{ $btw="and date_exchang between '$start_date' and '$to_date' ";}
		  
		  
    
   
		  @$sp=mysqli_query($con,"  select * from exchang where 1=1  $btw order by date_exchang desc		    ");
		  if($sp){
          
          $output ='
 			<table border="1"  class="table-bordered">
              <tr class="bgtd">
        
		 <td><strong>ວັນທີ</strong></td>
        <td><strong>ບາດ</strong></td>
        <td><strong>ໂດລາ</strong></td>
       
      
        <td><strong>ໜາຍເຫດ</strong></td>
		 <td><strong>ແກ້ໄຂ</strong></td>
		  <td><strong>ລົບ</strong></td>
              </tr>
           ';
            while($f=mysqli_fetch_array($sp)){
            
			$output .='
		 		<tr>
				<td align="center">'.$f['date_exchang'].'</td>
    	        <td>'. $f['kip_baht'].'</td>     
				<td>'. $f['dollar_baht'].'</td>      	
        	
				<td>'. $f['remark'].'</td> 
				
				
				
				
				<input type="hidden" name="eid" id="eid'. $f["eid"].'"  value="'. $f["eid"].'" />
				<input type="hidden" name="kip_baht" id="kip_baht'.$f["eid"].'"  value="'.$f["kip_baht"].'" />
				
				<input type="hidden" name="dollar_baht" id="dollar_baht'.$f["eid"].'"  value="'. $f["dollar_baht"].'" />
				<input type="hidden" name="date_exchang" id="date_exchang'.$f["eid"].'"  value="'.$f["date_exchang"].'" />
				<input type="hidden" name="remark" id="remark'.$f["eid"].'"  value="'.$f["remark"].'" />
		
              	<td ><button class="btn btn-success btn-sm edit_supplier" id="'.$f['eid'].'"  data-toggle="modal" data-target="#add_stock">
                ແກ້ໄຂ</button></td>
				<td ><button class="btn btn-danger btn-sm delete_Id"  id="'. $f["eid"].'">ລົບ</button></td>
				</tr>
                ';
            	
             } 
       $output .='   </table>';
		  
          } 
		
		
		
		


echo 	  $output; 

 
 
 ?>
