<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_sale.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
/*
         if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today'";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  */
  if($from_date=='' or $to_date==''){$btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' )='$to_date'";} 
		  else{ $btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) between '$from_date' and '$to_date'";}


 
           @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);
/*
		   if($sale_id==''){$sa_id="";}  else{ $sa_id="and  product_sale.sale_id='$sale_id' ";}		
		   */
 if($sale_id==''){$sa_id="";}  else{ $sa_id="and  sale_import.Invoice_Number='$sale_id' ";}



		    @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);	   
		 if($customer_id==''){$c_id="";}  else{ $c_id="and  product_sale.customer_id='$customer_id' ";}
		 
		@$summary= mysqli_real_escape_string($con,$_POST['summary']); 
      echo $summary;
if($summary=='1'){

		/*  
"
    
	   select * from (   
    
       SELECT product_sale.*,stocks.stock_name
       ,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,sum(product_sale.amount) as total_amt,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       where 1=1       $btw  $c_id $s_id  $sa_id
	   group by product_sale.sale_id   order by product_sale.sale_id 
     
        
        ) as tb_a where  payment < total_amt  
	   
	          "
*/




		  @$sp=mysqli_query($con,"SELECT * from (
SELECT 
sale_import.Invoice_Number as sale_id
,sum(sale_import.Quantity) as qty
	 ,sum(sale_import.Total) as total_amt
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
       
       
       where 1=1       $btw  $p_id   
	   group by sale_import.Invoice_Number   order by sale_import.Invoice_Number 

        
        ) as tb_a
        /*
         where  payment < total_amt  
	   */
	          ");
		  if($sp){
          ?>
        
 		<table border="1"   class="table-bordered " >
              <tr> 
              
              <th align="center">ລູກຄ້າ</th>
      
				<th align="center">ສາງ</th>
               
                <th align="center">ເລກທີບິນ</th>
               
              <th align="center">ມູນຄ່າລວມ</th>
               <th align="center">ມູນຄ່າຊຳລະ</th>
               <th align="center">ມູນຄ່າຍັງເຫຼືອ</th>
               <th align="center">ພິມ</th>
             
              </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
          
			?>	<tr>
               <td><?=$s["customer_id"];?>&nbsp;<?=$s["customer_name"];?></td>
			  
				<td><?=$s["stock_id"];?>&nbsp;<?=$s["stock_name"];?></td>
            	
               
            	<td align="center"><?= $s["sale_id"];?></td>
                <td align="right"><?=@number_format($s["total_amt"],2);?></td>
				<td align="right"><?=@number_format($s["payment"],2);?></td>
              <td align="right"><?=@number_format($s["total_amt"]-$s["payment"],2);?></td>
              <td align="right">
          <a href="print_invoice.php?sale_id=<?=$s["sale_id"];?>&sale_date=<?=$s["sale_date"];?>" target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> ພິມບິນ</button></a></td>
             
				</tr>
               
			<?php	
				@$t_amt +=$s["total_amt"];
				@$t_payment +=$s["payment"];
				@$t_debit +=$s["total_amt"]-$s["payment"];
             } ?>
             <td colspan="3" align="right">ລວມ</td>
             <td colspan="1" align="right"><?=@number_format($t_amt,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_payment,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_debit,2);?></td>
             <td colspan="1"></td>
             
       </table>
       
		  
        <?php  } 
}
elseif($summary=='2'){
		  
?>
        
 		<table border="1"   class="table-bordered " >
              <tr> 
              
              <th align="center">ລູກຄ້າ</th>      
			  <th align="center">ສາງ</th>               
              <th align="center">ບິນ</th>
              <th align="center">ລາຍການ</th>
              <th align="center">ລາຄາ</th>
               <th align="center">ຈຳນວນ</th>
               <th align="center">ມູນຄ່າ</th>
               <th align="center">ມູນຄ່າຊຳລະ</th>
                <th align="center">ຍັງເຫລືອ</th>
               
             
              </tr>
           <?php
		   
/*
"SELECT * from (   
    
       SELECT product_sale.*,stocks.stock_name
       ,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,sum(product_sale.amount) as total_amt,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       where 1=1       $btw  $c_id   
	   group by product_sale.sale_id   order by product_sale.sale_id 
     
        
        ) as tb_a where  payment < total_amt 
	  
	   
	          "
*/

		   		  @$sql_head=mysqli_query($con,"SELECT * from (   
    
       SELECT 
sale_import.*
,sale_import.Invoice_Number as sale_id
,sum(sale_import.Quantity) as qty
	 ,sum(sale_import.Total) as total_amt
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
       
       
       where 1=1       $btw  $p_id   
	   group by sale_import.Invoice_Number   order by sale_import.Invoice_Number 
     
        
        ) as tb_a 
        /*
        where  payment < total_amt 
	  */
	   
	          ");
			  
		 
			 
		while($fh=mysqli_fetch_array($sql_head)){
			?>
			<tr>
                <td colspan="3" align="right"><?=@$fh["sale_id"];?></td>
                <td colspan="3" align="center">ລວມ</td>
               <td align="right"><?=@number_format($fh["total_amt"],2);?></td>
               <td align="right"><?=@number_format($fh["payment"],2);?></td>
                <td align="right"><?=@number_format($fh["total_amt"]-$fh["payment"],2);?></td>
              
              
               </tr>
            <?php
/*
"SELECT product_sale.*,stocks.stock_name
       ,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,product_sale.amount,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       where 1=1    and  product_sale.sale_id='$fh[sale_id]' order by Id
	  
	   
	          "
            */

			   @$sql_body=mysqli_query($con,"SELECT sale_import.*,
      products.Product_Name,
			sale_import.amount,
      customer_import.outlet_name as customer_name
		   FROM  sale_import 
		  LEFT JOIN products ON products.Product_ID = sale_import.Product_SKU 
      LEFT JOIN customer_import ON customer_import.external_id = sale_import.Outlet_External_ID
       

       
       where 1=1    and  sale_import.Invoice_Number='$fh[sale_id]' order by Id

	          ");
		 
         
            while($s=mysqli_fetch_array($sql_body)){
          
			?>	<tr>
               <td><?=$s["customer_id"];?>&nbsp;<?=$s["customer_name"];?></td>
			  
				<td><?=$s["stock_id"];?>&nbsp;<?=$s["stock_name"];?></td>
            	
               
            	<td align="center"><?= $s["sale_id"];?></td>
                <td align="left"><?=$s["Product_Name"];?></td>
                <td align="right"><?=@number_format($s["price"],2);?></td>
				<td align="right"><?=@number_format($s["qty"],2);?></td>
               <td align="right"><?=@number_format($s["amount"],2);?></td>
               <td colspan="1"></td>
                <td></td>
              
             
				</tr>
               
			<?php	
				
             } 
			 
			    @$tt_amt +=$fh["total_amt"];
				@$tt_payment +=$fh["payment"];
				@$ttt_ap +=$fh["total_amt"]-$fh["payment"];
			  }
			  ?>
             <td colspan="6" align="right">ລວມ</td>
             <td colspan="1" align="right"><?=@number_format($tt_amt,2);?></td>
             <td colspan="1" align="right"><?=@number_format($tt_payment,2);?></td>
             <td colspan="1" align="right"><?=@number_format($ttt_ap,2);?></td>
             
             
             
       </table>
       
		  
        <?php  } 

else{} 
 
 ?>
