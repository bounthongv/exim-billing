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
"SELECT product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
		,tb_groups.Group_ID	,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       where 1=1 $btw $s_id  $p_id $g_id group by tb_groups.Group_ID"
*/




		  @$sql_g=mysqli_query($con,"SELECT sale_import.*
,sale_import.Invoice_Number as sale_id
,sum(sale_import.Quantity) as t_qty
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
       
       where 1=1 $btw $p_id ");

		  
		  
		 
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

/*
            while($g=mysqli_fetch_array($sql_g)){
				*/


/*
"SELECT product_sale.*,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	   left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id 
	  
	  where 1=1 and tb_groups.Group_ID='$g[Group_ID]' $s_id $p_id  $btw
	   order by product_sale.product_id"
*/
				
				@$sql_d=mysqli_query($con,"SELECT sale_import.*
,sale_import.Invoice_Number as sale_id
,sale_import.Quantity as qty
,sale_import.price as price
	 ,sale_import.Total as amount
	 ,products.Product_ID
   ,products.Product_Name
   ,customer_import.village as `address`
   ,customer_import.outlet_name as customer_name
   ,customer_import.phone_number as phone
   ,customer_import.outlet_name as fname
   ,customer_import.external_id as customer_id
   ,sale_import.Invoiced_Date as sale_date

		   FROM  sale_import 
		  LEFT JOIN products ON products.Product_ID = sale_import.Product_SKU 
      LEFT JOIN customer_import ON customer_import.external_id = sale_import.Outlet_External_ID
       
       where 1=1  $btw $p_id 
     order by sale_import.Product_SKU
     ");
			  ?>
			 
             
<?php /*

            <td colspan='9'><?php  echo $g['Group_ID'];?> &nbsp; <?php echo  $g['Product_Name'];?></td>
			 <td colspan='1' align="right"><?php echo  @number_format($g['amount'],2);?></td>
             <td colspan='3'></td>
             
*/ ?>


             
			<?  
			 while($s=mysqli_fetch_array($sql_d)){
			?>	<tr>
                <td align="center"><?=$i;?></td>
			    <td align="center"><?=$s["Product_ID"];?></td> 
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
                <td align="right"><?=@number_format($s["amount"],2);?></td>
				</tr>
               
			<?php	
		
			$i++;
             } 
			 
			 @$tt_amount +=$g['amount'];

/*
			 }
*/


			  ?>
              <tr>
             <td colspan="9" align="right">ລວມຍອດ</td>
             <td colspan="1" align="right"><?=@number_format($tt_amount,2);?></td>
             <td colspan="1" align="right"></td>
             <td colspan="1"></td>
             <td colspan="1" align="right"></td>
             </tr> 
       </table>
       
		  
        <?php  


			
 
 ?>
