<?php 
  include("init.php");
     
 
         @$gr_id= mysqli_real_escape_string($con,$_POST['gr_id']);		   
		  if($gr_id==''){$g_id="";}  else{ $g_id="and tb_groups.Group_ID='$gr_id' ";}
		  
		  @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);		   
		 if($stock_id==''){$s_id="";}  else{ $s_id="and  stock_product.stock_id='$stock_id' ";}
		  
		  @$price_type= mysqli_real_escape_string($con,$_POST['price_type']);		   
		  if($price_type==''){$pp=",products.Price ";}  
		  elseif($price_type=='001'){ $pp=",products.s1_price  as price";}
		  elseif($price_type=='002'){ $pp=",products.s2_price  as price";}
		  elseif($price_type=='003'){ $pp=",products.s3_price  as price";}

		  
		  @$sp=mysqli_query($con,"select products.* $pp ,stock_products.qty
		  from products 
		  LEFT JOIN (select sum(qty) as qty ,product_id from  stock_product where 1=1 $s_id group by product_id) as stock_products 
		  on products.Product_ID=stock_products.product_id
		  LEFT JOIN tb_groups on products.group_id=tb_groups.Group_ID
		  where 1=1    $g_id group by products.product_id 
		    ");
		  if($sp){
          ?>
          
 			<table  border="1"  class="table-bordered" >
            	<tr class="bgtd" align="center">
                	<th align="center">ລະຫັດ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>
					<th align="center" >ຈຳນວນ</th>
                   
                    <th align="center" >ຫົວຫນ່ວຍ</th>
					 <th align="center" >ລາຄາຕົ້ນທືນ</th>
                    <th align="center" >ແກ້ໄຂ</th>
					
                    
                </tr>
         <?php  
		   $e=1;
            while($s=mysqli_fetch_array($sp)){
            ?>
				<tr>
			 <td><?=$s["Product_ID"];?></td> 
            	<td><?=$s["Product_Name"];?></td>
				<td align="center"><?=$s["qty"];?> </td>
               
            	<td align="center"><?=$s["Unit"];?></td>
				<td align="right"><?=@number_format($s["price"],2);?></td>
                <td align="center">
				
				<input type="hidden" name="Id" id="Id<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["Id"];?>" />
				<input type="hidden" name="Bar_Code" id="Bar_Code<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["Bar_Code"];?>" />
				<input type="hidden" name="Quantity" id="Quantity<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["QTY"];?>" />
				<input type="hidden" name="Unit" id="Unit<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["Unit"];?>" />
				<input type="hidden" name="ups" id="ups<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["ups"];?>" />
				
				<input type="hidden" name="Group_ID" id="Group_ID<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["Group_ID"];?>" />
				
				<input type="hidden" name="qty_limit[]" id="qty_limit<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["qty"];?>" />
				<input type="hidden" name="Product_ID[]" id="Product_ID<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["Product_ID"];?>" />
                <input type="hidden" name="product_lot_id[]" id="product_lot_id<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["product_lot_id"];?>" />
				<input type="hidden" name="product_quantity[]" id="quantity<?=$s["Product_ID"];?>" class="form-control" value="1" />
            	<input type="hidden" name="product_name[]" id="product_name<?=$s["Product_ID"];?>" value="<?=$s["Product_Name"];?>" />
            	<input type="hidden" name="product_price[]" id="price<?=$s["Product_ID"];?>" value="<?=$s["price"];?>" />
   <button type="button"  class="btn btn-success btn-sm add_pro"  id="<?=$s["Product_ID"];?>" value="<?=$s["Product_ID"];?>" data-dismiss="modal" >
			ເລືອກ	</button>
            </td>
				
               <?php 
            $e++;	
             } 
      ?>   </table><?php
		  
          } 
		 





 
 
 ?>
