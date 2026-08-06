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
         if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today'";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  */

  if($from_date=='' or $to_date==''){$btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' )='$to_date'";} 
		  else{ $btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) between '$from_date' and '$to_date'";}


 
           @$sale_id=mysqli_real_escape_string($con,$_GET['sale_id']);
/*
		   if($sale_id==''){$sa_id="";}  else{ $sa_id="and  product_sale.sale_id='$sale_id' ";}		
		   */
 if($sale_id==''){$sa_id="";}  else{ $sa_id="and  sale_import.Invoice_Number='$sale_id' ";}




		    @$customer_id= mysqli_real_escape_string($con,$_GET['customer_id']);	   
		 if($customer_id==''){$c_id="";}  else{ $c_id="and  product_sale.customer_id='$customer_id' ";}
		 
		@$summary= mysqli_real_escape_string($con,$_GET['summary']); 

		  echo $sa_id;
/*
"
    
	   select * from (   
    
       SELECT product_sale.*,stocks.stock_name
       ,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,sum(product_sale.amount) as total_amt,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       where 1=1       $btw  $c_id $s_id  $sa_id
	   group by product_sale.sale_id   order by product_sale.sale_id 
     
        
        ) as tb_a where  payment < total_amt  
	   
	          "
*/
		  @$sp=mysqli_query($con,"SELECT * from (
SELECT 
sale_import.Invoice_Number as sale_id
,sum(sale_import.Quantity) as qty
	 ,sum(sale_import.Total) as total_amt
	 ,products.Product_ID
   ,products.Product_Name
   ,customer_import.village as `address`
   ,customer_import.outlet_name as customer_name
   ,customer_import.phone_number as phone
   ,customer_import.outlet_name as fname
   ,customer_import.external_id as customer_id
   ,sale_import.Invoiced_Date as sale_date


		   FROM  sale_import 
		  LEFT JOIN products ON products.Product_ID = sale_import.Product_SKU 
      LEFT JOIN customer_import ON customer_import.external_id = sale_import.Outlet_External_ID
       
       
       where 1=1       $btw  $p_id   
	   group by sale_import.Invoice_Number   order by sale_import.Invoice_Number 

        
        ) as tb_a
        /*
         where  payment < total_amt  
	   */
	   
	          ");
		 
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
    <td width="300px" align="center"><h6>ລາຍການໃບບິນຂາຍຕິດໜີ້</h6><br><h7>ປະຈຳວັນທີ &nbsp;<?php $date=date_create("$from_date");
echo date_format($date,"d/m/Y"); ?> &nbsp; - &nbsp; <?php $date=date_create("$to_date");
echo date_format($date,"d/m/Y"); ?> </h7>
</td>
    <td width="200px" align="center"><h6>&nbsp;&nbsp;</h6></td>
    </tr>
  </table>
  <?php
 	if($summary=='1'){	
   ?>
        
 		<table border="1"   class="table-bordered " align="center" >
              <tr> 
              
              <th align="center">ລູກຄ້າ</th>
      
				<th align="center">ສາງ</th>
               
                <th align="center">ເລກທີບິນ</th>
               
              <th align="center">ມູນຄ່າລວມ</th>
               <th align="center">ມູນຄ່າຊຳລະ</th>
               <th align="center">ມູນຄ່າຍັງເຫຼືອ</th>
               
             
              </tr>
           <?php
		
            while($s=mysqli_fetch_array($sp)){
          
			?>	<tr>
               <td><?=$s["customer_id"];?>&nbsp;<?=$s["customer_name"];?></td>
			  
				<td><?=$s["stock_id"];?>&nbsp;<?=$s["stock_name"];?></td>
            	
               
            	<td align="center"><?= $s["sale_id"];?></td>
                <td align="right"><?=@number_format($s["total_amt"],2);?></td>
				<td align="right"><?=@number_format($s["payment"],2);?></td>
              <td align="right"><?=@number_format($s["total_amt"]-$s["payment"],2);?></td>
             
             
				</tr>
               
			<?php	
				@$t_amt +=$s["total_amt"];
				@$t_payment +=$s["payment"];
				@$t_debit +=$s["total_amt"]-$s["payment"];
             } ?>
             <td colspan="3" align="right">ລວມ</td>
             <td colspan="1" align="right"><?=@number_format($t_amt,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_payment,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_debit,2);?></td>
             
             
       </table>
       
		  
        <?php  
}
elseif($summary=='2'){
		  
?>
        
 		<table border="1"   class="table-bordered " align="center" >
              <tr> 
              
              <th align="center">ລູກຄ້າ</th>      
			  <th align="center">ສາງ</th>               
              <th align="center">ບິນ</th>
              <th align="center">ລາຍການ</th>
              <th align="center">ລາຄາ</th>
               <th align="center">ຈຳນວນ</th>
               <th align="center">ມູນຄ່າ</th>
               <th align="center">ມູນຄ່າຊຳລະ</th>
                <th align="center">ຍັງເຫລືອ</th>
               
             
              </tr>
           <?php
		/*   
"
     select * from (   
    
       SELECT product_sale.*,stocks.stock_name
       ,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,sum(product_sale.amount) as total_amt,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       where 1=1       $btw  $c_id   
	   group by product_sale.sale_id   order by product_sale.sale_id 
     
        
        ) as tb_a where  payment < total_amt 
	  
	   
	          "
*/

		   		  @$sql_head=mysqli_query($con,"SELECT * from (   
    
       SELECT 
sale_import.*
,sale_import.Invoice_Number as sale_id
,sum(sale_import.Quantity) as qty
	 ,sum(sale_import.Total) as total_amt
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
       
       
       where 1=1       $btw  $p_id   
	   group by sale_import.Invoice_Number   order by sale_import.Invoice_Number 
     
        
        ) as tb_a 
        /*
        where  payment < total_amt 
	  */
	          ");
			  
		 
			 
		while($fh=mysqli_fetch_array($sql_head)){
			?>
			<tr>
                <td colspan="3" align="right"><?=@$fh["sale_id"];?></td>
                <td colspan="3" align="center">ລວມ</td>
               <td align="right"><?=@number_format($fh["total_amt"],2);?></td>
               <td align="right"><?=@number_format($fh["payment"],2);?></td>
                <td align="right"><?=@number_format($fh["total_amt"]-$fh["payment"],2);?></td>
              
              
               </tr>
            <?php
/*
"
     SELECT product_sale.*,stocks.stock_name
       ,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,product_sale.amount,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       where 1=1    and  product_sale.sale_id='$fh[sale_id]' order by Id
	  
	   
	          "
            */


			   @$sql_body=mysqli_query($con,"SELECT sale_import.*,
      products.Product_Name,
			sale_import.amount,
      customer_import.outlet_name as customer_name
		   FROM  sale_import 
		  LEFT JOIN products ON products.Product_ID = sale_import.Product_SKU 
      LEFT JOIN customer_import ON customer_import.external_id = sale_import.Outlet_External_ID
       

       
       where 1=1    and  sale_import.Invoice_Number='$fh[sale_id]' order by Id
	  
	   
	          ");
		 
         
            while($s=mysqli_fetch_array($sql_body)){
          
			?>	<tr>
               <td><?=$s["customer_id"];?>&nbsp;<?=$s["customer_name"];?></td>
			  
				<td><?=$s["stock_id"];?>&nbsp;<?=$s["stock_name"];?></td>
            	
               
            	<td align="center"><?= $s["sale_id"];?></td>
                <td align="left"><?=$s["Product_Name"];?></td>
                <td align="right"><?=@number_format($s["price"],2);?></td>
				<td align="right"><?=@number_format($s["qty"],2);?></td>
               <td align="right"><?=@number_format($s["amount"],2);?></td>
               <td colspan="1"></td>
                <td></td>
              
             
				</tr>
               
			<?php	
				
             } 
			 
			    @$tt_amt +=$fh["total_amt"];
				@$tt_payment +=$fh["payment"];
				@$ttt_ap +=$fh["total_amt"]-$fh["payment"];
			  }
			  ?>
             <td colspan="6" align="right">ລວມ</td>
             <td colspan="1" align="right"><?=@number_format($tt_amt,2);?></td>
             <td colspan="1" align="right"><?=@number_format($tt_payment,2);?></td>
             <td colspan="1" align="right"><?=@number_format($ttt_ap,2);?></td>
             
             
             
       </table>
       
		  
        <?php  } 

else{} 
  ?>
       
	</body>	  
       