<?php 
  include("init.php");
    
   /*
           @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);	
           if($customer_id==''){$s_id="";}  else{ $s_id="and product_sale.customer_id='$customer_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
		   
           if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  */
 
           @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);		   
		 if($sale_id==''){$r_id="";}  else{ $r_id="and  customer_payment.sale_id like '%$sale_id%' "; }
		 
		 
         if($_SESSION['status']=='1'){  
		 
		    $user_show="and product_sale.user_id='".$_SESSION['user_id']."' ";
		 }
		 else{
			  
			  $user_show="";
			 
			 }
		  




		  @$sp=mysqli_query($con,"SELECT customer_payment.* ,customers.customer_name,
  customers.TIN,
  tb_bank.Bank_Name
		 from  customer_payment
		 left join customers on customer_payment.customer_id=customers.customer_id
		 left join tb_bank on customer_payment.Bank_account=tb_bank.Bank_account
		 where 1=1 and customer_payment.payment_type='1' 
         and customer_payment.sale_id NOT IN (SELECT sale_id FROM payment_2)
         $r_id
         order by payment_date asc
       ");
		  if($sp){
          ?>
   <script>
 $('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
 </script>      
 		<table border="1"   class="table-bordered " >
              <tr>
                 <th align="center" ><input type="checkbox" name="select-all" id="select-all" /></th>
                    <th align="center">ລ/ດ</th>
                    <th align="center">ເລກທີ</th>
					<th align="center">ວັນທີຂາຍ</th>
                  
					<th align="center">ຊື່ລູກຄ້າ</th>
			
					
                    <th align="center">ປະເພດຊຳລະ</th>              
					 
                    <th align="center" >ຈຳນວນເງີນ</th>
             
              </tr>
           <?php

          $i=0;
            while($s=mysqli_fetch_array($sp)){
          $i++;
            $dd=date_create("$s[sale_date]");
			?>	<tr>
         <td align="center"><input type="checkbox" name="item_list[]" value="<?=$s["sale_id"];?>" class="form-control"  /></td>

         <td align="center"><?=$i;?></td>

		 <td align="center">
         <?php   if($s["status_off"]=='0') {  ?> 
         <input type="button" name="show" id="<?= $s["sale_id"];?>" value="<?=$s["sale_id"];?>" class="btn btn-success add_pro btn-sm" 
			   >
          <?php   }else {  ?> 
         <input type="button" name="show" id="<?= $s["sale_id"];?>" value="<?=$s["sale_id"];?>" class="btn btn-warning add_pro btn-sm" 
			   >     
           <?php   } ?>     
               
               </td> 
               
               
  
				<td align="center"><?=date_format($dd,"d/m/Y");?></td>
		
            	<td><?=$s["customer_id"];?>&nbsp;<?=$s["customer_name"];?></td>
                  <td align="center"><?php 
				 if($s["payment_type"]=='1'){ echo "ເງີນສົດ";}
				 elseif($s["payment_type"]=='2'){ echo "ເງີນໂອນ";}else{}  ?></td>
            	<td align="right"><?=@number_format($s["amount"],0);?></td>
             
        
                
                
				</tr>
               
			<?php		
             } 
             ?>
         
         
             
       </table>
       
		  
        <?php  } ?>
