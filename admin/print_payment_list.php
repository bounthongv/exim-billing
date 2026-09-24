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
  
    /*
         @$stock_id= mysqli_real_escape_string($con,$_GET['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and product_sale.stock_id='$stock_id'  ";}
		 */
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_GET['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_GET['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="and payment_2.pay_date='$today'";} 
		  else{ $btw="and payment_2.pay_date between '$from_date' and '$to_date' ";}
		  
 
           @$pay_id= mysqli_real_escape_string($con,$_GET['pay_id']);		   
		 if($pay_id==''){$p_id="";}  else{ $p_id="and  payment_2.pay_id='$pay_id' ";}
		 

        @$sale_id= mysqli_real_escape_string($con,$_GET['sale_id']);		   
		 if($sale_id==''){$s_id="";}  else{ $s_id="and  payment_2.sale_id='$sale_id' ";}
		 
		    /*
       "select payment.*,customers.customer_name ,customers.customer_id
           from payment
	  left join product_sale on payment.sale_id=product_sale.sale_id
	        left join customers on product_sale.customer_id=customers.customer_id
	   where 1=1 $btw $r_id $s_id";
*/
		  


		  @$sp=mysqli_query($con,"SELECT *,sum(amount)as amount,count(sale_id) as sale_id,tb_bank.Bank_Name FROM payment_2
LEFT JOIN tb_bank ON payment_2.Bank_account = tb_bank.Bank_account
  WHERE 1=1 $btw $p_id $s_id
  group by payment_2.pay_id");
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
    <td width="300px" align="center"><h6>ລາຍການມອບເງິນສົດ</h6><br><h7>ປະຈຳວັນທີ &nbsp;<?php $date=date_create("$from_date");
echo date_format($date,"d/m/Y"); ?> &nbsp; - &nbsp; <?php $date=date_create("$to_date");
echo date_format($date,"d/m/Y"); ?> </h7>
</td>
    <td width="200px" align="center"><h6>&nbsp;&nbsp;</h6></td>
    </tr>
  </table>
 		<table border="1"  align="center"   class="table-bordered " width="800px" >
              <tr>
                  <th align="center">ລ/ດ</th>
                	 <th align="center">ເລກທີມອບ</th>
                     <th align="center">ວັນທີມອບ</th>
                    <th align="center">ຈຳນວນ</th>
                  
					<th align="center">ທະນາຄານ</th>
			       
					 
                    <th align="center" >ຈຳນວນເງີນ</th>
               
          
             
              </tr>
           <?php

$e_list=0;       
            while($s=mysqli_fetch_array($sp)){

$e_list++;

		        $date1=$s["sale_date"];
				$date1=date_create($date1);

                $pay_date=$s["pay_date"];
				$pay_date=date_create($pay_date);

			?>	<tr>
                   <td align="center"><?=$e_list;?></td>

<td align="center"><?=$s["pay_id"];?></td>

				 <td align="center"><?php if($s["pay_date"]==''){echo '';}else{echo date_format($pay_date,"d/m/Y");} ?></td>
                <td align="center"><?=$s["sale_id"];?></td>
				
			            
				<td align="center"><?=$s["customer_name"].' '.$s["Bank_Name"];?></td>
	
            	<td align="right"><?=@number_format($s["amount"],0);?></td>

             
            
             
				</tr>
               
			<?php	
            @$t_sale_id +=$s["sale_id"];
				@$t_amt +=$s["amount"];
             } ?>
             <td colspan="3" align="right">ລວມ</td>
             <td colspan="1" align="center"><?=@number_format($t_sale_id,0);?></td>
             <td colspan="1" align="right"></td>
             <td colspan="1" align="right"><?=@number_format($t_amt,0);?></td>
         
             
             
       </table>
       
		  
        <?php  } 


 
 
 ?>
