<?php 
include("init.php");

 header("Content-Type: application/vnd.ms-excel");
 header("Content-Disposition: attachment;filename=ex_Beer_export_share.xls");

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



 @$sp=mysqli_query($con,"SELECT 
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
          ?>
        

<center>

<br>
<h3>ສັດສ່ວນການສົ່ງເບຍ</h3>
<br>
<br>
<h6>ວັນທີ <?php echo date_format($from_date1, "d/m/Y").' - '.date_format($to_date1, "d/m/Y"); ?></h6>
<br>


 		<table border="1" >
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

				   
              </tr>
			</thead>
          <tbody>
    <?php
    $list_id = 0;
    $today = new DateTime('now');

    while ($s = mysqli_fetch_array($sp)) {$list_id++;
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

         </table>
        
  


<br><br><br>


</center>


<script>
  window.onload = function() {
    window.print();
  };
</script>