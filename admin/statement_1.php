<?php 
  include("init.php");



    
$from_date = mysqli_real_escape_string($con,$_POST['from_date']);  
$to_date = mysqli_real_escape_string($con,$_POST['to_date']);
$customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
$Detailed = mysqli_real_escape_string($con,$_POST['Detailed']);

$now=date("Y-m-d");


$from_date=$now;
$to_date=$now;
$customer_id='';
$Detailed='ລະອຽດ';
		  


if($from_date=='' or $to_date==''){$btw="";} 
else{ $btw="and (sale_date>='$from_date' and sale_date<='$to_date')";}
	

/*
 if($from_date=='' or $to_date==''){$btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' )='$to_date'";} 
		  else{ $btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) between '$from_date' and '$to_date'";}
*/




if($customer_id==''){$c="";}
else{
	$c="and customer_id='$customer_id'";
}


/*
if($customer_id==''){$c="";}
else{
	$c="and Outlet_Name='$customer_id'";
}
*/



if($Detailed=='ລະອຽດ'){
/*
   @$sp0=mysqli_query($con,"TRUNCATE TABLE tb_statement");
		  
		  @$sp=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)
SELECT sale_id,sale_date, amount,customer_id, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HD'  $btw $c and amount!='0' order by sale_date
	          ");
			
  @$sp1=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)
SELECT sale_id,sale_date, amount,customer_id, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HM' $btw $c and amount!='0' order by sale_date
	          ");
 
 @$sp2=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)
SELECT sale_id,sale_date, amount,customer_id, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP' $btw $c and amount!='0' order by sale_date
	          ");

 
@$sp3=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP1' $btw $c and amount!='0' order by sale_date");
@$sp4=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ' $btw $c and amount!='0' order by sale_date");
@$sp5=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ1' $btw $c and amount!='0' order by sale_date");
@$sp6=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HS' $btw $c and amount!='0' order by sale_date");
@$sp7=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NC'$btw $c and amount!='0' order by sale_date");
@$sp8=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NQ' $btw $c and amount!='0' order by sale_date");
@$sp9=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP' $btw $c and amount!='0' order by sale_date");
@$sp10=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP1' $btw $c and amount!='0' order by sale_date");
@$sp11=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RS' $btw $c and amount!='0' order by sale_date");
@$sp12=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='TC' $btw $c and amount!='0' order by sale_date");
@$sp13=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0 FROM `product_sale` WHERE product_id='TQ' $btw $c and amount!='0' order by sale_date");
@$sp14=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0 FROM `product_sale` WHERE product_id='HC' $btw $c and amount!='0' order by sale_date");
@$sp15=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0 FROM `product_sale` WHERE product_id='RQ' $btw $c and amount!='0' order by sale_date");
@$sp16=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty FROM `product_sale` WHERE product_id='RQ1' $btw $c and amount!='0' order by sale_date");

*/

/*
// 1. ล้างตารางเดิมก่อน
@$sp0 = mysqli_query($con, "TRUNCATE TABLE tb_statement");

// 2. ใช้เพียง Query เดียวในการจัดการเงื่อนไขของทุกสินค้า
$query = "INSERT INTO tb_statement (
    inv_no, inv_date, inv_amt, customer_id, 
    `10031707`, `10031707D`, `10031708`, `10031708D`, `10031709`, `10031709D`, 
    `10031710`, `10031710D`, `10031711`, `10031711D`, `10031712`, `10031713`, 
    `10031713D`, `10031777`, `10031777D`, `10126756`, `10128824`, `10128824D`, `10135854`
)
SELECT 
    Invoice_Number as sale_id, 
    DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) as sale_date, 
    Total, 
    Outlet_External_ID,
    CASE WHEN Product_SKU = '10031707'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031707D'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031708'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031708D' THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031709'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031709D' THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031710'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031710D'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031711'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031711D'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031712' THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031713'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031713D'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031777'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031777D'  THEN Quantity ELSE 0 END, -- สังเกตจากโค้ดเดิม product_id='HC' จะเข้าคอลัมน์ CO2
    CASE WHEN Product_SKU = '10126756'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10128824' THEN Quantity ELSE 0 END,
	CASE WHEN Product_SKU = '10128824D' THEN Quantity ELSE 0 END,
	CASE WHEN Product_SKU = '10135854' THEN Quantity ELSE 0 END
FROM `sale_import` 
WHERE Product_SKU IN ('10031707','10031707D','10031708','10031708D','10031709','10031709D','10031710','10031710D','10031711','10031711D','10031712','10031713','10031713D','10031777','10031777D','10126756','10128824','10128824D','10135854')
  $btw $c 
  AND Total != '0' 
ORDER BY Invoiced_Date
";

@$sp = mysqli_query($con, $query);
*/



// 1. ล้างตารางเดิมก่อน
@$sp0 = mysqli_query($con, "TRUNCATE TABLE tb_statement");

// 1. ดึงรายการสินค้าปัจจุบันจากตาราง products
$product_query = mysqli_query($con, "SELECT DISTINCT Product_ID FROM `products` WHERE Product_ID IS NOT NULL AND Product_ID != '' ORDER BY Product_ID ASC");

$dynamic_columns = [];
$dynamic_cases = [];
$product_ids = [];

// เช็คคอลัมน์ที่มีอยู่แล้วในตาราง tb_statement ป้องกันการสร้างซ้ำ
$existing_cols_query = mysqli_query($con, "SHOW COLUMNS FROM `tb_statement`");
$existing_columns = [];
while ($col_row = mysqli_fetch_assoc($existing_cols_query)) {
    $existing_columns[] = $col_row['Field'];
}

// 2. วนลูปเพื่อเช็คโครงสร้างตาราง และเตรียมสร้าง Dynamic SQL
while ($row = mysqli_fetch_assoc($product_query)) {
    $pid = $row['Product_ID'];
    $product_ids[] = "'$pid'";
    $dynamic_columns[] = "`$pid`";
/*
    $dynamic_cases[] = "    CASE WHEN Product_SKU = '$pid' THEN Quantity ELSE 0 END";
    */

    $dynamic_cases[] = "    CASE WHEN product_id = '$pid' THEN qty ELSE 0 END";


    // 🔥 [จุดสำคัญ] ถ้าในตาราง products มีรหัสนี้ แต่ใน tb_statement ยังไม่มีคอลัมน์นี้...
    // ระบบจะสั่ง ALTER TABLE เพิ่มคอลัมน์ให้ทันทีอัตโนมัติ!
    if (!in_array($pid, $existing_columns)) {
        $alter_sql = "ALTER TABLE `tb_statement` ADD `$pid` VARCHAR(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL";
        mysqli_query($con, $alter_sql);
    }
}

// แปลงเป็นรูปแบบ String เพื่อนำไปใช้กับคิวรีหลัก
$str_columns = implode(", ", $dynamic_columns);
$str_cases = implode(",\n", $dynamic_cases);
$str_in_products = implode(", ", $product_ids);

$query = "INSERT INTO tb_statement (
    inv_no, inv_date, inv_amt, customer_id, 
    $str_columns
)
SELECT 
    sale_id, 
    sale_date, 
    total, 
    customer_id,
\n$str_cases
FROM `product_sale` 
WHERE product_id IN ($str_in_products)
  $btw $c 
  AND total != '0' 
ORDER BY customer_id, sale_date ASC
";

// 3. สั่งรันคิวรี
@$sp = mysqli_query($con, $query);









}
elseif($Detailed=='ສັງລວມ'){
	
	/*
	 @$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement
	          ");
	
	
	
		  @$sp=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)
SELECT sale_id,sale_date, amount,customer_id, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HD'  $btw $c and amount!='0'  order by sale_date
	          ");
  @$sp1=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)
SELECT sale_id,sale_date, amount,customer_id, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HM' $btw $c and amount!='0'  order by sale_date
	          ");

 @$sp2=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP' $btw $c and amount!='0' order by sale_date
	          ");


@$sp3=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP1' $btw $c and amount!='0' order by sale_date");
@$sp4=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ' $btw $c and amount!='0'  order by sale_date");
@$sp5=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ1' $btw $c and amount!='0' order by sale_date");
@$sp6=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HS' $btw $c and amount!='0'  order by sale_date");
@$sp7=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NC'$btw $c and amount!='0'   order by sale_date");
@$sp8=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NQ' $btw $c and amount!='0'  order by sale_date");
@$sp9=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP' $btw $c and amount!='0'  order by sale_date");
@$sp10=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP1' $btw $c and amount!='0'  order by sale_date");
@$sp11=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RS' $btw $c and amount!='0'  order by sale_date");
@$sp12=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='TC' $btw $c and amount!='0'  order by sale_date");
@$sp13=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0 FROM `product_sale` WHERE product_id='TQ' $btw $c and amount!='0'  order by sale_date");
@$sp14=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0 FROM `product_sale` WHERE product_id='HC' $btw $c and amount!='0'  order by sale_date");	
@$sp15=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0 FROM `product_sale` WHERE product_id='RQ' $btw $c and amount!='0'  order by sale_date");
@$sp16=mysqli_query($con,"INSERT into tb_statement(inv_no, inv_date, inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty FROM `product_sale` WHERE product_id='RQ1' $btw $c and amount!='0'  order by sale_date");	
	*/
	
	/*
	// 1. ล้างตารางเดิมก่อน
@$sp0 = mysqli_query($con, "TRUNCATE TABLE tb_statement");

// 2. ใช้เพียง Query เดียวในการจัดการเงื่อนไขของทุกสินค้า
$query = "INSERT INTO tb_statement (
    inv_no, inv_date, inv_amt, customer_id, 
    `10031707`, `10031707D`, `10031708`, `10031708D`, `10031709`, `10031709D`, 
    `10031710`, `10031710D`, `10031711`, `10031711D`, `10031712`, `10031713`, 
    `10031713D`, `10031777`, `10031777D`, `10126756`, `10128824`, `10128824D`, `10135854`
)
SELECT 
    Invoice_Number as sale_id, 
    DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) as sale_date, 
    Total as amount, 
    Outlet_External_ID,
    CASE WHEN Product_SKU = '10031707'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031707D'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031708'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031708D' THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031709'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031709D' THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031710'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031710D'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031711'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031711D'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031712' THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031713'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031713D'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031777'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10031777D'  THEN Quantity ELSE 0 END, -- สังเกตจากโค้ดเดิม product_id='HC' จะเข้าคอลัมน์ CO2
    CASE WHEN Product_SKU = '10126756'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10128824' THEN Quantity ELSE 0 END,
	CASE WHEN Product_SKU = '10128824D' THEN Quantity ELSE 0 END,
	CASE WHEN Product_SKU = '10135854' THEN Quantity ELSE 0 END
FROM `sale_import` 
WHERE Product_SKU IN ('10031707','10031707D','10031708','10031708D','10031709','10031709D','10031710','10031710D','10031711','10031711D','10031712','10031713','10031713D','10031777','10031777D','10126756','10128824','10128824D','10135854')
  $btw $c 
  AND Total != '0' 
ORDER BY Invoiced_Date
";
@$sp = mysqli_query($con, $query);
	

$query_help = "INSERT INTO tb_statement_help (
    inv_no, inv_date, inv_amt, 
    `10031707`, `10031707D`, `10031708`, `10031708D`, `10031709`, `10031709D`, 
    `10031710`, `10031710D`, `10031711`, `10031711D`, `10126756`, `10128824`, 
    `10128824D`, `10135854`, `10031712`, `10031713`, `10031713D`, `10031777`, `10031777D`
)
SELECT 
    inv_no,
    inv_date,
    SUM(inv_amt),
    SUM(`10031707`), 
    SUM(`10031707D`), 
    SUM(`10031708`), 
    SUM(`10031708D`), 
    SUM(`10031709`), 
    SUM(`10031709D`), 
    SUM(`10031710`), 
    SUM(`10031710D`), 
    SUM(`10031711`), 
    SUM(`10031711D`), 
    SUM(`10126756`), 
    SUM(`10128824`), 
    SUM(`10128824D`), 
    SUM(`10135854`),
    SUM(`10031712`),   -- แทนที่ตำแหน่ง TC เดิม
    SUM(`10031713`),   -- แทนที่ตำแหน่ง TQ เดิม
    SUM(`10031713D`),  -- แทนที่ตำแหน่ง CO2 เดิม
    SUM(`10031777`),   -- แทนที่ตำแหน่ง RQ เดิม
    SUM(`10031777D`)   -- แทนที่ตำแหน่ง RQ1 เดิม
FROM tb_statement 
GROUP BY inv_no
";
@$sp15 = mysqli_query($con, $query_help);

 @$sp15_1=mysqli_query($con,"TRUNCATE TABLE tb_statement
	          ");
	
$query_restore = "INSERT INTO tb_statement (
    inv_no, inv_date, inv_amt, 
    `10031707`, `10031707D`, `10031708`, `10031708D`, `10031709`, `10031709D`, 
    `10031710`, `10031710D`, `10031711`, `10031711D`, `10126756`, `10128824`, 
    `10128824D`, `10135854`, `10031712`, `10031713`, `10031713D`, `10031777`, `10031777D`
)
SELECT 
    inv_no,
    inv_date,
    inv_amt,
    `10031707`, 
    `10031707D`, 
    `10031708`, 
    `10031708D`, 
    `10031709`, 
    `10031709D`, 
    `10031710`, 
    `10031710D`, 
    `10031711`, 
    `10031711D`, 
    `10126756`, 
    `10128824`, 
    `10128824D`, 
    `10135854`,
    `10031712`, 
    `10031713`, 
    `10031713D`, 
    `10031777`, 
    `10031777D`
FROM tb_statement_help 
GROUP BY inv_no
";

@$sp15_2 = mysqli_query($con, $query_restore);

@$sp15_3=mysqli_query($con,"TRUNCATE TABLE tb_statement_help");	
*/




// 1. ดึงรายการสินค้าปัจจุบันจากตาราง products เพื่อเช็คและเตรียมชื่อคอลัมน์
$product_query = mysqli_query($con, "SELECT DISTINCT Product_ID FROM `products` WHERE Product_ID IS NOT NULL AND Product_ID != '' ORDER BY Product_ID ASC");

$dynamic_columns = [];
$dynamic_cases = [];
$dynamic_sum_cases = [];
$product_ids = [];

// เช็คคอลัมน์ที่มีอยู่แล้วในตาราง tb_statement ป้องกันการสร้างซ้ำ
$existing_cols_query = mysqli_query($con, "SHOW COLUMNS FROM `tb_statement`");
$existing_columns = [];
while ($col_row = mysqli_fetch_assoc($existing_cols_query)) {
    $existing_columns[] = $col_row['Field'];
}

// 2. วนลูปเพื่อเช็คโครงสร้างตาราง (ถ้ามีสินค้าใหม่ ระบบจะสร้างคอลัมน์ในตารางจริงให้ทันที)
while ($row = mysqli_fetch_assoc($product_query)) {
    $pid = $row['Product_ID'];
    $product_ids[] = "'$pid'";
    $dynamic_columns[] = "`$pid`";
    

    // ใช้ SUM ครอบ CASE WHEN เพื่อยุบยอดรวมแยกตามลูกค้า (customer_id) ตั้งแต่คิวรีแรก
    /*
    $dynamic_sum_cases[] = "    SUM(CASE WHEN Product_SKU = '$pid' THEN Quantity ELSE 0 END) AS `$pid`";
    */
    $dynamic_sum_cases[] = "    SUM(CASE WHEN product_id = '$pid' THEN qty ELSE 0 END) AS `$pid`";



    // ตรวจสอบและสร้างคอลัมน์ใน DB อัตโนมัติหากยังไม่มีรองรับ
    if (!in_array($pid, $existing_columns)) {
        $alter_sql = "ALTER TABLE `tb_statement` ADD `$pid` VARCHAR(255) COLLATE utf8mb3_unicode_ci DEFAULT '0'";
        mysqli_query($con, $alter_sql);
    }
}

// แปลง Array เป็น String สำหรับใช้ใน Statement หลัก
$str_columns = implode(", ", $dynamic_columns);
$str_sum_cases = implode(",\n", $dynamic_sum_cases);
$str_in_products = implode(", ", $product_ids);

// 3. ล้างข้อมูลเก่าในตารางหลักรอไว้
mysqli_query($con, "TRUNCATE TABLE tb_statement");

$query = "INSERT INTO tb_statement (
    inv_no, inv_date, inv_amt, customer_id, 
    $str_columns
)
SELECT 
    MAX(sale_id) as sale_id, -- เลือกเลขที่บิลล่าสุดหรือใช้ MAX ยุบกลุ่ม
    MAX(sale_date) as sale_date, 
    SUM(total) as inv_amt,          -- รวมยอดเงินบิลทั้งหมดของลูกค้ารายนี้
    customer_id,
\n$str_sum_cases
FROM `product_sale` 
WHERE product_id IN ($str_in_products)
  $btw $c 
  AND total != '0' 
GROUP BY customer_id
ORDER BY customer_id ASC;
";



// รันคำสั่งคำนวณและบันทึกผล
@$sp = mysqli_query($con, $query);



}
	
	if($sp){
    $now=date("Y-m-d");
    $from_date=$now;
    $to_date=$now;
				$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
				 header("location:statement_1_2.php?customer_id=".$customer_id."&from_date=".$from_date."&to_date=".$to_date."&Detailed=".$Detailed."");
				}
				else{
          $now=date("Y-m-d");
          $from_date=$now;
          $to_date=$now;
					$_SESSION['smg']="<div class='alert alert-danger'><strong>ບັນທືກບໍ່ສຳເລັດ!</strong></div>";
				 header("location:statement_1_2.php?customer_id=".$customer_id."&from_date=".$from_date."&to_date=".$to_date."&Detailed=".$Detailed."");					
					}
	


 ?>
