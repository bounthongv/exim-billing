<?php 
  include("init.php");
    
    @$s= mysqli_real_escape_string($con,$_POST['s']);	
	
	
		
		   

if($s=='1'){
	
	
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id=""; $s_id_t=""; $s_id_f="";} 
		  else{ $s_id="and stock_id='$stock_id' "; $s_id_t="and t_stock_id='$stock_id'  "; $s_id_f="and f_stock_id='$stock_id'  ";}	 
       
		  
		   @$m= mysqli_real_escape_string($con,$_POST['m']);	//  2019-08-28
		   @$y= mysqli_real_escape_string($con,$_POST['y']);	//  2019-08-29
		   
		   $date=date_create($m);
		  $open_day=date_format($date,"d");
          $open_month=date_format($date,"m");   // 08
		  $open_year=date_format($date,"Y");    // 2019
		  
		  $start_date=date($open_year.'-'.$open_month.'-'.'01');  // 2019-08-01
		  
		//  $date = "04-15-2013";
    $date_add = strtotime($m);
    $date_add = strtotime("-1 day", $date_add);
    $end_date=date('Y-m-d', $date_add);  // 2019-08-27
		   
		//   exit();
		 

		  @$group_id= mysqli_real_escape_string($con,$_POST['group_id']);		   
		 if($group_id==''){$g_id="";}  else{ $g_id="and  products.Group_ID='$group_id' ";}
		 
		   @$sql_p=mysqli_query($con," select * from products where 1=1 $g_id ");
		   
		   
	$sql=mysqli_query($con,"TRUNCATE TABLE summary_receipt_payment");
	
		  while($p=mysqli_fetch_array($sql_p)){
				
				
				@$sql_d=mysqli_query($con,"
 insert into summary_receipt_payment(Product_ID,Product_Name,unit,pprice,open_qty,open_amt,r_qty,r_amt,s_qty,s_amt,qty)
	   select 
     products.Product_ID,products.Product_Name,products.Unit
     ,products.s1_price as pprice
     , (tb_open.open_qty+tb_receipt_a.r_qty+tb_receipt_t_a.r_qty)-(tb_sale_a.s_qty+tb_sale_t_a.s_qty)  as open_qty,tb_open.open_amt 
    ,(tb_receipt.r_qty+tb_receipt_t.r_qty ) as r_qty,(tb_receipt.r_amt+tb_receipt_t.r_amt) as r_amt
    ,(tb_sale.s_qty+tb_sale_t.s_qty ) as s_qty,(tb_sale.s_amt+tb_sale_t.s_amt) as s_amt
    
    , sum(tb_open.open_qty+tb_receipt_a.r_qty+tb_receipt_t_a.r_qty)-(tb_sale_a.s_qty+tb_sale_t_a.s_qty)
    +sum(tb_receipt.r_qty+tb_receipt_t.r_qty )-sum(tb_sale.s_qty+tb_sale_t.s_qty ) as total_qty 
    
 from  products
  
 
 left join (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as open_qty,sum(amount) as open_amt from stock_opening  where product_id='$p[Product_ID]'  
 and  year(open_date)='$open_year' and month(open_date)='$open_month' $s_id ) as tb_open   on   products.Product_ID=tb_open.product_id 
 
 
 
 left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as r_qty,sum(qty*price) as r_amt from transfer  where product_id='$p[Product_ID]' 
and transfer_date between '$start_date' and '$end_date' $s_id_t  ) as tb_receipt_t_a on  products.Product_ID=tb_receipt_t_a.product_id 

 left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as r_qty,sum(amount) as r_amt from product_receipt  where product_id='$p[Product_ID]' 
and receipt_date between '$start_date' and '$end_date' $s_id ) as tb_receipt_a on  products.Product_ID=tb_receipt_a.product_id 
 
 
 
 left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as s_qty,sum(qty*price) as s_amt from transfer  where product_id='$p[Product_ID]' 
and transfer_date between '$start_date' and '$end_date' $s_id_f ) as tb_sale_t_a on  products.Product_ID=tb_sale_t_a.product_id 
 
 
  left join  (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as s_qty,sum(amount) as s_amt  from product_sale  where product_id='$p[Product_ID]' 
and  sale_date between '$start_date' and '$end_date' $s_id ) as tb_sale_a  on   products.Product_ID=tb_sale_a.product_id 

 
 
 
 
 
  left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as r_qty,sum(amount) as r_amt from product_receipt  where product_id='$p[Product_ID]' 
and receipt_date between '$m' and '$y' $s_id ) as tb_receipt on  products.Product_ID=tb_receipt.product_id  
 
 left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as r_qty,sum(qty*price) as r_amt from transfer  where product_id='$p[Product_ID]' 
and transfer_date between '$m' and '$y' $s_id_t ) as tb_receipt_t on  products.Product_ID=tb_receipt_t.product_id 
 
 
 
 
  left join  (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as s_qty,sum(amount) as s_amt  from product_sale  where product_id='$p[Product_ID]' 
and  sale_date between '$m' and '$y' $s_id ) as tb_sale  on   products.Product_ID=tb_sale.product_id 

left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as s_qty,sum(qty*price) as s_amt from transfer  where product_id='$p[Product_ID]' 
and transfer_date between '$m' and '$y' $s_id_f ) as tb_sale_t on  products.Product_ID=tb_sale_t.product_id

 
 where    products.Product_ID='$p[Product_ID]' 
	   
	          ");
			}
		  
	}
elseif($s=='2'){
	
	
       @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id=""; $s_id_t=""; $s_id_f="";} 
		  else{ $s_id="and stock_id='$stock_id'  "; $s_id_t="and t_stock_id='$stock_id'  "; $s_id_f="and f_stock_id='$stock_id'  ";}	 
       
		  
		   @$m= mysqli_real_escape_string($con,$_POST['m']);	
		   @$y= mysqli_real_escape_string($con,$_POST['y']);	
		   
		   if($m==""){ $m=date('m');}
		   if($y==""){ $y=date('Y');}

		  @$group_id= mysqli_real_escape_string($con,$_POST['group_id']);		   
		 if($group_id==''){$g_id="";}  else{ $g_id="and  products.Group_ID='$group_id' ";}
		 
		   @$sql_p=mysqli_query($con," select * from products where 1=1 $g_id ");
		   
	
	    $sql=mysqli_query($con,"TRUNCATE TABLE summary_receipt_payment");
	
	while($p=mysqli_fetch_array($sql_p)){
				
				
				@$sql_d=mysqli_query($con,"
  insert into summary_receipt_payment(Product_ID,Product_Name,unit,pprice,open_qty,open_amt,r_qty,r_amt,s_qty,s_amt,qty)
	   select 
          products.Product_ID,products.Product_Name,products.Unit
     ,products.s1_price as pprice, tb_open.open_qty  as open_qty,tb_open.open_amt 
    ,(tb_receipt.r_qty+tb_receipt_t.r_qty) as r_qty,(tb_receipt.r_amt+tb_receipt_t.r_amt) as r_amt
    ,(tb_sale.s_qty+tb_sale_t.s_qty) as s_qty ,(tb_sale.s_amt+tb_sale_t.s_amt) as s_amt
    , sum(tb_open.open_qty)+sum(tb_receipt.r_qty+tb_receipt_t.r_qty)-sum(tb_sale.s_qty+tb_sale_t.s_qty) as total_qty 
    
 from  products
  
 
 left join (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as open_qty,sum(amount) as open_amt from stock_opening  where product_id='$p[Product_ID]'  
 and  year(open_date)='$y' and month(open_date)='$m' $s_id) as tb_open   on   products.Product_ID=tb_open.product_id 
 
  left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as r_qty,sum(amount) as r_amt from product_receipt  where product_id='$p[Product_ID]' 
and  year(receipt_date)='$y' and month(receipt_date)='$m' $s_id) as tb_receipt on  products.Product_ID=tb_receipt.product_id 

 left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as r_qty,sum(qty*price) as r_amt from transfer  where product_id='$p[Product_ID]' 
and year(transfer_date)='$y' and month(transfer_date)='$m'  $s_id_t ) as tb_receipt_t on  products.Product_ID=tb_receipt_t.product_id 

 
 
  left join  (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as s_qty,sum(amount) as s_amt  from product_sale  where product_id='$p[Product_ID]' 
and  year(sale_date)='$y' and month(sale_date)='$m' $s_id) as tb_sale  on   products.Product_ID=tb_sale.product_id 

 left join
 (select '$p[Product_ID]' as product_id,ifnull(sum(qty),0) as s_qty,sum(qty*price) as s_amt from transfer  where product_id='$p[Product_ID]' 
and year(transfer_date)='$y' and month(transfer_date)='$m'  $s_id_f ) as tb_sale_t on  products.Product_ID=tb_sale_t.product_id
 
 where    products.Product_ID='$p[Product_ID]'
	   
	          ");
			}
	
	
	
	}
          ?>
       
 		<table border="1"   class="table-bordered " >
              <tr>
                <th  rowspan="2" align="center">ລຳດັບ</th>
                <th  rowspan="2" align="center">ລະຫັດສິນຄ້າ</th>
                <th  rowspan="2" align="center">ຊື່ສິນຄ້າ</th>
                <th  rowspan="2" align="center">ຫົວໜ່ວຍ</th>
                
				<th  rowspan="2" align="center">ລາຄາ</th>
                <th  colspan="2" align="center">ຍອດຍົກ</th>
                <th colspan="2" align="center">ຮັບເຂົ້າ</th>
               
                <th colspan="2" align="center">ຈ່າຍອອກ</th>
                <th  colspan="2" align="center">ຍັງເຫຼືອ</th>
                 
              </tr>
             <tr>
                <th align="center">ຈຳນວນ</th>
                <th align="center">ມູນຄ່າ</th>               
                <th align="center">ຈຳນວນ</th>
                <th align="center">ມູນຄ່າ</th>
                <th align="center">ຈຳນວນ</th>
                <th align="center">ມູນຄ່າ</th>
                <th align="center">ຈຳນວນ</th>
                <th align="center">ມູນຄ່າ</th>
             </tr>
           <?php
		   $i=1;
		   
		   
		  
				
  @$sql_d=mysqli_query($con," select * from summary_receipt_payment where 1=1 and qty !=0
	   
	          ");
			  ?>
			 
             
         
			<?  
			 while($s=mysqli_fetch_array($sql_d)){
			?>	<tr>
                <td align="center"><?=$i;?></td>
			    <td colspan='1' align="center"><?php  echo $s['Product_ID'];?></td>
                <td align="left"><?=$s["Product_Name"];?></td>
				<td align="center"><?=$s["unit"];?></td>
                
                <td align="right"><?=@number_format($s["pprice"],2);?></td> 
                <td align="right"><?=@number_format($s["open_qty"],2);?></td>                
                <td align="right"><?=@number_format($s["open_amt"],2);  ?></td>
                
                <td align="right"><?=@number_format($s["r_qty"],2);?></td>                
                <td align="right"><?=@number_format($s["r_amt"],2);  ?></td>
                
				<td align="right"><?=@number_format($s["s_qty"],2);?></td>                
                <td align="right"><?=@number_format($s["s_amt"],2);  ?></td>
                
                <td align="right"><?=@number_format($s["qty"],2);?></td>                
                <td align="right"><?=@number_format($s["qty"]*$s["pprice"],2);  ?></td>
                
				</tr>
               
			<?php	
		
			$i++;
             
			 @$t_oqty +=$s['open_qty'];
			 @$t_oamt +=$s['open_amt'];
			 
			 @$t_rqty +=$s['r_qty'];
			 @$t_ramt +=$s['r_amt'];
			 
			 @$t_sqty +=$s['s_qty'];
			 @$t_samt +=$s['s_amt'];
			 
			 @$t_qty +=$s['qty'];
			 @$t_amt +=$s['qty']*$s['pprice'];
			 }
			  ?>
              <tr>
             <td colspan="5" align="right">ລວມຍອດ</td>
             <td colspan="1" align="right"><?=@number_format($t_oqty,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_oamt,2);?></td>
             
             <td colspan="1" align="right"><?=@number_format($t_rqty,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_ramt,2);?></td>
             
             <td colspan="1" align="right"><?=@number_format($t_sqty,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_samt,2);?></td>
             
             <td colspan="1" align="right"><?=@number_format($t_qty,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_amt,2);?></td>
            
             </tr> 
       </table>
       
		  
        <?php  


			
 
 ?>
