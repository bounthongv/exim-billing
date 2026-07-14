<?php 
  include("init.php");
    
   
           @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);	
           if($customer_id==''){$s_id="";}  else{ $s_id="and product_sale.customer_id='$customer_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
		   
           if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  
 
           @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);		   
		 if($sale_id==''){$r_id="";}  else{ $r_id="and  product_sale.sale_id='$sale_id' "; $btw=""; }
		 
		 
         if($_SESSION['status']=='1'){  
		 
		    $user_show="and product_sale.user_id='".$_SESSION['user_id']."' ";
		 }
		 else{
			  
			  $user_show="";
			 
			 }
		  
		  @$sp=mysqli_query($con,"
		select product_sale.*
		,sum(product_sale.last_amount) as t_total_amt
		,count(product_sale.total_qty) as total_item
		,sum(product_sale.total_amt) as total_amt 
		,product_sale.qty_p
		 
		from 	  
   (SELECT product_sale.*,sum(product_sale.amount) as total_amt,sum(product_sale.qty) as total_qty
   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
			,sr_list.sr_fname,sr_list.sr_lname
	,custoemr_sale_order.qty_p
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	   left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       left join sr_list on product_sale.sr=sr_list.sr_id
	   
	  LEFT JOIN (select sum(product_sale.qty) as qty_p ,product_sale.sale_id
           from  product_sale 
     	          left join products on products.Product_ID=product_sale.product_id
		          left join tb_groups on tb_groups.Group_ID=products.group_id
              where 1=1 and tb_groups.Group_ID='001' $s_id $btw $r_id  group by sale_id) as custoemr_sale_order 
      
		             on product_sale.sale_id=custoemr_sale_order.sale_id
					 
	   
       where 1=1   $s_id $btw $r_id  $user_show and (product_sale.status is null or product_sale.status='' or product_sale.status='0')
         group by product_sale.sale_id,product_sale.product_id ) 
       as product_sale
          
	   group by product_sale.sale_id order by product_sale.sale_id asc
       
     
	  
	   
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
                <th align="center">ເລກທີ</th>
                <th align="center">ເລກທີອ້າງອີງ</th>
                <th align="center">ເລກທີສັ່ງຊື້</th>
                <th align="center">ວັນທີ</th>
				<th align="center">ສາງ</th>
                <th align="center">ລູກຄ້າ</th>
                <th align="center">ພະນັກງານຂາຍ</th>
                <th align="center">ຈຳນວນ</th>
              <th align="center">ມູນຄ່າລວມ</th>
               <th align="center">ຈ່າຍແລ້ວ</th>
                <th align="center">ຍັງເຫລືອ</th>
             
              </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[sale_date]");
			?>	<tr>
         <td align="center"><input type="checkbox" name="item_list[]" value="<?=$s["sale_id"];?>" class="form-control"  /></td>
		 <td align="center">
         <?php   if($s["status_off"]=='0') {  ?> 
         <input type="button" name="show" id="<?= $s["sale_id"];?>" value="<?=$s["sale_id"];?>" class="btn btn-success add_pro btn-sm" 
			   >
          <?php   }else {  ?> 
         <input type="button" name="show" id="<?= $s["sale_id"];?>" value="<?=$s["sale_id"];?>" class="btn btn-warning add_pro btn-sm" 
			   >     
           <?php   } ?>     
               
               </td> 
               
               
                <td><?=$s["refer_no"];?></td>
                 <td><?=$s["order_id"];?></td>
				<td align="center"><?=date_format($dd,"d/m/Y");?></td>
				<td><?=$s["stock_id"];?>&nbsp;<?=$s["stock_name"];?></td>
            	<td><?=$s["customer_id"];?>&nbsp;<?=$s["customer_name"];?></td>
               <td><?=$s["sr_fname"];?>&nbsp;<?=$s["sr_lname"];?></td>
            	<td align="center"><?=@$s["qty_p"];?></td>
                <td align="right"><?=@number_format($s["total_amt"],0);?></td>
                 <td align="right"><?=@number_format($s["payment"],0);?></td>
                  <td align="right"><?=@number_format($s["remain"],0);?></td>
             
        
                
                
				</tr>
               
			<?php	
				@$t_amt +=$s["total_amt"];
				@$t_p +=$s["payment"];
				@$t_r +=$s["remain"];
				
				
				@$t_payment +=$s["payment"];
				@$total_dis +=$s["bill_discount"];
				@$totals +=$s["total"];
				@$t_qty_p +=$s["qty_p"];
				
				
             } ?>
             <td colspan="8" align="right">ລວມ</td>
             <td colspan="1" align="center"><?=@number_format($t_qty_p,0);?></td>
             <td colspan="1" align="right"><?=@number_format($t_amt,0);?></td>
             <td colspan="1" align="right"><?=@number_format($t_p,0);?></td>
             <td colspan="1" align="right"><?=@number_format($t_r,0);?></td>
         
             
       </table>
       
		  
        <?php  } 


 
 
 ?>
