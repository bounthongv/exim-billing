<?php 
  include("init.php");
    
   
     
		  @$status= mysqli_real_escape_string($con,$_POST['status']);
        if($status==''){  $st="";} 
	elseif($status=='2'){ $st="and  product_sale.status='2'  ";} 
	else{ $st="and (  product_sale.status ='' or product_sale.status is null) ";}
	
	
	
		  
       @$select_mode= mysqli_real_escape_string($con,$_POST['select_mode']);
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		     @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
		   
         if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today'";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  
 
  @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);		   
 if($sale_id==''){$r_id="";}  else{ $r_id="and ( product_sale.sale_id like '$sale_id%' or product_sale.sale_id like '%$sale_id%') ";}
		 
		
		 
	
		 
		   @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);	
         if($customer_id==''){$c_id="";}  else{ $c_id="and ( product_sale.customer_id like '$customer_id%' 
		 or product_sale.customer_id like '%$customer_id%' or customers.customer_name like '$customer_id%'
		 or customers.customer_name like '%$customer_id%')  ";}


if($select_mode=='1'){
		  
  @$sp=mysqli_query($con,"
       
         select product_sale.* 
		 ,customers.customer_name
		 ,customer_payment.payment_id,customer_payment.payment_date,customer_payment.amount as total_payment
		 from  product_sale
		 left join customers on product_sale.customer_id=customers.customer_id
		 left join customer_payment on product_sale.sale_id=customer_payment.sale_id
		 
		 where 1=1 $btw $r_id $c_id $st
		 group by product_sale.sale_id
		 
	   
	          ");
		  if($sp){
          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            <tr>
                    <th align="center">ລ/ດ</th>
                	<th align="center">ລູກຄ້າ</th> 
                    <th align="center">ບິນຂາຍ</th>
					<th align="center">ວັນທີ</th>
                    <th align="center">ເລກທີສັ່ງຊື້</th>
					<th align="center" >ມູນຄ່າຂາຍ</th>
                    <th align="center" >ຮູບແບບ</th>                    
                    <th align="center" >ບິນຮັບເງີນ</th>
                    <th align="center">ວັນທີ</th>
                   <th align="center" >ມູນຄ່າຈ່າຍ</th>
                   <th align="center" >ຍອດເຫຼືອ</th>
                 
                    
                </tr>
               
           <?php
		   
		   $e_list=0;
            while($s=mysqli_fetch_array($sp)){
				
				$e_list++;
				$date1=$s["sale_date"];
				$date1=date_create($date1);
				
				$date2=$s["payment_date"];
				$date2=date_create($date2);
               
            
			?>
            	<tr>
                 
              
                <td align="center"><?=$e_list;?></td>
                <td><?=$s["customer_name"];?></td>
                
			    <td align="center"><?=$s["sale_id"];?></td>
				<td align="center"><?php if($s["sale_date"]==''){}else{
				echo	date_format($date1,"d/m/Y");
					}?></td>
                <td align="center"><?=$s["order_id"];?></td>				
            	<td align="right"><?=@number_format($s["total"],0);?></td>
                 <td align="center"><?php 
				 if($s["status_payment"]=='2'){ ?><button type="button" class="btn btn-success btn-sm">ສົດ</button> <?php }
			elseif($s["status_payment"]=='1' or $s["status_payment"]==''){?><button type="button" class="btn btn-danger btn-sm">ຕິດໜີ້</button><?php }
				 ?></td>
                <td align="center"><?php 
				if($s["payment_id"]==''){}else{?><button type="button" class="btn btn-success btn-sm"><?=$s["payment_id"];?></button><?php }
				
				?></td>
                <td align="center"><?php if($s["payment_date"]==''){}else{
				echo	date_format($date2,"d/m/Y");
					}?></td>
                 <td align="right"><?=@number_format($s["total_payment"]);?></td>	
                 <td align="right"><?=@number_format($s["remain"],0);?></td>
                
                
            	
				
			  </tr>
              <?php
          
		   @$t_amt +=$s["total"];
		   @$t_total_payment +=$s["total_payment"];
		   @$t_remain +=$s["remain"];
		 
             } 
			 ?>
 
             
             
             
             
			<tr>
			<td align="right" colspan="5">ລວມ</td>
            <td align="right"><?= @number_format($t_amt,0);?></td>
            <td colspan="3"></td>
             <td align="right"><?= @number_format($t_total_payment,0);?></td>
             <td align="right"><?= @number_format($t_remain,0);?></td>
           
           </tr>
			
        </table>
       
	      <p><br>
		      <br>
</p>
	      <p><br>
	        <?php }
      }
		elseif($select_mode=='2'){ 
		
		  @$sp=mysqli_query($con,"
       select *
	     ,sum(total)  as t_total 
		 ,sum(total_payment) as t_total_payment
		 ,sum(remain) as t_remain
  
  	 from (
        select product_sale.* 
		 ,customers.customer_name
		 ,customer_payment.payment_id,customer_payment.payment_date,customer_payment.amount as total_payment
		 from  product_sale
		 left join customers on product_sale.customer_id=customers.customer_id
		 left join customer_payment on product_sale.sale_id=customer_payment.sale_id
		 
		 where 1=1 $btw $r_id $c_id $st
		 group by product_sale.sale_id
		 
		) as tb_report group by customer_id
		 
	   
	          ");
		  if($sp){
          ?>
	        
</p>
		    <table id="myTable" border="1" width="100%"  class="table-bordered" align="left">
             <thead>
            	<tr>
                       <th  ></th>
            	
                     <th align="center">ລ/ດ</th>	
                     <th align="center">ລູກຄ້າ</th>
                     <th align="center" >ມູນຄ່າຂາຍ</th>
                     <th align="center" >ມູນຄ່າຈ່າຍ</th>
                     <th align="center" >ຍອດເຫຼືອ</th>     
                	
				         
					 
                    
                 
                    
                </tr>
                 </thead>
                <tbody>
           <?php
		   
		
		   $e_list=0;
            while($s=mysqli_fetch_array($sp)){
				
				$e_list++;
            
			?>
            	<tr>
                <td class="hdc" data-toggle="collapse" data-target="#group-of-rows-<?php echo $e_list;?>"
                  aria-expanded="false" aria-controls="group-of-rows-<?php echo $e_list;?>" align="center" >
                   <i class="fa fa-plus"></i></td>
              
                <td align="center"><?=$e_list;?></td>
                <td align="left"><?=$s["customer_id"];?> <?=$s["customer_name"];?></td>			   
            	 <td align="right"><?=@number_format($s["t_total"],0);?></td>
                 <td align="right"><?=@number_format($s["t_total_payment"]);?></td>	
            	 <td align="right"><?=@number_format($s["t_remain"]);?></td>
				 
				</tr>
                
                           <tbody>
             
            <tbody id="group-of-rows-<?php echo $e_list;?>" class="collapse">
      
      <td colspan="14" align="center">
      <table width="100%">
       <tr align="center" bgcolor="#F9F8FA">
       
                     
                    <th align="center">ລ/ດ</th>
                	<th align="center">ລູກຄ້າ</th> 
                    <th align="center">ບິນຂາຍ</th>
					<th align="center">ວັນທີ</th>
                    <th align="center">ເລກທີສັ່ງຊື້</th>
					<th align="center" >ມູນຄ່າຂາຍ</th>
                    <th align="center" >ຮູບແບບ</th>                    
                    <th align="center" >ບິນຮັບເງີນ</th>
                    <th align="center">ວັນທີ</th>
                   <th align="center" >ມູນຄ່າຈ່າຍ</th>
                   <th align="center" >ຍອດເຫຼືອ</th>
                   </tr>
                   <?php
		      @$ssp=mysqli_query($con,"
       
         select product_sale.* 
		 ,customers.customer_name
		 ,customer_payment.payment_id,customer_payment.payment_date,customer_payment.amount as total_payment
		 from  product_sale
		 left join customers on product_sale.customer_id=customers.customer_id
		 left join customer_payment on product_sale.sale_id=customer_payment.sale_id
		 
		 where 1=1 $btw $r_id $c_id $st and product_sale.customer_id='".$s["customer_id"]."'
		 group by product_sale.sale_id
		 
	   
	          ");
		   $ee_list=0;
            while($ss=mysqli_fetch_array($ssp)){
				
				$ee_list++;
				$date1=$ss["sale_date"];
				$date1=date_create($date1);
				
				$date2=$ss["payment_date"];
				$date2=date_create($date2);
               
            
			?>
            	<tr>
                 
              
                <td align="center"><?=$ee_list;?></td>
                <td><?=$ss["customer_name"];?></td>
                
			    <td align="center"><?=$ss["sale_id"];?></td>
				<td align="center"><?php if($s["sale_date"]==''){}else{
				echo	date_format($date1,"d/m/Y");
					}?></td>
                <td align="center"><?=$ss["order_id"];?></td>				
            	<td align="right"><?=@number_format($ss["total"],0);?></td>
                 <td align="center"><?php 
				 if($ss["status_payment"]=='2'){ ?><button type="button" class="btn btn-success btn-sm">ສົດ</button> <?php }
			elseif($ss["status_payment"]=='1' or $s["status_payment"]==''){?><button type="button" class="btn btn-danger btn-sm">ຕິດໜີ້</button><?php }
				 ?></td>
                <td align="center"><?php 
				if($ss["payment_id"]==''){}else{?><button type="button" class="btn btn-success btn-sm"><?=$ss["payment_id"];?></button><?php }
				
				?></td>
                <td align="center"><?php if($ss["payment_date"]==''){}else{
				echo	date_format($date2,"d/m/Y");
					}?></td>
                 <td align="right"><?=@number_format($ss["total_payment"]);?></td>	
                 <td align="right"><?=@number_format($ss["remain"],0);?></td>
                
                
            	
				
			  </tr>
              <?php
          
		   @$t_amts +=$ss["total"];
		   @$t_total_payments +=$ss["total_payment"];
		   @$t_remains +=$ss["remain"];
		 
             } 
			 ?>
 
             
             
             
             
			<!--<tr>
			<td align="right" colspan="5">ລວມ</td>
            <td align="right"><?=@number_format($t_amts,0);?></td>
            <td colspan="3"></td>
             <td align="right"><?=@number_format($t_total_payments,0);?></td>
             <td align="right"><?=@number_format($t_remains,0);?></td>
           
           </tr>-->
			
        
        
    </table>
    </td>
    </tbody>  
                
                
              <?php
          
		   
		   @$t_amt +=$s["t_total"];
		   @$t_total_payment +=$s["t_total_payment"];
		   @$t_remain +=$s["t_remain"];
		 
             } 
			 ?>
			<tr>
			<td align="right" colspan="3">ລວມ</td>
             <td align="right"><?= @number_format($t_amt,0);?></td>
             <td align="right"><?= @number_format($t_total_payment,0);?></td>
             <td align="right"><?= @number_format($t_remain,0);?></td>
              
           </tr>
           
			
        </table>
		 <br><br><br>
<?php	
		  }
	     }else{}
		
		
		

 
 ?>
 <br /> <br /> <br />
