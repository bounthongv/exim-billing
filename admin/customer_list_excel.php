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
  
  
       
		 

		  @$c_id= mysqli_real_escape_string($con,$_GET['c_id']);		   
		  if($c_id==''){$p_id="";}  else{ $p_id="and (customers.customer_id like '$c_id%' or customers.customer_id like '%$c_id%') ";}
		  
		  		  @$c_name= mysqli_real_escape_string($con,$_GET['c_name']);		   
		  if($c_name==''){$s_name="";}  else{ $s_name="and (customers.customer_name like '$c_name%' or customers.customer_name like '%$c_name%') ";}
		  
		 
		   @$c_type= mysqli_real_escape_string($con,$_GET['c_type']);	
         if($c_type==''){$ct="";}  else{ $ct="and customer_type like '$c_type%'  ";}
		 
		  @$c_village= mysqli_real_escape_string($con,$_GET['c_v']);	
         if($c_village==''){$cv="";}  else{ $cv="and (village like '$c_village%'  or village like '%$c_village%' )";}
		 
		 
		  @$c_district= mysqli_real_escape_string($con,$_GET['c_d']);	
         if($c_district==''){$cd="";}  else{ $cd="and (district like '$c_district%'  or district like '%$c_district%' )";}
		 
		 
		 @$limit_row= mysqli_real_escape_string($con,$_GET['limit_row']);	
         if($limit_row==''){$lmr="limit 500";}  else{ $lmr="limit $limit_row";}
		 
    
		
          
         ?>
         
 			<table id="example" border="1"  class="table table-bordered" >
			 <thead>
              <tr class="bgtd">
		<td align="center"><strong>No</strong></td>
        <td align="center"><strong>Code</strong></td>
    	<td><strong>ຊື່ ລູກຄ້າ </strong></td>     
		<td><strong>ປະເພດ</strong></td>       
        <td><strong>ບ້ານ</strong></td>
		<td><strong>ເມືອງ</strong></td>
        <td><strong>Tel</strong></td>
        <td><strong>sr</strong></td>
        <td><strong>segment</strong></td>
		 <td><strong>Grade</strong></td>
		  <td><strong>UP</strong></td>
		  <td><strong>Brand</strong></td>
		  <td><strong>Class</strong></td>
     
	  <td><strong>ເສັ້ນທາງ</strong></td> 
       <td><strong>ເພດານໜີ້</strong></td> 
        <td><strong>ຍອດໜີ້</strong></td> 
       
		
              </tr>
			   </thead>
			   <tbody>
          <?php
		   
		   $row_list=0;
		   
   
		  @$sp=mysqli_query($con,"  SELECT customers.*,customer_type.ct_id,customer_type.ct_name,routes.route_name
		  ,sr_list.sr_fname,sr_list.sr_lname
		   FROM  customers 
		   left join customer_type on customer_type.ct_id=customers.customer_type
		   left join routes on customers.route_id=routes.route_id
		   
		     left join sr_list on customers.sr=sr_list.sr_id
		   
		   
		   where 1=1 $s_name $p_id $ct $cv $cd order by customers.customer_id $lmr
		    ");
            while($f=mysqli_fetch_array($sp)){
            $row_list++;
			?>
		 		<tr>
				<td align="center"><?php echo $row_list; ?></td>
				<td align="center"><?php echo $f['customer_id']; ?></td>
    	        <td><?php echo  $f['customer_name']; ?></td>     
				<td><?php echo  $f['ct_name']; ?></td>      	
        		<td><?php echo  $f['village']; ?></td>
				<td><?php echo  $f['district']; ?></td>
        		<td><?php echo  $f['phone']; ?></td>
        		<td><?php echo  $f['sr_fname']; ?> <?php echo  $f['sr_lname']; ?></td>
        		<td><?php echo  $f['segment']; ?></td>
				<td><?php echo  $f['grade']; ?></td>
				<td><?php echo  $f['up']; ?></td>
				<td><?php echo  $f['brand']; ?></td>
				<td><?php echo  $f['class']; ?></td>
				
        		
				<td><?php echo  $f['route_name']; ?></td> 
        		<td align="right"><?php echo  @number_format($f['debit_amt'],0); ?></td> 
                <td align="right"><?php echo  @number_format($f['total_debit_amt'],0); ?></td> 
				
				
				
			
				
				
				
				
      
				</tr>
             <?php
            	
             } 
       ?>   <tbody> 
       
       </table>
		  
   
		

