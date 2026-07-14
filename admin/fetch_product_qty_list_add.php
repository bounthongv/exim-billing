<?php 
  include("init.php");
    
   
 
           @$gr_id= mysqli_real_escape_string($con,$_POST['gr_id']);		   
		  if($gr_id==''){$g_id="";}  else{ $g_id="and products.Group_ID='$gr_id' ";}

		  
		  @$sp=mysqli_query($con,"	    SELECT products.*,sum(stock_product.qty) as total_qty,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit ,tb_groups.Group_Name
		   FROM  products
		   left join stock_product on products.Product_ID=stock_product.product_id
       left join stocks on stocks.stock_id=stock_product.stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       
       where    1=1   $g_id   group by products.Product_ID  order by products.Product_ID ");
		  if($sp){
          
          $output ='
 			<table  border="1"  class="table-bordered" align="center">
            	<tr>
                	 <th align="center">ລ/ດ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>
					<th align="center" >ຈຳນວນ</th>
                    <th align="center" >ຈຸດສັ່ງຊື້</th>
                    <th align="center" >ຫົວຫນ່ວຍ</th>
                    <th align="center" >ແກ້ໄຂ</th>
                    
                </tr>
           ';
		   $ls=1;
            while($s=mysqli_fetch_array($sp)){
            
			$output .='	<tr>
			    <td>'. $ls.'</td>
            	<td>'. $s["Product_ID"].'&nbsp;'.$s["Product_Name"].'</td>
				<td>'.$s["total_qty"].'</td>	
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
   <a href="add_product_qty.php?action=cart&product_id='. $s["Product_ID"].'&product_name='. $s["Product_Name"].'&unit='. $s["Unit"].'&ups='. $s["ups"].'&sell_price='. $s["s3_price"].'"><input type="button"  class="btn btn-success btn-sm add_pro"  id="'.$s["Product_ID"].'" value="ເລືອກ"  ></a>
				
				</td>
				</tr>
                ';
            $ls++;	
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
