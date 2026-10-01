<?php 
  include("init.php");
    


            @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);

if($customer_id==''){$c_id="";} 
elseif($customer_id=='New_customer'){
 $c_id="and product_sale.customer_id NOT IN (SELECT customer_id FROM customers)";}
		   else{ 
 $c_id="and 
         (product_sale.customer_id like '$customer_id%' or product_sale.customer_id like '%$customer_id%')
         ";}
			
			

		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
		   


           if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today'";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  


           @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);	
      
		 if($sale_id==''){$r_id="";}  else{ $r_id="and  product_sale.sale_id like '%$sale_id%' "; /*$btw="";*/ }
		 



@$search= mysqli_real_escape_string($con,$_POST['search']);


if($search=='custom')
    {


// คำนวณช่วงวันโดยใช้ DATEDIFF(CURRENT_DATE(), product_sale.sale_date) ใน SQL
    @$sp = mysqli_query($con, "SELECT 
    customers.customer_id,
    customer_import.outlet_name,
    SUM(product_sale.total) AS total_all,
    SUM(CASE WHEN DATEDIFF(CURRENT_DATE(), product_sale.sale_date) BETWEEN 1 AND 7 THEN product_sale.total ELSE 0 END) AS d1_7,
    SUM(CASE WHEN DATEDIFF(CURRENT_DATE(), product_sale.sale_date) BETWEEN 8 AND 14 THEN product_sale.total ELSE 0 END) AS d8_14,
    SUM(CASE WHEN DATEDIFF(CURRENT_DATE(), product_sale.sale_date) BETWEEN 15 AND 30 THEN product_sale.total ELSE 0 END) AS d15_30,
    SUM(CASE WHEN DATEDIFF(CURRENT_DATE(), product_sale.sale_date) BETWEEN 31 AND 45 THEN product_sale.total ELSE 0 END) AS d31_45,
    SUM(CASE WHEN DATEDIFF(CURRENT_DATE(), product_sale.sale_date) BETWEEN 46 AND 60 THEN product_sale.total ELSE 0 END) AS d46_60,
    SUM(CASE WHEN DATEDIFF(CURRENT_DATE(), product_sale.sale_date) > 60 THEN product_sale.total ELSE 0 END) AS d_over60
FROM product_sale 
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id
LEFT JOIN customer_import ON customer_import.external_id = customers.customer_id
WHERE product_sale.`status` != '2' $btw $c_id$r_id
GROUP BY customers.customer_id, customer_import.outlet_name
ORDER BY customers.customer_id ASC");

    if ($sp) {
        // ตัวแปรสำหรับเก็บผลรวมท้ายตาราง
        $sum_1_7 = 0;
        $sum_8_14 = 0;
        $sum_15_30 = 0;
        $sum_31_45 = 0;
        $sum_46_60 = 0;
        $sum_over60 = 0;
        $sum_total_all = 0;
?>

<table border="1" class="table-bordered">
    <thead>
        <tr style="background-color: #e0e0e0;">
            <th align="center">ລ/ດ</th>
            <th align="center">1 - 7 Days</th>
            <th align="center">8 - 14 Days</th>
            <th align="center">15-30 Days</th>
            <th align="center">31-45 Days</th>
            <th align="center">46-60 Days</th>
            <th align="center">&gt; 60 Days</th>
            <th align="center">Total</th>
            <th align="center">CusID</th>
            <th align="center">Customer Name</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $list_id = 0;

    while ($s = mysqli_fetch_array($sp)) {$list_id++;

        // บวกสะสมยอดรวมท้ายตาราง
        $sum_1_7    +=$s['d1_7'];
        $sum_8_14   +=$s['d8_14'];
        $sum_15_30  +=$s['d15_30'];
        $sum_31_45  +=$s['d31_45'];
        $sum_46_60  +=$s['d46_60'];
        $sum_over60 +=$s['d_over60'];
        $sum_total_all +=$s['total_all'];
    ?>
        <tr>
            <td align="center"><?=$list_id;?></td>
            <td align="right"><?=$s['d1_7'] > 0 ? @number_format($s['d1_7'], 0) : '0';?></td>
            <td align="right"><?=$s['d8_14'] > 0 ? @number_format($s['d8_14'], 0) : '0';?></td>
            <td align="right"><?=$s['d15_30'] > 0 ? @number_format($s['d15_30'], 0) : '0';?></td>
            <td align="right"><?=$s['d31_45'] > 0 ? @number_format($s['d31_45'], 0) : '0';?></td>
            <td align="right"><?=$s['d46_60'] > 0 ? @number_format($s['d46_60'], 0) : '0';?></td>
            <td align="right"><?=$s['d_over60'] > 0 ? @number_format($s['d_over60'], 0) : '0';?></td>
            <td align="right"><b><?=@number_format($s['total_all'], 0);?></b></td>
            <td align="center"><?=$s['customer_id'];?></td>
            <td align="left"><?=$s['outlet_name'];?></td>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
        <tr style="font-weight: bold; background-color: #f2f2f2;">
            <td align="center">ລວມ</td>
            <td align="right"><?=number_format($sum_1_7, 0);?></td>
            <td align="right"><?=number_format($sum_8_14, 0);?></td>
            <td align="right"><?=number_format($sum_15_30, 0);?></td>
            <td align="right"><?=number_format($sum_31_45, 0);?></td>
            <td align="right"><?=number_format($sum_46_60, 0);?></td>
            <td align="right"><?=number_format($sum_over60, 0);?></td>
            <td align="right"><b><?=number_format($sum_total_all, 0);?></b></td>
            <td colspan="2"></td>
        </tr>
    </tfoot>
</table>




<?php   }

     }else{



 @$sp=mysqli_query($con,"SELECT product_sale.*,sum(product_sale.total) as total_2,customer_import.outlet_name FROM product_sale 

left join customers on customers.customer_id=product_sale.customer_id
left join customer_import on customer_import.external_id=customers.customer_id
 WHERE `status`!='2'
$btw $c_id $r_id
 group by product_sale.sale_id,product_sale.sale_date order by product_sale.sale_id,product_sale.sale_date ASC
 ");


			  
		  if($sp){



          ?>
        
 		<table border="1"   class="table-bordered " >
             <thead>
              <tr>
            <th align="center">ລ/ດ</th>
            <th align="center">ວັນທີ</th>
            <th align="center">ເລກທີ</th>
            <th align="center">Days</th>
            <th align="center">1 - 7 Days</th>
            <th align="center">8 - 14 Days</th>
            <th align="center">15-30 Days</th>
            <th align="center">31-45 Days</th>
            <th align="center">46-60 Days</th>
            <th align="center">&gt; 60 Days</th>
            <th align="center">Total</th>
            <th align="center">CusID</th>
            <th align="center">Customer Name</th>
        </tr>

				   
              </tr>
			</thead>
          <tbody>
    <?php
    $list_id = 0;
    $today = new DateTime('now');

    while ($s = mysqli_fetch_array($sp)) {$list_id++;
        $dd = date_create($s["sale_date"]);
        $startDate = new DateTime($s['sale_date']);

        // คำนวณจำนวนวัน
        $interval = $startDate->diff($today);
        $diffDays =$interval->days;

        // กำหนดค่าเริ่มต้นแต่ละคอลัมน์เป็น 0
        $d1_7   = 0;
        $d8_14  = 0;
        $d15_30 = 0;
        $d31_45 = 0;
        $d46_60 = 0;
        $d_over60 = 0;

        $amount =$s["total_2"];

        // เช็คช่วงวันแล้วเอายอดเงินไปใส่ในคอลัมน์นั้นๆ
        if ($diffDays >= 1 &&$diffDays <= 7) {
            $d1_7 =$amount;
        } elseif ($diffDays >= 8 &&$diffDays <= 14) {
            $d8_14 =$amount;
        } elseif ($diffDays >= 15 &&$diffDays <= 30) {
            $d15_30 =$amount;
        } elseif ($diffDays >= 31 &&$diffDays <= 45) {
            $d31_45 =$amount;
        } elseif ($diffDays >= 46 &&$diffDays <= 60) {
            $d46_60 =$amount;
        } elseif ($diffDays > 60) {
            $d_over60 =$amount;
        }

        // บวกสะสมยอดรวมด้านล่าง
        $sum_1_7   +=$d1_7;
        $sum_8_14  +=$d8_14;
        $sum_15_30 +=$d15_30;
        $sum_31_45 +=$d31_45;
        $sum_46_60 +=$d46_60;
        $sum_over60 +=$d_over60;

 $sum_total_all +=$amount;

    ?>
        <tr>
            <td align="center"><?=$list_id;?></td>
            <td align="center"><?=date_format($dd, "d/m/Y");?></td>
            <td align="center"><?=$s['sale_id'];?></td>
            <td align="center"><?=$diffDays;?></td>
            <td align="right"><?=number_format($d1_7, 0);?></td>
            <td align="right"><?=number_format($d8_14, 0);?></td>
            <td align="right"><?=number_format($d15_30, 0);?></td>
            <td align="right"><?=number_format($d31_45, 0);?></td>
            <td align="right"><?=number_format($d46_60, 0);?></td>
            <td align="right"><?=number_format($d_over60, 0);?></td>
            <td align="right"><?=number_format($amount, 0);?></td>
            <td align="center"><?=$s['customer_id'];?></td>
            <td align="left"><?=$s['outlet_name'];?></td>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
        <!-- แถวยอดรวมท้ายตาราง -->
        <tr style="font-weight: bold; background-color: #f2f2f2;">
            <td colspan="4" align="center">ລວມ</td>
            <td align="right"><?=number_format($sum_1_7, 0);?></td>
            <td align="right"><?=number_format($sum_8_14, 0);?></td>
            <td align="right"><?=number_format($sum_15_30, 0);?></td>
            <td align="right"><?=number_format($sum_31_45, 0);?></td>
            <td align="right"><?=number_format($sum_46_60, 0);?></td>
            <td align="right"><?=number_format($sum_over60, 0);?></td>
            <td align="right"><?=number_format($sum_total_all, 0);?></td>
        </tr>
    </tfoot>
         </table>
        
        <?php } ?>
        
    <?php } ?>


