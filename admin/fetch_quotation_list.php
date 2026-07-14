<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and quotations.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="and quotations.sale_date='$today'";} 
		  else{ $btw="and quotations.sale_date between '$from_date' and '$to_date' ";}
		  
 
           @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);		   
		 if($sale_id==''){$r_id="";}  else{ $r_id="and  quotations.sale_id='$sale_id' ";}
		 
		 
/*
"SELECT quotations.*,sum(quotations.total_amt) as t_total_amt,count(quotations.total_qty) as total_item
		,sum(quotations.amount) as total_amt ,sum(quotations.discount) as total_dis from 	  
   (SELECT quotations.*,sum(quotations.amount) as total_amt,sum(quotations.qty) as total_qty
   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  quotations 
		   left join products on products.Product_ID=quotations.product_id
       left join stocks on stocks.stock_id=quotations.stock_id
	   left join customers on customers.customer_id=quotations.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       where 1=1   $s_id $btw $r_id
         group by quotations.sale_id,quotations.product_id ) 
       as quotations
          
	   group by quotations.sale_id order by quotations.sale_id";
*/

		  
		  @$sp=mysqli_query($con,"SELECT quotations.*,sum(quotations.total_amt) as t_total_amt,count(quotations.total_qty) as total_item
		,sum(quotations.amount) as total_amt ,sum(quotations.discount) as total_dis from 	  
   (SELECT quotations.*,sum(quotations.amount) as total_amt,sum(quotations.qty) as total_qty
   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  quotations 
		   left join products on products.Product_ID=quotations.product_id
       left join stocks on stocks.stock_id=quotations.stock_id
	   left join customers on customers.customer_id=quotations.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       where 1=1   $s_id $btw $r_id
         group by quotations.sale_id,quotations.product_id ) 
       as quotations
          
	   group by quotations.sale_id order by quotations.sale_id 
       
     
	  
	   
	          ");
		  if($sp){
          ?>
        
 		<table border="1"   class="table-bordered " >
              <tr>
                <th align="center">ເລກທີ</th>
                <th align="center">ເລກທີອ້າງອີງ</th>
                <th align="center">ວັນທີ</th>
				<th align="center">ສາງ</th>
                <th align="center">ລູກຄ້າ</th>
               
                <th align="center">ຈຳນວນລາຍການ</th>
              <th align="center">ມູນຄ່າລວມ</th>
              <th align="center">ສ່ວນຫຼູດ</th>
              <th align="center">ມູນຄ່າສູດທິ</th>
               <th align="center">ມູນຄ່າຊຳລະ</th>
               <th align="center">ພິມ</th>
                <th align="center">ແກ້ໄຂ</th>
                  <th align="center">ລົບ</th>
              </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[sale_date]");
			?>	<tr>
			   <td align="center"><input type="button" name="show" id="<?= $s["sale_id"];?>" value="<?= $s["sale_id"];?>" class="btn show btn-sm" 
			   data-toggle="modal" data-target="#pro_detail" ></td> 
                <td><?=$s["refer_no"];?></td>
				<td align="center"><?=date_format($dd,"d-m-Y");?></td>
				<td><?=$s["stock_id"];?>&nbsp;<?=$s["stock_name"];?></td>
            	<td><?=$s["customer_id"];?>&nbsp;<?=$s["customer_name"];?></td>
               
            	<td align="center"><?= $s["total_item"];?></td>
                <td align="right"><?=@number_format($s["t_total_amt"],2);?></td>
                <td align="right"><?=@number_format($s["total_dis"]+$s["bill_discount"],2);?></td>
                 <td align="right"><?=@number_format($s["total"],2);?></td>
				<td align="right"><?=@number_format($s["payment"],2);?></td>
              
              <td align="right">
          <a href="print_quotation.php?sale_id=<?=$s["sale_id"];?>&sale_date=<?=$s["sale_date"];?>&sale_time=<?=$s["sale_time"];?>" target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> ພິມບິນ</button></a></td>
              <td align="center"><button type="button" class="btn btn-success btn-sm edit_Id" id="<?= $s["sale_id"];?>">ແກ້ໄຂ</button></td>
                <td align="center"><button type="button" class="btn btn-danger btn-sm delete_Id" id="<?= $s["sale_id"];?>">ລົບ</button></td>
				</tr>
               
			<?php	
				@$t_amt +=$s["t_total_amt"];
				@$t_payment +=$s["payment"];
				@$total_dis +=$s["total_dis"]+$s["bill_discount"];
				@$totals +=$s["total"];
             } ?>
             <td colspan="6" align="right">ລວມ</td>
             <td colspan="1" align="right"><?=@number_format($t_amt,2);?></td>
             <td colspan="1" align="right"><?=@number_format($total_dis,2);?></td>
             <td colspan="1" align="right"><?=@number_format($totals,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_payment,2);?></td>
             <td colspan="3"></td>
             
       </table>
       
		  
        <?php  } 


 
 
 ?>
