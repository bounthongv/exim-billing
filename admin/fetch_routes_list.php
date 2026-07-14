<?php 
  include("init.php");
    
   
		  @$sp=mysqli_query($con,"SELECT * FROM routes ");
		  if($sp){
          
          $output ='
 			<table border="1"   class="table-bordered">
              <tr class="bgtd">
                <th>ລະຫັດ</th>
                <th>ລາຍການ</th>
                <th>ແກ້ໄຂ</th>
				<th>ລົບ</th>
              </tr>
           ';
            while($p=mysqli_fetch_array($sp)){
            
			$output .='
		 		<tr>
		 		<td>'.$p["route_id"].'</td>
              	<td ><font color="#000000">'.$p["route_name"].'</font></td>
				
				<input type="hidden" name="route_name" id="route_name'. $p["route_id"].'"  value="'. $p["route_name"].'" />
				<input type="hidden" name="Id" id="Id'. $p["route_id"].'"  value="'. $p["Id"].'" />
              	<td ><button class="btn btn-success btn-sm edit_route" id="'.$p['route_id'].'"  data-toggle="modal" data-target="#add_route">
                ແກ້ໄຂ</button></td>
				<td ><button class="btn btn-danger btn-sm delete_Id"  id="'. $p["Id"].'">ລົບ</button></td>
				</tr>
                ';
            	
             } 
       $output .='   </table>';
		  
          } 
		
		
		
		


echo 	  $output; 

 
 
 ?>
