<?php 
  include("init.php");
    
  $from_date = mysqli_real_escape_string($con,$_POST['from_date']);  
$to_date = mysqli_real_escape_string($con,$_POST['to_date']);
$customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
		   
           if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and (sale_date>='$from_date' and sale_date<='$to_date')
		  ";}
		  

if($customer_id==''){$c="";}
else{
	$c="and customer_id='$customer_id'";
}

//$c="and sale_id='21.000010'";

   @$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement
	          ");
		  
		  @$sp=mysqli_query($con,"
insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)
SELECT sale_id,sale_date, amount, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HD'  $btw $c order by sale_date
	          ");
  @$sp1=mysqli_query($con,"
insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)
SELECT sale_id,sale_date, amount, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HM' $btw $c order by sale_date
	          ");

 @$sp2=mysqli_query($con,"
insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP' $btw $c order by sale_date
	          ");


@$sp3=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP1' $btw $c order by sale_date");
@$sp4=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ' $btw $c order by sale_date");
@$sp5=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ1' $btw $c order by sale_date");
@$sp6=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HS' $btw $c order by sale_date");
@$sp7=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NC'$btw $c order by sale_date");
@$sp8=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NQ' $btw $c order by sale_date");
@$sp9=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP' $btw $c order by sale_date");
@$sp10=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP1' $btw $c order by sale_date");
@$sp11=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0 FROM `product_sale` WHERE product_id='RS' $btw $c order by sale_date");
@$sp12=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0 FROM `product_sale` WHERE product_id='TC' $btw $c order by sale_date");
@$sp13=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0 FROM `product_sale` WHERE product_id='TQ' $btw $c order by sale_date");
@$sp14=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2)SELECT sale_id,sale_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty FROM `product_sale` WHERE product_id='CO2' $btw $c order by sale_date");

	if($sp){
				$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
				 header("location:statement_1.php?customer_id=".$customer_id."&from_date=".$from_date."&to_date=".$to_date."");
				}
				else{
					$_SESSION['smg']="<div class='alert alert-danger'><strong>ບັນທືກບໍ່ສຳເລັດ!</strong></div>";
				 header("location:statement_1.php?customer_id=".$customer_id."&from_date=".$from_date."&to_date=".$to_date."");					
					}
	
 ?>
