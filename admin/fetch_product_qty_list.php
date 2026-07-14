<?php 
  include("init.php");
             
			 
			 
            @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and stock_product.stock_id='$stock_id'  ";}
		 
        
		  
		  @$product_id= mysqli_real_escape_string($con,$_POST['product_id']);		   
		  if($product_id==''){$p_id="";}  else{ $p_id="and stock_product.product_id='$product_id' ";}
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$dd="";} 
		  else{ $dd="and stock_product.stockin_date between '$from_date' and '$to_date' ";}
   
 
           @$gr_id= mysqli_real_escape_string($con,$_POST['gr_id']);		   
		  if($gr_id==''){$g_id="";}  else{ $g_id="and tb_groups.Group_ID='$gr_id' ";}
		  
		  
		 $user_status=$_SESSION['status'];

/*	select products.* $pp ,stock_products.qty,stock_products.block_id,block.block_name,stock_products.barcode as bc_id
		 
		  from products 
		  
		  LEFT JOIN (select sum(qty) as qty ,product_id,product_lot_id,block_id,barcode from  stock_product 
		  where 1=1 $s_id group by product_id,block_id) as stock_products 
		  on products.Product_ID=stock_products.product_id
		 
		  LEFT JOIN block on stock_products.block_id=block.block_id
		  left join zone on zone.zone_id=block.zone_id
		  LEFT JOIN tb_groups on products.group_id=tb_groups.Group_ID
		  
		  where 1=1  and stock_products.qty>0 $z_id $bl $g_id $p_id $name  
		  group by products.product_id,stock_products.block_id*/
		  
		  @$sp=mysqli_query($con,"SELECT stock_product.*,stock_product.qty,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,products.ups,products.s3_price,products.QTY as qty_limit
		   FROM  stock_product 
		   left join products on products.Product_ID=stock_product.product_id
       left join stocks on stocks.stock_id=stock_product.stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       
       where      stock_product.qty>0   $g_id $s_id $p_id 
	   
	   group by stock_product.product_lot_id,stock_product.stock_id 
	    order by stock_product.product_id,stock_product.product_lot_id
		
		
	
 		   
		   
		    ");
		  if($sp){
          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="center">
            	<tr>
                	
					<th align="center">ລະຫັດສິ້ນຄ້າ</th>
                    <th align="center">ຊື່ສິນຄ້າ(ລາວ)</th>
					<th align="center" >ຫົວຫນ່ວຍ</th>
					  <th align="center" >ລຸ້ນ</th>
                      <?php if($user_status=='0'){ ?>
					   <th align="center" >ລາຄາຕົ້ນທືນ</th>
                        <?php } else{ }?>
					    <th align="center" >ສາງ</th>
                    <th align="center" >ຈຳນວນ</th> 
                    <?php if($user_status=='0'){ ?>                   
                    <th align="center" >ເປັນເງີນ</th>
                     <?php } else{ }?>
					<th align="center" >ວັນທີຮັບເຂົ້າ</th>
                     <?php if($user_status=='0'){ ?>   
					<th align="center" >ແກ້ໄຂ</th>
                    <th align="center" >ລົບ</th>
                     <?php } else{ }?>
                </tr>
          <?php
            while($s=mysqli_fetch_array($sp)){
            
			?>
				<tr>
			
			     <td><?php echo $s["product_lot_id"]; ?></td>
            	<td><?php echo $s["Product_ID"]; ?>&nbsp;<?php echo$s["Product_Name"]; ?></td>              
            	<td align="center"><?php echo $s["Unit"]; ?></td>
				<td><?php echo $s["version"]; ?></td>
                 <?php if($user_status=='0'){ ?>
				<td align="right"><?php echo@number_format( $s["price"],2); ?></td>
                <?php } else{ }?>
				<td><?php echo$s["stock_id"]; ?> </td>	
				<td><?php echo$s["qty"]; ?> </td>	
                <?php if($user_status=='0'){ ?>
				<td align="right" ><?php echo@number_format($s["qty"]*$s["price"],2); ?> </td>
                <?php } else{ }?>
                
				<td><?php echo$s["stockin_date"]; ?> </td>
					 <?php if($user_status=='0'){ ?>  
		<?php			
				if(strlen($s["product_lot_id"])>7){  ?>
					
					 <td></td>
					<td>
   <button  type="button" class="btn btn-danger btn-sm delete_product_qty " name="del" id="<?php echo $s["Id"]; ?>">ລົບ</button></td> 
				
				
		<?php		}else{  ?>
		
                 <td>
	<a href="edit_product_qty.php?product_id=<?php echo$s["product_lot_id"]; ?>&product_name=<?php echo $s["Product_Name"]; ?>&unit=<?php echo $s["Unit"]; ?>&ups=<?php echo $s["ups"]; ?>&sell_price=<?php echo $s["s3_price"]; ?>&price=<?php echo $s["price"]; ?>&qty=<?php echo $s["qty"]; ?>&expert_date=<?php echo $s["expert_date"]; ?>&Id=<?php echo $s["Id"]; ?>&stock_id=<?php echo $s["stock_id"]; ?>">
	<button class="btn btn-success btn-sm " name="product_id" id="product_id">ແກ້ໄຂ</button> </a>
	
	</td>
	<td>
   <button  type="button" class="btn btn-danger btn-sm delete_product_qty " name="del" id="<?php echo $s["Id"]; ?>">ລົບ</button></td>
				
               
		<?php	} ?>
        <?php } else{ }?>
			</tr>
           <?php	} ?>
        </table>
		  
       <?php	} 
		 

  /*
	   $data = array(
	'table_product'		=>	$output
        );	

echo json_encode($data);
	   
*/

// echo 	  $output; 

 
 
 ?>
