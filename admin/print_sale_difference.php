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
         if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today' ";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  
		  
		  
 
           @$product_id= mysqli_real_escape_string($con,$_GET['product_id']);		   
		 if($product_id==''){$p_id="";}  else{ $p_id="and  product_sale.product_id='$product_id' ";}
		 
		  @$group_id= mysqli_real_escape_string($con,$_GET['group_id']);		   
		 if($group_id==''){$g_id="";}  else{ $g_id="and  tb_groups.Group_ID='$group_id' ";}
		 
		  @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);	
         if($sale_id==''){$sa_id="";}  else{ $sa_id="and product_sale.sale_id='$sale_id'  ";}
		 
		  @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);	
         if($customer_id==''){$c_id="";}  else{ $c_id="and product_sale.customer_id='$customer_id'  ";}
		 
		  @$user_id= mysqli_real_escape_string($con,$_POST['user_id']);	
         if($user_id==''){$u_id="";}  else{ $u_id="and product_sale.user_id='$user_id'  ";}
		 
		 
		  @$sql_g=mysqli_query($con,"SELECT product_sale.*,sum(product_sale.amount) as t_amount
		  ,sum(product_sale.qty*stock_product.price) as tt_amount,sum(discount) as discount,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
		,tb_groups.Group_ID,tb_groups.Group_Name,products.version,stock_product.price as t_price
		   FROM  product_sale 
	   left join products on products.Product_ID=product_sale.product_id
	   left join stock_product on stock_product.product_id=product_sale.product_id 
	            and stock_product.product_lot_id=product_sale.product_lot_id and  stock_product.stock_id=product_sale.stock_id 
       left join stocks on stocks.stock_id=product_sale.stock_id	  
       left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       where 1=1 $btw $s_id  $p_id $g_id $sa_id $c_id $u_id  group by tb_groups.Group_ID ");

		  
		  
		 
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
    <td width="300px" align="center"><h6>ລາຍງານຜິດດ່ຽງຕົ້ນທືນຂາຍ</h6><br><h7>ປະຈຳວັນທີ &nbsp;<?php $date=date_create("$from_date");
echo date_format($date,"d/m/Y"); ?> &nbsp; - &nbsp; <?php $date=date_create("$to_date");
echo date_format($date,"d/m/Y"); ?> </h7>
</td>
    <td width="200px" align="center"><h6>&nbsp;&nbsp;</h6></td>
    </tr>
  </table>
 		<table border="1"  align="center"   class="table-bordered " width="800px" >
              <tr>
                <th align="center">ລຳດັບ</th>
                <th align="center">ສາງ</th>
                <th align="center">ລະຫັດສິນຄ້າ</th>
                <th align="center">ຊື່ສິນຄ້າ</th>
                <th align="center">ຫົວໜ່ວຍ</th>
				<th align="center">ຈຳນວນ</th>
                <th align="center">ຕົ້ນທືນ</th>
                <th align="center">ມູນຄ່າຕົ້ນທືນ</th>
               
                <th align="center">ລາຄາຂາຍ</th>
                <th align="center">ມູນຄ່າຂາຍ</th>
                <th align="center">ສ່ວນຫລູດ</th>
                <th align="center">ມູນຄ່າຂາຍສຸດທິ</th>
                <th align="center">ມູນຄ່າທຽບຕົ້ນທືນຂາຍ</th>
                 
              </tr>
           <?php
		   $i=1;
            while($g=mysqli_fetch_array($sql_g)){
				
				
				@$sql_d=mysqli_query($con,"
  
	   
	        SELECT  product_sale.* ,sum(product_sale.qty) as tt_qty,sum(product_sale.amount) as tt_amount, stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version , stock_product.price as t_price
		   FROM  product_sale
        
     left join stock_product on stock_product.stock_id=product_sale.stock_id and stock_product.product_lot_id=product_sale.product_lot_id
	   left join products on products.Product_ID=product_sale.product_id	     
     left join stocks   on stocks.stock_id=product_sale.stock_id
     left join tb_groups   on tb_groups.Group_ID=products.group_id 
	  
	  where 1=1 and tb_groups.Group_ID='$g[Group_ID]' $s_id $p_id  $btw $sa_id $c_id $u_id 
	  group by product_sale.product_id,product_sale.product_lot_id
	   order by product_sale.product_id
	   
	          ");
			  ?>
			 
             
            <td colspan='7'><?php  echo $g['Group_ID'];?> &nbsp; <?php echo  $g['Product_Name'];?></td>
			 <td colspan='1' align="right"><?php echo  @number_format($g['tt_amount'],2);?></td>             <td colspan='1'></td>
              <td colspan='1' align="right"><?php echo  @number_format($g['t_amount'],2);?></td>
              
             <td colspan='1' align="right"><?php echo  @number_format($g['discount'],2);?></td>
             <td colspan='1' align="right"><?php echo  @number_format($g['t_amount']-$g['discount'],2);?></td>
             <td colspan='1' align="right"><?php echo  @number_format($g['t_amount']-$g['tt_amount']-$g['discount'],2);?></td>
			<?  
			 while($s=mysqli_fetch_array($sql_d)){
			?>	<tr>
                <td align="center"><?=$i;?></td>
                 <td align="center"><?=$s["stock_id"];?></td> 
			    <td align="center"><?=$s["product_lot_id"];?></td> 
                <td align="left"><?=$s["Product_Name"];?></td>
				<td align="center"><?=$s["Unit"];?></td>
                <td align="center"><?=$s["tt_qty"];?></td>
                <td align="right"><?=@number_format($s["t_price"],2);?></td>
                
                <td align="right"><?=@number_format($s["tt_qty"]*$s["t_price"],2);?></td>
                <td align="right"><?=@number_format($s["price"],2);?></td>
                <td align="right"><?=@number_format($s["tt_amount"],2);?></td>
                
				<td align="right" ><?=@number_format($s["discount"],2);?></td>
            	<td align="right"><?=@number_format($s["tt_qty"]*$s["price"]-$s["discount"],2);?></td>
                <td align="right"><?=@number_format($s["tt_amount"]-($s["tt_qty"]*$s["t_price"]),2);?></td>
                
				</tr>
               
			<?php	
		
			$i++;
             } 
			 @$tt_t_amount +=$g['tt_amount'];
			 @$tt_amount +=$g['t_amount'];
			 @$t_discount +=$g['discount'];
			 @$t_ad +=$g['t_amount']-$g['discount'];
			  @$tt_ad +=$g['t_amount']-$g['tt_amount']-$g['discount'];
			 }
			  ?>
              <tr>
             <td colspan="7" align="right">ລວມຍອດ</td>
             <td colspan="1" align="right"><?=@number_format($tt_t_amount,2);?></td>
             <td colspan="1" align="right"></td>
             <td colspan="1" align="right"><?=@number_format($tt_amount,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_discount,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_ad,2);?></td>
             <td colspan="1" align="right"><?=@number_format($tt_ad,2);?></td>
            
             </tr> 
       </table>
       <br><br>
     <table align="center"  width="800px">
     <tr >
     <td align="center"><?php echo $r['signature1'] ?><td>
     <td align="center"><?php echo $r['signature2'] ?><td>
     <td align="center"><?php echo $r['signature3'] ?><td>
     <td align="center"><?php echo $r['signature4'] ?><td>
     </td>
     </table>  
</body>		  
        <?php  


			
 
 ?>
