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


   
      tr.hide_right > td, td.hide_right{
        border-right-style:hidden;
      }
      tr.hide_all > td, td.hide_all{
        border-style:hidden;
      }
	  tr.hide_button > td, td.hide_button{
        border-style:hidden;
		border-right-style:groove;
		border-left-style:double;
		
      }

</style>
<?php
foreach ($_GET as $key => $value) {
  $_GET[$key]=addslashes(strip_tags(trim($value)));
}

if ($_GET['sale_id'] !='') {
	   $s_id=(string) $_GET['sale_id']; 
	    }
	   
extract($_GET); 


?>

<body onLoad="print()">
<div >

     <?php  $sql_office = mysqli_query($con," select * from office order by Id desc limit 1");  
	 $r=mysqli_fetch_array($sql_office);
	 ?>      
        
<table width="720" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <th scope="col" width="240" ><p align="left"><img src="<?php echo $r['path'] ?>" class="img-rounded" alt="Cinque Terre" width="80" height="50">
    <br>
    <?php echo $r['office_name'] ?>
   <br>
   <br>
    </p></th>
    <th scope="col" width="240" align="center"><h2 align="center">ໃບເກັບເງີນ <br>RECEIPT
      <br>&nbsp;
      <br> &nbsp;
    </h2></th>
    <th scope="col" width="240" >ເລກທີບິນ: 
        <br>Bill No:
        <br>ວັນທີ:
      <br>Date:</th>
  </tr>
  
</table>

<table width="720" align="center" border="1" cellspacing="0" cellpadding="0">
  <tr valign="top">
    <td colspan="3" scope="col">
      ລະຫັດລູກຄ້າ:
     <br>ຊື່ລູກຄ້າ:
     <br>ໂທ:021 3333 44444
     </td>
    
    
    <td colspan="4" scope="col">
    ເງື່ອນໄຂການຊຳລະ: Cash
     <br>ເລກທີອ້າງອີງ: 
     <br>ພະນັກງານ: 
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
						
						
						
                        include("../dblink.php");
						$sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);
                        
                        $sql = mysqli_query($con,"
				 select product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,products.Product_Name,customers.customer_name 
				 from product_sale 
LEFT JOIN products ON products.Product_ID = product_sale.product_id 
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id 
where product_sale.sale_id='$sale_id'  group by product_sale.product_id ");
                       
                while($f = mysqli_fetch_array($sql)){        ?>
                        
                        <tr class="hide_button">
                     <?php       
                       // $total = $f['qty_iv'] * $f['prices'];
                        @$amount = $amount + $f['amount']; ?>
                          <td valign="top" align="left"><?php echo $f['Product_Name'];?></td>
                            <td valign="top" align="center"><?php echo $f['qty'];?></td>                     
                       
                            <td align="center" valign="top"><?php echo @number_format($f['price'],2);?></td>
                             <td align="center" valign="top"><?php echo @number_format($f['amount'],2);?></td>
                                <td valign="top" align="center"><?php echo $f['qty'];?></td>                     
                       
                            <td align="center" valign="top"><?php echo @number_format($f['price'],2);?></td>
                             <td align="center" valign="top"><?php echo @number_format($f['amount'],2);?></td>
                           
             

                        </tr>
                       
                       <?php
						$customer_name=$f['customer_name'];
						 }
                        ?>
     					
    <tr class="hide_button">
    <td >&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
     <tr class="hide_button">
     <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
   
   
   
                        <tr >
                            <th align="right" colspan="3">ລວມ &nbsp; &nbsp; : &nbsp; &nbsp;</th>
                            <th align="center">B<?php echo @number_format($amount,2); ?></th>
                        </tr>
                         <tr >
                            <th align="center" colspan="2"><?php echo $_SESSION['fname']; ?></th>
                            <th align="center" colspan="2"><?php echo $customer_name; ?></th>
                        </tr>
                        </table>
  
 
 
</div>
</body>

</html>

