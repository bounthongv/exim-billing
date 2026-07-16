<?php 
  include("init.php");
    
  $from_date = mysqli_real_escape_string($con,$_POST['from_date']);  
$to_date = mysqli_real_escape_string($con,$_POST['to_date']);
$receipt_id = mysqli_real_escape_string($con,$_POST['receipt_id']);
$Detailed = mysqli_real_escape_string($con,$_POST['Detailed']);

		   
           if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and (receipt_date>='$from_date' and receipt_date<='$to_date')
		  ";}
		  

if($receipt_id==''){$c="";}
else{
	$c="and receipt_id='$receipt_id'";
}

if($Detailed=='ລະອຽດ'){
/*
   @$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement
	          ");
		  
		  @$sp=mysqli_query($con,"
insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)
SELECT receipt_id,receipt_date, amount, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HD'  $btw $c and amount!='0' order by receipt_date
	          ");
  @$sp1=mysqli_query($con,"
insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)
SELECT receipt_id,receipt_date, amount, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HM' $btw $c and amount!='0' order by receipt_date
	          ");

 @$sp2=mysqli_query($con,"
insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HP' $btw $c and amount!='0' order by receipt_date
	          ");


@$sp3=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HP1' $btw $c and amount!='0' order by receipt_date");
@$sp4=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HQ' $btw $c and amount!='0' order by receipt_date");
@$sp5=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HQ1' $btw $c and amount!='0' order by receipt_date");
@$sp6=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HS' $btw $c and amount!='0' order by receipt_date");
@$sp7=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='NC'$btw $c and amount!='0' order by receipt_date");
@$sp8=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='NQ' $btw $c and amount!='0' order by receipt_date");
@$sp9=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='RP' $btw $c and amount!='0' order by receipt_date");
@$sp10=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='RP1' $btw $c and amount!='0' order by receipt_date");
@$sp11=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0 FROM `product_receipt` WHERE product_id='RS' $btw $c and amount!='0' order by receipt_date");
@$sp12=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0 FROM `product_receipt` WHERE product_id='TC' $btw $c and amount!='0' order by receipt_date");
@$sp13=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0 FROM `product_receipt` WHERE product_id='TQ' $btw $c and amount!='0' order by receipt_date");
@$sp14=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty FROM `product_receipt` WHERE product_id='HC' $btw $c and amount!='0' order by receipt_date");


*/






// 1. ล้างตารางสรุปข้อมูลเดิม
@$sp0 = mysqli_query($con, "TRUNCATE TABLE tb_statement");

// 2. ยุบคิวรีเหลือชุดเดียว ดึงข้อมูลและแยกคอลัมน์สินค้าให้ครบในรอบเดียว
@$sp = mysqli_query($con, "INSERT INTO tb_statement (
        inv_no, inv_date, inv_amt, 
        `10031707`, `10031707D`, `10031708`, `10031708D`, `10031709`, `10031709D`, 
        `10031710`, `10031710D`, `10126756`, `10128824`, `10128824D`, `10135854`, 
        `10031711`, `10031711D`, `10031712`, `10031713`, `10031713D`, `10031777`, `10031777D`
    )
    SELECT 
        receipt_id, 
        receipt_date, 
        amount,
        IF(product_id = '10031707', qty, 0),
        IF(product_id = '10031707D', qty, 0),
        IF(product_id = '10031708', qty, 0),
        IF(product_id = '10031708D', qty, 0),
        IF(product_id = '10031709', qty, 0),
        IF(product_id = '10031709D', qty, 0),
        IF(product_id = '10031710', qty, 0),
        IF(product_id = '10031710D', qty, 0),
        IF(product_id = '10126756', qty, 0),
        IF(product_id = '10128824', qty, 0),
        IF(product_id = '10128824D', qty, 0),
        IF(product_id = '10135854', qty, 0),
        IF(product_id = '10031711', qty, 0),
        IF(product_id = '10031711D', qty, 0),
        IF(product_id = '10031712', qty, 0),
        IF(product_id = '10031713', qty, 0),
        IF(product_id = '10031713D', qty, 0),
        IF(product_id = '10031777', qty, 0),
        IF(product_id = '10031777D', qty, 0)
    FROM `product_receipt` 
    WHERE product_id IN (
        '10031707', '10031707D', '10031708', '10031708D', '10031709', '10031709D', 
        '10031710', '10031710D', '10126756', '10128824', '10128824D', '10135854', 
        '10031711', '10031711D', '10031712', '10031713', '10031713D', '10031777', '10031777D'
    ) 
    $btw $c 
    AND amount != '0' 
    ORDER BY receipt_date
");





}elseif($Detailed=='ສັງລວມ'){
	
	/*
	 @$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement
	          ");
	
	
	   @$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement
	          ");
		  
		  @$sp=mysqli_query($con,"
insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)
SELECT receipt_id,receipt_date, amount, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HD'  $btw $c and amount!='0' order by receipt_date
	          ");
  @$sp1=mysqli_query($con,"
insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)
SELECT receipt_id,receipt_date, amount, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HM' $btw $c and amount!='0' order by receipt_date
	          ");

 @$sp2=mysqli_query($con,"
insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HP' $btw $c and amount!='0' order by receipt_date
	          ");


@$sp3=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HP1' $btw $c and amount!='0' order by receipt_date");
@$sp4=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HQ' $btw $c and amount!='0' order by receipt_date");
@$sp5=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HQ1' $btw $c and amount!='0' order by receipt_date");
@$sp6=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='HS' $btw $c and amount!='0' order by receipt_date");
@$sp7=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='NC'$btw $c and amount!='0' order by receipt_date");
@$sp8=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='NQ' $btw $c and amount!='0' order by receipt_date");
@$sp9=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='RP' $btw $c and amount!='0' order by receipt_date");
@$sp10=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0 FROM `product_receipt` WHERE product_id='RP1' $btw $c and amount!='0' order by receipt_date");
@$sp11=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0 FROM `product_receipt` WHERE product_id='RS' $btw $c and amount!='0' order by receipt_date");
@$sp12=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0 FROM `product_receipt` WHERE product_id='TC' $btw $c and amount!='0' order by receipt_date");
@$sp13=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0 FROM `product_receipt` WHERE product_id='TQ' $btw $c and amount!='0' order by receipt_date");
@$sp14=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT receipt_id,receipt_date, amount, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty FROM `product_receipt` WHERE product_id='HC' $btw $c and amount!='0' order by receipt_date");	
	
	
	
	
	
	
	
@$sp15=mysqli_query($con,"insert into tb_statement_help(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT inv_no,inv_date,sum(inv_amt),sum(HD), sum(HM), sum(HP), sum(HP1), sum(HQ), sum(HQ1), sum(HS), sum(NC), sum(NQ), sum(RP), sum(RP1), sum(RS), sum(TC), sum(TQ), sum(HC) from tb_statement group by inv_no");
	
 @$sp15_1=mysqli_query($con,"
TRUNCATE TABLE tb_statement
	          ");
	
@$sp15_2=mysqli_query($con,"insert into tb_statement(inv_no, inv_date, inv_amt, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC)SELECT inv_no,inv_date,inv_amt,HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC from tb_statement_help group by inv_no");	
	
@$sp15_3=mysqli_query($con,"TRUNCATE TABLE tb_statement_help");	
*/



}
	
	if($sp){
				$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
				 header("location:statement_2.php?receipt_id=".$receipt_id."&from_date=".$from_date."&to_date=".$to_date."&Detailed=".$Detailed."");
				}
				else{
					$_SESSION['smg']="<div class='alert alert-danger'><strong>ບັນທືກບໍ່ສຳເລັດ!</strong></div>";
				 header("location:statement_2.php?receipt_id=".$receipt_id."&from_date=".$from_date."&to_date=".$to_date."&Detailed=".$Detailed."");					
					}
	
 ?>
