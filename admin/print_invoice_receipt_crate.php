<?php 
include("init.php");
?>
<!DOCTYPE html>
<html lang="en">
<title>EXIM</title>
<?php 
$receipt_id=mysqli_real_escape_string($con,$_GET['receipt_id']);
$sql_h = mysqli_query($con," select product_receipt_crate.*,sum(product_receipt_crate.qty) as qty,sum(product_receipt_crate.amount) as amount
				 ,products.Product_Name,customers.customer_name ,stocks.stock_name
				 from product_receipt_crate 
         LEFT JOIN products ON products.Product_ID = product_receipt_crate.product_id 
         LEFT JOIN customers ON customers.customer_id = product_receipt_crate.customer_id
		  LEFT JOIN stocks ON product_receipt_crate.stock_id = stocks.stock_id 
         
		 where product_receipt_crate.receipt_id='$receipt_id'  group by product_receipt_crate.product_id");
              $ff = mysqli_fetch_array($sql_h);
			  $date_x=$ff['receipt_date'];
			  
			   $stock_name=$ff['stock_name'];
			   
			  /* $date_add=date_create($date_x);
              date_add($date_add,date_interval_create_from_date_string("7 days"));
          $next_date=date_format($date_add,"d/m/Y");
*/

			  
			  $date=date_create($date_x);
 $receipt_date=date_format($date,"d/m/Y");
?>
  <script src="jquery-3.1.1.min.js"></script>
  <style>
  @media{
  body{ font-size:10px;}
  }
  a {
   color: black;
   text-decoration: none;
  }
  </style>
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="2; url=add_receipt_crate.php">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
  <div id="invoice-POS">
    <div id="mid">
      <div class="info">      
       
      <h2> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<font style="font-family:Saysettha OT, Phetsarath OT;">ບິນຊື້ຄືນລັງເປົ່າ </h2>
        <p> EXIM <br>
            Address :<font style="font-family:Saysettha OT, Phetsarath OT;"> ໂພນທັນ, ໄຊເສດຖາ</font></br>
            Email   : nome@exim.la</br>
            Phone   : 020-5222 1074</br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="mid">
   <strong><font style="font-family:Saysettha OT, Phetsarath OT;"> <?php echo $ff['customer_name']; ?></font></strong><br>
  <font style="font-family:Saysettha OT, Phetsarath OT;"> ເລກທິ</font>: <?php echo $ff['receipt_id']; ?>  &nbsp;Date: <?php echo $receipt_date; ?> <?php echo $ff['sale_time']; ?><br>
   ---------------------------------------------------------------
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
				 select product_receipt_crate.*,sum(product_receipt_crate.qty) as qty,sum(product_receipt_crate.amount) as amount
				 ,products.Product_Name,customers.customer_name ,products.Product_Name
				 from product_receipt_crate 
         LEFT JOIN products ON products.Product_ID = product_receipt_crate.product_id 
         LEFT JOIN customers ON customers.customer_id = product_receipt_crate.customer_id 
         
		 where product_receipt_crate.receipt_id='$receipt_id'  group by product_receipt_crate.product_id ");
                        while($f = mysqli_fetch_array($sql)){
                       // $total = $f['qty_iv'] * $f['prices'];
                        @$amount = $amount + $f['amount'];
						@$total_last_amount += $f['last_amount'];
                        ?>
							<tr class="service">
								<td class="tableitem"><p class="itemtext"><?php echo $f["Product_Name"]; ?></p>
                                
                                </td>
								<td class="tableitem" align="center"><p class="itemtext"><?php echo $f["qty"]; ?>x<?php echo @number_format($f["price"],0); ?></p></td>
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
								
								<td class="Rate"><h2>Total</h2></td>
                                <td></td>
								<td class="payment"><h2><?php echo @number_format($amount,0); ?></h2></td>
							</tr>
                            <tr>
           <td colspan="3"><p>
           <br>
           ++++++++++++++++++++++++++++++++++++</p>
           
           </td>
                            </tr>

						</table>
					</div><!--End Table-->
<div id="mid">

  
				<div >

    

   <br>
   <br>
   <br> 
    <br> 
    <p > ---------------------------------------------------------------<br>
  &nbsp;&nbsp;&nbsp;&nbsp;<font style="font-family:Saysettha OT, Phetsarath OT;">ລາຍເຊັນຜູ້ຊື້  &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $stock_name; ?></font> </p>
  
   <br>
   <br>
   <br>
   <br> 
   <p >  
    ---------------------------------------------------------------<br>
   &nbsp;&nbsp;&nbsp;&nbsp; <font style="font-family:Saysettha OT, Phetsarath OT;">ລາຍເຊັນຜູ້ຂາຍ </font></p>
					</div>

				</div>
  </div><!--End Invoice-->

<script>

function goBack() {
  window.history.back();
}

printpage();
function printpage() {
window.print(); 

}
</script>