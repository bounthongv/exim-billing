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

		  
		  @$sp=mysqli_query($con,"select	stock_product.*,products.* $pp,sum(stock_product.qty) as qty
		  from stock_product 
		  LEFT JOIN products on products.Product_ID=stock_product.product_id
		  LEFT JOIN tb_groups on products.group_id=tb_groups.Group_ID
		  where 1=1  and stock_product.qty>0 $s_id $g_id group by stock_product.product_id 
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
				
				<input type="hidden" name="Id" id="Id<?=$e;?>" class="form-control" value="<?=$s["Id"];?>" />
				<input type="hidden" name="Bar_Code" id="Bar_Code<?=$e;?>" class="form-control" value="<?=$s["Bar_Code"];?>" />
				<input type="hidden" name="Quantity" id="Quantity<?=$e;?>" class="form-control" value="<?=$s["QTY"];?>" />
				<input type="hidden" name="Unit" id="Unit<?=$e;?>" class="form-control" value="<?=$s["Unit"];?>" />
				<input type="hidden" name="ups" id="ups<?=$e;?>" class="form-control" value="<?=$s["ups"];?>" />
				
				<input type="hidden" name="Group_ID" id="Group_ID<?=$e;?>" class="form-control" value="<?=$s["Group_ID"];?>" />
				
				<input type="hidden" name="qty_limit[]" id="qty_limit<?=$e;?>" class="form-control" value="<?=$s["qty"];?>" />
				<input type="hidden" name="Product_ID[]" id="Product_ID<?=$e;?>" class="form-control" value="<?=$s["Product_ID"];?>" />
                <input type="hidden" name="product_lot_id[]" id="product_lot_id<?=$e;?>" class="form-control" value="<?=$s["product_lot_id"];?>" />
				<input type="hidden" name="product_quantity[]" id="quantity<?=$e;?>" class="form-control" value="1" />
            	<input type="hidden" name="product_name[]" id="product_name<?=$e;?>" value="<?=$s["Product_Name"];?>" />
            	<input type="hidden" name="product_price[]" id="price<?=$e;?>" value="<?=$s["price"];?>" />
   <button type="button"  class="btn btn-success btn-sm add_pro"  id="<?=$e;?>" value="<?=$s["Product_ID"];?>" data-dismiss="modal" >
			ເລືອກ	</button>
            </td>
				
               <?php 
            $e++;	
             } 
      ?>   </table><?php
		  
          } 
		 





 
 
 ?>
