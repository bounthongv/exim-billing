<?php 
  include("init.php");
    
   
      
		  
 
           @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);		   
		 if($sale_id==''){$r_id="";}  else{ $r_id="and  quotations.sale_id='$sale_id' ";}
		 
		 

		  
		  @$sp=mysqli_query($con,"
       SELECT quotations.* ,sum(quotations.qty) as qty,sum(quotations.amount) as amount,
	   stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version
		   FROM  quotations 
		   left join products on products.Product_ID=quotations.product_id
       left join stocks on stocks.stock_id=quotations.stock_id
	 
       left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       
     where 1=1 $r_id group by quotations.product_id
         
	   
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
                    <th align="center" >ຂະຫນາດບັນຈຸ</th>
                    <th align="center" >ລາຄາ</th>
                    <th align="center" >ຈຳນວນ</th>
                    <th align="center" >ມູນຄ່າ</th>
                    <th align="center" >ສ່ວນຫຼຸດ</th>
					<th align="center" >ມູນຄ່າສຸດທິ</th>
                
                    
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
                <td align="center"><?= $s["size"];?></td>
                
				<td align="center"><?=@number_format($s["price"],2);?> </td>
                <td align="center"><?=@number_format($s["qty"],2);?> </td>
                <td align="center"><?=@number_format($s["amount"],2);?> </td>
                <td align="center"><?=@number_format($s["discount"],2);?> </td>
                <td align="center"><?=@number_format($s["amount"]-$s["discount"],2);?> </td>
				
				</tr>
              <?php
           @$t_qty+=$s["qty"]; 
		   
		   @$t_amt += $s["amount"];
		   @$t_dis += $s["discount"];
		   $dis_bill= $s["bill_discount"];
		   @$t_amt_dis += $s["amount"]-$s["discount"];
             } 
			 ?>
			<tr>
			<td align="right" colspan="7">ລວມ</td>
            <td align="right"><?= @number_format($t_qty,2);?></td>
            <td align="right"><?= @number_format($t_amt,2);?></td>
            <td align="right"><?= @number_format($t_dis+$dis_bill,2);?></td>
            <td align="right"><?= @number_format($t_amt_dis-$dis_bill,2);?></td>
			</tr> 
           
			
        </table>
		<?php
		  
          } 

 
 ?>
 
            
 
