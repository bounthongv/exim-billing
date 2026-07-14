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
<body onLoad="print()">
<?php 

    
   
     
		 
       @$select_mode= mysqli_real_escape_string($con,$_GET['select_mode']);
	   
	   
		  
		   @$from_date= mysqli_real_escape_string($con,$_GET['from_date']);	
		     @$to_date= mysqli_real_escape_string($con,$_GET['to_date']);	
		   $today=date("Y-m-d");
		   
         if($from_date=='' or $to_date==''){$btw="and customer_payment.payment_date='$today'";} 
		  else{ $btw="and customer_payment.payment_date between '$from_date' and '$to_date' ";}
		  
 
  @$sale_id= mysqli_real_escape_string($con,$_GET['sale_id']);		   
 if($sale_id==''){$r_id="";}  else{ $r_id="and ( customer_payment.payment_id like '$sale_id%' or customer_payment.payment_id like '%$sale_id%') ";}
		 
	 @$payment_type= mysqli_real_escape_string($con,$_GET['payment_type']);		   
    if($payment_type==''){$pt="";}  else{ $pt="and  customer_payment.payment_type='$payment_type'  ";}
		
		 
	
		 
		   @$customer_id= mysqli_real_escape_string($con,$_GET['customer_id']);	
         if($customer_id==''){$c_id="";}  else{ $c_id="and ( customer_payment.customer_id like '$customer_id%' 
		 or customer_payment.customer_id like '%$customer_id%' or customers.customer_name like '$customer_id%'
		 or customers.customer_name like '%$customer_id%')  ";}


if($select_mode=='1'){
		  
  @$sp=mysqli_query($con,"
       
         select customer_payment.* ,customers.customer_name
		 from  customer_payment
		 left join customers on customer_payment.customer_id=customers.customer_id
		 
		 where 1=1 $btw $r_id $c_id $pt
		 
		 
	   
	          ");
		  if($sp){
          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                    <th align="center">ລ/ດ</th>
                	<th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
                    <th align="center">ເລກທີຂາຍ</th>
					<th align="center">ວັນທີຂາຍ</th>
                  
					<th align="center">ຊື່ລູກຄ້າ</th> 
                    <th align="center">ປະເພດຊຳລະ</th>              
					 
                    <th align="center" >ຈຳນວນເງີນ</th>
                 
                    
                </tr>
           <?php
		   
		   $e_list=0;
            while($s=mysqli_fetch_array($sp)){
				
				$e_list++;
				
				$date1=$s["sale_date"];
				$date1=date_create($date1);
				
				$date2=$s["payment_date"];
				$date2=date_create($date2);
            
			?>
            	<tr>
                <td align="center"><?=$e_list;?></td>
			    <td align="center"><?=$s["payment_id"];?></td>
				<td align="center"><?php if($s["payment_date"]==''){}else{
				echo	date_format($date2,"d/m/Y");
					}?></td>
                <td align="center"><?=$s["sale_id"];?></td>
				<td align="center"><?php if($s["sale_date"]==''){}else{
				echo	date_format($date1,"d/m/Y");
					}?></td>               
				<td><?=$s["customer_name"];?></td>
                 <td align="center"><?php 
				 if($s["payment_type"]=='1'){ echo "ເງີນສົດ";}
				 elseif($s["payment_type"]=='1'){ echo "ເງີນໂອນ";}else{}  ?></td>
            	<td align="right"><?=@number_format($s["amount"],0);?></td>
                
            	
				
				</tr>
              <?php
          
		   @$t_amt +=$s["amount"];
		 
             } 
			 ?>
			<tr>
			<td align="right" colspan="7">ລວມ</td>
            <td align="right"><?= @number_format($t_amt,0);?></td>
           
           
			
        </table>
		  
        <?php }
      }
		elseif($select_mode=='2'){ 
		
		  @$sp=mysqli_query($con,"
       
         select customer_payment.* ,customers.customer_name
		 from  customer_payment
		 left join customers on customer_payment.customer_id=customers.customer_id
		 
		 where 1=1 $btw $r_id $c_id $pt
		 
		 group by customer_payment.payment_id
		 
		 
	   
	          ");
		  if($sp){
          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                    <th align="center">ລ/ດ</th>
                	<th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
                  
					<th align="center">ຊື່ລູກຄ້າ</th>              
					 
                    <th align="center" >ຈຳນວນເງີນ</th>
                 
                    
                </tr>
           <?php
		   
		   $e_list=0;
            while($s=mysqli_fetch_array($sp)){
				
				$e_list++;
            
			?>
            	<tr>
                <td align="center"><?=$e_list;?></td>
			    <td align="center"><?=$s["payment_id"];?></td>
				<td align="center"><?=$s["payment_date"];?></td>               
				<td align="center"><?=$s["customer_name"];?></td>
            	<td align="right"><?=@number_format($s["total_amount"],0);?></td>
                
            	
				
				</tr>
              <?php
          
		   @$t_amt +=$s["total_amount"];
		 
             } 
			 ?>
			<tr>
			<td align="right" colspan="4">ລວມ</td>
            <td align="right"><?= @number_format($t_amt,0);?></td>
           
           
			
        </table>
		
	<?php	
		  }
	     }else{}
		
		
		

 
 ?>
 <br /> <br /> <br />
