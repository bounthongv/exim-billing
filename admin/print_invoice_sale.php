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
    <meta http-equiv="refresh" content="5; url=add_sale_stock_mini.php">
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
.print_size{ width:4in; alignment-adjust:central}
tr.border_top td{
  border-top:1pt solid black;

}
tr.bottom-border {
  border-bottom: 1px solid #222;
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


	$sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);
                        
                        $sql_d= mysqli_query($con,"
				 select product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,products.Product_Name,customers.customer_name 
				 from product_sale 
LEFT JOIN products ON products.Product_ID = product_sale.product_id 
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id 
where product_sale.sale_id='$sale_id'  group by product_sale.product_id ");
$ff = mysqli_fetch_array($sql_d);

?>

<body onLoad="print()">

<!--<body onload="window.print()" onfocus="window.close()">-->
       <!-- <h3 align="center">ໃບເກັບເງີນ</h3>-->
        <p align="center"><a href="add_sale_stock_mini">ບໍລິສັດ ສີເພັດດາ ການຄ້າ ຂາອອກ-ເຂົ້າ</a></p>
       
<p align="center">  ວັນທີ :<span class="ffe"> <?php $dd=date_create(mysqli_real_escape_string($con,$_GET['sale_date'])); echo   date_format($dd,"d-m-Y");?><?php echo $_GET['sale_time'];?> &nbsp;&nbsp;&nbsp;&nbsp;</span>ໂທ: <span class="ffe">02059000070 &nbsp;&nbsp;&nbsp;&nbsp;</span><br> ເລກທີ : <span class="ffe"> <?php echo $s_id; ?></span> &nbsp;&nbsp;&nbsp;&nbsp;    </span>       
       </p>   
     <p align="center"><span >ພະນັກງານ: <?php echo $_SESSION['fname']; ?></span> 
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <span >ລູກຄ້າ: <?php echo $ff['customer_name']; ?></span></p>
            <table class="col-md-12 table-bordered print_size"  border="0" cellpadding="0" cellspacing="0" align="center">
                        
                       
                        
                        <thead>
                        <tr class="border_top">
                                                     
                                                               
                                <td width="43%" align="left">ຊື່ສິນຄ້າ</td>
                                <td width="24%" align="center">ຈຳນວນ</td>
                                <td width="13%" align="center">ລາຄາ</td>
                                <td width="20%" align="center">ເປັນເງີນ</td>
                                
                            
                        </tr>
                        </thead>
                        
                        
                        <?php 

						$sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);
                        
                        $sql = mysqli_query($con,"
				 select product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,products.Product_Name,customers.customer_name 
				 from product_sale 
LEFT JOIN products ON products.Product_ID = product_sale.product_id 
LEFT JOIN customers ON customers.customer_id = product_sale.customer_id 
where product_sale.sale_id='$sale_id'  group by product_sale.product_id ");
                        while($f = mysqli_fetch_array($sql)){
                       // $total = $f['qty_iv'] * $f['prices'];
                        @$amount = $amount + $f['amount'];
                        ?>
                        
                        <tr >
                           
                          <td valign="top" align="left"><?php echo $f['Product_Name'];?></td>
                            <td valign="top" align="center"><?php echo $f['qty'];?></td>                     
                       
                            <td align="center" valign="top"><?php echo @number_format($f['price'],2);?></td>
                             <td align="center" valign="top"><?php echo @number_format($f['amount'],2);?></td>
                            
                        </tr>
                       
                     
                        <?php
						@$customer_name=$f['customer_name'];
						 }
                        ?>
   
                        <tr >
                            <th align="right" colspan="3">ລວມ &nbsp; &nbsp; : &nbsp; &nbsp;</th>
                            <th align="center">B<?php echo @number_format($amount,2); ?>&nbsp; </th>
                        </tr>
                        
                        </table>
  
 
 
</div>
</body>

</html>




