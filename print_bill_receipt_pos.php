<?php 
include("init.php");
?>
<!DOCTYPE>
<html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>exim</title>
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
$sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);
$sql_h = mysqli_query($con," select product_sale.*,sum(product_sale.qty) as qty
                               ,sum(product_sale.amount) as amount
				 ,products.Product_Name,customers.customer_name ,stocks.stock_name,customers.address,customers.phone
				 ,users.User_Name
         ,users.fname
				 from product_sale 
         LEFT JOIN products ON products.Product_ID = product_sale.product_id 
         LEFT JOIN customers ON customers.customer_id = product_sale.customer_id
		 LEFT JOIN stocks ON product_sale.stock_id = stocks.stock_id 
		 LEFT JOIN users ON product_sale.user_id = users.User_ID 
         
		 where product_sale.sale_id='$sale_id'  group by product_sale.product_id");
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
<table width="347" border="0">
<tr>
    <td colspan="2" valign="bottom">ເລກທີ: <?php echo $ff['sale_id']; ?><br />
    ວັນທີ: <?php echo $sale_date;?> <br>
    ເວລາ: <?php echo date("h:i");?> <br>
    <td colspan="4" align="left" ><h5> &nbsp;ໃບບິນຂາຍ/Invoice</h5></td>   
</tr>
<tr>
    <td colspan="3" valign="bottom">
     <img src="heineken-logos.png" width="128" ></td>
    <td colspan="3" width="52%" align="right" >
      <img src="exim-logo-n.png" width="60">    </td>
</tr>
  <tr>
    <td colspan="3" valign="top"><strong>Heineken Lao Brewery <br> Co., Ltd.</strong><br />
    Phone:020 76719197,<br /> 
          020 52221074<br />   
    </td> 
    
    <td colspan="3" valign="top" width="52%" align="right" ><strong>Exim Sole Co., Ltd.</strong><br />
    Phone: +856-21-264 087  <br />
    Email: sale@exim.la,<br />
    www.exim.la</td>
  </tr>
  <tr>
  <td colspan="3"  >ຊື່ລູກຄ້າ: <?php echo $ff['customer_name']; ?> <br>
    ລະຫັດ: <?php echo $ff['customer_id']; ?><br>  ທີ່ຢູ່ລູກຄ້າ: <?php echo $ff['address']; ?><br> ເບີໂທ: <?php echo $ff['phone']; ?></td>
  <td colspan="3" width="52%" align="right" valign="top"><font style="font-size: 10px;" >Acc Name: EXIM SOLE CO.,LTD.</font><br>
                                             Acct.: 162.12.00.00335568.001
  <br><br>
  <strong> ຜູ້ໃຊ້: <?php echo $ff['fname']; ?> &nbsp;</strong><br>
  <strong> ສາງ: <?php echo $ff['stock_name']; ?> &nbsp;</strong>
  </td>
  </tr>
</table>

<table width="349" border="1">
  <tr align="center">
    <td width="5%"><strong>No<br>ລ.ດ</strong></td>
    <td width="30%"><strong> Description<br>ລາຍການ</strong></td>
    <td width="8%"><strong>QTY<br>ຈຳນວນ</strong></td>
    <td width="18%"><strong>Price<br>ລາຄາ</strong></td>
    <td width="20%"><strong>Amount<br>ຈຳນວນເງີນ</strong></td>
  </tr>
   <?php 

						
                       
                       /* $sql = mysqli_query($con,"
				 select   products.Product_ID,products.Product_Name,products.Unit,tb_product_sale.product_id
   ,tb_product_sale.s_qty,tb_product_sale.price,tb_product_sale.crate_price,tb_product_sale.amount
   ,tb_product_sale.amount_crate,tb_product_sale.last_amount,tb_product_sale.customer_id
    from products
   
   left join (select sum(qty) as s_qty,product_id,price,crate_price,amount,amount_crate,last_amount,customer_id
    from product_sale where 1=1 and sale_id='$sale_id' group by product_id ) as tb_product_sale
                 on products.Product_ID=tb_product_sale.product_id
              
                 
     where products.Group_ID='001' ");*/
	 $sql = mysqli_query($con," select product_sale.* ,sum(product_sale.qty) as t_qty
	 ,sum(product_sale.amount) as t_amount
	 ,products.Product_ID,products.Product_Name,customers.customer_name 
				 ,stocks.stock_name,customers.address,customers.phone,products.Unit
				 from product_sale 
         LEFT JOIN products ON products.Product_ID = product_sale.product_id 
         LEFT JOIN customers ON customers.customer_id = product_sale.customer_id
		  LEFT JOIN stocks ON product_sale.stock_id = stocks.stock_id 
         
		 where product_sale.sale_id='$sale_id'  group by product_sale.product_id");
		 
		 $e=0;
                        while($f = mysqli_fetch_array($sql)){
                       // $total = $f['qty_iv'] * $f['prices'];
                        @$amount = $amount + $f["t_amount"];
						@$total_last_amount += $f['last_amount'];
						$e++;
                        ?>
  <tr>
    <td align="center"><?php echo $e; ?></td>
    <td><?php echo $f["Product_Name"]; ?>&nbsp;<strong>(<?php echo substr($f["Product_ID"],-2); ?>)</strong></td>
    <td align="center"><strong><?php echo $f["t_qty"]; ?></strong></td>
     <td align="right"><strong><?php  if($f["price"]=='0'){ echo "Free"; }else{ echo @number_format($f["price"],0); } ?></strong></td>
    <td align="right"><strong><?php  if($f["t_amount"]=='0'){ echo "Free"; }else{ echo @number_format($f["t_amount"],0); } ?></strong></td>
  </tr>
  <?php } ?>
  <tr>
  <td colspan="4" align="right"><strong>Total/ລວມ</strong></td>
  <td colspan="2"  align="right"><strong><font style="font-size: 18px;"><?php echo @number_format($amount,0); ?></font></strong></td>
  </tr>
</table>
<br>
<table width="347" border="0">
  <tr align="center">
    <td width="115"><strong>ຜູ້ຮັບເຄື່ອງ<br>Receiver</strong></td>
    <td width="22"><strong><br></strong></td>
    <td width="16"><strong><br></strong></td>
    <td width="129" colspan="3"  align="center"><strong> &nbsp; &nbsp;ຜູ້ສົ່ງເຄື່ອງ<br>Cashair</strong></td>
  </tr>
  <tr align="center">
    <!-- width="129" height="124" -->
    <?php
$a=1.3;
$width=129;
$height=124;
?>

    <td colspan="6">&nbsp;</td>
  </tr>
</table>
  <br>
  <br>
  <br>
  <br>
  
</body>
</html>


<script>



printpage();
function printpage() {
window.print(); 

}
</script>