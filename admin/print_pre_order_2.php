<?php 
include("init.php");
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ໃບສັ່ງຊື້ PURCHASE ORDER</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<?php 
$receipt_id=mysqli_real_escape_string($con,$_GET['receipt_id']);
$sql_h = mysqli_query($con," select product_customer_order.*,sum(product_customer_order.qty) as qty
                               ,sum(product_customer_order.amount) as amount
				 ,products.Product_Name,customers.customer_name ,stocks.stock_name,customers.address,customers.phone
				 ,users.User_Name
				 from product_customer_order 
         LEFT JOIN products ON products.Product_ID = product_customer_order.product_id 
         LEFT JOIN customers ON customers.customer_id = product_customer_order.customer_id
		 LEFT JOIN stocks ON product_customer_order.stock_id = stocks.stock_id 
		 LEFT JOIN users ON product_customer_order.user_id = users.User_ID 
         
		 where product_customer_order.sale_id='$sale_id'  group by product_customer_order.product_id");
              $ff = mysqli_fetch_array($sql_h);
			  $date_x=$ff['sale_date'];
			  
			   $stock_name=$ff['stock_name'];
			   
			  


			  
			  $date=date_create($date_x);
 $sale_date=date_format($date,"d/m/Y");
?>
<body>
<style>
body{ font-family:"Phetsarath OT"; font-size:11px; }
h2,h3,h4,h5{ font-family:"Phetsarath OT";  }
a,a:link,a:hover { text-decoration:none; color:
#000;}
.ff{ font-family:"Times New Roman", Times, serif}
.print_size{ width:3in; alignment-adjust:central}
tr.border_top td{
  border-top:1pt solid black;

}

</style>
<!--<table width="700" border="0">
  <tr>
    <td align="center">ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</td>
  </tr>
  <tr>
    <td align="center">ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</td>
  </tr>
</table>
-->
<table width="100%" border="0">
<tr>
    <td valign="bottom"><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><img src="heineken-logos.png" width="128" > </td>
    <td width="30%" colspan="1" align="center" ><h5>ໃບສັ່ງຊື້ PURCHASE ORDER</h5></td>
    <td width="35%" align="right" >ເລກທີ: <?php echo $ff['sale_id']; ?><br />
    ວັນທີ: <?php echo $sale_date;?> <br><br>
    
     <div >
    <strong>ຮ້ານລາຊານອດ</strong>
    </div><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
    
    </td>
</tr>
  <tr>
    <td valign="top" width="35%"><strong>Heineken Lao Brewery Co., Ltd.</strong><br />
    Vernkham Village, Xaythani District,<br /> Vientiane Capital	
    <br />
    Phone: <!--+856-21-264 087 --> 020 55329646,020 52221074
    </td>
    
    
    
    
   <td colspan="2" valign="top" align="right" >ບ້ານ ຫົວຂົວ, ເມືອງ ນາຊາຍທອງ,<br />
    ນະຄອນຫຼວງວຽງຈັນ<br />
     Tel: 55555764</td>
  </tr>
  <tr>
  <td  >ຊື່ລູກຄ້າ: <?php echo $ff['customer_name']; ?> <br>ລະຫັດ: <?php echo $ff['customer_id']; ?>  ທີ່ຢູ່ລູກຄ້າ: <?php echo $ff['address']; ?><br> ເບີໂທ: <?php echo $ff['phone']; ?></td>
  <td colspan="2" align="right" valign="top">
  </td>
  </tr>
</table>



<table width="100%" border="1">
  <tr align="center">
    <td><strong><br>ລ/ດ</strong></td>
    <td><strong><br>ເລກທີຮັບເຂົ້າ</strong></td>
    <td><strong><br>ວັນທີ</strong></td>
    <td><strong><br>ຊື່ສິນຄ້າ</strong></td>
    <td><strong><br>ຈຳນວນ</strong></td>
    <td><strong><br>ຫົວຫນ່ວຍ</strong></td>
    <td><strong><br>ມູນຄ່າ</strong></td>
    <td><strong><br>ລັງເປົ່າ</strong></td>
    <td><strong><br>ໝາຍເຫດ</strong></td>
    
  </tr>
   <?php 
if($receipt_id==''){$r_id="";}  else{ $r_id="where  pre_orders.receipt_id='$receipt_id' ";}
			
	 $sql = mysqli_query($con,"SELECT pre_orders.*,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit ,tb_groups.Group_Name
		   FROM  pre_orders 
		left join products on products.Product_ID=pre_orders.product_id
       left join stocks on stocks.stock_id=pre_orders.stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id  
	  $r_id
	  ");
		 
		 $e=0;
                        while($f = mysqli_fetch_array($sql)){
                       // $total = $f['qty_iv'] * $f['prices'];
                        @$t_qty+=$f["qty"];
				@$t_amount_crate+=$f["amount_crate"];
				@$t_remark+=$f["remark"];
					    
						$e++;
                        ?>
  <tr>
    <td align="center"><?php echo $e; ?></td>
    <td align="center"><?php echo $f["receipt_id"]; ?></td>
    
    
    <td align="center"><?php echo $f["receipt_date"]; ?></td>
    <td align="center"><?php echo $f["Product_Name"]; ?></td>
    <td align="right"><?php echo $f["Unit"];?></td>
     <td align="right"><?php echo @number_format($f["qty"],0);  ?></td>
    
     <td align="right"><?php echo @number_format($f["price"],0);  ?></td>
     
     <td align="right"><?php echo @number_format($f["amount_crate"],0);  ?></td>
     <td align="right"><?php echo @number_format($f["remark"],0);  ?></td>
  </tr>
  <?php } ?>
  <tr>
  <td colspan="5" align="right"><strong>Total/ລວມ</strong></td>
  <td align="right"><strong><?php echo @number_format($t_qty,0); ?></strong></td>
  <td align="center">&nbsp;</td>
  <td align="right"><strong><?php echo @number_format($t_amount_crate,0); ?></strong></td>
  <td align="right"><strong><?php echo @number_format($t_remark,0); ?></strong></td>
  </tr>
</table>
<br>
<table width="700" border="0">
  <tr align="center">
    <td><strong>Receiver<br>ຜູ້ຮັບເຄື່ອງ</strong></td>
    <td><strong>Deliver<br>ຜູ້ສົ່ງເຄື່ອງ</strong></td>
    <td><strong>Cashair<br>ຜູ້ຮັບເງີນ</strong></td>
    <td><strong>Paid<br>ຜູ້ຈ່າຍເງີນ</strong></td>
  </tr>
</table>

</body>
</html>


<script>



printpage();
function printpage() {
window.print(); 

}
</script>