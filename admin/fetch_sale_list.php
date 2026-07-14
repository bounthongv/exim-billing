<?php 
  include("init.php");
    


            @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);
			if($customer_id==''){$c_id="";} 
		   else{ $c_id="and ( product_sale.customer_id like '$customer_id%' or product_sale.customer_id like '%$customer_id%'
		    or customers.customer_name like '$customer_id%' or customers.customer_name like '%$customer_id%' ) ";}
			
			
           @$status_payment= mysqli_real_escape_string($con,$_POST['status_payment']);	
           if($status_payment==''){$st_id="";} 
		   elseif($status_payment=='2'){ $st_id="and product_sale.status_payment='2'  ";}
		   elseif($status_payment=='3'){ $st_id="and product_sale.status_payment='3'  ";}
		    else{ $st_id="and ( product_sale.status_payment='1' or product_sale.status_payment is null or product_sale.status_payment='')  ";}
		 
       
	       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
           if($stock_id==''){$s_id="";}  else{ $s_id="and product_sale.stock_id='$stock_id'  ";}
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
		   

/*
           if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today'";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  */

 if($from_date=='' or $to_date==''){$btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' )='$today'";} 
		  else{ $btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) between '$from_date' and '$to_date'";}


           @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);	
    /*	   
		 if($sale_id==''){$r_id="";}  else{ $r_id="and  product_sale.sale_id='$sale_id' "; $btw=""; }
		 */
		 if($sale_id==''){$r_id="";}  else{ $r_id="and Invoice_Number='$sale_id' "; $btw=""; }




		  @$sale_order_id= mysqli_real_escape_string($con,$_POST['sale_order_id']);		   
		 if($sale_order_id==''){$sr_id="";}  else{ $sr_id="and  product_sale.order_id='$sale_order_id' "; $btw=""; }
		 
		 
		  @$status= mysqli_real_escape_string($con,$_POST['status']);		   
		 if($status==''){$sta="";}  
		 elseif($status=='1'){$sta=" and  ( product_sale.status='1' or product_sale.status='' or product_sale.status is null) ";}  
		 else{ $sta="and  product_sale.status='$status' "; }
		 
		 
         if($_SESSION['status']=='1'){  
		 
		    $user_show="and product_sale.user_id='".$_SESSION['user_id']."' ";
		 }
		 else{
			  
			  $user_show="";
			 
			 }
		  

 "SELECT product_sale.*
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
              where 1=1 and tb_groups.Group_ID='001' $s_id $sr_id $btw $r_id $st_id $sta group by sale_id) as custoemr_sale_order 
      
		             on product_sale.sale_id=custoemr_sale_order.sale_id
					 
	   
       where 1=1   $s_id $sr_id $btw $r_id $st_id $user_show $c_id $sta
         group by product_sale.sale_id,product_sale.product_id ) 
       as product_sale
          
	   group by product_sale.sale_id order by product_sale.sale_id desc";




		  @$sp=mysqli_query($con,"SELECT 
      Invoice_Number as sale_id,
      Display_ID as order_id,
      DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) AS sale_date,
      Outlet_Name as customer_name,
      sum(Quantity) as qty_p,
      sum(Total) as total_amt
      FROM sale_import
      WHERE 1=1
      $btw $r_id
      group by Invoice_Number order by DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) desc
      ");
			 
			  
		  if($sp){



          ?>
        
 		<table border="1"   class="table-bordered " >
             <thead>
              <tr>
                <th align="center">ລ/ດ</th>
                <th align="center">ພິມບິນ</th>
                <th align="center">POS</th>
                <th align="center">ເລກທີ</th>
               <!-- <th align="center">ເລກທີອ້າງອີງ</th>-->
                <th align="center">ເລກທີສັ່ງຊື້</th>
                <th align="center">ວັນທີ</th>
				        <th align="center">ສາງ</th>
                <th align="center">ລູກຄ້າ</th>
                <th align="center">ພະນັກງານຂາຍ</th>
                <th align="center">ຈຳນວນ</th>
              <th align="center">ມູນຄ່າລວມ</th>
             <th align="center">ສະຖານະ</th>
              <th align="center">ການຈ່າຍ</th>
             <!-- 
              <th align="center">ມູນຄ່າສູດທິ</th>
               <th align="center">ມູນຄ່າຊຳລະ</th>-->
             <!--  <th align="center">Invoice</th>
               <th align="center">Cash Receipt</th>-->
                <th align="center">ໃບສົ່ງເຄື່ອງ</th>
            
       
                <th align="center">ແກ້ໄຂ</th>
          <?php   if($_SESSION['status']=='1'){ }else{?>    
               <th align="center">ລົບ</th>
                   <th align="center">ສົ່ງແລ້ວ</th>
                  <?php
		          }
				  
				   ?>
              </tr>
			</thead>
           <?php
		   
		    $list_id=0;
			
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[sale_date]");
			
			$list_id++;
			
			?>	<tr>
      
         <td align="center"><?=$list_id;?></td>
         <td align="center">
    <a href="print_bill_receipt.php?sale_id=<?=$s["sale_id"];?>&sale_date=<?=$s["sale_date"];?>&sale_time=<?=$s["sale_time"];?>" 
          target="_blank" ><button type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i></button></a>
          
          </td>

          <td align="center">
    <a href="print_bill_receipt_pos.php?sale_id=<?=$s["sale_id"];?>&sale_date=<?=$s["sale_date"];?>&sale_time=<?=$s["sale_time"];?>" 
          target="_blank" ><button type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i></button></a>
          
          </td>



		 <td align="center">
         <?php   if($s["status_off"]=='0') {  ?> 
         <input type="button" name="show" id="<?= $s["sale_id"];?>" value="<?=$s["sale_id"];?>" class="btn btn-success show_detail btn-sm" 
			   data-toggle="modal" data-target="#pro_detail" >
          <?php   }else {  ?> 
         <input type="button" name="show" id="<?= $s["sale_id"];?>" value="<?=$s["sale_id"];?>" class="btn btn-warning show_detail btn-sm" 
			   data-toggle="modal" data-target="#pro_detail" >     
           <?php   } ?>     
               
               </td> 
               
               
                <!--<td><?=$s["refer_no"];?></td>-->
                 <td><?=$s["order_id"];?></td>
				<td align="center"><?=date_format($dd,"d/m/Y");?></td>
				<td><?=$s["stock_name"];?></td>
            	<td><?=$s["customer_name"];?></td>
               <td><?=$s["sr_fname"];?>&nbsp;<?=$s["sr_lname"];?></td>
            	<td align="center"><?=@$s["qty_p"];?></td>
                <td align="right"><?=@number_format($s["total_amt"],0);?></td>
               <td align="right"><?php
			   
			   if($s["status_payment"]=="2"){ ?>
				<button type="button" class="btn btn-success btn-sm">ສົດ</button>   
				<?php   }
				elseif($s["status_payment"]=="3"){ ?>
				<button type="button" class="btn btn-info btn-sm">ເງີນໂອນ</button>   
				<?php   }
			 
			   else{ ?>
				 <button type="button" class="btn btn-danger btn-sm">ຕິດໜີ້</button>   
				<?php   }
			   
			   ?></td> 
                <td align="right"><?php
			   
			   if($s["status"]=="2"){ ?>
				<button type="button" class="btn btn-success btn-sm">ຈ່າຍແລ້ວ</button>   
				<?php   }
							 
			   else{ ?>
				 <button type="button" class="btn btn-danger btn-sm">ຕິດໜີ້</button>   
				<?php   }
			   
			   ?></td> 
              <!--  <td align="right"><?=@number_format($s["bill_discount"],0);?></td>
                 <td align="right"><?=@number_format($s["total"],0);?></td>
				<td align="right"><?=@number_format($s["payment"],0);?></td>-->
              
           <!--   <td align="center">
      <?php if($s['bill_size']=='1'){?>     
       <a href="print_invoice_mini.php?sale_id=<?=$s["sale_id"];?>&sale_date=<?=$s["sale_date"];?>&sale_time=<?=$s["sale_time"];?>" 
          target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> </button></a>
      <?php }else { ?>   
          <a href="print.php?sale_id=<?=$s["sale_id"];?>&sale_date=<?=$s["sale_date"];?>&sale_time=<?=$s["sale_time"];?>" 
          target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button></a>
        <?php } ?>    
          
          </td>
            <td align="center">
      <?php if($s['bill_size']=='1'){?>     
       <a href="print_cash_receipt.php?sale_id=<?=$s["sale_id"];?>&sale_date=<?=$s["sale_date"];?>&sale_time=<?=$s["sale_time"];?>" 
          target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button></a>
      <?php }else { ?>   
          <a href="print.php?sale_id=<?=$s["sale_id"];?>&sale_date=<?=$s["sale_date"];?>&sale_time=<?=$s["sale_time"];?>" 
          target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button></a>
        <?php } ?>    
          
          </td>-->
            <td align="center">
    <a href="print_delivery_receipt.php?sale_id=<?=$s["sale_id"];?>&sale_date=<?=$s["sale_date"];?>&sale_time=<?=$s["sale_time"];?>" 
          target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button></a>
          
          </td>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
              <?php   if($s["status_off"]=='0') {  ?>
              
              
               <td colspan="2"></td>
               <td align="center"><i class="fa fa-check" aria-hidden="true"></i></td>
              
                  <?php  }else{  ?>
					  
		
          <?php    if($_SESSION['status']=='0'){  ?>
          
          <td align="center"><button type="button" class="btn btn-success btn-sm edit_Id"
           id="<?=$s["sale_id"];?>" data-stock_id="<?=$s["stock_id"];?>">ແກ້ໄຂ</button></td>       
            
           <td align="center"><button type="button" class="btn btn-danger btn-sm delete_Id"
            id="<?=$s["sale_id"];?>" data-stock_id="<?=$s["stock_id"];?>"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
           
            <td align="center"> 		 
<a href="update_delivery_off.php?sale_id=<?=$s["sale_id"];?>" onclick=" return confirm('ທ່ານຕ້ອງການອັບເດດແທ້ບໍ່');"><button type="button" class="btn btn-success btn-sm delivery_off" id="<?=$s["sale_id"];?>"><i class="fa fa-check" aria-hidden="true"></i></button></a>
		 
            </td> 
				<?php }else{ ?>	  
					  
                      
                <td align="center"><button type="button" class="btn btn-success btn-sm edit_Id" id="<?=$s["sale_id"];?>">ແກ້ໄຂ</button></td>     
			    <td></td>
            	<td></td>	
                
                
                	  
				<?php	}  } ?>
			    
			 
               
             
                
                
                
                
				</tr>
               
			<?php	
				@$t_amt +=$s["total_amt"];
				@$t_payment +=$s["payment"];
				@$total_dis +=$s["bill_discount"];
				@$totals +=$s["total"];
				@$t_qty_p +=$s["qty_p"];
				
				
             } ?>
             <td colspan="8" align="right">ລວມ</td>
             <td colspan="1" align="center"><?=@number_format($t_qty_p,0);?></td>
             <td colspan="1" align="right"><?=@number_format($t_amt,0);?></td>
           <!--  <td colspan="1" align="right"><?=@number_format($total_dis,0);?></td>
             <td colspan="1" align="right"><?=@number_format($totals,0);?></td>
             <td colspan="1" align="right"><?=@number_format($t_payment,0);?></td>-->
             <td colspan="6"></td>
             
       </table>
       
		  
        <?php  } 


 
 
 ?>
