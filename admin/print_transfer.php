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
$transfer_id=mysqli_real_escape_string($con,$_GET['transfer_id']);
 if($transfer_id==''){$r_id="";}  else{ $r_id="and  transfer.transfer_id='$transfer_id' ";}
 
$sql_h = mysqli_query($con,"  SELECT transfer.*,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,stocks2.stock_name as stock_name2
			,users.fname
		   FROM  transfer 
		   left join products on products.Product_ID=transfer.product_id
       left join stocks on stocks.stock_id=transfer.f_stock_id
	   left join stocks as stocks2 on stocks2.stock_id=transfer.t_stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
	    left join users on transfer.user_id=users.user_id
       
       
       where      transfer.qty>0 $r_id  
         order by transfer.product_id,transfer.product_lot_id ");
              $ff = mysqli_fetch_array($sql_h);
			  $date_x=$ff['sale_date'];
			  
			   $stock_name=$ff['stock_name'];
			   $stock_name2=$ff['stock_name2'];
			   $fname=$ff['fname'];
			   
			  

                  $date_x=$ff['transfer_date'];
			  
			  $date=date_create($date_x);
 $sale_date=date_format($date,"d/m/Y");
?>
<body>
<style>
body{ font-family:"Phetsarath OT"; font-size:11px; }
h2,h3,h4,h5,h6{ font-family:"Phetsarath OT";  }
a,a:link,a:hover { text-decoration:none; color:
#000;}
.ff{ font-family:"Times New Roman", Times, serif}
.print_size{ width:3in; alignment-adjust:central}
tr.border_top td{
  border-top:1pt solid black;

}

</style>


<table width="700" border="0">
<tr>
    <td valign="bottom"><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><img src="heineken-logos.png" width="128" > </td>
    <td width="30%" colspan="1" align="left" ><h5>ໃບໂອນເຄື່ອງ</h5></td>
    <td width="35%" align="right" >ເລກທີ: <?php echo $transfer_id; ?><br />
    ວັນທີ: <?php echo $sale_date;?> <br><br>
    
    <img src="exim-logo-n.png" width="60"><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
    
    </td>
</tr>
  <tr>
    <td valign="top" width="35%"><strong>Heineken Lao Brewery Co., Ltd.</strong><br />
    Vernkham Village, Xaythani District,<br /> Vientiane Capital	
    <br />
    Phone: <!--+856-21-264 087 --> 020 55329646,020 52221074<br />
    Email: <!--sale@exim.la,  www.exim.la--><br />
    </td>
    
    
    
    
    <td colspan="2" valign="top" align="right" ><strong>Exim Sole Co., Ltd.</strong><br />
    Vientiane Office K21-22  Asian Mall,<br />
     Kamphaengmoung (T4) Road, Saysettha District,<br /> Vientiane, Lao PDR <br />
    Phone: +856-21-264 087  <br />
    Email: sale@exim.la,  www.exim.la<br /></td>
  </tr>
<tr>
   <td colspan="3" align="left"><strong><h6>ຈາກ <?php echo $stock_name; ?> ຫາ <?php echo $stock_name2; ?></h6> 
   &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $fname; ?>
   </strong></td>
</tr>
</table>

<table width="700" border="1">
  <tr align="center">
    <td width="5%"><strong>ລ/ດ</strong></td>
    <td width="40%"><strong>ລາຍການ</strong></td>
 
    <td width="10%"><strong>ຈຳນວນ</strong></td>
       <td width="15%"><strong>ຫົວໝ່ວຍ</strong></td>
 <!--   <td width="15%"><strong>ລາຄາ</strong></td>
    <td width="20%"><strong>ຈຳນວນເງີນ</strong></td>-->
  </tr>
   <?php 

						
                       
                        $sql = mysqli_query($con,"
				SELECT transfer.*,stocks.stock_name,products.Product_ID,products.Product_Name
				,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,stocks2.stock_name as stock_name2
			,sum(transfer.qty) as t_qty
		   FROM  transfer 
		   left join products on products.Product_ID=transfer.product_id
       left join stocks on stocks.stock_id=transfer.f_stock_id
	   left join stocks as stocks2 on stocks2.stock_id=transfer.t_stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       
       where      transfer.qty>0 $r_id  
	   group by transfer.product_id
         order by transfer.product_id,transfer.product_lot_id  ");
		 
		 $e=0;
                        while($f = mysqli_fetch_array($sql)){
                       // $total = $f['qty_iv'] * $f['prices'];
                        @$amount = $amount + $f['amount'];
						@$total_last_amount += $f['last_amount'];
						@$total_qty += $f['t_qty'];
						$e++;
                        ?>
  <tr>
    <td align="center"><?php echo $e; ?></td>
    <td><?php echo $f["Product_Name"]; ?>&nbsp;<strong>(<?php echo $f["Product_ID"]; ?>)</strong></td>
   
    <td align="center"><?php echo $f["t_qty"]; ?></td>
     <td align="center"><?php echo $f["Unit"]; ?></td>
   <!--  <td align="right"><?php echo @number_format($f["price"]+$f["crate_price"],0); ?></td>
    <td align="right"><?php echo @number_format($f["last_amount"],0); ?></td>-->
  </tr>
  <?php } ?>
  <tr>
  <td colspan="2" align="right">ລວມ</td>
  <td align="center"><?php echo @number_format($total_qty,0); ?></td>
  <td ></td>
  </tr>
</table>
<br>
<table width="700" border="0">
  <tr>
    <td align="center">ຜູ້ໂອນ</td>
    <td align="center"><!--ຜູ້ຮັບເງີນ--></td>
    <td  align="center">ຜູ້ຮັບ</td>
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