<?php 
include("init.php");
?>
<!DOCTYPE html>
<html lang="en">
<title>Print</title>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<style type="text/css">
.ffe {
	font-family: "Times New Roman", Times, serif;
}
</style>
</head>
<style>
body{ font-family:"Phetsarath OT";  }
td{ padding:5px;}
a,a:link,a:hover { text-decoration:none; color:
#000;}
.ff{ font-family:"Times New Roman", Times, serif}
.print_size{ width:3in; alignment-adjust:central}
tr.border_top td{
  border-top:1pt solid black;

}

.noBorder {
	border-bottom:hidden;
}
 tr.hide_button > td, td.hide_button{
        border-style:hidden;
		border-right-style:groove;
		border-left-style:double;
		
      }
.time_n{ font-family:"Times New Roman", Times, serif;}
</style>
<?php
foreach ($_GET as $key => $value) {
  $_GET[$key]=addslashes(strip_tags(trim($value)));
}

if ($_GET['sale_id'] !='') {
	   $s_id=(string) $_GET['sale_id']; 
	    }
	   
extract($_GET); 


 $sql_d = mysqli_query($con,"
				 select quotations.*,sum(quotations.qty) as qty,sum(quotations.amount) as amount,products.Product_Name,customers.customer_name ,customers.phone
				 from quotations 
LEFT JOIN products ON products.Product_ID = quotations.product_id 

LEFT JOIN customers ON customers.customer_id = quotations.customer_id 
where quotations.sale_id='$sale_id'  group by quotations.product_id ");

 $ff = mysqli_fetch_array($sql_d);
?>

<body onLoad="print()">

     <?php  $sql_office = mysqli_query($con," select * from office order by Id desc limit 1");  
	 $r=mysqli_fetch_array($sql_office);
	 ?>   
        
<table width="720" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td scope="col" width="240" ><p align="left"><img src="<?php echo $r['path'];?>" class="img-rounded" alt="Cinque Terre" width="80" height="50">
    <br>
   <?php echo $r['office_name'];?>
   <br>
   <br>
    </p></td>
    <td scope="col" width="240" align="center"><h2 align="center">ໃບສະເໜີລາຄາ <br >
    <b>Quotation</b><br>
      &nbsp;
    </h2></td>
    <td width="240" align="center" scope="col" >ເລກທີບິນ: <b class="time_n"><?php echo $ff['sale_id'];?></b>
    
        <br>ວັນທີ:<?php $date=date_create($ff['sale_date']);
              echo date_format($date,"d/m/Y");   ?>
   </td>
  </tr>
  
</table>

<table width="720" align="center" border="1" cellspacing="0" cellpadding="0" >
  <tr valign="top">
    <td colspan="3" scope="col">
      ລະຫັດລູກຄ້າ:<b class="time_n"><?php echo $ff['customer_id'];?></b>
     <br>ຊື່ລູກຄ້າ: <?php echo $ff['customer_name'];?>
     <br>ໂທ:<?php echo $ff['phone'];?>
     </td>
    
    
    <td colspan="4" scope="col">
    ເງື່ອນໄຂການຊຳລະ: Cash
     <br>ເລກທີອ້າງອີງ: <?php echo $ff['refer_no'];?>
     <br>ພະນັກງານ: <?php echo $ff['phone'];?>
     </td>
  </tr>
 

                        
                       
                        
                       
                        <tr >
                                                     
                                <td  align="center"><strong>ລ/ດ <br>No.</strong></td>                             
                                <td  align="center"><strong>ລາຍການ <br> Description</strong></td>
                                <td  align="center"><strong>ຈຳນວນ <br> Qty</strong></td>
                                <td  align="center"><strong>ຫ/ໜ <br> Unit</strong></td>
                                <td  align="center"><strong>ລາຄາ <br> Price</strong></td>
                                <td  align="center"><strong>%ສຫຼ <br> Dis</strong></td>
                                <td  align="center"><strong>ເປັນເງີນ <br>Amount</strong></td>
                                
                            
                        </tr>
                       
                        
                        
                        <?php 
						
						
						
                       
						$sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);
                        
                        $sql = mysqli_query($con,"
				 select quotations.*,sum(quotations.qty) as qty,sum(quotations.amount) as amount,products.Product_Name,customers.customer_name,products.Unit 
				 from quotations 
LEFT JOIN products ON products.Product_ID = quotations.product_id 
LEFT JOIN customers ON customers.customer_id = quotations.customer_id 
where quotations.sale_id='$sale_id'  group by quotations.product_id ");
                       $i=1;
					   
			$count_row=mysqli_num_rows($sql);
                while($f = mysqli_fetch_array($sql)){        ?>
                        
                        <tr class="hide_button">
                     <?php       
                       // $total = $f['qty_iv'] * $f['prices'];
                        @$t_amount = $t_amount + $f['amount']; ?>
                        <td valign="top" align="center"><?php echo $i;?></td> 
                          <td valign="top" align="left"><?php echo $f['Product_Name'];?></td>
                                                
                       
                            <td align="center" valign="top"><?php echo $f['qty'];?></td>
                             <td align="center" valign="top"><?php echo $f['Unit'];?></td>
                                <td valign="top" align="center"><?php echo $f['price'];?></td>                     
                       
                            <td align="center" valign="top"><?php echo @number_format($f['discount'],2);?></td>
                             <td align="center" valign="top"><?php echo @number_format($f['amount'],2);?></td>
                           
             

                        </tr>
                       
                       <?php
						$customer_name=$f['customer_name'];
						$i++;
						 }
                        ?>
     					
   <!-- <tr class="noBorder">
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
     <tr class="noBorder">
     <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>-->
   <?php 
   $max=8;
   $count_row;
   $row_avirable=$max-$count_row;
   
   for ($x = 0; $x <= $row_avirable; $x++) {
   
   ?>
   <tr  class="hide_button">
   	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   
   <?php } ?>
   <tr>

     <td rowspan="3" colspan="6" valign="top" align="right">
     	
         <table width="100%">
         <tr><td align="right">Sub Total:</td></tr>
         <tr><td align="right">Less Cash Disc:</td></tr>
         <tr><td align="right">Sub Total:</td></tr>
         </table>
     </td>
     <td align="right"><?php echo @number_format($t_amount,2);?></td>
   </tr>
   <tr>
     <td align="right"> &nbsp; <?php echo @number_format($ff['bill_discount'],2);?></td>
   </tr>
   <tr>
     <td align="right"><?php echo @number_format($ff['total'],2);?></td>
   </tr>
  
   
   
   
   

</table>
<table width="720" align="center"> 
<tr>
	<td align="center" colspan="7">&nbsp;</td>
    <td  align="center"><strong>ລາຍເຊັນ:</strong></td>
</tr>
</table>
 
 
</body>

</html>




