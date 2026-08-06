<?php 
include("init.php");

?>

<!DOCTYPE html>
<html lang="en">

<title>SPD</title>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

<style type="text/css">
    @import url("LAOS/stylesheet.css");
body,td,th ,h1,h2,h3,h4,h5,h6,h7,small,input[type='button'],input[type='text'],input[type='submit'], a{
	font-family: LAOS;


}
.ui-autocomplete { font-family:"Phetsarath OT";}
	
</style>




<style>
#search{border:1px solid #008000; border-radius:4px; background-color:#008000; padding:5px; color:#FFF; font-family:"Phetsarath OT";}

input{padding:4px; border:1px solid #D8D8D8; border-radius:4px;}


</style>
<style>
td{ padding:10px;
font-weight:!important;
height:20px;
font-size:10px;
 }
</style>

    <!-- Navigation -->
<style>
.save1{
	    color:#000;
	    border:1px solid #E4E4E4;
		border-radius:3px;
		padding:5px;
}
.bgtd{background-color: #EBEBEB;
		
}



td{ padding:10px;
font-weight:!important;
height:40px;
 }
 th{ background-color:#E0E0E0; text-align:center;
 padding:10px;
font-weight:!important;
height:40px;
font-size:10px;
 }
</style>
<?php
    
   
       @$stock_id= mysqli_real_escape_string($con,$_GET['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_sale.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_GET['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_GET['to_date']);	
		   $today=date("Y-m-d");

/*
         if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today' ";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  */
		     if($from_date=='' or $to_date==''){$btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' )='$to_date'";} 
		  else{ $btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) between '$from_date' and '$to_date'";}

		  
 
           @$product_id= mysqli_real_escape_string($con,$_GET['product_id']);		   
			   /*   
		 if($product_id==''){$p_id="";}  else{ $p_id="and  product_sale.product_id='$product_id' ";}
		 */
	 if($product_id==''){$p_id="";}  else{ $p_id="and  sale_import.Product_SKU='$product_id' ";}




		  @$group_id= mysqli_real_escape_string($con,$_GET['group_id']);		   
		 if($group_id==''){$g_id="";}  else{ $g_id="and  tb_groups.Group_ID='$group_id' ";}
		 
		// echo $g_id;
		
		/* 
		  @$sql_g=mysqli_query($con,"SELECT product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.amount) as amount,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
		,tb_groups.Group_ID	,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       where 1=1 $btw $s_id  $p_id $g_id group by tb_groups.Group_ID");

		  
		  */
		 
          ?>
<body onLoad="print()" >
    <?php  $sql_office = mysqli_query($con," select * from office order by Id desc limit 1");  
	 $r=mysqli_fetch_array($sql_office);
	 ?> 
  <table width="800px"  align="center" >
    <tr>
    <td width="200px"><img src="<?php echo $r['path'] ?>" class="img-rounded" alt="Cinque Terre" width="80" height="50"> 
    <p><?php echo $r['office_name'] ?></p>
    </td>
    <td width="300px" align="center"><h6>ລາຍງານສິນຄ້າຂາຍດີ</h6><br><h7>ປະຈຳວັນທີ &nbsp;<?php $date=date_create("$from_date");
echo date_format($date,"d/m/Y"); ?> &nbsp; - &nbsp; <?php $date=date_create("$to_date");
echo date_format($date,"d/m/Y"); ?> </h7>
</td>
    <td width="200px" align="center"><h6>&nbsp;&nbsp;</h6></td>
    </tr>
  </table>
 		<table border="1"  align="center"   class="table-bordered " width="800px" >
             
 	
              <tr>
                <th align="center">ລຳດັບ</th>
                <th align="center">ລະຫັດສິນຄ້າ</th>
                <th align="center">ຊື່ສິນຄ້າ</th>
              
				<th align="center">ຈຳນວນ</th>
                <th align="center">ຫົວໜ່ວຍ</th>
               
                 
              </tr>
           <?php
		   $i=1;
        //    while($g=mysqli_fetch_array($sql_g)){
				
/*
SELECT product_sale.*,sum(product_sale.qty) as qty,sum(product_sale.discount) as discount,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	   left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id 
	  
	  where 1=1  $s_id $p_id $g_id $btw  group by product_sale.product_id
	   order by product_sale.qty asc
	   */

				
				@$sql_d=mysqli_query($con,"SELECT sale_import.*
,sale_import.Invoice_Number as sale_id
,sum(sale_import.Quantity) as qty
	 ,sum(sale_import.Total) as t_amount
	 ,products.Product_ID,products.Product_Name
   ,customer_import.village as `address`
   ,customer_import.outlet_name as customer_name
   ,customer_import.phone_number as phone
   ,customer_import.outlet_name as fname
   ,customer_import.external_id as customer_id
   ,sale_import.Invoiced_Date as sale_date

		   FROM  sale_import 
		  LEFT JOIN products ON products.Product_ID = sale_import.Product_SKU 
      LEFT JOIN customer_import ON customer_import.external_id = sale_import.Outlet_External_ID
       
       where 1=1 $btw $p_id 
	   group by sale_import.Product_SKU
	   order by sale_import.Quantity asc ");
			  ?>
			 
             
          <!--  <td colspan='9'></td>
			 <td colspan='1' align="right"></td>
             <td colspan='3'></td>-->
             
             
			<?  
			 while($s=mysqli_fetch_array($sql_d)){
			?>	<tr>
                <td align="center"><?=$i;?></td>
			    <td align="center"><?=$s["product_id"];?></td> 
                <td align="left"><?=$s["Product_Name"];?></td>
				
               
            	<td align="right"><?=$s["qty"];?></td>
                <td align="center"><?=$s["Unit"];?></td>
                 
				</tr>
               
			<?php	
			 @$t_qty +=$s['qty'];
		
			$i++;
             } 
			 
		
		//	 }
			  ?>
              <tr>
             <td colspan="3" align="right">ລວມຍອດ</td>
             <td colspan="1" align="right"><?=@$t_qty;?></td>
            <td colspan="1" align="right"></td>
             </tr> 
       </table>
       
		 </body> 
        <?php  


			
 
 ?>
