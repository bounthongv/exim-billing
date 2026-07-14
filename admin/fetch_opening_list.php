<?php 
  include("init.php");
    
   
          @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and stock_opening.stock_id='$stock_id'  ";}
		 
           @$group_id= mysqli_real_escape_string($con,$_POST['group_id']);		   
		 if($group_id==''){$g_id="";}  else{ $g_id="and  tb_groups.Group_ID='$group_id' ";}
		  
		   @$m= mysqli_real_escape_string($con,$_POST['m']);	
		   @$y= mysqli_real_escape_string($con,$_POST['y']);
		   $open_date=date($y.'-'.$m.'-'.'01');	
		   $today=date("Y-m-01");
         if($m=='' or $y==''){$btw="and stock_opening.open_date = '$today'";} 
		  else{ $btw="and stock_opening.open_date = '$open_date' ";}
		  
 
       
		 
		 

		  
		  @$sp=mysqli_query($con," SELECT stock_opening.*,products.Product_ID,products.Product_Name,products.size,products.Unit
		   ,tb_groups.Group_Name,products.ups
		   FROM  stock_opening 
		   left join products on products.Product_ID=stock_opening.product_id
       left join stocks on stocks.stock_id=stock_opening.stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
	   where 1=1 $s_id $g_id $btw and stock_opening.qty is not null
	          ");
		  if($sp){
          
          $output ='
 		<table border="1"  class="table-bordered " >
              <tr >
                <th align="center">ວັນທີເປີດ</th>
                <th align="center">ລະຫັດສິນຄ້າ</th>
                <th align="center">ຊື່ສິນຄ້າ</th>
               
                <th align="center">ຂະຫນາດ</th>
               <th align="center">ແພັກPCS</th>
			    <th align="center">ຫົວຫນ່ວຍ</th>
				 <th align="center">ຈຳນວນຍົກມາ</th>
				  <th align="center">ລາຄາຕົ້ນທືນ</th>
               <th align="center">ມູນຄ່າ</th>
			    <th align="center">ຫມວດສິນຄ້າ</th>
                <th align="center">ແກ້ໄຂ</th>
                  <th align="center">ລົບ</th>
              </tr>
           ';
            while($s=mysqli_fetch_array($sp)){
            
			$dd=date_create($s['open_date']);  
			$output .='	<tr>
			  
				<td align="center">'.date_format($dd,"m/Y").'</td>
            	<td align="center">'.$s["product_id"].'</td>               
            	<td align="left">'. $s["Product_Name"].'</td>
				<td align="center">'. $s["size"].'</td>
				<td align="center">'. $s["ups"].'</td>
				<td align="center">'. $s["Unit"].'</td>
				
				<td align="right">'. $s["qty"].'</td>
				<td align="right">'. $s["price"].'</td>
				<td align="right">'. $s["amount"].'</td>
				<td>'. $s["Group_Name"].'</td>
              <td align="center"><a href="edit_opening.php?Id='.$s["Id"].'"><button type="button" class="btn btn-success btn-sm">ແກ້ໄຂ</button></td>
                <td align="center">
			<input type="hidden" name="stock_id'.$s["product_id"].'" id="stock_id'.$s["product_id"].'" value="'.$s["stock_id"].'">
				<button type="button" class="btn btn-danger btn-sm delete_Id" id="'. $s["Id"].'" value="'.$s["product_id"].'">ລົບ</button></td>
				</tr>
                ';
				
				
				
             } 
       $output .='   </table>';
		  
          } 
		 


echo 	  $output; 

 
 
 ?>
