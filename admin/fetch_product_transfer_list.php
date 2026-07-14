<?php 
  include("init.php");
    
   
 
           @$gr_id= mysqli_real_escape_string($con,$_POST['gr_id']);		   
		  if($gr_id==''){$g_id="";}  else{ $g_id="and tb_groups.Group_ID='$gr_id' ";}
		  
		     @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);		   
		  if($stock_id==''){$s_id="";}  else{ $s_id="and stock_product.stock_id='$stock_id'";}

		  
		  @$sp=mysqli_query($con," select stock_product.*,sum(stock_product.qty) as t_qty
		  ,products.*   
		  from stock_product 
		  
		  LEFT JOIN products on products.Product_ID=stock_product.product_id
		  LEFT JOIN tb_groups on products.group_id=tb_groups.Group_ID
		  
		  where 1=1  and stock_product.qty>0 $s_id $g_id 
		  
		   group by stock_product.product_id  
		
		    ");
			//echo $s_id;
		
          ?>
          
 			<table  border="1"  class="table-bordered" >
            	<tr class="bgtd">
                	<th align="center">ລະຫັດ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>
					<th align="center" >ຈຳນວນ</th>
                   
                    <th align="center" >ຫົວຫນ່ວຍ</th>
					 <th align="center" >ລາຄາຕົ້ນທືນ</th>
                    <th align="center" >ແກ້ໄຂ</th>
				
                    
                </tr>
         <?php  
		   $e=0;
            while($s=mysqli_fetch_array($sp)){
            ?>
				<tr>
			    <td><?=$s["product_id"];?></td>
            	<td><?=$s["Product_Name"];?></td>
				<td align="center"><?=$s["t_qty"];?> </td>
               
            	<td align="center"><?=$s["Unit"];?></td>
				<td align="right"><?=@number_format($s["s3_price"],2);?></td>
                <td align="center">
				
				<input type="hidden" name="Id" id="Id<?=$s["product_id"];?>" class="form-control" value="<?=$s["Id"];?>" />
				<input type="hidden" name="Bar_Code" id="Bar_Code<?=$s["product_id"];?>" class="form-control" value="<?=$s["Bar_Code"];?>" />
				<input type="hidden" name="Quantity" id="Quantity<?=$s["product_id"];?>" class="form-control" value="<?=$s["QTY"];?>" />
				<input type="hidden" name="Unit" id="Unit<?=$s["product_id"];?>" class="form-control" value="<?=$s["Unit"];?>" />
				<input type="hidden" name="ups" id="ups<?=$s["product_id"];?>" class="form-control" value="<?=$s["ups"];?>" />
				
				<input type="hidden" name="Group_ID" id="Group_ID<?=$s["product_id"];?>" class="form-control" value="<?=$s["Group_ID"];?>" />
				
				<input type="hidden" name="qty_limit[]" id="qty_limit<?=$s["product_id"];?>" class="form-control" value="<?=$s["t_qty"];?>" />
				<input type="hidden" name="Product_ID[]" id="Product_ID<?=$s["product_id"];?>" class="form-control" value="<?=$s["product_id"];?>" />
                
				<input type="hidden" name="product_quantity[]" id="quantity<?=$s["product_id"];?>" class="form-control" value="1" />
            	<input type="hidden" name="product_name[]" id="product_name<?=$s["product_id"];?>" value="<?=$s["Product_Name"];?>" />
            	<input type="hidden" name="product_price[]" id="price<?=$s["product_id"];?>" value="<?=$s["s3_price"];?>" />
   <button type="button"  class="btn btn-success btn-sm add_pro"  id="<?=$s["product_id"];?>" value="<?=$s["product_id"];?>" data-dismiss="modal" >
			ເລືອກ	</button></td>
				
               <?php 
            $e++;	
             } 
      ?>   </table><?php
		  
       
		 





 
 
 ?>
