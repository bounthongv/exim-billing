<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_sale.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
/*
         if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today' ";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  */
		  
		  	   if($from_date=='' or $to_date==''){$btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' )='$to_date'";} 
		  else{ $btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) between '$from_date' and '$to_date'";}

 
           @$product_id= mysqli_real_escape_string($con,$_POST['product_id']);		
		   /*   
		 if($product_id==''){$p_id="";}  else{ $p_id="and  product_sale.product_id='$product_id' ";}
		 */
	 if($product_id==''){$p_id="";}  else{ $p_id="and  sale_import.Product_SKU='$product_id' ";}


		  @$group_id= mysqli_real_escape_string($con,$_POST['group_id']);		   
		 if($group_id==''){$g_id="";}  else{ $g_id="and  tb_groups.Group_ID='$group_id' ";}
		
		/* 
		  @$sql_g=mysqli_query($con,"SELECT product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
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
              
				<th align="center">ຈຳນວນ</th>
                <th align="center">ຫົວໜ່ວຍ</th>
               
                 
              </tr>
           <?php
		   $i=1;
        //    while($g=mysql_fetch_array($sql_g)){
				

/*
	      SELECT product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.discount) as discount,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	   left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id 
	  
	  where 1=1  $s_id $p_id $g_id $btw  group by product_sale.product_id
	   order by product_sale.qty asc
	   */

				
				@$sql_d=mysqli_query($con,"SELECT sale_import.*
,sale_import.Invoice_Number as sale_id
,sum(sale_import.Quantity) as qty
	 ,sum(sale_import.Total) as t_amount
	 ,products.Product_ID,products.Product_Name
   ,customer_import.village as `address`
   ,customer_import.outlet_name as customer_name
   ,customer_import.phone_number as phone
   ,customer_import.outlet_name as fname
   ,customer_import.external_id as customer_id
   ,sale_import.Invoiced_Date as sale_date

		   FROM  sale_import 
		  LEFT JOIN products ON products.Product_ID = sale_import.Product_SKU 
      LEFT JOIN customer_import ON customer_import.external_id = sale_import.Outlet_External_ID
       
       where 1=1 $btw $p_id 
	   group by sale_import.Product_SKU
	   order by sale_import.Quantity asc
	          ");
			  ?>
			 
             
          <!--  <td colspan='9'></td>
			 <td colspan='1' align="right"></td>
             <td colspan='3'></td>-->
             
             
			<?  
			 while($s=mysqli_fetch_array($sql_d)){
			?>	<tr>
                <td align="center"><?=$i;?></td>
			    <td align="center"><?=$s["Product_ID"];?></td> 
                <td align="left"><?=$s["Product_Name"];?></td>
				
               
            	<td align="right"><?=$s["qty"];?></td>
                <td align="center"><?=$s["Unit"];?></td>
                 
				</tr>
               
			<?php	
			 @$t_qty +=$s['qty'];
		
			$i++;
             } 
			 
		
		//	 }
			  ?>
              <tr>
             <td colspan="3" align="right">ລວມຍອດ</td>
             <td colspan="1" align="right"><?=@$t_qty;?></td>
            <td colspan="1" align="right"></td>
             </tr> 
       </table>
       
		  
        <?php  


			
 
 ?>
