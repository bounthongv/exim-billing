<?php 
  include("init.php");
    
 /* $from_date = mysqli_real_escape_string($con,$_POST['from_date']);  
$to_date = mysqli_real_escape_string($con,$_POST['to_date']);*/
$customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
$Detailed = mysqli_real_escape_string($con,$_POST['Detailed']);


@$month = mysqli_real_escape_string($con,$_POST['month']);
$month = sprintf("%02d", $month); 
@$year = mysqli_real_escape_string($con,$_POST['year']);


@$year=date("Y");

$date=date_create_from_format("Y",$year);
$y=date_format($date,"y");

  

if($month=='' or $year==''){$btw="";} 
else{ $btw="and (month(sale_date)='$month' and year(sale_date)='$year')
";}


/*
 if($month=='' || $month=='00'){$btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y' )='$year'";} 
		  else{ $btw="and (DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%m' )='$month' 
		  and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y' )='$year')
		  ";}
		  */
/*
           if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and (sale_date>='$from_date' and sale_date<='$to_date')
		  ";}
		  */

if($customer_id==''){$c="";}
else{
	$c="and customer_id='$customer_id'";
}


@$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement_customers_month
	          ");



	 @$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement_customers
	          ");

/*
		  @$sp=mysqli_query($con,"
insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)
SELECT  amount,customer_id, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HD'  $btw $c and amount!='0'  order by sale_date
	          ");
  @$sp1=mysqli_query($con,"
insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)
SELECT  amount,customer_id, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HM' $btw $c and amount!='0'  order by sale_date
	          ");

 @$sp2=mysqli_query($con,"
insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP' $btw $c and amount!='0' order by sale_date
	          ");


@$sp3=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HP1' $btw $c and amount!='0' order by sale_date");
@$sp4=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ' $btw $c and amount!='0'  order by sale_date");
@$sp5=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HQ1' $btw $c and amount!='0' order by sale_date");
@$sp6=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='HS' $btw $c and amount!='0'  order by sale_date");
@$sp7=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NC'$btw $c and amount!='0'   order by sale_date");
@$sp8=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='NQ' $btw $c and amount!='0'  order by sale_date");
@$sp9=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP' $btw $c and amount!='0'  order by sale_date");
@$sp10=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RP1' $btw $c and amount!='0'  order by sale_date");
@$sp11=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='RS' $btw $c and amount!='0'  order by sale_date");
@$sp12=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='TC' $btw $c and amount!='0'  order by sale_date");
@$sp13=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0 FROM `product_sale` WHERE product_id='TQ' $btw $c and amount!='0'  order by sale_date");
@$sp14=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0 FROM `product_sale` WHERE product_id='CO2' $btw $c and amount!='0'  order by sale_date");	
@$sp15=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0 FROM `product_sale` WHERE product_id='RQ' $btw $c and amount!='0'  order by sale_date");
@$sp16=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT  amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty FROM `product_sale` WHERE product_id='RQ1' $btw $c and amount!='0'  order by sale_date");	
	

@$sp15=mysqli_query($con,"insert into tb_statement_customers_help(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT sum(inv_amt),customer_id,sum(HD), sum(HM), sum(HP), sum(HP1), sum(HQ), sum(HQ1), sum(HS), sum(NC), sum(NQ), sum(RP), sum(RP1), sum(RS), sum(TC), sum(TQ), sum(CO2),sum(RQ),sum(RQ1) from tb_statement_customers group by customer_id");
	
 @$sp15_1=mysqli_query($con,"TRUNCATE TABLE tb_statement_customers");
	



			  
@$sp15_2=mysqli_query($con,"insert into tb_statement_customers(inv_amt,customer_id, HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1)SELECT inv_amt,customer_id,HD, HM, HP, HP1, HQ, HQ1, HS, NC, NQ, RP, RP1, RS, TC, TQ, CO2,RQ,RQ1 from tb_statement_customers_help group by customer_id");	
	
@$sp15_3=mysqli_query($con,"TRUNCATE TABLE tb_statement_customers_help");	
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
    CASE WHEN Product_SKU = '10031777D'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10126756'  THEN Quantity ELSE 0 END,
    CASE WHEN Product_SKU = '10128824' THEN Quantity ELSE 0 END,
	CASE WHEN Product_SKU = '10128824D' THEN Quantity ELSE 0 END,
	CASE WHEN Product_SKU = '10135854' THEN Quantity ELSE 0 END
FROM `sale_import` 
WHERE Product_SKU IN ('10031707','10031707D','10031708','10031708D','10031709','10031709D','10031710','10031710D','10031711','10031711D','10031712','10031713','10031713D','10031777','10031777D','10126756','10128824','10128824D','10135854')
  $btw
  AND Total != '0' 
ORDER BY Invoiced_Date
";
@$sp = mysqli_query($con, $query);
*/

$query = "INSERT INTO tb_statement_customers (
    inv_amt, customer_id, 
    `10031707`, `10031707D`, `10031708`, `10031708D`, `10031709`, `10031709D`, 
    `10031710`, `10031710D`, `10031711`, `10031711D`, `10031712`, `10031713`, 
    `10031713D`, `10031777`, `10031777D`, `10126756`, `10128824`, `10128824D`, `10135854`
)
SELECT 
    total, 
    customer_id,
    CASE WHEN product_id = '10031707'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031707D'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031708'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031708D' THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031709'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031709D' THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031710'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031710D'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031711'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031711D'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031712' THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031713'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031713D'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031777'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10031777D'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10126756'  THEN qty ELSE 0 END,
    CASE WHEN product_id = '10128824' THEN qty ELSE 0 END,
	CASE WHEN product_id = '10128824D' THEN qty ELSE 0 END,
	CASE WHEN product_id = '10135854' THEN qty ELSE 0 END
FROM `product_sale` 
WHERE product_id IN ('10031707','10031707D','10031708','10031708D','10031709','10031709D','10031710','10031710D','10031711','10031711D','10031712','10031713','10031713D','10031777','10031777D','10126756','10128824','10128824D','10135854')
  $btw
  AND total != '0' 
ORDER BY sale_date
";





if ($month != "00" && !empty($month)) {


if($month=="1" || $month=="01"){$mn="Jan";}
elseif($month=="2" || $month=="02"){$mn="Feb";}
elseif($month=="3" || $month=="03"){$mn="Mar";}
elseif($month=="4" || $month=="04"){$mn="Apr";}
elseif($month=="5" || $month=="05"){$mn="May";}
elseif($month=="6" || $month=="06"){$mn="Jun";}
elseif($month=="7" || $month=="07"){$mn="Jul";}
elseif($month=="8" || $month=="08"){$mn="Aug";}
elseif($month=="9" || $month=="09"){$mn="Sep";}
elseif($month=="10"){$mn="Oct";}
elseif($month=="11"){$mn="Nov";}
elseif($month=="12"){$mn="`Dec`";}




/*
	@$sp15_2=mysqli_query($con,"INSERT into tb_statement_customers_month(Customers_ID, $mn)
		SELECT 
        tb_statement_customers.customer_id,
    (`tb_statement_customers`.`10031707` +
  
     `tb_statement_customers`.`10031708` +
   
     `tb_statement_customers`.`10031709` +

     `tb_statement_customers`.`10031710` +

     `tb_statement_customers`.`10031711` +

     `tb_statement_customers`.`10126756` +
     `tb_statement_customers`.`10128824` +

     `tb_statement_customers`.`10135854` +
     `tb_statement_customers`.`10031712` +
     `tb_statement_customers`.`10031713` +

     `tb_statement_customers`.`10031777`) AS total_statement
FROM tb_statement_customers 
WHERE 
    tb_statement_customers.customer_id IN 
    (
        SELECT Outlet_External_ID COLLATE utf8mb3_general_ci
        FROM sale_import 
        WHERE 
            DATE_FORMAT(STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = '$mn'
            AND DATE_FORMAT(STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y') = '$year'
        GROUP BY Outlet_External_ID
    )
");	
*/



	@$sp15_2=mysqli_query($con,"INSERT into tb_statement_customers_month(Customers_ID, $mn)
		SELECT 
        tb_statement_customers.customer_id,
    (`tb_statement_customers`.`10031707` +
  
     `tb_statement_customers`.`10031708` +
   
     `tb_statement_customers`.`10031709` +

     `tb_statement_customers`.`10031710` +

     `tb_statement_customers`.`10031711` +

     `tb_statement_customers`.`10126756` +
     `tb_statement_customers`.`10128824` +

     `tb_statement_customers`.`10135854` +
     `tb_statement_customers`.`10031712` +
     `tb_statement_customers`.`10031713` +

     `tb_statement_customers`.`10031777`) AS total_statement
FROM tb_statement_customers 
WHERE 
    tb_statement_customers.customer_id IN 
    (
        SELECT customer_id COLLATE utf8mb3_general_ci
        FROM product_sale 
        WHERE 
            DATE_FORMAT(sale_date, '%b') = '$mn'
            AND DATE_FORMAT(sale_date, '%Y') = '$year'
        GROUP BY customer_id
    )
");	






  @$sp15=mysqli_query($con,"INSERT into tb_statement_customers_month_help(
Customers_ID,
Customers_Name,
sr, Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, `Dec`)
SELECT Customers_ID,Customers_Name,sr,sum(Jan), sum(Feb), sum(Mar), sum(Apr), sum(May), sum(Jun), sum(Jul), sum(Aug), sum(Sep), sum(Oct), sum(Nov), sum(`Dec`)
  from tb_statement_customers_month group by Customers_ID");

  @$sp15_3=mysqli_query($con,"TRUNCATE TABLE tb_statement_customers_month");	



@$sp15_2=mysqli_query($con,"INSERT into tb_statement_customers_month(Customers_ID,
Customers_Name,
sr, Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, `Dec`
)SELECT Customers_ID,Customers_Name,sr,Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, `Dec`
from tb_statement_customers_month_help");	
	
@$sp15_3=mysqli_query($con,"TRUNCATE TABLE tb_statement_customers_month_help");	


  }
  else{
@$sp0=mysqli_query($con,"TRUNCATE TABLE tb_statement_customers");

// 1. เคลียร์ตารางแสดงผลลัพธ์รายเดือนรอไว้ก่อน
mysqli_query($con, "TRUNCATE TABLE tb_statement_customers_month");

// 2. ใช้คำสั่ง SQL ทรงประสิทธิภาพ Group ข้อมูลลูกค้า และดึงยอดรวมแยกรายเดือน (Jan - Dec) ในคิวรีเดียว
// ไม่ต้องใช้ foreach วนลูปส่งผลให้ระบบทำงานเร็วขึ้นมากและแยกเดือนได้ถูกต้องแน่นอน

/*

echo $sql = "INSERT INTO tb_statement_customers_month (
    Customers_ID, 
    Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, `Dec`
)
SELECT 
    SI.Outlet_External_ID AS Customers_ID,

    
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Jan' THEN SI.Quantity ELSE 0 END) AS Jan,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Feb' THEN SI.Quantity ELSE 0 END) AS Feb,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Mar' THEN SI.Quantity ELSE 0 END) AS Mar,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Apr' THEN SI.Quantity ELSE 0 END) AS Apr,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'May' THEN SI.Quantity ELSE 0 END) AS May,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Jun' THEN SI.Quantity ELSE 0 END) AS Jun,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Jul' THEN SI.Quantity ELSE 0 END) AS Jul,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Aug' THEN SI.Quantity ELSE 0 END) AS Aug,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Sep' THEN SI.Quantity ELSE 0 END) AS Sep,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Oct' THEN SI.Quantity ELSE 0 END) AS Oct,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Nov' THEN SI.Quantity ELSE 0 END) AS Nov,
    SUM(CASE WHEN DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%b') = 'Dec' THEN SI.Quantity ELSE 0 END) AS `Dec`

FROM `sale_import` SI
WHERE 
    SI.Product_SKU IN ('10031707','10031708','10031709','10031710','10031711','10126756','10128824','10135854','10031712','10031713','10031777')
    AND DATE_FORMAT(STR_TO_DATE(SI.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y') = '$year'
    AND SI.Total != '0'
GROUP BY SI.Outlet_External_ID
ORDER BY SI.Outlet_External_ID
";
*/
echo $sql = "INSERT INTO tb_statement_customers_month (
    Customers_ID, 
    Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, `Dec`
)
SELECT 
    SI.customer_id AS Customers_ID,

    
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Jan' THEN SI.qty ELSE 0 END) AS Jan,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Feb' THEN SI.qty ELSE 0 END) AS Feb,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Mar' THEN SI.qty ELSE 0 END) AS Mar,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Apr' THEN SI.qty ELSE 0 END) AS Apr,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'May' THEN SI.qty ELSE 0 END) AS May,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Jun' THEN SI.qty ELSE 0 END) AS Jun,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Jul' THEN SI.qty ELSE 0 END) AS Jul,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Aug' THEN SI.qty ELSE 0 END) AS Aug,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Sep' THEN SI.qty ELSE 0 END) AS Sep,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Oct' THEN SI.qty ELSE 0 END) AS Oct,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Nov' THEN SI.qty ELSE 0 END) AS Nov,
    SUM(CASE WHEN DATE_FORMAT(sale_date, '%b') = 'Dec' THEN SI.qty ELSE 0 END) AS `Dec`

FROM `product_sale` SI
WHERE 
    SI.product_id IN ('10031707','10031708','10031709','10031710','10031711','10126756','10128824','10135854','10031712','10031713','10031777')
    AND DATE_FORMAT(sale_date, '%Y') = '$year'
    AND SI.total != '0'
GROUP BY SI.customer_id
ORDER BY SI.customer_id
";


mysqli_query($con, $sql);

}

	if($sp){
				$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
				// header("location:statement_customers_month_2.php?customer_id=".$customer_id."&from_date=".$from_date."&to_date=".$to_date."&Detailed=".$Detailed."");
				header("location:statement_customers_month_2.php?customer_id=".$customer_id."&month=".$month."&year=".$year."");
			}
				else{
					$_SESSION['smg']="<div class='alert alert-danger'><strong>ບັນທືກບໍ່ສຳເລັດ!</strong></div>";
				// header("location:statement_customers_month_2.php?customer_id=".$customer_id."&from_date=".$from_date."&to_date=".$to_date."&Detailed=".$Detailed."");					
				header("location:statement_customers_month_2.php?customer_id=".$customer_id."&month=".$month."&year=".$year."");
			}
	
 ?>
