<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_receipt.stock_id='$stock_id'  ";}
		 
       @$select_mode= mysqli_real_escape_string($con,$_POST['select_mode']);
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		     @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
		   
         if($from_date=='' or $to_date==''){$btw="and product_receipt.receipt_date='$today'";} 
		  else{ $btw="and product_receipt.receipt_date between '$from_date' and '$to_date' ";}
		  
 
  @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);		   
 if($sale_id==''){$r_id="";}  else{ $r_id="and ( product_receipt.receipt_id like '$sale_id%' or product_receipt.receipt_id like '%$sale_id%') ";}
		 
		  @$group_id= mysqli_real_escape_string($con,$_POST['group_id']);	
         if($group_id==''){$g_id="";}  else{ $g_id="and products.Group_ID='$group_id'  ";}
		 
		 
		  @$product_id= mysqli_real_escape_string($con,$_POST['product_id']);	
         if($product_id==''){$p_id="";}  else{ $p_id="and (product_receipt.product_id like '$product_id%'  )";}
		 
		 
		   @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);	
         if($customer_id==''){$c_id="";}  else{ $c_id="and ( product_receipt.customer_id like '$customer_id%' 
		 or product_receipt.customer_id like '%$customer_id%' or customers.customer_name like '$customer_id%'
		 or customers.customer_name like '%$customer_id%')  ";}


if($select_mode=='1'){
		  
  @$sp=mysqli_query($con,"
       SELECT product_receipt.* ,stocks.stock_name,products.Product_ID
	   ,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version
			,sum(product_receipt.qty) as t_qty
            ,sum(product_receipt.amount) as t_amount
		   FROM  product_receipt 
	
	left join products on products.Product_ID=product_receipt.product_id
    left join stocks on stocks.stock_id=product_receipt.stock_id
    left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       
     where 1=1 $btw  $s_id $r_id $c_id $p_id  $g_id  and product_receipt.qty>0
	 group by product_receipt.product_id,product_receipt.receipt_id
	order by  product_receipt.receipt_id,product_receipt.product_id asc limit 1000 
	
         
	   
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
			    <td><?= $s["receipt_id"];?></td>
				<td><?= $s["receipt_date"];?></td>
               
				<td><?= $s["Product_ID"];?></td>
            	<td><?=$s["Product_Name"];?></td>
                
            	<td align="center"><?= $s["Unit"];?></td>				
                <td align="center"><?=@number_format($s["t_qty"],0);?> </td>
                
				<td align="right"><?=@number_format($s["price"],0);?> </td>
               
                <td align="right"><?php if($s["t_amount"]==0){ echo "";}else{ echo @number_format(($s["t_amount"]),0); } ?> </td>
              <!--  <td align="center"><?=@number_format($s["amount_crate"],0);?> </td>
                <td align="center"><?=@number_format($s["last_amount"],0);?> </td>-->
				
				</tr>
              <?php
           @$t_qty+=$s["t_qty"]; 
		   
		   @$t_amt +=$s["t_amount"];
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
		  
        <?php }
      }
		elseif($select_mode=='2'){ 
		
		
		      @$sp=mysqli_query($con,"
       SELECT product_receipt.* ,stocks.stock_name,products.Product_ID
	   ,sum(product_receipt.qty) as t_qty
	   ,sum(product_receipt.amount) as t_amount
	   
	   ,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version
		   FROM  product_receipt 
	
	left join products on products.Product_ID=product_receipt.product_id
    left join stocks on stocks.stock_id=product_receipt.stock_id	
    left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       
     where 1=1 $btw  $s_id $r_id $c_id $p_id  $g_id and product_receipt.qty>0
	 
	  group by product_receipt.product_id
	
	  order by product_receipt.product_id asc limit 1000 
         
	   
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
			    <td><?=$s["receipt_id"];?></td>
				<td><?=$s["receipt_date"];?></td>
               
				<td><?=$s["Product_ID"];?></td>
            	<td><?=$s["Product_Name"];?></td>
                
            	<td align="center"><?=$s["Unit"];?></td>				
                <td align="center"><?=@number_format($s["t_qty"],0);?> </td>
                
				<td align="right"><?=@number_format($s["price"],0);?> </td>
               
                <td align="right"><?php if($s["t_amount"]==0){ echo "";}else{ echo @number_format(($s["t_amount"]),0); } ?> </td>
             
				
				</tr>
              <?php
           @$t_qty+=$s["t_qty"]; 
		   
		   @$t_amt +=$s["t_amount"];
		
		  
             } 
			 ?>
			<tr>
			<td align="right" colspan="5">ລວມ</td>
            <td align="center"><?=@number_format($t_qty,0);?></td>
             <td align="right"></td>
            <td align="right"><?=@number_format($t_amt,0);?></td>
          
			</tr> 
           
			
        </table>
		
	<?php	
		  }
	     }else{}
		
		
		

 
 ?>
 <br /> <br /> <br />
