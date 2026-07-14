<?php 
include("init.php");

?>
<?php
 header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment;filename=Reporte.xls");

?>
<!DOCTYPE html>
<html lang="en">

<title>SPD</title>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>-->

<style type="text/css">

body,td,th ,h1,h2,h3,h4,h5,h6,h7,small,input[type='button'],input[type='text'],input[type='submit'], a{
	font-family: "Phetsarath OT";


}

	
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
  include("init.php");
    
   
       @$stock_id= mysqli_real_escape_string($con,$_GET['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_sale.stock_id='$stock_id'  ";}
		 
       
		   @$select_mode= mysqli_real_escape_string($con,$_GET['select_mode']);
	
		   @$from_date= mysqli_real_escape_string($con,$_GET['from_date']);	
		     @$to_date= mysqli_real_escape_string($con,$_GET['to_date']);	
		   $today=date("Y-m-d");
		   /*
         if($from_date=='' or $to_date==''){$btw="and product_sale.sale_date='$today'";} 
		  else{ $btw="and product_sale.sale_date between '$from_date' and '$to_date' ";}
		  */
   if($from_date=='' or $to_date==''){$btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' )='$to_date'";} 
		  else{ $btw="and DATE_FORMAT( STR_TO_DATE(Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d' ) between '$from_date' and '$to_date'";}



 
           @$sale_id= mysqli_real_escape_string($con,$_GET['sale_id']);		   
		 if($sale_id==''){$r_id="";}  else{ $r_id="and ( product_sale.sale_id like '$sale_id%' or product_sale.sale_id like '%$sale_id%') ";}
		 


		 
		  @$group_id= mysqli_real_escape_string($con,$_GET['group_id']);	
         if($group_id==''){$g_id="";}  else{ $g_id="and products.Group_ID='$group_id'  ";}
		 
		 
		  @$product_id= mysqli_real_escape_string($con,$_GET['product_id']);	
/*
         if($product_id==''){$p_id="";}  else{ $p_id="and (product_sale.product_id like '$product_id%'  )";}
		 */
		 
		  if($product_id==''){$p_id="";}  else{ $p_id="and  sale_import.Product_SKU like '$product_id' ";}



		 @$user_id= mysqli_real_escape_string($con,$_POST['user_id']);	
         if($user_id==''){$u_id="";}  else{ $u_id="and (product_customer_order.user_id like '$user_id%'  )";}
		 
		 @$sr_id= mysqli_real_escape_string($con,$_POST['sr_id']);	
         if($sr_id==''){$sro_id="";}  else{ $sro_id="and (product_sale.sr like '$sr_id%'  )";}
		 
		 
		   @$customer_id= mysqli_real_escape_string($con,$_GET['customer_id']);	
         if($customer_id==''){$c_id="";}  else{ $c_id="and ( product_sale.customer_id like '$customer_id%' 
		 or product_sale.customer_id like '%$customer_id%' or customers.customer_name like '$customer_id%'
		 or customers.customer_name like '%$customer_id%')  ";}

		  
if($select_mode=='1'){
		  
  @$sp=mysqli_query($con,"
         SELECT product_sale.* ,stocks.stock_name,products.Product_ID
	   ,products.Product_Name,products.size,products.Unit ,customers.customer_name
			,tb_groups.Group_Name,products.version
			,sum(product_sale.qty) as t_qty
            ,sum(product_sale.amount) as t_amount
		   FROM  product_sale 
	
	left join products on products.Product_ID=product_sale.product_id
    left join stocks on stocks.stock_id=product_sale.stock_id
	left join customers on product_sale.customer_id=customers.customer_id
    left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       
     where 1=1 $btw  $s_id $r_id $c_id $p_id  $g_id 
	 group by product_sale.product_id,product_sale.sale_id
	order by  product_sale.sale_id,product_sale.product_id asc 
         
	   
	          ");
		  if($sp){
          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                	<th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
                    <th align="center">ຊື່ລູກຄ້າ</th>
					<th align="center">ລະຫັດສິນຄ້າ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>  
					 <th align="center" >ຫົວຫນ່ວຍ</th>
                    <th align="center" >ຈຳນວນ</th>
                    <th align="center" >ລາຄາ</th>
                   
                    <th align="center" >ມູນຄ່າ</th>
                  <!--  <th align="center" >ລັງເປົ່າ</th>
					<th align="center" >ມູນຄ່າລວມ</th>-->
                
                    
                </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            
			?>
            	<tr>
			    <td><?= $s["sale_id"];?></td>
				<td><?= $s["sale_date"];?></td>
                <td><?= $s["customer_name"];?></td>
				<td><?= $s["Product_ID"];?></td>
            	<td><?=$s["Product_Name"];?></td>
                
            	<td align="center"><?= $s["Unit"];?></td>				
                <td align="center"><?=@number_format($s["t_qty"],0);?> </td>
                
				<td align="right"><?=@number_format($s["price"],0);?> </td>
               
                <td align="right"><?php if($s["t_amount"]==0){ echo "Free";}else{ echo @number_format(($s["t_amount"]),0); } ?> </td>
              <!--  <td align="center"><?=@number_format($s["amount_crate"],0);?> </td>
                <td align="center"><?=@number_format($s["last_amount"],0);?> </td>-->
				
				</tr>
              <?php
           @$t_qty+=$s["t_qty"]; 
		   
		   @$t_amt +=$s["t_amount"];
		 //  @$t_dis += $s["discount"];
		   $t_amount_crate+= $s["amount_crate"];
		   @$t_last_amount += $s["last_amount"];
             } 
			 ?>
			<tr>
			<td align="right" colspan="6">ລວມ</td>
            <td align="center"><?= @number_format($t_qty,0);?></td>
             <td align="right"></td>
            <td align="right"><?= @number_format($t_amt,0);?></td>
           <!-- <td align="right"><?= @number_format($t_amount_crate,0);?></td>
            <td align="right"><?= @number_format($t_last_amount,0);?></td>-->
			</tr> 
           
			
        </table>
		  
        <?php }
      }
		elseif($select_mode=='2'){ 
		
		
		      @$sp=mysqli_query($con,"
       SELECT product_sale.* ,stocks.stock_name,products.Product_ID,sum(product_sale.qty) as qty
	   ,sum(product_sale.amount) as amount
	   ,products.Product_Name,products.size,products.Unit ,customers.customer_name
			,tb_groups.Group_Name,products.version
		   FROM  product_sale 
	
	left join products on products.Product_ID=product_sale.product_id
    left join stocks on stocks.stock_id=product_sale.stock_id
	  left join customers on product_sale.customer_id=customers.customer_id
    left join tb_groups on tb_groups.Group_ID=products.group_id 
       
       
     where 1=1 $btw  $s_id $r_id $c_id $p_id  $g_id 
	  group by product_sale.product_id,product_sale.price
	  order by  product_sale.sale_id, product_sale.product_id asc 
         
	   
	          ");
		  if($sp){
          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                	
					<th align="center">ລະຫັດສິນຄ້າ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>  
					 <th align="center" >ຫົວຫນ່ວຍ</th>
                    <th align="center" >ຈຳນວນ</th>
                    <th align="center" >ລາຄາ</th>
                   
                    <th align="center" >ມູນຄ່າ</th>
                  <!--  <th align="center" >ລັງເປົ່າ</th>
					<th align="center" >ມູນຄ່າລວມ</th>-->
                
                    
                </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            
			?>
            	<tr>
			   
				<td align="center"><?=$s["Product_ID"];?></td>
            	<td><?=$s["Product_Name"];?></td>
                
            	<td align="center"><?=$s["Unit"];?></td>				
                <td align="center"><?=@number_format($s["qty"],0);?> </td>
                
				<td align="right"><?=@number_format($s["price"],0);?> </td>
               
                <td align="right"><?php if($s["amount"]==0){ echo "Free";}else{ echo @number_format(($s["amount"]),0); } ?> </td>
              <!--  <td align="center"><?=@number_format($s["amount_crate"],0);?> </td>
                <td align="center"><?=@number_format($s["last_amount"],0);?> </td>-->
				
				</tr>
              <?php
           @$t_qty+=$s["qty"]; 
		   
		   @$t_amt +=$s["amount"];
		 //  @$t_dis += $s["discount"];
		   $t_amount_crate+=$s["amount_crate"];
		   @$t_last_amount+=$s["last_amount"];
             } 
			 ?>
			<tr>
			<td align="right" colspan="3">ລວມ</td>
            <td align="center"><?=@number_format($t_qty,0);?></td>
             <td align="right"></td>
            <td align="right"><?=@number_format($t_amt,0);?></td>
           <!-- <td align="right"><?=@number_format($t_amount_crate,0);?></td>
            <td align="right"><?=@number_format($t_last_amount,0);?></td>-->
			</tr> 
           
			
        </table>
		
	<?php }	
		  }
		elseif($select_mode=='3'){ 
		
		
		      @$sp=mysqli_query($con,"
         SELECT product_sale.* ,stocks.stock_name,products.Product_ID
	   ,sum(product_sale.qty) as t_qty
	   ,sum(product_sale.amount) as t_amount
	   
	   ,products.Product_Name,products.size,products.Unit ,customers.customer_name
	   ,tb_groups.Group_Name,products.version
	   ,sr_list.sr_fname,sr_list.sr_lname
	   ,users.fname
	   
		   FROM  product_sale 
	
	left join products on products.Product_ID=product_sale.product_id
  left join stocks on stocks.stock_id=product_sale.stock_id
	left join customers on product_sale.customer_id=customers.customer_id
  left join tb_groups on tb_groups.Group_ID=products.group_id 
    
	
	left join sr_list on product_sale.sr=sr_list.sr_id
	left join users on product_sale.user_id=users.User_ID
	
       
     where 1=1 $btw  $s_id $r_id $c_id $p_id  $g_id $u_id $sro_id
	 
	  group by product_sale.sale_id
	
	  order by product_sale.sale_id asc  
         
	   
	          ");
		  if($sp){
          ?>
        
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                	
					<th align="center">ເລກບິນ</th>
                    <th align="center">ວັນທີຂາຍ</th>
                    <th align="center">ຊື່ລູກຄ້າ</th> 					 
                    <th align="center" >ຈຳນວນເງີນ</th>
                    <th align="center" >ປະເພດການຂາຍ</th>                   
                    <th align="center" >ສະຖານະການຂາຍ</th>
                    <th align="center" >ຜູ້ເປີດຈ໊ອບ</th>
                    <th align="center" >ພ/ງ ຂາຍ</th>
				
                
                    
                </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            
			?>
            	<tr>
			    
				<td align="center"><?=$s["sale_id"];?></td>
            	<td><?=$s["sale_date"];?></td>
                
            	<td align="left"><?=$s["customer_name"];?></td>				
                <td align="right"><?=@number_format($s["t_amount"],0);?> </td>
                <td align="center"><?php
			   
			   if($s["status_payment"]=="2"){ ?>
				<button type="button" class="btn btn-success btn-sm">ສົດ</button>   
				<?php   }
				elseif($s["status_payment"]=="3"){ ?>
				<button type="button" class="btn btn-info btn-sm">ເງີນໂອນ</button>   
				<?php   }
			 
			   else{ ?>
				 <button type="button" class="btn btn-danger btn-sm">ຕິດໜີ້</button>   
				<?php   }
			   
			   ?></td>
                <td align="center"><?php
			   
			   if($s["status"]=="2"){ ?>
				<button type="button" class="btn btn-success btn-sm">ຈ່າຍແລ້ວ</button>   
				<?php   }
							 
			   else{ ?>
				 <button type="button" class="btn btn-danger btn-sm">ຕິດໜີ້</button>   
				<?php   }
			   
			   ?></td>
                <td><?=$s["fname"];?></td>
                <td><?=$s["sr_fname"];?>&nbsp;<?=$s["sr_lname"];?></td>
				
             
				
				</tr>
              <?php
           @$t_qty+=$s["t_qty"]; 
		   
		   @$t_amt +=$s["t_amount"];
		
		  
             } 
			 ?>
			<tr>
			<td align="right" colspan="3">ລວມ</td>
            <td align="right"><?=@number_format($t_amt,0);?></td>
             <td align="right" colspan="4"></td>
           
          
			</tr> 
           
			
        </table>
		
	<?php	
		  }
	     }else{}
		

 
 ?>
