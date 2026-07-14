<?php 
include("init.php");


 $no=mysqli_real_escape_string($con,$_GET['no']);
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ໃບສັ່ງລັງ ແລະ ແກ້ວເປົ່າ</title>
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



.table > :not(:first-child) {
    border-top: 2px solid currentColor;
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

			<?php
@$s1 = mysqli_query($con,"SELECT * from tbl_empty_pay_out_note where `no`='$no'");
$m = mysqli_fetch_array($s1);
		 ?>

<table width="100%" border="0">
<tr>
    <td valign="bottom"><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><img src="heineken-logos.png" width="128" > </td>
    <td width="30%" colspan="1" align="center" ><h5>ໃບຈ່າຍອອກລັງ ແລະ ແກ້ວເປົ່າ <br> Empty Pay Out Note</h5></td>
    <td width="35%" align="right" >ເລກທີ: <?php echo $m['no']; ?><br />
    ວັນທີ: <?php echo $sale_date;?> <br><br>
    
     <div >
    <strong></strong>
    </div><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
    
    </td>
</tr>
  <tr>
    <td valign="top" width="35%"><strong>Heineken Lao Brewery Co., Ltd.</strong><br />
    Vernkham Village, Xaythani District,<br /> Vientiane Capital	
    <br />
    Phone: <!--+856-21-264 087 --> 020 55329646,020 52221074
    </td>
    
    
    
    
   <td colspan="2" valign="top" align="center" >ວັນທີ່ສົ່ງ Sending Date:
    <?php
   $date1=date_create(@$m['Sending_date']);
   echo date_format($date1,"d/m/Y");
   ?><br />
    ເລກລົດ Truck Number: <?php $m['Truck_Number']; ?><br />
    ຊື່ຄົນຂັບລົດ Driver Name: <?php $m['Driver_Name']; ?></td>
  </tr>
  <tr>
  <td>ຊື່ຕົວແທນສົ່ງ Distributor Name: <?php $m['Distributor_Name']; ?><br>
ສົ່ງໃຫ້ Ship To: Heineken Lao Breweries Limited
  </td>
  <td colspan="2" align="right" valign="top">
  </td>
  </tr>
</table>



<table width="100%" border="1">
  <tr align="center">

    <td><strong><br>ລາຍລະອຽດສິນຄ້າ</strong></td>
   <!-- <td><strong><br>ວັນທີ</strong></td>-->
    <td><strong><br>ລະຫັດ</strong></td>
	  <td><strong><br>ຫ.ໝ</strong></td>
    <td><strong><br>ປະເພດລັງ</strong></td>
    <td><strong><br>ຈຳນວນຈ່າຍ</strong></td>


<!--
    <td><strong><br>ລູກຄ້ານັບ</strong></td>
    <td><strong><br>ຄົນຂັບລົດນັບເຄື່ອງຂື້ນລົດ</strong></td>
    
    <td><strong><br>ຄົນຂັບລົດນັບລົງຢູ່ສາງ</strong></td>
    <td><strong><br>ນາຍສາງນັບ</strong></td>
    <td><strong><br>ລາຍລະອຽດ</strong></td>
    -->
  </tr>
   <?php 

			
	 $sql = mysqli_query($con,"SELECT `Description`,count(`Description`) as count_Description from tbl_empty_pay_out_note where `no`='$no' group by `Description`");
		 
	
                        while($f = mysqli_fetch_array($sql)){
    
                          $Description=$f['Description'];
                          $count_Description=$f['count_Description'];
?>


<tr>       
<td style="border-bottom:2pt solid black;" align="center" rowspan="<?php echo $count_Description; ?>"><?php echo $f["Description"]; ?></td>
<?php 
  $e=1;
                          @$sql1 = mysqli_query($con,"SELECT * from tbl_empty_pay_out_note where `Description`='$Description'");
                          while(@$f1 = mysqli_fetch_array($sql1)){


                        ?>


    
    <td align="center" <?php if($count_Description==$e){ ?>style='border-bottom:2pt solid black;'<?php }else{?> style='' <?php };?>><?php echo $f1["Item_number"]; ?></td>
    <td align="center" <?php if($count_Description==$e){ ?>style='border-bottom:2pt solid black;'<?php }else{?> style='' <?php };?>><?php echo $f1["UOM"];?></td>
    <td align="center" <?php if($count_Description==$e){ ?>style='border-bottom:2pt solid black;'<?php }else{?> style='' <?php };?>><?php echo $f1["crate_type"];?></td>
    <td align="center" <?php if($count_Description==$e){ ?>style='border-bottom:2pt solid black;'<?php }else{?> style='' <?php };?>><?php echo $f1["amount_received"];?></td>

    
  </tr>
  <?php 

$e++;
                        }
  }
  
   ?>

</table>
<br>
<table width="100%" border="1">
<tr align="center">
    <td height="80px">&nbsp;</td>
    <td height="80px">&nbsp;</td>
    <td height="80px">&nbsp;</td>
    <td height="80px">&nbsp;</td>
  </tr>

  <tr align="center">
    <td><strong>ລາຍເຊັນ/ວັນທີ/ເວລາ<br>Signature/Date/Time</strong></td>
    <td><strong>ລາຍເຊັນ/ວັນທີ/ເວລາ<br>Signature/Date/Time</strong></td>
    <td><strong>ລາຍເຊັນ/ວັນທີ/ເວລາ<br>Signature/Date/Time</strong></td>
    <td><strong>ລາຍເຊັນ/ວັນທີ/ເວລາ<br>Signature/Date/Time</strong></td>
  </tr>

  <tr align="center">
    <td><strong>ລູກຄ້າ/Customer</strong></td>
    <td><strong>ຄົນຂັບລົດ(ເຄື່ອງຂຶ້ນລົດ)/Driver</strong></td>
    <td><strong>ຄົນຂັບລົດ(ເຄື່ອງລົງຢູ່ສາງ)/Driver</strong></td>
    <td><strong>ພະນັກງານສາງ/FLD/Storekeeper</strong></td>
  </tr>

  <tr align="left">
    <td colspan="4"><strong>Remarks/ໝາຍເຫດ<br>
        .........................................<br>
        .........................................<br>
        .........................................
</strong></td>
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