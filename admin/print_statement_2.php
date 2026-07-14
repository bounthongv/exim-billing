<?php 
include("init.php");
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EXIM</title>
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



<table width="800" border="0" align="center">
<tr>
    <td valign="bottom"><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><img src="heineken-logos.png" width="128" > </td>
    <td width="21%" colspan="1" align="center" ><h5>Receipt Product Statement</h5></td>
    <td width="32%" align="right" >&nbsp;<br />
   &nbsp;<br><br>

 <img src="exim-logo-n.png" width="60"><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
    
    </td>
</tr>
  <tr>
    <td valign="top" width="47%"><strong>Heineken Lao Brewery Co., Ltd.</strong><br />
    Vernkham Village, Xaythani District,<br /> Vientiane Capital	
    <br />
    Phone:  020 55329646,020 52221074
   
    </td>
    
    
    
    
    <td colspan="2" valign="top" align="right" ><strong>Exim Sole Co., Ltd.</strong><br />
    Vientiane Office K21-22  Asian Mall,<br />
     Kamphaengmoung (T4) Road, Saysettha District,<br /> Vientiane, Lao PDR <br />
    Phone: +856-21-264 087  <br />
    Email: sale@exim.la,  www.exim.la<br />
	
	</td>
  </tr>
  <tr>
  <td  >ຊື່ລູກຄ້າ: <?php echo $ff['customer_name']; ?> <br>ລະຫັດ: <?php echo $ff['customer_id']; ?><br> ທີ່ຢູ່ລູກຄ້າ: <?php echo $ff['address']; ?><br> ເບີໂທ: <?php echo $ff['phone']; ?></td>
  <td colspan="2" align="right" valign="top">
  Print Date: <?php echo date("d-m-Y"); ?>  <br /> 
  <?php /*ສາງ: <?php echo $ff['User_Name']; ?> &nbsp;*/?>
  </td>
  </tr>
</table>

	<table width="800" align="center">
		<tr>
		<td align="center"> From Date:      &nbsp; &nbsp;
		<?php 
		$date=date_create($from_date); 
echo date_format($date,"d/m/Y"); 	
			?>		
			To 
		<?php 
			$date1=date_create($to_date);
echo date_format($date1,"d/m/Y");	
			?>		</td>
		</tr>
</table>

  <?php	
	  // ส่วนของ repeat content
    /*    for($v=1;$v<=$total_page_item;$v++){
            $item_i=(($i-1)*$total_page_item)+$v;
            $_province_name = isset($arr_data_set['inv_no'][$item_i])?$arr_data_set['inv_no'][$item_i]:"";
            $item_i = isset($arr_data_set['inv_no'][$item_i])?$item_i:"";*/
        ?>
		
<table width="700" border="1" align="center"> 
<thead>
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
    </thead>
   <?php 

        
    	  @$sp=mysqli_query($con,"
       SELECT * from tb_statement2
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
<td align="right"><?php if($s["inv_amt"]=='0'){echo "-";}else{echo number_format($s["inv_amt"]);};?></td>
<td><?php if($s["HD"]=='0'){echo "-";}else{echo $s["HD"];};?></td>
<td><?php if($s["HM"]=='0'){echo "-";}else{echo $s["HM"];};?></td>
<td><?php if($s["HP"]=='0'){echo "-";}else{echo $s["HP"];};?></td>
<td><?php if($s["HP1"]=='0'){echo "-";}else{echo $s["HP1"];};?></td>
<td><?php if($s["HQ"]=='0'){echo "-";}else{echo $s["HQ"];};?></td>
<td><?php if($s["HQ1"]=='0'){echo "-";}else{echo $s["HQ1"];};?></td>
<td><?php if($s["HS"]=='0'){echo "-";}else{echo $s["HS"];};?></td>
<td><?php if($s["NC"]=='0'){echo "-";}else{echo $s["NC"];};?></td>
<td><?php if($s["NQ"]=='0'){echo "-";}else{echo $s["NQ"];};?></td>
<td><?php if($s["RP"]=='0'){echo "-";}else{echo $s["RP"];};?></td>
<td><?php if($s["RP1"]=='0'){echo "-";}else{echo $s["RP1"];};?></td>
<td><?php if($s["RS"]=='0'){echo "-";}else{echo $s["RS"];};?></td>
<td><?php if($s["TC"]=='0'){echo "-";}else{echo $s["TC"];};?></td>
<td><?php if($s["TQ"]=='0'){echo "-";}else{echo $s["TQ"];};?></td>
<td><?php if($s["CO2"]=='0'){echo "-";}else{echo $s["CO2"];};?></td>
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
<table width="800" border="0" align="center">
<tr align="left">
<td><strong><br><u>Remark:</u></strong> ບໍ່ລວມເບຍແຖມ ແລະ ລັງເປົ່າ</td>
    <td><strong><br></strong></td>
    <td><strong><br></strong></td>
    <td colspan="3"  align="center"><strong> &nbsp; &nbsp;<br></strong></td>
  </tr>
  <tr align="center">
<td><strong>ຜູ້ກວດກາ<br>
  Check by </strong></td>
    <td><strong><br></strong></td>
    <td><strong><br></strong></td>
    <td colspan="3"  align="center"><strong> &nbsp; &nbsp;ຜູ້ລາຍງານ<br>
      Issue by:</strong></td>
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