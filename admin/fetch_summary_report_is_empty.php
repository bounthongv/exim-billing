<?php 
  include("init.php");
  $office1=$_SESSION['office'];
   
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
		 
		  @$sql_g=mysqli_query($con,"SELECT product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
		,tb_groups.Group_ID	,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id and products.office_id='$office1'
       left join stocks on stocks.stock_id=product_sale.stock_id and stocks.office_id='$office1'
	     left join customers on customers.customer_id=product_sale.customer_id and customers.office_id='$office1'
       left join tb_groups on tb_groups.Group_ID=products.group_id and tb_groups.office_id='$office1'
       
       where 1=1 $btw $s_id  $p_id $g_id    
       and products.Product_ID like 'E%'
       and product_sale.office_id='$office1'

        group by tb_groups.Group_ID");

		  
		  
		 
          ?>
        
 		<table border="1"   class="table-bordered " >
              <tr>
                <th align="center">ລຳດັບ</th>
                <th align="center">ລະຫັດສິນຄ້າ</th>
                <th align="center">ຊື່ສິນຄ້າ</th>
                <th align="center">ລູກຄ້າ</th>
                <th align="center">ບິນເລກທີ</th>
                <th align="center">ວັນທີ</th>
				<th align="center">ຈຳນວນ</th>
                <th align="center">ຫົວໜ່ວຍ</th>
                <th align="center"></th>
                <th align="center">ແກ້ວ</th>
         
              </tr>
           <?php
		   $i=1;
            while($g=mysqli_fetch_array($sql_g)){
				
				
				@$sql_d=mysqli_query($con,"SELECT product_sale.*,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name,if(products.ups = '',0,products.ups)as ups
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id and products.office_id='$office1'
       left join stocks on stocks.stock_id=product_sale.stock_id and stocks.office_id='$office1'
	   left join customers on customers.customer_id=product_sale.customer_id and customers.office_id='$office1'
       left join tb_groups on tb_groups.Group_ID=products.group_id and tb_groups.office_id='$office1'
	  
	  where 1=1 and tb_groups.Group_ID='$g[Group_ID]' $s_id $p_id  $btw
      and products.Product_ID like 'E%'
    and product_sale.office_id='$office1'
	   order by product_sale.product_id
	          ");


			  ?>
			 
             
            <td colspan='6'><?php  echo $g['Group_ID'];?> &nbsp; <?php echo  $g['Product_Name'];?></td>

       <td colspan='1' align="right"><?php echo  @number_format($g['qty'],2);?></td>
    
             
             
			<?php  
			 while($s=mysqli_fetch_array($sql_d)){
                $glasses=$s["ups"]*$s["qty"];
			?>	<tr>
                <td align="center"><?=$i;?></td>
			    <td align="center"><?=$s["product_id"];?></td> 
                <td align="left"><?=$s["Product_Name"];?></td>
				<td align="left"><?=$s["customer_name"];?></td>
                
				<td align="left"><?=$s["sale_id"];?></td>
            	<td align="center"><?php $dd=date_create("$s[sale_date]"); ?><?=date_format($dd,"d-m-Y");?></td>
               
            	<td align="center"><?=$s["qty"];?></td>
                <td align="center"><?=$s["Unit"];?></td>
                <td align="center"><?=$s["ups"];?></td>
                <td align="center"><?=$glasses;?></td>
				</tr>
               
			<?php	
		
			$i++;
            
      @$tt_qty +=$s['qty'];
      @$tt_glasses +=$glasses;
             } 
       


			 }
             
			  ?>
              <tr>
             <td colspan="6" align="right">ລວມລັງເປົ່າ</td>
             <td colspan="1" align="right"><?=@number_format($tt_qty,0);?></td>
             <td colspan="1" align="right">ລວມແກ້ວເປົ່າ</td>
             <td colspan="1" align="right"><?=@number_format($tt_glasses,0);?></td>
     
          
             </tr> 
       </table>
       
		  
        <?php  


			
 
 ?>
