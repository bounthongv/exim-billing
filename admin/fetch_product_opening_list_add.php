<?php 
  include("init.php");
    
   
 
           @$gr_id= mysqli_real_escape_string($con,$_POST['gr_id']);		   
		  if($gr_id==''){$g_id="";}  else{ $g_id="where Group_ID='$gr_id' ";}

		  
		  @$sp=mysqli_query($con,"select	* from products $g_id  ");
		  if($sp){
          
          $output ='
 			<table  border="1"  class="table-bordered" align="center">
            	<tr>
                	
                    <th align="center">ຊື່ສິນຄ້າ</th>
                    <th align="center" >ຈຳນວນຈຸດສັ່ງຊື້</th>
                    <th align="center" >ຫົວຫນ່ວຍ</th>
                    <th align="center" >ແກ້ໄຂ</th>
                    
                </tr>
           ';
            while($s=mysqli_fetch_array($sp)){
            
			$output .='	<tr>
            	<td>'. $s["Product_ID"].'&nbsp;'.$s["Product_Name"].'</td>
                <td>'.$s["QTY"].' </td>
            	<td>'. $s["Unit"].'</td>
                <td align="center">
				
				<input type="hidden" name="Id" id="Id'. $s["Product_ID"].'" class="form-control" value="'. $s["Id"].'" />
				<input type="hidden" name="Bar_Code" id="Bar_Code'. $s["Product_ID"].'" class="form-control" value="'. $s["Bar_Code"].'" />
				<input type="hidden" name="Quantity" id="Quantity'. $s["Product_ID"].'" class="form-control" value="'. $s["QTY"].'" />
				<input type="hidden" name="Unit" id="Unit'. $s["Product_ID"].'" class="form-control" value="'. $s["Unit"].'" />
				<input type="hidden" name="ups" id="ups'. $s["Product_ID"].'" class="form-control" value="'. $s["ups"].'" />
				
				<input type="hidden" name="Group_ID" id="Group_ID'. $s["Product_ID"].'" class="form-control" value="'. $s["Group_ID"].'" />
				
				
				<input type="hidden" name="quantity" id="quantity'. $s["Product_ID"].'" class="form-control" value="1" />
            	<input type="hidden" name="product_name" id="product_name'.$s["Product_ID"].'" value="'.$s["Product_Name"].'" />
            	<input type="hidden" name="price" id="price'.$s["Product_ID"].'" value="'.$s["Price"].'" />
   <a href="add_opening.php?action=cart&product_id='. $s["Product_ID"].'&product_name='. $s["Product_Name"].'&unit='. $s["Unit"].'&ups='. $s["ups"].'&sell_price='. $s["s3_price"].'"><input type="button"  class="btn btn-success btn-sm add_pro"  id="'.$s["Product_ID"].'" value="ເລືອກ"  ></a>
				
				</td>
				</tr>
                ';
            	
             } 
       $output .='   </table>';
		  
          } 
		 

  /*
	   $data = array(
	'table_product'		=>	$output
        );	

echo json_encode($data);
	   
*/

echo 	  $output; 

 
 
 ?>
