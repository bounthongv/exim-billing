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

  


<style>
#search{border:1px solid #008000; border-radius:4px; background-color:#008000; padding:5px; color:#FFF; font-family:"Phetsarath OT";}

input{padding:4px; border:1px solid #D8D8D8; border-radius:4px;}


</style>
<style>
td{ padding:10px;
font-weight:!important;
height:20px;
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
 }

</style>
 <style type="text/css">
    @import url("LAOS/stylesheet.css");
body,td,th ,h1,h2,h3,h4,h6,small,input[type='button'],input[type='text'],input[type='submit'], a{
	font-family: LAOS;


}
.ui-autocomplete { font-family:"Phetsarath OT";}
	
</style>
<body onLoad="print()">
<?php
   
       @$stock_id= mysqli_real_escape_string($con,$_GET['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and quotation_transfer.stock_id='$stock_id'  ";}
		 
       
		  
		   @$from_date= mysqli_real_escape_string($con,$_GET['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_GET['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and quotation_transfer.transfer_date between '$from_date' and '$to_date' ";}
		  
 
           @$transfer_id= mysqli_real_escape_string($con,$_GET['transfer_id']);		   
		 if($transfer_id==''){$r_id="";}  else{ $r_id="and  quotation_transfer.transfer_id='$transfer_id' ";}
		 
		 

		  
		  @$sp=mysqli_query($con,"
   SELECT quotation_transfer.*,
         sum(quotation_transfer.qty) as q_qty,
         stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version
		   FROM  quotation_transfer 
		   left join products on products.Product_ID=quotation_transfer.product_id
       left join stocks on stocks.stock_id=quotation_transfer.stock_id	
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       
       where      quotation_transfer.qty>0  $btw $r_id $s_id
	    group by  products.Product_ID
	   order by quotation_transfer.product_id  

	          ");
		  if($sp){
          
          ?>
           <?php  $sql_office = mysqli_query($con," select * from office order by Id desc limit 1");  
	 $r=mysqli_fetch_array($sql_office);
	 ?>
            <table width="800px"  align="center" >
    <tr>
    <td width="200px"><img src="<?php echo $r['path'];?>" class="img-rounded" alt="Cinque Terre" width="80" height="50"> 
    <p><?php echo $r['office_name'];?></p>
    </td>
    <td width="300px" align="center"><h6>ລາຍງານສັງລວມໃບສະເໜີເບີກເຄື່ອງ</h6><br><h7>ປະຈຳວັນທີ &nbsp;<?php $date=date_create("$from_date");
echo date_format($date,"d/m/Y"); ?> &nbsp; - &nbsp; <?php $date=date_create("$to_date");
echo date_format($date,"d/m/Y"); ?> </h7>
</td>
    <td width="200px" align="center"><h6>&nbsp;&nbsp;</h6></td>
    </tr>
  </table>
 		<table border="1"  align="center"  class="table-bordered " >
              <tr>
                 <th align="center">ລ/ດ</th>
			       <th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
					<th align="center">ສາງ</th>
					<th align="center">ລະຫັດສິນຄ້າ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>  
					 <th align="center" >ຫົວຫນ່ວຍ</th>
                   
                    <th align="center" >ຈຳນວນ</th>
              </tr>
           <?php
		   $i=1;
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[transfer_date]");
			?>
            
            
            	<tr>
			
			  <td align="center"><?php echo $i; ?></td>
			 <td><?php echo $s["transfer_id"]; ?></td>
				<td><?php echo $s["transfer_date"]; ?></td>
				<td><?php echo $s["stock_id"]; ?></td>
            	<td><?php echo $s["Product_ID"]; ?></td>
                <td><?php echo$s["Product_Name"]; ?></td>
            	<td align="center"><?php echo $s["Unit"]; ?></td>				
               
				<td align="right"><?php echo $s["q_qty"]; ?> </td>
				</tr>
               <?php
			$i++;	
				
				
             } 
       ?>  </table><?php
		  
          } 

 
 ?>
</body>