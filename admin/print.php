<?php 
include("init.php");
?>
<!DOCTYPE>
<html>
<head>
<title>ລະບົບສາງ-ຂາຍສິນຄ້າ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="refresh" content="5; url=add_sale_stock.php">
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/png" href="images/shopping-cart.png">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
	
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>	

</head>
<style type="text/css">
    @import url("../LAOS/stylesheet.css");
body,td,th ,h3, a, h4, h2, h1, h4, h5, h6,small {
	font-family: LAOS;
}
.q{border:1px solid #ccc;}
</style>
<?php


foreach ($_GET as $key => $value) {
  $_GET[$key]=addslashes(strip_tags(trim($value)));
}

if (@$_GET['sale_id'] !='') {
	   $s_id=(string) $_GET['sale_id']; 
	    }
	   
extract($_GET); 


 

@$sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);

//  echo $start.$perpage.'<br>';
  
   //} 
?>
<body onLoad="print()">
  <?php
 
 @$query1 = mysqli_query($con,"
				 select product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,products.Product_Name,customers.customer_name ,customers.phone
				 from product_sale 
LEFT JOIN products ON products.Product_ID = product_sale.product_id 

LEFT JOIN customers ON customers.customer_id = product_sale.customer_id 
where product_sale.sale_id='$sale_id'  group by product_sale.product_id ");

 $perpage=16;
 $total_record = mysqli_num_rows($query1);
 $total_page = ceil($total_record / $perpage);
 

  /*for($p=1;$p<=$total_page;$p++){ 
  
  //echo $i;
  $page=$p;
   $start = ($page - 1) * $perpage;
   
   // echo $start.$perpage.'<br>';
   
  }*/
  $row_page=$total_page;
  $r_max=$total_page;

if($row_page==1){
	  // echo $p1;
	  
	  include("print_page1.php");
	}

else{
	
   for($i=1;$i<=$row_page;$i++){
	   
	   
         if($i==1){  
		     $start = ($i - 1) * $perpage;
		     $perpage;
		// echo ceil($total_record/$i).'<br>'; 
		// echo $p12;
		 include("print_page12.php");
	
	//  echo $i;
		  
		  }
   		elseif($i!==1 && $i!=$r_max){  		
		// echo $p2; 
		 $start = ($i - 1) * $perpage;
	    //	 echo ceil($total_record/$i).'<br>'; 
		 echo $i;
		// echo   
		// echo    $perpage;
		
		
		   
		  include("print_page2.php");
		
		 }
       else{  
	   // echo $p3; 
	    
		 echo $i;
		// echo ceil($total_record/$i).'<br>'; 
		     $start = ($i - 1) * $perpage;
	//	echo   $perpage.'<br>';
		include("print_page3.php");
		
		
		 }
		 
		
   
		}
}
   
   ?>
  
</body>

</html>