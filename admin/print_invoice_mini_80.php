<?php 
include("init.php");
?>
<!DOCTYPE html>
<html lang="en">
<title>EXIM</title>
<?php 
$sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);
$sql_h = mysqli_query($con," select * from product_sale where sale_id='$sale_id'");
              $ff = mysqli_fetch_array($sql_h);
?>
<head>

    <meta charset="utf-8">
   <!-- <meta http-equiv="refresh" content="2; url=add_sale_stock_mini.php">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
  <div id="invoice-POS">
    
  <!--  <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>EXIM</h2>
      </div>
     
    </center> -->  <!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2  onClick="goBack()">EXIM SOLE Co.,LTD</h2>
        <p> 
            Address :<font style="font-family:Saysettha OT, Phetsarath OT;"> ໂພນທັນ, ໄຊເສດຖາ</font></br>
            Email   : Sale@exim.la</br>
            Phone   : 020-5559 9682</br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="mid">
    Date: <?php echo $ff['sale_date']; ?>  Time:<?php echo $ff['sale_time']; ?><br>
    -------------------------------------------------
    </div>
    <div id="bot">

					<div id="table">
						<table>
							<tr class="tabletitle">
								<td class="item"><h2>Item</h2></td>
								<td class="Hours" align="center"><h2>Qty</h2></td>
								<td class="Rate" align="right"><h2>Amount</h2></td>
							</tr>
 <?php 

						
                       
                        $sql = mysqli_query($con,"
				 select product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount
				 ,products.Product_Name,customers.customer_name 
				 from product_sale 
         LEFT JOIN products ON products.Product_ID = product_sale.product_id 
         LEFT JOIN customers ON customers.customer_id = product_sale.customer_id 
         
		 where product_sale.sale_id='$sale_id'  group by product_sale.product_id ");
                        while($f = mysqli_fetch_array($sql)){
                       // $total = $f['qty_iv'] * $f['prices'];
                        @$amount = $amount + $f['amount'];
                        ?>
							<tr class="service">
								<td class="tableitem"><p class="itemtext"><?php echo $f["Product_Name"]; ?></p></td>
								<td class="tableitem" align="center"><p class="itemtext"><?php echo $f["qty"]; ?></p></td>
								<td class="tableitem" align="right"><p class="itemtext"><?php echo @number_format($f["amount"],0); ?></p></td>
							</tr>

					<?php } ?>

							<!--<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>tax</h2></td>
								<td class="payment"><h2>$419.25</h2></td>
							</tr>
-->
                       
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Total</h2></td>
								<td class="payment"><h2><?php echo @number_format($amount,0); ?></h2></td>
							</tr>

						</table>
					</div><!--End Table-->
 <div id="mid">
    -------------------------------------------------
    </div>
					<div id="legalcopy">
						<p class="legal"><strong><font style="font-family:Saysettha OT, Phetsarath OT;">ຂໍຂອບໃຈ</font></strong><font style="font-family:Saysettha OT, Phetsarath OT;">  ກະລຸນາກວດເບີ່ງສິນຄ້າຂອງທ່ານ</font>
						</p>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->
  <script src="jquery-3.1.1.min.js"></script>
<script>

function goBack() {
  window.history.back();
}

printpage();
function printpage() {
window.print(); 

}
</script>