<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_sale.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="and payment.pay_date='$today'";} 
		  else{ $btw="and payment.pay_date between '$from_date' and '$to_date' ";}
		  
 
           @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);		   
		 if($sale_id==''){$r_id="";}  else{ $r_id="and  payment.sale_id='$sale_id' ";}
		 
		 

		  
		  @$sp=mysqli_query($con,"
      
    
       select payment.*,customers.customer_name ,customers.customer_id,product_sale.stock_id
           from payment
	  left join product_sale on payment.sale_id=product_sale.sale_id
	        left join customers on product_sale.customer_id=customers.customer_id
	   where 1=1 $btw   $r_id $s_id  group by payment.pay_id
	  
	   
	          ");
		  if($sp){
          ?>
        
 		<table border="1"   class="table-bordered " >
              <tr>
                <th align="center">ເລກທີບິນ</th>
                <th align="center">ບິນຂາຍ</th>
                <th align="center">ວັນທີ</th>
			
                <th align="center">ລູກຄ້າ</th>
                <th align="center">ລະຫັດສາງ</th>
               <th align="center">ກີບ</th>
               <th align="center">ບາດ</th>
               <th align="center">ໂດລາ</th>
               
              <th align="center">ມູນຄ່າລວມ</th>
               
               <th align="center">ພິມ</th>
                
             
              </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[pay_date]");
			?>	<tr>
            <td><?=$s["pay_id"];?></td>
			   <td align="center"><input type="button" name="show" id="<?= $s["sale_id"];?>" value="<?= $s["sale_id"];?>" class="btn show btn-sm" 
			   data-toggle="modal" data-target="#pro_detail" ></td> 
                
				<td align="center"><?=date_format($dd,"d-m-Y");?></td>
			
            	<td><?=$s["customer_id"];?>&nbsp;<?=$s["customer_name"];?></td>
                <td><?=$s["stock_id"];?></td>
               <td align="right"><?=@number_format($s["pay_lak"],2);?></td>
               <td align="right"><?=@number_format($s["pay_thb"],2);?></td>
               <td align="right"><?=@number_format($s["pay_usd"],2);?></td>
            	
             
				<td align="right"><?=@number_format($s["total"],2);?></td>
             
              <td align="right">
          <a href="print_payment.php?sale_id=<?=$s["sale_id"];?>&sale_date=<?=$s["sale_date"];?>" target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> ພິມບິນ</button></a></td>
             
				</tr>
               
			<?php	
				@$t_pay_lak +=$s["pay_lak"];
				@$t_pay_thb +=$s["pay_thb"];
				@$t_pay_usd +=$s["pay_usd"];
				@$t_amt +=$s["total"];
             } ?>
             <td colspan="4" align="right">ລວມ</td>
             <td colspan="1" align="right"><?=@number_format($t_pay_lak,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_pay_thb,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_pay_usd,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_amt,2);?></td>
             <td colspan="1"></td>
             
             
       </table>
       
		  
        <?php  } 


 
 
 ?>
