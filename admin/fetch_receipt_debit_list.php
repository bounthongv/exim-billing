<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_receipt.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="and product_receipt.receipt_date='$today'";} 
		  else{ $btw="and product_receipt.receipt_date between '$from_date' and '$to_date' ";}
		  
 
           @$receipt_id= mysqli_real_escape_string($con,$_POST['receipt_id']);		   
		 if($receipt_id==''){$r_id="";}  else{ $r_id="and  product_receipt.receipt_id='$receipt_id' ";}
		 
		      @$supplier_id= mysqli_real_escape_string($con,$_POST['supplier_id']);		   
		 if($supplier_id==''){$sp_id="";}  else{ $sp_id="and  product_receipt.supplier_id='$supplier_id' ";}

		  
		  @$sp=mysqli_query($con,"
             
        select *,total_amt-payment as debit from (   
    
       SELECT product_receipt.*,count(product_receipt.product_id) as total_item,stocks.stock_name
       ,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,sum(product_receipt.amount) as total_amt,suppliers.supplier_name
		   FROM  product_receipt 
		   left join products on products.Product_ID=product_receipt.product_id
       left join stocks on stocks.stock_id=product_receipt.stock_id
	     left join suppliers on suppliers.supplier_id=product_receipt.supplier_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       where 1=1 $s_id $btw $r_id $sp_id
          
	   group by product_receipt.receipt_id order by product_receipt.receipt_id       ) as tb_a where  payment < total_amt    
	  
	   
	          ");
		  if($sp){
          ?>
        
 		<table border="1"   class="table-bordered " >
              <tr>
                <th align="center">ເລກທີບິນ</th>
                <th align="center">ອ້າງອີງ</th>
                <th align="center">ວັນທີ</th>
				<th align="center">ສາງ</th>
                <th align="center">ລູກຄ້າ</th>
               
                <th align="center">ລາຍການ</th>
              <th align="center">ມູນຄ່າລວມ</th>
               <th align="center">ມູນຄ່າຊຳລະ</th>
               <th align="center">ມູນຄ່າຍັງເຫຼືອ</th>
               
                <th align="center">ຊຳລະ</th>
             
              </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[receipt_date]");
			?>	<tr>
			   <td align="center"><input type="button" name="show" id="<?= $s["receipt_id"];?>" value="<?= $s["receipt_id"];?>" class="btn show btn-sm" 
			   data-toggle="modal" data-target="#pro_detail" ></td> 
                <td><?=$s["refer_no"];?></td>
				<td align="center"><?=date_format($dd,"d-m-Y");?></td>
				<td><?=$s["stock_id"];?>&nbsp;<?=$s["stock_name"];?></td>
            	<td><?=$s["supplier_id"];?>&nbsp;<?=$s["supplier_name"];?></td>
               
            	<td align="center"><?= $s["total_item"];?></td>
                <td align="right"><?=@number_format($s["total_amt"],2);?></td>
				<td align="right"><?=@number_format($s["payment"],2);?></td>
              <td align="right"><?=@number_format($s["debit"],2);?></td>
        
             <td colspan="1"><button type="button" class="btn btn-success btn-sm payment" id="<?= $s["receipt_id"];?>" ><i class="fa fa-dollar-sign"></i> ຊຳລະ</button></td>
				</tr>
               
			<?php	
				@$t_amt +=$s["total_amt"];
				@$t_payment +=$s["payment"];
				@$t_debit +=$s["debit"];
             } ?>
             <td colspan="6" align="right">ລວມ</td>
             <td colspan="1" align="right"><?=@number_format($t_amt,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_payment,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_debit,2);?></td>
             <td colspan="1"></td>
             
             
       </table>
       
		  
        <?php  } 


 
 
 ?>
