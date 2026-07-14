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
		
		/* 
		  @$sql_g=mysql_query("SELECT product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
		,tb_groups.Group_ID	,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       where 1=1 $btw $s_id  $p_id $g_id group by tb_groups.Group_ID");

		  
		  */
		 
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
               
                <th align="center">ລາຄາ/ໜ່ວຍ</th>
              <th align="center">ມູນຄ່າລວມ</th>
               <th align="center">ສ່ວນຫລູດ</th>
               <th align="center">ແຖມ</th>
                <th align="center">ມູນຄ່າຍັງເຫຼືອ</th>
                 
              </tr>
           <?php
		   $i=1;
        //    while($g=mysql_fetch_array($sql_g)){
				
				
				@$sql_d=mysqli_query($con,"
  
	   
	      SELECT product_sale.*,sum(product_sale.qty) as qty,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	   left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id 
	  
	  where 1=1  $s_id $p_id $g_id $btw  group by product_sale.sale_id,product_sale.product_id
	   order by product_sale.product_id
	   
	          ");
			  ?>
			 
             
          <!--  <td colspan='9'></td>
			 <td colspan='1' align="right"></td>
             <td colspan='3'></td>-->
             
             
			<?  
			 while($s=mysqli_fetch_array($sql_d)){
			?>	<tr>
                <td align="center"><?=$i;?></td>
			    <td align="center"><?=$s["product_id"];?></td> 
                <td align="left"><?=$s["Product_Name"];?></td>
				<td align="left"><?=$s["customer_name"];?></td>
                
				<td align="left"><?=$s["sale_id"];?></td>
            	<td align="center"><?php $dd=date_create("$s[sale_date]"); ?><?=date_format($dd,"d-m-Y");?></td>
               
            	<td align="center"><?=$s["qty"];?></td>
                <td align="center"><?=$s["Unit"];?></td>
                 <td align="right"><?=@number_format($s["price"],2);?></td>
                <td align="right"><?=@number_format($s["amount"],2);?></td>
				<td align="right"><?=@number_format($s["discount"],2);?></td>
                <td align="right"></td>
                <td align="right"><?=@number_format($s["amount"]-$s["discount"],2);?></td>
				</tr>
               
			<?php	
			 @$tt_amount +=$s['amount'];
			  @$t_discount +=$s['discount'];
			  @$tt_amt +=$s['amount']-$s['discount'];
			$i++;
             } 
			 
		
		//	 }
			  ?>
              <tr>
             <td colspan="9" align="right">ລວມຍອດ</td>
             <td colspan="1" align="right"><?=@number_format($tt_amount,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_discount,2);?></td>
             <td colspan="1"></td>
              <td colspan="1" align="right"><?=@number_format($tt_amt,2);?></td>
             </tr> 
       </table>
       
		  
        <?php  


			
 
 ?>
