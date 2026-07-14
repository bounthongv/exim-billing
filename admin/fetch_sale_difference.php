<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_sale.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today' ";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  
		  
		  
 
           @$product_id= mysqli_real_escape_string($con,$_POST['product_id']);		   
		 if($product_id==''){$p_id="";}  else{ $p_id="and  product_sale.product_id='$product_id' ";}
		 
		  @$group_id= mysqli_real_escape_string($con,$_POST['group_id']);		   
		 if($group_id==''){$g_id="";}  else{ $g_id="and  tb_groups.Group_ID='$group_id' ";}
		 
		  @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);	
         if($sale_id==''){$sa_id="";}  else{ $sa_id="and product_sale.sale_id='$sale_id'  ";}
		 
		  @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);	
         if($customer_id==''){$c_id="";}  else{ $c_id="and product_sale.customer_id='$customer_id'  ";}
		 
		  @$user_id= mysqli_real_escape_string($con,$_POST['user_id']);	
         if($user_id==''){$u_id="";}  else{ $u_id="and product_sale.user_id='$user_id'  ";}
		 
		 
		 
		 
		 
		  @$sql_g=mysqli_query($con,"SELECT product_sale.*,sum(product_sale.amount) as t_amount
		  ,sum(product_sale.qty*stock_product.price) as tt_amount,sum(discount) as discount,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
		,tb_groups.Group_ID,tb_groups.Group_Name,products.version,stock_product.price as t_price
		   FROM  product_sale 
	   left join products on products.Product_ID=product_sale.product_id
	   left join stock_product on stock_product.product_id=product_sale.product_id 
	            and stock_product.product_lot_id=product_sale.product_lot_id and  stock_product.stock_id=product_sale.stock_id 
       left join stocks on stocks.stock_id=product_sale.stock_id	  
       left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       where 1=1 $btw $s_id  $p_id $g_id $sa_id $c_id $u_id  group by tb_groups.Group_ID ");

		  
		  
		 
          ?>
       
 		<table border="1"   class="table-bordered " >
              <tr>
                <th align="center">ລຳດັບ</th>
                <th align="center">ສາງ</th>
                <th align="center">ລະຫັດສິນຄ້າ</th>
                <th align="center">ຊື່ສິນຄ້າ</th>
                <th align="center">ຫົວໜ່ວຍ</th>
				<th align="center">ຈຳນວນ</th>
                <th align="center">ຕົ້ນທືນ</th>
                <th align="center">ມູນຄ່າຕົ້ນທືນ</th>
               
                <th align="center">ລາຄາຂາຍ</th>
                <th align="center">ມູນຄ່າຂາຍ</th>
                <th align="center">ສ່ວນຫລູດ</th>
                <th align="center">ມູນຄ່າຂາຍສຸດທິ</th>
                <th align="center">ມູນຄ່າທຽບຕົ້ນທືນຂາຍ</th>
                 
              </tr>
           <?php
		   $i=1;
            while($g=mysqli_fetch_array($sql_g)){
				
				
				@$sql_d=mysqli_query($con,"
  
	   
	        SELECT  product_sale.* ,sum(product_sale.qty) as tt_qty,sum(product_sale.amount) as tt_amount, stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version , stock_product.price as t_price
		   FROM  product_sale
        
     left join stock_product on stock_product.stock_id=product_sale.stock_id and stock_product.product_lot_id=product_sale.product_lot_id
	   left join products on products.Product_ID=product_sale.product_id	     
     left join stocks   on stocks.stock_id=product_sale.stock_id
     left join tb_groups   on tb_groups.Group_ID=products.group_id 
	  
	  where 1=1 and tb_groups.Group_ID='$g[Group_ID]' $s_id $p_id  $btw $sa_id $c_id $u_id
	  group by product_sale.product_id,product_sale.product_lot_id
	   order by product_sale.product_id
	   
	          ");
			  ?>
			 
             
            <td colspan='7'><?php  echo $g['Group_ID'];?> &nbsp; <?php echo  $g['Product_Name'];?></td>
			 <td colspan='1' align="right"><?php echo  @number_format($g['tt_amount'],2);?></td>
             <td colspan='1'></td>
              <td colspan='1' align="right"><?php echo  @number_format($g['t_amount'],2);?></td>
             <td colspan='1' align="right"><?php echo  @number_format($g['discount'],2);?></td>
             <td colspan='1' align="right"><?php echo  @number_format($g['t_amount']-$g['discount'],2);?></td>
             <td colspan='1' align="right"><?php echo  @number_format($g['t_amount']-$g['tt_amount']-$g['discount'],2);?></td>
			<?  
			 while($s=mysqli_fetch_array($sql_d)){
			?>	<tr>
                <td align="center"><?=$i;?></td>
                <td align="center"><?=$s["stock_id"];?></td> 
			    <td align="center"><?=$s["product_lot_id"];?></td> 
                <td align="left"><?=$s["Product_Name"];?></td>
				<td align="center"><?=$s["Unit"];?></td>
                <td align="center"><?=$s["tt_qty"];?></td>
                <td align="right"><?=@number_format($s["t_price"],2);?></td>
                
                <td align="right"><?=@number_format($s["tt_qty"]*$s["t_price"],2);?></td>
                <td align="right"><?=@number_format($s["price"],2);?></td>
                <td align="right"><?=@number_format($s["tt_amount"],2);?></td>
                
				<td align="right" ><?=@number_format($s["discount"],2);?></td>
            	<td align="right"><?=@number_format($s["tt_qty"]*$s["price"]-$s["discount"],2);?></td>
                <td align="right"><?=@number_format($s["tt_amount"]-($s["tt_qty"]*$s["t_price"]),2);?></td>
                
				</tr>
               
			<?php	
		
			$i++;
             } 
			 @$tt_t_amount +=$g['tt_amount'];
			 @$tt_amount +=$g['t_amount'];
			 @$t_discount +=$g['discount'];
			 @$t_ad +=$g['t_amount']-$g['discount'];
			 @$tt_ad +=$g['t_amount']-$g['tt_amount']-$g['discount'];
			 }
			  ?>
              <tr>
             <td colspan="7" align="right">ລວມຍອດ</td>
             <td colspan="1" align="right"><?=@number_format($tt_t_amount,2);?></td>
             <td colspan="1" align="right"></td>
             <td colspan="1" align="right"><?=@number_format($tt_amount,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_discount,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_ad,2);?></td>
             <td colspan="1" align="right"><?=@number_format($tt_ad,2);?></td>
            
             </tr> 
       </table>
       
		  
        <?php  


			
 
 ?>
