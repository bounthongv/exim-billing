<?php 
  include("init.php");
    
  $from_date = mysqli_real_escape_string($con,$_POST['from_date']);  
$to_date = mysqli_real_escape_string($con,$_POST['to_date']);
$customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
$Detailed = mysqli_real_escape_string($con,$_POST['Detailed']);

		   
     
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



   @$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement_customers
	          ");
		  /*
		  @$sp=mysqli_query($con,"
insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)
SELECT  amount,customer_id, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HD'  $btw $c and amount!='0' order by sale_date
	          ");
  @$sp1=mysqli_query($con,"
insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)
SELECT  amount,customer_id, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HM' $btw $c and amount!='0' order by sale_date
	          ");

 @$sp2=mysqli_query($con,"
insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP' $btw $c and amount!='0' order by sale_date
	          ");


@$sp3=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP1' $btw $c and amount!='0' order by sale_date");
@$sp4=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ' $btw $c and amount!='0' order by sale_date");
@$sp5=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ1' $btw $c and amount!='0' order by sale_date");
@$sp6=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HS' $btw $c and amount!='0' order by sale_date");
@$sp7=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NC'$btw $c and amount!='0' order by sale_date");
@$sp8=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NQ' $btw $c and amount!='0' order by sale_date");
@$sp9=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP' $btw $c and amount!='0' order by sale_date");
@$sp10=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP1' $btw $c and amount!='0' order by sale_date");
@$sp11=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RS' $btw $c and amount!='0' order by sale_date");
@$sp12=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='TC' $btw $c and amount!='0' order by sale_date");
@$sp13=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='TQ' $btw $c and amount!='0' order by sale_date");
@$sp14=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HC' $btw $c and amount!='0' order by sale_date");
@$sp15=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RQ' $btw $c and amount!='0' order by sale_date");
@$sp16=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0 FROM `product_sale` WHERE product_id='RQ1' $btw $c and amount!='0' order by sale_date");
@$sp17=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0 FROM `product_sale` WHERE product_id='HS22' $btw $c and amount!='0' order by sale_date");
@$sp18=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0 FROM `product_sale` WHERE product_id='HD2' $btw $c and amount!='0'  order by sale_date");	
@$sp19=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty FROM `product_sale` WHERE product_id='HS25' $btw $c and amount!='0'  order by sale_date");	
*/

/*
$query = "INSERT INTO tb_statement_customers (
    inv_amt, customer_id, 
    `10031707`, `10031707D`, `10031708`, `10031708D`, `10031709`, `10031709D`, 
    `10031710`, `10031710D`, `10031711`, `10031711D`, `10031712`, `10031713`, 
    `10031713D`, `10031777`, `10031777D`, `10126756`, `10128824`, `10128824D`, `10135854`
)
SELECT 
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
ORDER BY Outlet_External_ID,Invoiced_Date ASC
";
*/


// 1. ดึงรายการสินค้าปัจจุบันจากตาราง products เพื่อเช็คและเตรียมสร้างชื่อคอลัมน์
$product_query = mysqli_query($con, "SELECT DISTINCT Product_ID FROM `products` WHERE Product_ID IS NOT NULL AND Product_ID != '' ORDER BY Product_ID ASC");

$dynamic_columns = [];
$dynamic_cases = [];
$product_ids = [];

// เช็คคอลัมน์ที่มีอยู่แล้วในตาราง tb_statement_customers ป้องกันการสร้างซ้ำ
$existing_cols_query = mysqli_query($con, "SHOW COLUMNS FROM `tb_statement_customers`");
$existing_columns = [];
while ($col_row = mysqli_fetch_assoc($existing_cols_query)) {
    $existing_columns[] = $col_row['Field'];
}

// 2. วนลูปตรวจสอบโครงสร้าง และสร้างคำสั่ง SQL แบบอัตโนมัติ
while ($row = mysqli_fetch_assoc($product_query)) {
    $pid = $row['Product_ID'];
    $product_ids[] = "'$pid'";
    $dynamic_columns[] = "`$pid`";

   // $dynamic_cases[] = "    CASE WHEN Product_SKU = '$pid' THEN Quantity ELSE 0 END";
    
  $dynamic_cases[] = "    CASE WHEN product_id = '$pid' THEN qty ELSE 0 END";


    // 🔥 ถ้าในตาราง products มีสินค้าชิ้นใหม่เพิ่มเข้ามา แต่ในโครงสร้างตารางเดิมยังไม่มีคอลัมน์รองรับ
    // ระบบจะสั่งเพิ่มคอลัมน์ (ALTER TABLE) ให้เองโดยอัตโนมัติทันที ปลอดภัย ไม่พัง
    if (!in_array($pid, $existing_columns)) {
        $alter_sql = "ALTER TABLE `tb_statement_customers` ADD `$pid` VARCHAR(255) COLLATE utf8mb3_unicode_ci DEFAULT '0'";
        mysqli_query($con, $alter_sql);
    }
}

// แปลงเป็น String เพื่อนำไปจัดวางในโครงสร้าง Query หลัก
$str_columns = implode(", ", $dynamic_columns);
$str_cases = implode(",\n", $dynamic_cases);
$str_in_products = implode(", ", $product_ids);

// 3. ประกอบโครงสร้าง SQL Query ตัวใหม่ที่เป็น Dynamic
/*
$query = "INSERT INTO tb_statement_customers (
    inv_amt, customer_id, 
    $str_columns
)
SELECT 
    Total as amount, 
    Outlet_External_ID,
\n$str_cases
FROM `sale_import` 
WHERE Product_SKU IN ($str_in_products)
  $btw $c 
  AND Total != '0' 
ORDER BY Outlet_External_ID, Invoiced_Date ASC
";
*/
$query = "INSERT INTO tb_statement_customers (
    inv_amt, customer_id, 
    $str_columns
)
SELECT 
    total as amount, 
    customer_id,
\n$str_cases
FROM `product_sale` 
WHERE product_id IN ($str_in_products)
  $btw $c 
  AND total != '0' 
ORDER BY customer_id, sale_date ASC
";




@$sp = mysqli_query($con, $query);

}elseif($Detailed=='ສັງລວມ'){
	

	 @$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement_customers
	          ");
/*
		  @$sp=mysqli_query($con,"
insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)
SELECT  amount,customer_id, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HD'  $btw $c and amount!='0'  order by sale_date
	          ");
  @$sp1=mysqli_query($con,"
insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)
SELECT  amount,customer_id, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HM' $btw $c and amount!='0'  order by sale_date
	          ");

 @$sp2=mysqli_query($con,"
insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP' $btw $c and amount!='0' order by sale_date
	          ");


@$sp3=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP1' $btw $c and amount!='0' order by sale_date");
@$sp4=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ' $btw $c and amount!='0'  order by sale_date");
@$sp5=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ1' $btw $c and amount!='0' order by sale_date");
@$sp6=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HS' $btw $c and amount!='0'  order by sale_date");
@$sp7=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NC'$btw $c and amount!='0'   order by sale_date");
@$sp8=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NQ' $btw $c and amount!='0'  order by sale_date");
@$sp9=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP' $btw $c and amount!='0'  order by sale_date");
@$sp10=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP1' $btw $c and amount!='0'  order by sale_date");
@$sp11=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RS' $btw $c and amount!='0'  order by sale_date");
@$sp12=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='TC' $btw $c and amount!='0'  order by sale_date");
@$sp13=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='TQ' $btw $c and amount!='0'  order by sale_date");
@$sp14=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HC' $btw $c and amount!='0'  order by sale_date");	
@$sp15=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RQ' $btw $c and amount!='0'  order by sale_date");
@$sp16=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0 FROM `product_sale` WHERE product_id='RQ1' $btw $c and amount!='0'  order by sale_date");	
@$sp17=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0 FROM `product_sale` WHERE product_id='HS22' $btw $c and amount!='0'  order by sale_date");	
@$sp18=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0 FROM `product_sale` WHERE product_id='HD2' $btw $c and amount!='0'  order by sale_date");	
@$sp19=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty FROM `product_sale` WHERE product_id='HS25' $btw $c and amount!='0'  order by sale_date");	
*/
	
	
	
	/*
	  @$spaa=mysqli_query($con,"
       SELECT * from tb_statement_customers
	  order by inv_date, inv_no asc
          ");
	
         
	  
            while($f=mysqli_fetch_array($spaa)){

     
			  
	@$inv_no=$f["inv_no"];	
	@$inv_date=$f["inv_date"];		  
			  
	@$t_inv_amt+=$f["inv_amt"];	  
	@$t_HD+=$f["HD"];
@$t_HM+=$f["HM"];
@$t_HP+=$f["HP"];
@$t_HP1+=$f["HP1"];
@$t_HQ+=$f["HQ"];
@$t_HQ1+=$f["HQ1"];
@$t_HS+=$f["HS"];
@$t_NC+=$f["NC"];
@$t_NQ+=$f["NQ"];
@$t_RP+=$f["RP"];
@$t_RP1+=$f["RP1"];
@$t_RS+=$f["RS"];
@$t_TC+=$f["TC"];
@$t_TQ+=$f["TQ"];
@$t_HC+=$f["HC"];
		  
	
}
*/	



/*

$query = "INSERT INTO tb_statement_customers (
     inv_amt, customer_id, 
    `10031707`, `10031707D`, `10031708`, `10031708D`, `10031709`, `10031709D`, 
    `10031710`, `10031710D`, `10031711`, `10031711D`, `10031712`, `10031713`, 
    `10031713D`, `10031777`, `10031777D`, `10126756`, `10128824`, `10128824D`, `10135854`
)
SELECT 
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
ORDER BY Outlet_External_ID,Invoiced_Date ASC
";
@$sp = mysqli_query($con, $query);



$query_help = "INSERT INTO tb_statement_customers_help (
    customer_id, inv_amt, 
    `10031707`, `10031707D`, `10031708`, `10031708D`, `10031709`, `10031709D`, 
    `10031710`, `10031710D`, `10031711`, `10031711D`, `10126756`, `10128824`, 
    `10128824D`, `10135854`, `10031712`, `10031713`, `10031713D`, `10031777`, `10031777D`
)
SELECT 
    customer_id,
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
    SUM(`10031712`),
    SUM(`10031713`),
    SUM(`10031713D`),
    SUM(`10031777`),
    SUM(`10031777D`)
FROM tb_statement_customers 
GROUP BY customer_id
";
@$sp15 = mysqli_query($con, $query_help);

 @$sp15_1=mysqli_query($con,"TRUNCATE TABLE tb_statement_customers
	          ");
	
$query_restore = "INSERT INTO tb_statement_customers (
    customer_id, inv_amt, 
    `10031707`, `10031707D`, `10031708`, `10031708D`, `10031709`, `10031709D`, 
    `10031710`, `10031710D`, `10031711`, `10031711D`, `10126756`, `10128824`, 
    `10128824D`, `10135854`, `10031712`, `10031713`, `10031713D`, `10031777`, `10031777D`
)
SELECT 
    customer_id,
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
FROM tb_statement_customers_help 
GROUP BY customer_id
";

@$sp15_2 = mysqli_query($con, $query_restore);

@$sp15_3=mysqli_query($con,"TRUNCATE TABLE tb_statement_customers_help");	
*/
	
	/*
@$sp15=mysqli_query($con,"insert into tb_statement_customers_help(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT sum(inv_amt),customer_id,sum(HD), sum(HM), sum(HP), sum(HP1), sum(HQ), sum(HQ1), sum(HS), sum(NC), sum(NQ), sum(RP), sum(RP1), sum(RS), sum(TC), sum(TQ), sum(HC),sum(RQ),sum(RQ1),sum(HS22),sum(HD2),sum(HS25) from tb_statement_customers group by customer_id");
	
 @$sp15_1=mysqli_query($con,"
TRUNCATE TABLE tb_statement_customers
	          ");
	
@$sp15_2=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25)SELECT inv_amt,customer_id,HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, HC,RQ,RQ1,HS22,HD2,HS25 from tb_statement_customers_help group by customer_id");	
	
@$sp15_3=mysqli_query($con,"TRUNCATE TABLE tb_statement_customers_help");	
*/





// 1. ดึงรายการสินค้าปัจจุบันจากตาราง products เพื่อนำมาเตรียมชื่อคอลัมน์
$product_query = mysqli_query($con, "SELECT DISTINCT Product_ID FROM `products` WHERE Product_ID IS NOT NULL AND Product_ID != '' ORDER BY Product_ID ASC");

$dynamic_columns = [];
$dynamic_sum_cases = [];
$product_ids = [];

// ดึงรายชื่อคอลัมน์ที่มีอยู่แล้วในตาราง tb_statement_customers เพื่อเช็คป้องกันการสร้างซ้ำ
$existing_cols_query = mysqli_query($con, "SHOW COLUMNS FROM `tb_statement_customers`");
$existing_columns = [];
while ($col_row = mysqli_fetch_assoc($existing_cols_query)) {
    $existing_columns[] = $col_row['Field'];
}

// 2. วนลูปตรวจสอบโครงสร้างตารางและสร้างเงื่อนไขแบบ Dynamic
while ($row = mysqli_fetch_assoc($product_query)) {
    $pid = $row['Product_ID'];
    $product_ids[] = "'$pid'";
    $dynamic_columns[] = "`$pid`";
    
    // ใช้ SUM ครอบ CASE WHEN เพื่อยุบรวมยอดรวมตามพฤติกรรมเดิมของตาราง _help
   // $dynamic_sum_cases[] = "    SUM(CASE WHEN Product_SKU = '$pid' THEN Quantity ELSE 0 END) AS `$pid`";
     $dynamic_sum_cases[] = "    SUM(CASE WHEN product_id = '$pid' THEN qty ELSE 0 END) AS `$pid`";


    // 🔥 [Auto-Alter Table] หากพบสินค้าใหม่ที่ไม่มีคอลัมน์รองรับ ระบบจะสร้างคอลัมน์ในฐานข้อมูลให้ทันที
    if (!in_array($pid, $existing_columns)) {
        $alter_sql = "ALTER TABLE `tb_statement_customers` ADD `$pid` VARCHAR(255) COLLATE utf8mb3_unicode_ci DEFAULT '0'";
        mysqli_query($con, $alter_sql);
    }
}

// แปลงอาเรย์ให้เป็นข้อความยาวสำหรับต่อประโยค SQL
$str_columns = implode(", ", $dynamic_columns);
$str_sum_cases = implode(",\n", $dynamic_sum_cases);
$str_in_products = implode(", ", $product_ids);

// 3. เคลียร์ข้อมูลตารางหลักเพื่อเตรียมรับยอดใหม่
mysqli_query($con, "TRUNCATE TABLE tb_statement_customers");

// 4. สั่งประมวลผลดึงข้อมูล ยุบรวมกลุ่มด้วย GROUP BY และบันทึกใน Query เดียวจบ (ไม่ต้องใช้ตาราง Help)
/*
$query = "INSERT INTO tb_statement_customers (
    customer_id, inv_amt, 
    $str_columns
)
SELECT 
    Outlet_External_ID as customer_id,
    SUM(Total) as inv_amt, -- ยุบรวมยอดเงินรวมแยกรายลูกค้าตามโครงสร้างเดิมของคุณ
\n$str_sum_cases
FROM `sale_import` 
WHERE Product_SKU IN ($str_in_products)
  $btw $c 
  AND Total != '0' 
GROUP BY Outlet_External_ID
ORDER BY Outlet_External_ID ASC;
";
*/
$query = "INSERT INTO tb_statement_customers (
    customer_id, inv_amt, 
    $str_columns
)
SELECT 
    customer_id as customer_id,
    SUM(total) as inv_amt, -- ยุบรวมยอดเงินรวมแยกรายลูกค้าตามโครงสร้างเดิมของคุณ
\n$str_sum_cases
FROM `product_sale` 
WHERE product_id IN ($str_in_products)
  $btw $c 
  AND total != '0' 
GROUP BY customer_id
ORDER BY customer_id ASC;
";




// ประมวลผลคำสั่งหลัก
@$sp = mysqli_query($con, $query);


/*
// 5. ล้างตารางตารางช่วยจำ (Help) เผื่อกรณีที่มีโค้ดส่วนอื่นยังเรียกใช้งานอยู่เพื่อป้องกันข้อมูลค้าง
mysqli_query($con, "TRUNCATE TABLE tb_statement_customers_help");
*/


}
	
	if($sp){
				$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
				 header("location:statement_customers_1_2.php?customer_id=".$customer_id."&from_date=".$from_date."&to_date=".$to_date."&Detailed=".$Detailed."");
				}
				else{
					$_SESSION['smg']="<div class='alert alert-danger'><strong>ບັນທືກບໍ່ສຳເລັດ!</strong></div>";
				 header("location:statement_customers_1_2.php?customer_id=".$customer_id."&from_date=".$from_date."&to_date=".$to_date."&Detailed=".$Detailed."");					
					}
	
 ?>
