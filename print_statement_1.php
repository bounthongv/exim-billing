<?php 
include("init.php");
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sinxay</title>
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

<?php 
$customer_id=mysqli_real_escape_string($con,$_GET['customer_id']);
$from_date = mysqli_real_escape_string($con,$_GET['from_date']);
$to_date = mysqli_real_escape_string($con,$_GET['to_date']);	
	
$sql_h = mysqli_query($con," SELECT * FROM customers where customer_id='$customer_id'");
              $ff = mysqli_fetch_array($sql_h);

?>



<table width="700" border="0">
<tr>
    <td valign="bottom"><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><img src="heineken-logos.png" width="128" > </td>
    <td width="30%" colspan="1" align="center" ><h5>Statement of Account</h5></td>
    <td width="35%" align="right" >&nbsp;<br />
   &nbsp;<br><br>

 <img src="images/sx_logo.png" width="60"><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
    
    </td>
</tr>
  <tr>
    <td valign="top" width="35%"><strong>Heineken Lao Brewery Co., Ltd.</strong><br />
    Vernkham Village, Xaythani District,<br /> Vientiane Capital	
    <br />
    Phone:  020 55329646,020 52221074
   
    </td>
    
    
    
    
    <td colspan="2" valign="top" align="right" >ບ້ານ ຫົວຂົວ, ເມືອງ ນາຊາຍທອງ,<br />
    ນະຄອນຫຼວງວຽງຈັນ<br />
     Tel: 55555764</td>
  </tr>
  <tr>
  <td  >ຊື່ລູກຄ້າ: <?php echo $ff['customer_name']; ?> <br>ລະຫັດ: <?php echo $ff['customer_id']; ?><br> ທີ່ຢູ່ລູກຄ້າ: <?php echo $ff['address']; ?><br> ເບີໂທ: <?php echo $ff['phone']; ?></td>
  <td colspan="2" align="right" valign="top">
  <?php /*ສາງ: <?php echo $ff['User_Name']; ?> &nbsp;*/?>
  </td>
  </tr>
</table>

	<table width="700">
		<tr>
		<td align="right">
		<?php 
		$date=date_create($from_date);
echo date_format($date,"d/m/Y");	
			?>
		</td>
		<td align="center">
		ຫາ
			</td>	
		<td align="left">
		<?php 
			$date1=date_create($to_date);
echo date_format($date1,"d/m/Y");	
			?>
		</td>
		</tr>
	</table>

<table width="700" border="1">
  <tr align="center">
   <th align="center">.No</th>
               <th align="center">inv_no</th>
<th align="center">inv_date</th>
<th align="center">inv_amt</th>
<th align="center">HD</th>
<th align="center">HM</th>
<th align="center">HP</th>
<th align="center">HP1</th>
<th align="center">HQ</th>
<th align="center">HQ1</th>
<th align="center">HS</th>
<th align="center">NC</th>
<th align="center">NQ</th>
<th align="center">RP</th>
<th align="center">RP1</th>
<th align="center">RS</th>
<th align="center">TC</th>
<th align="center">TQ</th>
<th align="center">CO2</th>
  </tr>
   <?php 

        
    	  @$sp=mysqli_query($con,"
       SELECT * from tb_statement
	  order by inv_date, inv_no asc
          ");
	
           $i=0;
	  
            while($s=mysqli_fetch_array($sp)){
            $i++;
                        ?>
                        
  <tr>
     <td><?php echo $i;?></td>
<td><?php echo $s["inv_no"];?></td>
<td><?php  $date=date_create($s["inv_date"]); echo date_format($date,"d/m/Y");?></td>
<td><?php echo number_format($s["inv_amt"])?></td>
<td><?php echo $s["HD"];?></td>
<td><?php echo $s["HM"];?></td>
<td><?php echo $s["HP"];?></td>
<td><?php echo $s["HP1"];?></td>
<td><?php echo $s["HQ"];?></td>
<td><?php echo $s["HQ1"];?></td>
<td><?php echo $s["HS"];?></td>
<td><?php echo $s["NC"];?></td>
<td><?php echo $s["NQ"];?></td>
<td><?php echo $s["RP"];?></td>
<td><?php echo $s["RP1"];?></td>
<td><?php echo $s["RS"];?></td>
<td><?php echo $s["TC"];?></td>
<td><?php echo $s["TQ"];?></td>
<td><?php echo $s["CO2"];?></td>
	</tr>
	
	<?php 
	@$t_inv_amt+=$s["inv_amt"];	  
	@$t_HD+=$s["HD"];
@$t_HM+=$s["HM"];
@$t_HP+=$s["HP"];
@$t_HP1+=$s["HP1"];
@$t_HQ+=$s["HQ"];
@$t_HQ1+=$s["HQ1"];
@$t_HS+=$s["HS"];
@$t_NC+=$s["NC"];
@$t_NQ+=$s["NQ"];
@$t_RP+=$s["RP"];
@$t_RP1+=$s["RP1"];
@$t_RS+=$s["RS"];
@$t_TC+=$s["TC"];
@$t_TQ+=$s["TQ"];
@$t_CO2+=$s["CO2"];
  
		  
		  } ?>
	

<tr style="background-color:#99ff99;">	
<td colspan="3" align="center"><strong>ລວມ</strong></td>
<td colspan="1"><?=@number_format($t_inv_amt);?></td>
<td colspan="1"><?=@number_format($t_HD);?></td>
<td colspan="1"><?=@number_format($t_HM);?></td>
<td colspan="1"><?=@number_format($t_HP);?></td>
<td colspan="1"><?=@number_format($t_HP1);?></td>
<td colspan="1"><?=@number_format($t_HQ);?></td>
<td colspan="1"><?=@number_format($t_HQ1);?></td>
<td colspan="1"><?=@number_format($t_HS);?></td>
<td colspan="1"><?=@number_format($t_NC);?></td>
<td colspan="1"><?=@number_format($t_NQ);?></td>
<td colspan="1"><?=@number_format($t_RP);?></td>
<td colspan="1"><?=@number_format($t_RP1);?></td>
<td colspan="1"><?=@number_format($t_RS);?></td>
<td colspan="1"><?=@number_format($t_TC);?></td>
<td colspan="1"><?=@number_format($t_TQ);?></td>
<td colspan="1"><?=@number_format($t_CO2);?></td>

</tr>		
				
</table>
<br>
<table width="700" border="0">
  <tr align="center">
<td><strong>ຜູ້ຈ່າຍເງິນ<br>Payer</strong></td>
    <td><strong><br></strong></td>
    <td><strong><br></strong></td>
    <td colspan="3"  align="center"><strong> &nbsp; &nbsp;ຜູ້ຮິບເງິນ<br>Payee</strong></td>
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