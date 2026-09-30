<?php 
  include("init.php");

@$customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);

if($customer_id==''){
    $c_id="";
} elseif($customer_id=='New_customer'){
    $c_id="and product_sale.customer_id NOT IN (SELECT customer_id FROM customers)";
} else {
    $c_id="and (product_sale.customer_id like '$customer_id%' or product_sale.customer_id like '%$customer_id%')";
}

@$from_date = mysqli_real_escape_string($con,$_POST['from_date']);
@$to_date   = mysqli_real_escape_string($con,$_POST['to_date']);
$today = date("Y-m-d");

if($from_date=='' or $to_date==''){
    $btw="and product_sale.sale_date='$today'";
} else {
    $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";
}

@$sale_id = mysqli_real_escape_string($con,$_POST['sale_id']);
if($sale_id==''){
    $r_id="";
} else {
    $r_id="and product_sale.sale_id like '%$sale_id%' ";
}

@$difference = mysqli_real_escape_string($con,$_POST['difference']);
if($difference==''){
    $diff="";
} elseif($difference=='<12'){
    $diff="and CAST(TIMEDIFF(product_sale.Delivery_Date_LAT, product_sale.Created_Date_LAT) AS TIME)<'12:00:00' ";
} elseif($difference=='12-24'){
    $diff="and CAST(TIMEDIFF(product_sale.Delivery_Date_LAT, product_sale.Created_Date_LAT) AS TIME) between '12:00:00' and '24:00:00' ";
} elseif($difference=='>24'){
    $diff="and CAST(TIMEDIFF(product_sale.Delivery_Date_LAT, product_sale.Created_Date_LAT) AS TIME)>'24:00:00' ";
}

@$sp = mysqli_query($con,"SELECT 
 product_sale.sale_date,
 product_sale.sale_id,
 product_sale.Created_Date_LAT,
 product_sale.Delivery_Date_LAT,
 product_sale.customer_id,
 customer_import.outlet_name,
 customer_import.outlet_name,
     CAST(TIMEDIFF(product_sale.Delivery_Date_LAT, product_sale.Created_Date_LAT) AS TIME) AS diff_time
  FROM product_sale 
  left join customers on customers.customer_id=product_sale.customer_id
  left join customer_import on customer_import.external_id=customers.customer_id
  WHERE 1=1
  $btw $c_id $r_id $diff
  group by product_sale.sale_id
");

// นับจำนวนรายการ
$total_rows = $sp ? mysqli_num_rows($sp) : 0;
?>

<!-- ตัวเลขจำนวนรายการ (ซ่อนไว้ให้ JS อ่าน) -->
<span id="row_total" data-total="<?=$total_rows;?>" style="display:none;"></span>

<table border="1" class="table-bordered">
    <thead>
        <tr>
            <th align="center">ລ/ດ</th>
            <th align="center">ວັນທີ</th>
            <th align="center">ເລກທີ</th>
            <th align="center">Created_Date_LAT</th>
            <th align="center">Delivery_Date_LAT</th>
            <th align="center">ສ່ວນຕ່າງເວລາ</th>
            <th align="center">CusID</th>
            <th align="center">Customer Name</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $list_id = 0;
    while ($s = mysqli_fetch_array($sp)) {
        $list_id++;
        $dd = date_create($s["sale_date"]);
    ?>
        <tr>
            <td align="center"><?=$list_id;?></td>
            <td align="center"><?=date_format($dd, "d/m/Y");?></td>
            <td align="center"><?=$s['sale_id'];?></td>
            <td align="right"><?=$s['Created_Date_LAT'];?></td>
            <td align="right"><?=$s['Delivery_Date_LAT'];?></td>
            <td align="right"><?=$s['diff_time'];?></td>
            <td align="center"><?=$s['customer_id'];?></td>
            <td align="left"><?=$s['outlet_name'];?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>