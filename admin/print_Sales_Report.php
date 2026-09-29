<?php 
include("init.php");

?>





<!DOCTYPE html>
<html lang="en">

<title>ລະບົບສາງ</title>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

<style type="text/css">
    @import url("LAOS/stylesheet.css");
body,td,th ,h1,h2,h3,h4,h5,h6,h7,small,input[type='button'],input[type='text'],input[type='submit'], a{
	font-family: LAOS;


}
.ui-autocomplete { font-family:"Phetsarath OT";}
	
</style>







<?php
            @$customer_id= mysqli_real_escape_string($con,$_GET['customer_id']);

if($customer_id==''){$c_id="";} 
elseif($customer_id=='New_customer'){
 $c_id="and product_sale.customer_id NOT IN (SELECT customer_id FROM customers)";}
		   else{ 
 $c_id="and 
         (product_sale.customer_id like '$customer_id%' or product_sale.customer_id like '%$customer_id%')
         ";}
			
			

		   @$from_date= mysqli_real_escape_string($con,$_GET['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_GET['to_date']);	
		   $today=date("Y-m-d");
		   


           if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today'";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  


           @$sale_id= mysqli_real_escape_string($con,$_GET['sale_id']);	
      
		 if($sale_id==''){$r_id="";}  else{ $r_id="and  product_sale.sale_id like '%$sale_id%' "; /*$btw="";*/ }
		 




$from_date1 = date_create($from_date);
$to_date1 = date_create($to_date);

          ?>
        

<center>

<br>
<h3>ລາຍງານຍອດຂາຍ</h3>
<br>
<br>
<h6>ວັນທີ <?php echo date_format($from_date1, "d/m/Y").' - '.date_format($to_date1, "d/m/Y"); ?></h6>
<br>



<?php
if($search=='custom'){
?>



<?php   


 @$sp1=mysqli_query($con,"SELECT
    -- ใส่คอลัมน์จัดกลุ่มตรงนี้ (เช่น product_sale.customer_id) หากต้องการ GROUP BY
        customers.customer_id,
        customer_import.outlet_name,
    SUM(product_sale.qty) AS qty,
  /*SUM(product_sale.qty * product_sale.price) AS all_price,*/
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) THEN product_sale.qty * product_sale.price ELSE 0 END) AS all_price,

    -- กลุ่มสินค้า 001 (ขายปกติ)
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '001' THEN product_sale.qty ELSE 0 END) AS t_qty_1,
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '001' THEN product_sale.qty * product_sale.price ELSE 0 END) AS amt_1,
    SUM(CASE WHEN product_sale.free <> '' AND product_sale.free IS NOT NULL AND tb_groups.Group_ID = '001' THEN product_sale.qty ELSE 0 END) AS free_qty,

    -- กลุ่มสินค้า 002 (ขายปกติ)
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '002' THEN product_sale.qty ELSE 0 END) AS t_qty_2,
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '002' THEN product_sale.qty * product_sale.price ELSE 0 END) AS amt_2,

    -- กลุ่มสินค้า 003 (ขายปกติ)
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '003' THEN product_sale.qty ELSE 0 END) AS t_qty_3,
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '003' THEN product_sale.qty * product_sale.price ELSE 0 END) AS amt_3

FROM product_sale
LEFT JOIN products ON products.Product_ID = product_sale.product_id
LEFT JOIN stocks ON stocks.stock_id = product_sale.stock_id
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id
LEFT JOIN customer_import ON customer_import.external_id = customers.customer_id
LEFT JOIN tb_groups ON tb_groups.Group_ID = products.group_id
LEFT JOIN sr_list ON product_sale.sr = sr_list.sr_id

WHERE 1=1 $btw $c_id $r_id Group by product_sale.customer_id
 ");


          ?>
        
 		<table border="1" class="table-bordered">
             <thead>
              <tr>
            <th align="center">ລ/ດ</th>
            <th align="center">ລູກຄ້າ</th>
            <th align="center">ຍອດຂາຍ</th>
            <th align="center">ຍອດມັດຈຳລັງ</th>
            <th align="center">ຍອດຄືນລັງເປົ່າ</th>
            <th align="center">ຍອດເບຍແຖມ</th>
      
        </tr>

				   
              </tr>
			</thead>
          <tbody>
    <?php
    $list_id = 0;

    while ($s = mysqli_fetch_array($sp1)) {

    $list_id++;

        
    ?>
        <tr>
            <td align="center"><?=$list_id;?></td>
            <td align="left"><?=$s['outlet_name'];?></td>

            <td align="center"><?=@number_format($s['t_qty_1'],0);?></td>
            <td align="center"><?=@number_format($s['t_qty_2'],0);?></td>
            <td align="center"><?=@number_format($s['t_qty_3'],0);?></td>
            <td align="center"><?=@number_format($s['free_qty'],0);?></td>
        </tr>



    <?php 
    
    $t_qty_1+=$s['t_qty_1'];
    $t_qty_2+=$s['t_qty_2'];
    $t_qty_3+=$s['t_qty_3'];
    $free_qty+=$s['free_qty'];
    
    } ?>

 <tr>
<td colspan="2" align="center">ລວມ</td>
<td align="center"><?=number_format($t_qty_1, 0);?></td>
<td align="center"><?=number_format($t_qty_2, 0);?></td>
<td align="center"><?=number_format($t_qty_3, 0);?></td>
<td align="center"><?=number_format($free_qty, 0);?></td>
</tr>


         </table>


<?php
}
elseif($search=='date'){
?>


<?php   


 @$sp1=mysqli_query($con,"SELECT
    -- ใส่คอลัมน์จัดกลุ่มตรงนี้ (เช่น product_sale.customer_id) หากต้องการ GROUP BY
        customers.customer_id,
        customer_import.outlet_name,
        product_sale.sale_date,
    SUM(product_sale.qty) AS qty,
  /*SUM(product_sale.qty * product_sale.price) AS all_price,*/
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) THEN product_sale.qty * product_sale.price ELSE 0 END) AS all_price,

    -- กลุ่มสินค้า 001 (ขายปกติ)
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '001' THEN product_sale.qty ELSE 0 END) AS t_qty_1,
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '001' THEN product_sale.qty * product_sale.price ELSE 0 END) AS amt_1,
    SUM(CASE WHEN product_sale.free <> '' AND product_sale.free IS NOT NULL AND tb_groups.Group_ID = '001' THEN product_sale.qty ELSE 0 END) AS free_qty,

    -- กลุ่มสินค้า 002 (ขายปกติ)
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '002' THEN product_sale.qty ELSE 0 END) AS t_qty_2,
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '002' THEN product_sale.qty * product_sale.price ELSE 0 END) AS amt_2,

    -- กลุ่มสินค้า 003 (ขายปกติ)
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '003' THEN product_sale.qty ELSE 0 END) AS t_qty_3,
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '003' THEN product_sale.qty * product_sale.price ELSE 0 END) AS amt_3

FROM product_sale
LEFT JOIN products ON products.Product_ID = product_sale.product_id
LEFT JOIN stocks ON stocks.stock_id = product_sale.stock_id
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id
LEFT JOIN customer_import ON customer_import.external_id = customers.customer_id
LEFT JOIN tb_groups ON tb_groups.Group_ID = products.group_id
LEFT JOIN sr_list ON product_sale.sr = sr_list.sr_id

WHERE 1=1 $btw $c_id $r_id Group by product_sale.sale_date
 ");


          ?>
        
 		<table border="1" class="table-bordered">
             <thead>
              <tr>
            <th align="center">ລ/ດ</th>
            <th align="center">ວັນທີ</th>
            <th align="center">ຍອດຂາຍ</th>
            <th align="center">ຍອດມັດຈຳລັງ</th>
            <th align="center">ຍອດຄືນລັງເປົ່າ</th>
            <th align="center">ຍອດເບຍແຖມ</th>
      
        </tr>

				   
              </tr>
			</thead>
          <tbody>
    <?php
    $list_id = 0;

    while ($s = mysqli_fetch_array($sp1)) {

    $list_id++;
$dd = date_create($s["sale_date"]);
        
    ?>
        <tr>
            <td align="center"><?=$list_id;?></td>
            <td align="center"><?=date_format($dd, "d/m/Y");?></td>
            <td align="center"><?=@number_format($s['t_qty_1'],0);?></td>
            <td align="center"><?=@number_format($s['t_qty_2'],0);?></td>
            <td align="center"><?=@number_format($s['t_qty_3'],0);?></td>
            <td align="center"><?=@number_format($s['free_qty'],0);?></td>
        </tr>



    <?php 
    
    $t_qty_1+=$s['t_qty_1'];
    $t_qty_2+=$s['t_qty_2'];
    $t_qty_3+=$s['t_qty_3'];
    $free_qty+=$s['free_qty'];
    
    } ?>

 <tr>
<td colspan="2" align="center">ລວມ</td>
<td align="center"><?=number_format($t_qty_1, 0);?></td>
<td align="center"><?=number_format($t_qty_2, 0);?></td>
<td align="center"><?=number_format($t_qty_3, 0);?></td>
<td align="center"><?=number_format($free_qty, 0);?></td>
</tr>


         </table>




<?php
}
else{
?>



<?php   


 @$sp1=mysqli_query($con,"SELECT
    -- ใส่คอลัมน์จัดกลุ่มตรงนี้ (เช่น product_sale.customer_id) หากต้องการ GROUP BY
        customers.customer_id,
        customer_import.outlet_name,
        product_sale.sale_date,
    SUM(product_sale.qty) AS qty,
  /*SUM(product_sale.qty * product_sale.price) AS all_price,*/
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) THEN product_sale.qty * product_sale.price ELSE 0 END) AS all_price,

    -- กลุ่มสินค้า 001 (ขายปกติ)
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '001' THEN product_sale.qty ELSE 0 END) AS t_qty_1,
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '001' THEN product_sale.qty * product_sale.price ELSE 0 END) AS amt_1,
    SUM(CASE WHEN product_sale.free <> '' AND product_sale.free IS NOT NULL AND tb_groups.Group_ID = '001' THEN product_sale.qty ELSE 0 END) AS free_qty,

    -- กลุ่มสินค้า 002 (ขายปกติ)
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '002' THEN product_sale.qty ELSE 0 END) AS t_qty_2,
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '002' THEN product_sale.qty * product_sale.price ELSE 0 END) AS amt_2,

    -- กลุ่มสินค้า 003 (ขายปกติ)
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '003' THEN product_sale.qty ELSE 0 END) AS t_qty_3,
    SUM(CASE WHEN (product_sale.free = '' OR product_sale.free IS NULL) AND tb_groups.Group_ID = '003' THEN product_sale.qty * product_sale.price ELSE 0 END) AS amt_3

FROM product_sale
LEFT JOIN products ON products.Product_ID = product_sale.product_id
LEFT JOIN stocks ON stocks.stock_id = product_sale.stock_id
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id
LEFT JOIN customer_import ON customer_import.external_id = customers.customer_id
LEFT JOIN tb_groups ON tb_groups.Group_ID = products.group_id
LEFT JOIN sr_list ON product_sale.sr = sr_list.sr_id
WHERE 1=1 $btw 
/*
$c_id $r_id Group by product_sale.sale_date
*/
 ");


          ?>
        
 		<table border="1" class="table-bordered">
             <thead>
              <tr>
            <th align="center">ລ/ດ</th>
            <th align="center">ຍອດຂາຍ</th>
            <th align="center">ຍອດມັດຈຳລັງ</th>
            <th align="center">ຍອດຄືນລັງເປົ່າ</th>
            <th align="center">ຍອດເບຍແຖມ</th>
      
        </tr>

				   
              </tr>
			</thead>
          <tbody>
    <?php
    $list_id = 0;

    while ($s = mysqli_fetch_array($sp1)) {

    $list_id++;
$dd = date_create($s["sale_date"]);
        
    ?>
        <tr>
            <td align="center"><?=$list_id;?></td>
            <td align="center"><?=@number_format($s['t_qty_1'],0);?></td>
            <td align="center"><?=@number_format($s['t_qty_2'],0);?></td>
            <td align="center"><?=@number_format($s['t_qty_3'],0);?></td>
            <td align="center"><?=@number_format($s['free_qty'],0);?></td>
        </tr>



    <?php 
    
    $t_qty_1+=$s['t_qty_1'];
    $t_qty_2+=$s['t_qty_2'];
    $t_qty_3+=$s['t_qty_3'];
    $free_qty+=$s['free_qty'];
    
    } ?>

 <tr>
<td colspan="1" align="center">ລວມ</td>
<td align="center"><?=number_format($t_qty_1, 0);?></td>
<td align="center"><?=number_format($t_qty_2, 0);?></td>
<td align="center"><?=number_format($t_qty_3, 0);?></td>
<td align="center"><?=number_format($free_qty, 0);?></td>
</tr>


         </table>


<?php
}
?>
        

        
<br>
<br>
<br>

</center>


<script>
  window.onload = function() {
    window.print();
  };
</script>