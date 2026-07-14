<?php 
include("init.php");


	$customer_id = mysqli_real_escape_string($con,$_GET['customer_id']);
$sql_h = mysqli_query($con," SELECT * FROM customers where customer_id='$customer_id'");
              $ff = mysqli_fetch_array($sql_h);
/*
$from_date = mysqli_real_escape_string($con,$_GET['from_date']);
$to_date = mysqli_real_escape_string($con,$_GET['to_date']);
*/
//$Detailed = mysqli_real_escape_string($con,$_GET['Detailed']);


$month = mysqli_real_escape_string($con,$_GET['month']);
$year = mysqli_real_escape_string($con,$_GET['year']);

$date=date_create_from_format("Y",$year);
$y=date_format($date,"y");
/*
if($month=='' or $year==''){$btw="";} 
else{ $btw="and (month(sale_date)='$month' and year(sale_date)='$year')
";}
*/
?>





<!DOCTYPE html>
<html lang="en">


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

  

	</head>



<?php  include("header.php");?>
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
 .container_xx{ padding-left:20px;}
	
	
	
	.tableFixHead {
		overflow-y: auto;
		height: 500px;
	}

	.tableFixHead thead th {
		position: sticky;
		top: 0;
	}	
	

</style>
 <link rel="stylesheet" href="select2/select2.min.css">
<script src="select2/select2.full.min.js"></script>

<script>
$(document).on('click', '#print', function(){
	
   var customer_id = $('#customer_id').val();    

   var month = $('#month').val(); 
   var year = $('#year').val(); 

   
		var action = $(this).attr("value");


   // window.open('print_sale_list.php?stock_id='+stock_id + '&from_date='+from_date  + '&to_date='+to_date+' ','_blank'); 
   
 window.open('print_statement_customers_month.php?customer_id='+ customer_id +'&month='+ month +'&year='+ year +'','_blank'); 

	});


	$(document).on('click', '#print_excel', function(){
	
    var customer_id = $('#customer_id').val();    

var month = $('#month').val(); 
var year = $('#year').val(); 



   window.open('print_statement_customers_month_excel.php?customer_id='+customer_id +'&month='+month + '&year='+ year +'','_blank'); 


});

</script>


 <link rel="stylesheet" href="select2/select2.min.css">
<script src="select2/select2.full.min.js"></script>

<script>

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script> 



<div class="container">
    <br>
    <h3 align="center">Statement Customers Month</h3><br>
   </div>
    <!-- /.container -->  
    <form action="insert_statement_customer_month.php" method="post" onkeydown="return event.key != 'Enter';"  enctype="multipart/form-data" name="me">
<table>
       <tr>
       <!--
     <td> <br>  <a href="product_qty_list.php"> <button type="button" name="reset" value="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
       <td> <br><a href="add_sale_customer_order.php"  ><button type="button" class="btn btn-success" >
            <i class="fa fa-plus-square"></i>&nbsp; ຂາຍ</button></a></td>
            -->
        
         <?php   /*
         <td>ວັນທີ<br><input type="date" class="form-control" name="from_date" id="from_date" value="<?php 
		    if($from_date==''){
			  echo date("Y-m-d");
			  }else{
			echo $from_date; 
			  } ?>"></td> 
            
            <td>ຫາ<br><input type="date" class="form-control" name="to_date" id="to_date" value="<?php
			  if($to_date==''){
			  echo date("Y-m-d");
			  }else{
			echo $to_date; 
			  }
			  ?>"></td> 
       */?>
             
         <td>ລູກຄ້າ<br>
      <select name="customer_id" id="customer_id" class="form-control select2">   
       	<option value="<?php if($ff['customer_id']==''){echo "";}else{echo $ff['customer_id'];}?>">
       	<?php if($ff['customer_id']==''){echo "ທັງຫມົດ";}else{echo $ff['customer_id'];?>&nbsp;<?php echo $ff['customer_name'];}?></option>
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from customers");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['customer_id'];?>"><?php echo $f['customer_id'];?>&nbsp;<?php echo $f['customer_name'];?></option>
	<?PHP } ?>
    </select> </td>   
             

    <td>ເດືອນ<br>
    <select name="month" id="month" class="form-control">
   
  <option value="<?php echo $month;?>"><?php echo $month;?></option>
  <option value=""><?php echo 'ທັງໝົດ';?></option>
    <?PHP 
    for($i=1;$i<=12;$i++){ ?>
    <option value="<?php echo $i;?>"><?php echo $i;?></option>
    <?PHP }?>


    </select></td>   


<td>ປີ<br>
<input type="number" name="year" id="year" class="form-control" value="<?php 
if($year!=''){
  echo $year;
    }else{
      echo date("Y");
    }
?>">
    </td>   


                <?
               /*  
       <td>ລະອຽດ ຫຼື ສັງລວມ<br>
      <select name="Detailed" id="Detailed" class="form-control"> 
      <?php if($Detailed==''){ ?>
	<option value="ລະອຽດ">ລະອຽດ</option>
     <option value="ສັງລວມ">ສັງລວມ</option>
<?php	
}else{?>
	<option value="<?php echo $Detailed; ?>"><?php echo $Detailed; ?></option>
      <option value="ລະອຽດ">ລະອຽດ</option>
     <option value="ສັງລວມ">ສັງລວມ</option>	 
       	 <?php } ?>
    </select> </td>            
                    */?>
 <td><br><button type="submit" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>      


<td><br> <button type="button" class="btn btn-warning" id="print">ພິມ</button></td> 

<td><br><button type="button" class="btn btn-success" id="print_excel"><i class="fa fa-file-excel" aria-hidden="true"></i></button></td>




</tr>

       </table>
</form>
           <br>
      <div class="tableFixHead">  
 <table id="myTable" border="1"  class="table-bordered" align="center" style="width:95%;">   
    <thead>
       
    <tr>
	    <th align="center">.No</th>
<th align="center">Customers' Name</th>
<th align="center">Customers ID</th>
<th align="center">Sales Person</th>
<th align="center">Jan-<?php echo $y;?></th>
<th align="center">Feb-<?php echo $y;?></th>
<th align="center">Mar-<?php echo $y;?></th>
<th align="center">Apr-<?php echo $y;?></th>
<th align="center">May-<?php echo $y;?></th>
<th align="center">Jun-<?php echo $y;?></th>
<th align="center">Jul-<?php echo $y;?></th>
<th align="center">Aug-<?php echo $y;?></th>
<th align="center">Sep-<?php echo $y;?></th>
<th align="center">Oct-<?php echo $y;?></th>
<th align="center">Nov-<?php echo $y;?></th>
<th align="center">Dec-<?php echo $y;?></th>              
<th align="center">ລວມ</th>                 
                </tr>
     
      
     </thead>  
         
     <?php
        
    	  @$sp=mysqli_query($con,"SELECT tb_statement_customers_month.*,
        IF(tb_statement_customers_month.Jan is null, '0', tb_statement_customers_month.Jan)+
        IF(tb_statement_customers_month.Feb is null, '0', tb_statement_customers_month.Feb)+
        IF(tb_statement_customers_month.Mar is null, '0', tb_statement_customers_month.Mar)+
        IF(tb_statement_customers_month.Apr is null, '0', tb_statement_customers_month.Apr)+
        IF(tb_statement_customers_month.May is null, '0', tb_statement_customers_month.May)+
        IF(tb_statement_customers_month.Jun is null, '0', tb_statement_customers_month.Jun)+
        IF(tb_statement_customers_month.Jul is null, '0', tb_statement_customers_month.Jul)+
        IF(tb_statement_customers_month.Aug is null, '0', tb_statement_customers_month.Aug)+
        IF(tb_statement_customers_month.Sep is null, '0', tb_statement_customers_month.Sep)+
        IF(tb_statement_customers_month.Oct is null, '0', tb_statement_customers_month.Oct)+
        IF(tb_statement_customers_month.Nov is null, '0', tb_statement_customers_month.Nov)+
        IF(tb_statement_customers_month.`Dec` is null, '0', tb_statement_customers_month.`Dec`) 

        as total_year
        from tb_statement_customers_month 
        order by 
/*
        (IF(tb_statement_customers_month.Jan is null, '0', tb_statement_customers_month.Jan)+
          IF(tb_statement_customers_month.Feb is null, '0', tb_statement_customers_month.Feb)+
          IF(tb_statement_customers_month.Mar is null, '0', tb_statement_customers_month.Mar)+
          IF(tb_statement_customers_month.Apr is null, '0', tb_statement_customers_month.Apr)+
          IF(tb_statement_customers_month.May is null, '0', tb_statement_customers_month.May)+
          IF(tb_statement_customers_month.Jun is null, '0', tb_statement_customers_month.Jun)+
          IF(tb_statement_customers_month.Jul is null, '0', tb_statement_customers_month.Jul)+
          IF(tb_statement_customers_month.Aug is null, '0', tb_statement_customers_month.Aug)+
          IF(tb_statement_customers_month.Sep is null, '0', tb_statement_customers_month.Sep)+
          IF(tb_statement_customers_month.Oct is null, '0', tb_statement_customers_month.Oct)+
          IF(tb_statement_customers_month.Nov is null, '0', tb_statement_customers_month.Nov)+
          IF(tb_statement_customers_month.`Dec` is null, '0', tb_statement_customers_month.`Dec`)
          )
        desc
*/
Customers_ID
asc
");
	
           $i=0;
	  
            while($s=mysqli_fetch_array($sp)){
            $i++;
			?>
            	<tr>
            <td><?php echo $i;?></td>	
            <td><?php 
             $customer_id_2=$s['Customers_ID'];
            $sp1="SELECT outlet_name FROM customer_import Where external_id='$customer_id_2' group by external_id";
            $sp_a=mysqli_query($con,$sp1);
            $s1=mysqli_fetch_array($sp_a);
            echo $s1['outlet_name'];
            ?></td>
<td><?php echo $s["Customers_ID"];?></td>
<td><?php echo $s["sr"];?></td>
<td align="right"><?php echo number_format($s["Jan"]);?></td>
<td align="right"><?php echo number_format($s["Feb"]);?></td>
<td align="right"><?php echo number_format($s["Mar"]);?></td>
<td align="right"><?php echo number_format($s["Apr"]);?></td>
<td align="right"><?php echo number_format($s["May"]);?></td>
<td align="right"><?php echo number_format($s["Jun"]);?></td>
<td align="right"><?php echo number_format($s["Jul"]);?></td>
<td align="right"><?php echo number_format($s["Aug"]);?></td>
<td align="right"><?php echo number_format($s["Sep"]);?></td>
<td align="right"><?php echo number_format($s["Oct"]);?></td>
<td align="right"><?php echo number_format($s["Nov"]);?></td>
<td align="right"><?php echo number_format($s["Dec"]);?></td>
<td align="right"><?php echo number_format($s["total_year"]);?></td>

	</tr>

<?php
 } 
 ?>

</table>  
	</div>
<!---- add product--->



<!----->
 <?php /*  
 if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); }
  */ ?>
 
 
	


    <br>
    <br>
</html>




