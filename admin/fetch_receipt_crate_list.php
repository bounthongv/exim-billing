<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_receipt_crate.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="and product_receipt_crate.receipt_date='$today'";} 
		  else{ $btw="and product_receipt_crate.receipt_date between '$from_date' and '$to_date' ";}
		  
 
           @$receipt_id= mysqli_real_escape_string($con,$_POST['receipt_id']);		   
		 if($receipt_id==''){$r_id="";}  else{ $r_id="and  product_receipt_crate.receipt_id='$receipt_id' ";}
		 
		 

		  
		  @$sp=mysqli_query($con,"
		  
		SELECT product_receipt_crate.*,sum(product_receipt_crate.amount) as total_amt,sum(product_receipt_crate.qty) as total_qty
        ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
			,customers.customer_name
		   FROM  product_receipt_crate 
		   left join products on products.Product_ID=product_receipt_crate.product_id
       left join stocks on stocks.stock_id=product_receipt_crate.stock_id
	   left join customers on customers.customer_id=product_receipt_crate.customer_id
      
       
       where 1=1   $s_id $btw $r_id
         group by product_receipt_crate.receipt_id
	   
	          ");
		  if($sp){
          ?>
        
 		<table border="1"   class="table-bordered " >
              <tr>
                <th align="center">ເລກທີ</th>
              
                <th align="center">ວັນທີ</th>
				<th align="center">ສາງ</th>
                <th align="center">ລູກຄ້າ</th>
               
                <th align="center">ຈຳນວນ</th>
                <th align="center">ມູນຄ່າລວມ</th>
             
               <th align="center">ພິມ</th>
              
                <th align="center">ແກ້ໄຂ</th>
                  <th align="center">ລົບ</th>
              </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[receipt_date]");
			?>	<tr>
			   <td align="center"><input type="button" name="show" id="<?=$s["receipt_id"];?>" value="<?=$s["receipt_id"];?>" class="btn show_detail btn-sm" 
			   data-toggle="modal" data-target="#pro_detail" ></td> 
               
				<td align="center"><?=date_format($dd,"d/m/Y");?></td>
				<td><?=$s["stock_id"];?>&nbsp;<?=$s["stock_name"];?></td>
            	<td><?=$s["customer_id"];?>&nbsp;<?=$s["customer_name"];?></td>
               
            	<td align="center"><?=@$s["total_qty"];?></td>
                <td align="right"><?=@number_format($s["total_amt"],0);?></td>
            
          
          
          </td>
            <td align="center">
    <a href="print_invoice_receipt_crate.php?receipt_id=<?=$s["receipt_id"];?>&receipt_date=<?=$s["receipt_date"];?>" 
          target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button></a>
          
          </td>
          
              <td align="center"><button type="button" class="btn btn-success btn-sm edit_Id" id="<?= $s["receipt_id"];?>">ແກ້ໄຂ</button></td>
                <td align="center"><button type="button" class="btn btn-danger btn-sm delete_Id" id="<?= $s["receipt_id"];?>">ລົບ</button></td>
				</tr>
               
			<?php	
				@$t_amt +=$s["total_amt"];
				
				@$t_total_qty +=$s["total_qty"];
             } ?>
             <td colspan="4" align="right">ລວມ</td>
             <td colspan="1" align="center"><?=@number_format($t_total_qty,0);?></td>
             <td colspan="1" align="right"><?=@number_format($t_amt,0);?></td>
          
             <td colspan="3"></td>
             
       </table>
       
		  
        <?php  } 


 
 
 ?>
