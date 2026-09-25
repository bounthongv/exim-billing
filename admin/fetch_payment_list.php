<?php 
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_sale.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="and payment_2.pay_date='$today'";} 
		  else{ $btw="and payment_2.pay_date between '$from_date' and '$to_date' ";}
		  
 
           @$pay_id= mysqli_real_escape_string($con,$_POST['pay_id']);		   
		 if($pay_id==''){$p_id="";}  else{ $p_id="and  payment_2.pay_id='$pay_id' ";}
		 

        @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);		   
		 if($sale_id==''){$s_id="";}  else{ $s_id="and  payment_2.sale_id='$sale_id' ";}

		 @$list_id= mysqli_real_escape_string($con,$_POST['list_id']);

/*
if($list_id=='02.009'){
    $payment_type="and customer_payment.payment_type = '1'"; 
   }elseif($list_id=='07.003'){
    $payment_type="and customer_payment.payment_type = '2'";
   }
*/
         
/*

		  @$sp=mysqli_query($con,"SELECT payment.*,customers.customer_name ,customers.customer_id,product_sale.stock_id
           from payment
	  left join product_sale on payment.sale_id=product_sale.sale_id
	        left join customers on product_sale.customer_id=customers.customer_id
	   where 1=1 $btw   $r_id $s_id  group by payment.pay_id");
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


 */
 
 ?>

 <?php

"SELECT 
    customer_payment.*,
    customers.customer_name,
    customers.TIN,
    tb_bank.Bank_Name,
    payment_2.pay_date,
    payment_2.pay_id
/*
    CASE 
        WHEN customer_payment.sale_id IN (SELECT sale_id FROM payment_2) THEN 1 
        ELSE 0 
    END AS is_in_payment2
*/

FROM customer_payment
LEFT JOIN customers ON customer_payment.customer_id = customers.customer_id
LEFT JOIN tb_bank ON customer_payment.Bank_account = tb_bank.Bank_account
LEFT JOIN payment_2  ON payment_2.sale_id = customer_payment.sale_id
WHERE 1=1 and customer_payment.payment_type = '1'
ORDER BY customer_payment.payment_date ASC";




  @$sp=mysqli_query($con,"SELECT *,sum(amount)as amount,count(sale_id) as sale_id,tb_bank.Bank_Name FROM payment_2
LEFT JOIN tb_bank ON payment_2.Bank_account = tb_bank.Bank_account
  WHERE 1=1 $btw $p_id $s_id
  group by payment_2.pay_id
  ");




          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="left" style="width:80%">
            	<tr>
                    <th align="center">ລ/ດ</th>
                	 <th align="center">ເລກທີມອບ</th>
                     <th align="center">ວັນທີມອບ</th>
                    <th align="center">ຈຳນວນ</th>
                  
					<th align="center">ທະນາຄານ</th>
			       
					 
                    <th align="center" >ຈຳນວນເງີນ</th>

                    <th align="center" >ແກ້ໄຂ</th>
                    <th align="center" >ພິມ</th>
             
                </tr>
           <?php
		   
		   $e_list=0;
            while($s=mysqli_fetch_array($sp)){
				
				$e_list++;
				
				$date1=$s["sale_date"];
				$date1=date_create($date1);
				
				$date2=$s["payment_date"];
				$date2=date_create($date2);
            
                $pay_date=$s["pay_date"];
				$pay_date=date_create($pay_date);
             

			?>
            	<tr>
                <td align="center"><?=$e_list;?></td>

<td align="center"><input type="button" name="show" id="<?=$s["pay_id"];?>" value="<?=$s["pay_id"];?>" class="btn btn-success show_detail btn-sm" 
			   data-toggle="modal" data-target="#pro_detail" >
</td>

				 <td align="center"><?php if($s["pay_date"]==''){echo '';}else{echo date_format($pay_date,"d/m/Y");} ?></td>
                <td align="center"><?=$s["sale_id"];?></td>
				
			            
				<td align="center"><?=$s["customer_name"].' '.$s["Bank_Name"];?></td>
	
            	<td align="right"><?=@number_format($s["amount"],0);?></td>

       
<td align="center"><button type="button" class="btn btn-success btn-sm edit_Id" id="<?=$s["pay_id"];?>" data-pay_id="<?=$s["pay_id"];?>" >ແກ້ໄຂ</button></td>     

<td align="center"><button type="button" class="btn btn-warning btn-sm print_Id" id="<?=$s["pay_id"];?>" data-pay_id="<?=$s["pay_id"];?>" >ພິມ</button></td>     



<?php 
/*

if($s["pay_id"]==''){
?>

<button type="button" class="btn btn-danger" style="width: 100px">ຍັງ</button>

<?php
}else{
?>
<button type="button" class="btn btn-success" style="width: 100px">ມອບແລ້ວ</button>
<?php
}


*/
?>





				</tr>
          	<?php	
            @$t_sale_id +=$s["sale_id"];
				@$t_amt +=$s["amount"];
             } ?>
             <td colspan="3" align="right">ລວມ</td>
             <td colspan="1" align="center"><?=@number_format($t_sale_id,0);?></td>
             <td colspan="1" align="right"></td>
             <td colspan="1" align="right"><?=@number_format($t_amt,0);?></td>
           
