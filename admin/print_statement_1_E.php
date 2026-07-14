<?php 
include("init.php");
?>
<!DOCTYPE>


<?php
$total_page_data = 0;  // เก็บจำนวนหน้า รายการทั้งหมด
$total_page_item = 30; // จำนวนรายการที่แสดงสูงสุดในแต่ละหน้า
$total_page_item_all = 0; // ไว้เก็บจำนวนรายการจริงทั้งหมด
$arr_data_set=array(array()); // [][];
$sql = "
SELECT * from tb_statement_E
	       order by inv_date, inv_no asc
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

<?php for($i=1;$i<=$total_page_data;$i++){ ?>
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
	
$sql_h = mysqli_query($con," SELECT * FROM customers where customer_id='$customer_id'");
              $ff = mysqli_fetch_array($sql_h);



@$sql_select=mysqli_query($con,"SELECT * from tb_statement_E");
	
    @$sql_query_all=mysqli_query($connect,$sql_select);
			  @$total_records=mysqli_num_rows($sql_query_all);

					@$p=mysqli_fetch_array($sql_query_all); 
						
					


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
<th align="center"  colspan="2">ຊື່ລູກຄ້າ</th>

<?php

$sql2 = mysqli_query($con,"SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = 'apis_exim_stock' 
        AND TABLE_NAME like 'tb_statement_E'
        and COLUMN_NAME!='customer_id' 
        and COLUMN_NAME!='inv_amt'
				and COLUMN_NAME!='inv_date' 
        and COLUMN_NAME!='inv_no'");  



        while($s=mysqli_fetch_array($sql2)){
?>

<th align="center"><?php echo $s['COLUMN_NAME']; ?></th>

<?php } ?>

<th align="center">Total</th>  

  </tr>
  </thead>
  
  
  
  
   <?php 
$stt=0;
        
    	  @$sp=mysqli_query($con,"SELECT tb_statement_E.*,customers.customer_name from tb_statement_E 
        left join customers on customers.customer_id=tb_statement_E.customer_id
        order by tb_statement_E.inv_date, tb_statement_E.inv_no asc
          ");
	
           $i=0;
								  $p=0;
	  
            while($s=mysqli_fetch_array($sp)){
            $i++;
		
	
                        ?>
         
  <tr>
     <td><?php echo $i;?></td>
<td><?php echo $s["inv_no"];?></td>
<td><?php  $date=date_create($s["inv_date"]); echo date_format($date,"d/m/Y");?></td>
<td><?php if($s["inv_amt"]=='0'){echo "-";}else{echo number_format($s["inv_amt"]);};?></td>
<td><?php echo $s["customer_id"];?></td>
<td><?php echo $s["customer_name"];?></td>
<td><?php if($s["EHD"]==0){echo "-";}else{echo $s["EHD"];};?></td>
<td><?php if($s["EHP"]==0){echo "-";}else{echo $s["EHP"];};?></td>
<td><?php if($s["EHP1"]==0){echo "-";}else{echo $s["EHP1"];};?></td>
<td><?php if($s["EHP2"]==0){echo "-";}else{echo $s["EHP2"];};?></td>
<td><?php if($s["EHQ"]==0){echo "-";}else{echo $s["EHQ"];};?></td>
<td><?php if($s["EHQ1"]==0){echo "-";}else{echo $s["EHQ1"];};?></td>
<td><?php if($s["EHQ2"]==0){echo "-";}else{echo $s["EHQ2"];};?></td>
<td><?php if($s["ENQ"]==0){echo "-";}else{echo $s["ENQ"];};?></td>
<td><?php if($s["ENQ1"]==0){echo "-";}else{echo $s["ENQ1"];};?></td>
<td><?php if($s["ENQ2"]==0){echo "-";}else{echo $s["ENQ2"];};?></td>
<td><?php if($s["ERP"]==0){echo "-";}else{echo $s["ERP"];};?></td>
<td><?php if($s["ERP1"]==0){echo "-";}else{echo $s["ERP1"];};?></td>
<td><?php if($s["ERQ"]==0){echo "-";}else{echo $s["ERQ"];};?></td>
<td><?php if($s["ERQ1"]==0){echo "-";}else{echo $s["ERQ1"];};?></td>
<td><?php if($s["ETQ"]==0){echo "-";}else{echo $s["ETQ"];};?></td>
<td><?php if($s["ETQ1"]==0){echo "-";}else{echo $s["ETQ1"];};?></td>
<td><?php if($s["ETQ2"]==0){echo "-";}else{echo $s["ETQ2"];};?></td>
<?php
$sum=
$s["EHD"]+
$s["EHP"]+
$s["EHP1"]+
$s["EHP2"]+
$s["EHQ"]+
$s["EHQ1"]+
$s["EHQ2"]+
$s["ENQ"]+
$s["ENQ1"]+
$s["ENQ2"]+
$s["ERP"]+
$s["ERP1"]+
$s["ERQ"]+
$s["ERQ1"]+
$s["ETQ"]+
$s["ETQ1"]+
$s["ETQ2"];
?>
<td><?php if($sum=='0'){echo "-";}else{echo @number_format($sum);} ?></td>
<?php	/*<td><?php echo $stt.' '.$p; ?></td>*/ ?>
	  
	  
	</tr>
	
	<?php 
	@$t_inv_amt+=$s["inv_amt"];	  
    @$t_EHD+=$s["EHD"];
    @$t_EHP+=$s["EHP"];
    @$t_EHP1+=$s["EHP1"];
    @$t_EHP2+=$s["EHP2"];
    @$t_EHQ+=$s["EHQ"];
    @$t_EHQ1+=$s["EHQ1"];
    @$t_EHQ2+=$s["EHQ2"];
    @$t_ENQ+=$s["ENQ"];
    @$t_ENQ1+=$s["ENQ1"];
    @$t_ENQ2+=$s["ENQ2"];
    @$t_ERP+=$s["ERP"];
    @$t_ERP1+=$s["ERP1"];
    @$t_ERQ+=$s["ERQ"];
    @$t_ERQ1+=$s["ERQ1"];
    @$t_ETQ+=$s["ETQ"];
    @$t_ETQ1+=$s["ETQ1"];
    @$t_ETQ2+=$s["ETQ2"];

@$T_sum_all=
@$t_EHD+
@$t_EHP+
@$t_EHP1+
@$t_EHP2+
@$t_EHQ+
@$t_EHQ1+
@$t_EHQ2+
@$t_ENQ+
@$t_ENQ1+
@$t_ENQ2+
@$t_ERP+
@$t_ERP1+
@$t_ERQ+
@$t_ERQ1+
@$t_ETQ+
@$t_ETQ1+
@$t_ETQ2;
  /*
		 if($i==13)  {
			 $stt=0; 
			 ?>
				<tr style="border-color:white" ><td  align="center"  colspan="19">1</td></tr>
			 <?php 
		 }
	
	  if($i>12)
			  {
			  $stt++;
			  if($stt==24){
				  $p++;
				$stt=0;  
				  ?>
	<tr style="border-color:white" ><td  align="center"  colspan="19"><?php echo $p+1; ?></td></tr>
				 <?php 
				    
			  }
			  }	
			 */ 
			  
			  
		} 

	?>
	

<tr style="background-color:#99ff99;">	
<td colspan="3" align="center"><strong>ລວມ</strong></td>
<td colspan="1"><?php if($t_inv_amt=='0'){echo "-";}else{echo @number_format($t_inv_amt);}?></td>
<td colspan="1">&nbsp;</td>
<td colspan="1"><?php if($t_EHD==0){echo "-";}else{echo @number_format($t_EHD);}?></td>
<td colspan="1"><?php if($t_EHP==0){echo "-";}else{echo @number_format($t_EHP);}?></td>
<td colspan="1"><?php if($t_EHP1==0){echo "-";}else{echo @number_format($t_EHP1);}?></td>
<td colspan="1"><?php if($t_EHP2==0){echo "-";}else{echo @number_format($t_EHP2);}?></td>
<td colspan="1"><?php if($t_EHQ==0){echo "-";}else{echo @number_format($t_EHQ);}?></td>
<td colspan="1"><?php if($t_EHQ1==0){echo "-";}else{echo @number_format($t_EHQ1);}?></td>
<td colspan="1"><?php if($t_EHQ2==0){echo "-";}else{echo @number_format($t_EHQ2);}?></td>
<td colspan="1"><?php if($t_ENQ==0){echo "-";}else{echo @number_format($t_ENQ);}?></td>
<td colspan="1"><?php if($t_ENQ1==0){echo "-";}else{echo @number_format($t_ENQ1);}?></td>
<td colspan="1"><?php if($t_ENQ2==0){echo "-";}else{echo @number_format($t_ENQ2);}?></td>
<td colspan="1"><?php if($t_ERP==0){echo "-";}else{echo @number_format($t_ERP);}?></td>
<td colspan="1"><?php if($t_ERP1==0){echo "-";}else{echo @number_format($t_ERP1);}?></td>
<td colspan="1"><?php if($t_ERQ==0){echo "-";}else{echo @number_format($t_ERQ);}?></td>
<td colspan="1"><?php if($t_ERQ1==0){echo "-";}else{echo @number_format($t_ERQ1);}?></td>
<td colspan="1"><?php if($t_ETQ==0){echo "-";}else{echo @number_format($t_ETQ);}?></td>
<td colspan="1"><?php if($t_ETQ1==0){echo "-";}else{echo @number_format($t_ETQ1);}?></td>
<td colspan="1"><?php if($t_ETQ2==0){echo "-";}else{echo @number_format($t_ETQ2);}?></td>

<td colspan="1"><?php if($T_sum_all=='0'){echo "-";}else{echo @number_format($T_sum_all);}?></td>
</tr>	

  
        <?php /*} */
	/*
	if($stt<23){
		$p=$p+1;
		
	}else{
		$p=$p+1;
	}
							  
	?>		
        <tr style="border-color:white" ><td align="center"  colspan="19"><?php echo $p+1; ?></td></tr>
   
*/ ?>
						
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
								 }
?>
<script>



printpage();
function printpage() {
window.print(); 

}
</script>