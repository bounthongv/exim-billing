<?php 
include("init.php");
?>
<!DOCTYPE>


<?php
/*
$total_page_data = 0;  // เก็บจำนวนหน้า รายการทั้งหมด
$total_page_item = 30; // จำนวนรายการที่แสดงสูงสุดในแต่ละหน้า
$total_page_item_all = 0; // ไว้เก็บจำนวนรายการจริงทั้งหมด
$arr_data_set=array(array()); // [][];
$sql = "
SELECT * from tb_statement_customers
order by 
(tb_statement_customers.HD+
tb_statement_customers.HM+
tb_statement_customers.HP+
tb_statement_customers.HP1+
tb_statement_customers.HQ+
tb_statement_customers.HQ1+
tb_statement_customers.HS+
tb_statement_customers.NC+
tb_statement_customers.NQ+
tb_statement_customers.RP+
tb_statement_customers.RP1+
tb_statement_customers.RS+
tb_statement_customers.TC+
tb_statement_customers.TQ+
tb_statement_customers.CO2+
tb_statement_customers.RQ+
tb_statement_customers.RQ1)
desc
";
$i=1;
$result = $con->query($sql);
if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
    $total_page_item_all = $result->num_rows; // จำนวนรายการทั้งหมด
    $total_page_data = ceil($total_page_item_all/$total_page_item); // หาจำนวนหน้าจากรายการทั้งหมด
    while($row = $result->fetch_assoc()){ // วนลูปแสดงรายการ     
        $arr_data_set['inv_no'][$i]=$row['inv_no'];
       // $arr_data_set['province_name'][$i]=$row['province_name'];
        $i++;
    }   
}


?>

<?php for($i=1;$i<=$total_page_data;$i++){ */?>
<div class="page-break<?=($i==1)?"-no":""?>">&nbsp;</div>
 <td align="left"></td>
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


	
@media print {
    @page {
        	margin-top: 0;
		@bottom-left-corner{
		margin:0;	
			
	    }
    }
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
$year = mysqli_real_escape_string($con,$_GET['year']);	

$date=date_create_from_format("Y",$year);
$y=date_format($date,"y");
/*
$sql_h = mysqli_query($con," SELECT * FROM customers where customer_id='$customer_id'");
              $ff = mysqli_fetch_array($sql_h);



@$sql_select=mysqli_query($con,"SELECT * from tb_statement_customers");
	
    @$sql_query_all=mysqli_query($connect,$sql_select);
			  @$total_records=mysqli_num_rows($sql_query_all);

					@$p=mysqli_fetch_array($sql_query_all); 
						*/
					


?>
                        

<table width="700" border="0" align="center">
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
    
    
    
    
    <td colspan="2" valign="top" align="right">ບ້ານ ຫົວຂົວ, ເມືອງ ນາຊາຍທອງ,<br />
    ນະຄອນຫຼວງວຽງຈັນ<br />
     Tel: 55555764<br />
    Date <?php echo date("d-m-Y"); ?><br />

     </td>
  </tr>
  <tr>
  <td  >ຊື່ລູກຄ້າ: <?php echo $ff['customer_name']; ?> <br>ລະຫັດ: <?php echo $ff['customer_id']; ?><br> ທີ່ຢູ່ລູກຄ້າ: <?php echo $ff['address']; ?><br> ເບີໂທ: <?php echo $ff['phone']; ?></td>
  <td colspan="2" align="right" valign="top">
  <?php /*ສາງ: <?php echo $ff['User_Name']; ?> &nbsp;*/?>
  </td>
  </tr>
</table>

	<table width="700" align="center">
 <?php  /*
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
*/   ?>

<td align="center">
		ປີ : <? echo $year; ?>

			</td>	
	</table>

  <?php	
	  // ส่วนของ repeat content
    /*    for($v=1;$v<=$total_page_item;$v++){
            $item_i=(($i-1)*$total_page_item)+$v;
            $_province_name = isset($arr_data_set['inv_no'][$item_i])?$arr_data_set['inv_no'][$item_i]:"";
            $item_i = isset($arr_data_set['inv_no'][$item_i])?$item_i:"";*/
        ?>

<table width="1500" border="1" align="center">
 <thead>
 
  <tr align="center">
 	    <th align="center">.No</th>
<th align="center">Customers' Name</th>
<th align="center">Customers ID</th>
<th align="center">Sales Person</th>
<th align="center">Jan-<?php echo $y;?></th>
<th align="center">Feb-<?php echo $y;?></th>
<th align="center">Mar-<?php echo $y;?></th>
<th align="center">Apr-<?php echo $y;?></th>
<th align="center">May-<?php echo $y;?></th>
<th align="center">Jun-<?php echo $y;?></th>
<th align="center">Jul-<?php echo $y;?></th>
<th align="center">Aug-<?php echo $y;?></th>
<th align="center">Sep-<?php echo $y;?></th>
<th align="center">Oct-<?php echo $y;?></th>
<th align="center">Nov-<?php echo $y;?></th>
<th align="center">Dec-<?php echo $y;?></th>       
<th align="center">ລວມ</th>    
  </tr>
  </thead>
  
  
   <?php 
   	  @$sp=mysqli_query($con,"SELECT tb_statement_customers_month.*,
        IF(tb_statement_customers_month.Jan is null, '0', tb_statement_customers_month.Jan)+
        IF(tb_statement_customers_month.Feb is null, '0', tb_statement_customers_month.Feb)+
        IF(tb_statement_customers_month.Mar is null, '0', tb_statement_customers_month.Mar)+
        IF(tb_statement_customers_month.Apr is null, '0', tb_statement_customers_month.Apr)+
        IF(tb_statement_customers_month.May is null, '0', tb_statement_customers_month.May)+
        IF(tb_statement_customers_month.Jun is null, '0', tb_statement_customers_month.Jun)+
        IF(tb_statement_customers_month.Jul is null, '0', tb_statement_customers_month.Jul)+
        IF(tb_statement_customers_month.Aug is null, '0', tb_statement_customers_month.Aug)+
        IF(tb_statement_customers_month.Sep is null, '0', tb_statement_customers_month.Sep)+
        IF(tb_statement_customers_month.Oct is null, '0', tb_statement_customers_month.Oct)+
        IF(tb_statement_customers_month.Nov is null, '0', tb_statement_customers_month.Nov)+
        IF(tb_statement_customers_month.`Dec` is null, '0', tb_statement_customers_month.`Dec`) 

        as total_year
        from tb_statement_customers_month 
        order by 
/*
        (IF(tb_statement_customers_month.Jan is null, '0', tb_statement_customers_month.Jan)+
          IF(tb_statement_customers_month.Feb is null, '0', tb_statement_customers_month.Feb)+
          IF(tb_statement_customers_month.Mar is null, '0', tb_statement_customers_month.Mar)+
          IF(tb_statement_customers_month.Apr is null, '0', tb_statement_customers_month.Apr)+
          IF(tb_statement_customers_month.May is null, '0', tb_statement_customers_month.May)+
          IF(tb_statement_customers_month.Jun is null, '0', tb_statement_customers_month.Jun)+
          IF(tb_statement_customers_month.Jul is null, '0', tb_statement_customers_month.Jul)+
          IF(tb_statement_customers_month.Aug is null, '0', tb_statement_customers_month.Aug)+
          IF(tb_statement_customers_month.Sep is null, '0', tb_statement_customers_month.Sep)+
          IF(tb_statement_customers_month.Oct is null, '0', tb_statement_customers_month.Oct)+
          IF(tb_statement_customers_month.Nov is null, '0', tb_statement_customers_month.Nov)+
          IF(tb_statement_customers_month.`Dec` is null, '0', tb_statement_customers_month.`Dec`)
          )
        desc
*/
Customers_ID
asc
");
	
           $i=0;
	  
            while($s=mysqli_fetch_array($sp)){
            $i++;
			?>
            	<tr>
            <td><?php echo $i;?></td>	
             <td><?php 
             $customer_id_2=$s['Customers_ID'];
            $sp1="SELECT outlet_name FROM customer_import Where external_id='$customer_id_2' group by external_id";
            $sp_a=mysqli_query($con,$sp1);
            $s1=mysqli_fetch_array($sp_a);
            echo $s1['outlet_name'];
            ?></td>
<td><?php echo $s["Customers_ID"];?></td>
<td><?php echo $s["sr"];?></td>
<td><?php echo number_format($s["Jan"]);?></td>
<td><?php echo number_format($s["Feb"]);?></td>
<td><?php echo number_format($s["Mar"]);?></td>
<td><?php echo number_format($s["Apr"]);?></td>
<td><?php echo number_format($s["May"]);?></td>
<td><?php echo number_format($s["Jun"]);?></td>
<td><?php echo number_format($s["Jul"]);?></td>
<td><?php echo number_format($s["Aug"]);?></td>
<td><?php echo number_format($s["Sep"]);?></td>
<td><?php echo number_format($s["Oct"]);?></td>
<td><?php echo number_format($s["Nov"]);?></td>
<td><?php echo number_format($s["Dec"]);?></td>
<td align="right"><?php echo number_format($s["total_year"]);?></td>
	</tr>

<?php
 } 
 ?>
	

</tr>	

 
						
</table>
<br>
<table width="700" border="0" align="center">

<tr align="center">
<td><strong><br><u>Remark:</u></strong>ບໍ່ລວມເບຍແຖມ ແລະ ລັງເປົ່າ</td>
    <td><strong><br></strong></td>
    <td><strong><br></strong></td>
    <td colspan="3"  align="center"><strong> &nbsp; &nbsp;<br></strong></td>
  </tr>

  <tr align="center">
<td><strong>ຜູ້ຈ່າຍເງິນ<br>Payer</strong></td>
    <td><strong><br></strong></td>
    <td><strong><br></strong></td>
    <td colspan="3"  align="center"><strong> &nbsp; &nbsp;ຜູ້ຮິບເງິນ<br>Payee</strong></td>
  </tr>
</table>

</body>
</html>
<?php
						/*		 }*/
?>
<script>



printpage();
function printpage() {
window.print(); 

}
</script>