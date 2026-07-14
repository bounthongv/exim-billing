<?php 
  include("init.php");
    
   
		  @$sp=mysqli_query($con,"SELECT * FROM stocks ");
		  if($sp){
          
          $output ='
 			<table border="1"   class="table-bordered">
              <tr class="bgtd">
                <th>ລະຫັດສາງ</th>
                <th>ລາຍການສາງ</th>
                <th>ແກ້ໄຂ</th>
				<th>ລົບ</th>
              </tr>
           ';
            while($p=mysqli_fetch_array($sp)){
            
			$output .='
		 		<tr>
		 		<td>'.$p["stock_id"].'</td>
              	<td ><font color="#000000">'.$p["stock_name"].'</font></td>
				
				<input type="hidden" name="stock_name" id="stock_name'. $p["stock_id"].'"  value="'. $p["stock_name"].'" />
				<input type="hidden" name="Id" id="Id'. $p["stock_id"].'"  value="'. $p["Id"].'" />
              	<td ><button class="btn btn-success btn-sm edit_stock" id="'.$p['stock_id'].'"  data-toggle="modal" data-target="#add_stock">
                ແກ້ໄຂ</button></td>
				<td ><button class="btn btn-danger btn-sm delete_Id"  id="'. $p["Id"].'">ລົບ</button></td>
				</tr>
                ';
            	
             } 
       $output .='   </table>';
		  
          } 
		
		
		
		


echo 	  $output; 

 
 
 ?>
