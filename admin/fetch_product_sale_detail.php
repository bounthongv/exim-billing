<?php 
  include("init.php");
    
   
      
		  
 
        @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);		   
		 if($sale_id==''){$r_id="";}  else{ 
			
		 $r_id="and  product_sale.sale_id='$sale_id' ";
		 
/*
		$r_id="and Invoice_Number='$sale_id' ";
*/

		 }
		
		
		 if($sale_id==''){}
		 else{
		 


"SELECT product_sale.* ,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,
	   stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version
		   FROM  product_sale 
	
	left join products on products.Product_ID=product_sale.product_id
    left join stocks on stocks.stock_id=product_sale.stock_id
	 
    left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       
     where 1=1 $r_id and product_sale.qty>0 group by product_sale.product_id limit 50
         
	   
	          ";


"SELECT  
		  Invoice_Number as sale_id,
		  DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) AS sale_date,
		  Product_SKU as Product_ID,
		  Product_Name,
		  Quantity as qty,
		  Price as price
		  FROM sale_import where 1=1 $r_id group by Product_SKU,Item_ID";

		  
		  @$sp=mysqli_query($con,"SELECT product_sale.* ,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,
	   stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version
		   FROM  product_sale 
	
	left join products on products.Product_ID=product_sale.product_id
    left join stocks on stocks.stock_id=product_sale.stock_id
	 
    left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       
     where 1=1 $r_id and product_sale.qty>0 group by product_sale.product_id limit 50
         
	   
	          ");
		  if($sp){
          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                	<th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
					<th align="center">ລະຫັດສິນຄ້າ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>  
					 <th align="center" >ຫົວຫນ່ວຍ</th>
                    <th align="center" >ຈຳນວນ</th>
                    <th align="center" >ລາຄາ</th>
                   
                    <th align="center" >ມູນຄ່າ</th>
                  <!--  <th align="center" >ລັງເປົ່າ</th>
					<th align="center" >ມູນຄ່າລວມ</th>-->
                
                    
                </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            
			?>
            	<tr>
			    <td><?= $s["sale_id"];?></td>
				<td><?= $s["sale_date"];?></td>
				<td><?= $s["Product_ID"];?></td>
            	<td><?=$s["Product_Name"];?></td>
                
            	<td align="center"><?= $s["Unit"];?></td>				
                <td align="center"><?=@number_format($s["qty"],0);?> </td>
                
				<td align="right"><?=@number_format($s["price"],0);?> </td>
               
                <td align="right"><?=@number_format(($s["qty"])*$s["price"],0);?> </td>
              <!--  <td align="center"><?=@number_format($s["amount_crate"],0);?> </td>
                <td align="center"><?=@number_format($s["last_amount"],0);?> </td>-->
				
				</tr>
              <?php
           @$t_qty+=$s["qty"];  
		   
		   @$t_amt += ($s["qty"])*$s["price"];
		 //  @$t_dis += $s["discount"];
		   $t_amount_crate+= $s["amount_crate"];
		   @$t_last_amount += $s["last_amount"];
             } 
			 ?>
			<tr>
			<td align="right" colspan="5">ລວມ</td>
            <td align="center"><?= @number_format($t_qty,0);?></td>
             <td align="right"></td>
            <td align="right"><?= @number_format($t_amt,0);?></td>
           <!-- <td align="right"><?= @number_format($t_amount_crate,0);?></td>
            <td align="right"><?= @number_format($t_last_amount,0);?></td>-->
			</tr> 
           
			
        </table>
		<?php
		  
          } 
		 }
 
 ?>
 
            
 
