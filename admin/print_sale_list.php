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
         if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today'";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  
 
           @$sale_id= mysqli_real_escape_string($con,$_GET['sale_id']);		   
		 if($sale_id==''){$r_id="";}  else{ $r_id="and  product_sale.sale_id='$sale_id' ";}
		 
		 

		  
		  @$sp=mysqli_query($con,"
  		select product_sale.*,sum(product_sale.total_amt) as t_total_amt,count(product_sale.total_qty) as total_item
		,sum(product_sale.amount) as total_amt,sum(product_sale.discount) as total_dis  from 	  
   (SELECT product_sale.*,sum(product_sale.amount) as total_amt,sum(product_sale.qty) as total_qty
   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	   left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       where 1=1   $s_id $btw $r_id
         group by product_sale.sale_id,product_sale.product_id ) 
       as product_sale
          
	   group by product_sale.sale_id order by product_sale.sale_id 
	  
	   
	          ");
		  if($sp){
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
    <td width="300px" align="center"><h6>ລາຍການຂາຍສິນຄ້າ</h6><br><h7>ປະຈຳວັນທີ &nbsp;<?php $date=date_create("$from_date");
echo date_format($date,"d/m/Y"); ?> &nbsp; - &nbsp; <?php $date=date_create("$to_date");
echo date_format($date,"d/m/Y"); ?> </h7>
</td>
    <td width="200px" align="center"><h6>&nbsp;&nbsp;</h6></td>
    </tr>
  </table>
 		<table border="1"  align="center"   class="table-bordered " width="800px" >
              <tr>
                <th align="center">ເລກທີ</th>
                <th align="center">ເລກທີອ້າງອີງ</th>
                <th align="center">ວັນທີ</th>
				<th align="center">ສາງ</th>
                <th align="center">ລູກຄ້າ</th>
               
                <th align="center">ຈຳນວນລາຍການ</th>
              <th align="center">ມູນຄ່າລວມ</th>
              <th align="center">ສ່ວນຫຼູດ</th>
              <th align="center">ມູນຄ່າສູດທິ</th>
               <th align="center">ມູນຄ່າຊຳລະ</th>
               
              </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[sale_date]");
			?>	<tr>
			   <td align="center"><?=$s["sale_id"];?></td> 
                <td><?=$s["refer_no"];?></td>
				<td align="center"><?=date_format($dd,"d-m-Y");?></td>
				<td><?=$s["stock_id"];?>&nbsp;<?=$s["stock_name"];?></td>
            	<td><?=$s["customer_id"];?>&nbsp;<?=$s["customer_name"];?></td>
               
            	<td align="center"><?= $s["total_item"];?></td>
                <td align="right"><?=@number_format($s["t_total_amt"],2);?></td>
                <td align="right"><?=@number_format($s["total_dis"]+$s["bill_discount"],2);?></td>
                 <td align="right"><?=@number_format($s["total"],2);?></td>
				<td align="right"><?=@number_format($s["payment"],2);?></td>
              
             
				</tr>
               
			<?php	
				@$t_amt +=$s["t_total_amt"];
				@$t_payment +=$s["payment"];
				@$total_dis +=$s["total_dis"]+$s["bill_discount"];
				@$totals +=$s["total"];
             } ?>
             <td colspan="6" align="right">ລວມ</td>
             <td colspan="1" align="right"><?=@number_format($t_amt,2);?></td>
               <td colspan="1" align="right"><?=@number_format($total_dis,2);?></td>
             <td colspan="1" align="right"><?=@number_format($totals,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_payment,2);?></td>
           
             
       </table>
       
		  
        <?php  } 


 
 
 ?>
