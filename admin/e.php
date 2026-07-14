<?php 
include("init.php");



@$sp=mysqli_query($con,"select Product_ID from products where Product_ID like 'E%'");
while($s=mysqli_fetch_array($sp)){

    $sProduct_ID=$s['Product_ID'];
 


    mysqli_query($con,"ALTER TABLE tb_statement_E_help_E ADD $sProduct_ID int(11)");




}


	$customer_id = mysqli_real_escape_string($con,$_GET['customer_id']);
$sql_h = mysqli_query($con," SELECT * FROM customers where customer_id='$customer_id'");
              $ff = mysqli_fetch_array($sql_h);

$from_date = mysqli_real_escape_string($con,$_GET['from_date']);
$to_date = mysqli_real_escape_string($con,$_GET['to_date']);

$Detailed = mysqli_real_escape_string($con,$_GET['Detailed']);

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
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var Detailed = $('#Detailed').val(); 
  // var group_id = $('#group_id').val(); 
	//	var action = $(this).attr("value");


   // window.open('print_sale_list.php?stock_id='+stock_id + '&from_date='+from_date  + '&to_date='+to_date+' ','_blank'); 
   
 window.open('print_statement_1_E.php?customer_id='+customer_id +'&from_date='+from_date + '&to_date='+to_date+'&Detailed='+Detailed+'','_blank'); 

	});


	$(document).on('click', '#print_excel', function(){
	
   
    var customer_id = $('#customer_id').val();    
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var Detailed = $('#Detailed').val(); 

   window.open('print_statement_1_excel_E.php?customer_id='+customer_id +'&from_date='+from_date + '&to_date='+to_date+'&Detailed='+Detailed+'','_blank'); 


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
    <h3 align="center">ລາຍງານສັງລວມລັງເປົ່າ</h3><br>
   </div>
    <!-- /.container -->  
    <form action="insert_statement_e.php" method="post" onkeydown="return event.key != 'Enter';"  enctype="multipart/form-data" name="me">
<table>
       <tr>
       <!--
     <td> <br>  <a href="product_qty_list.php"> <button type="button" name="reset" value="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
       <td> <br><a href="add_sale_customer_order.php"  ><button type="button" class="btn btn-success" >
            <i class="fa fa-plus-square"></i>&nbsp; ຂາຍ</button></a></td>
            -->
            
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
	    <th align="center">inv_no</th>
<th align="center">inv_date</th>
<th align="center">inv_amt</th>
<th align="center" colspan="2">ຊື່ລູກຄ້າ</th>

<?php

$sql2 = mysqli_query($con,"SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = 'apis_exim_stock' 
        AND TABLE_NAME like 'tb_statement_E'
        and COLUMN_NAME!='customer_id' 
        and COLUMN_NAME!='inv_amt'
				and COLUMN_NAME!='inv_date' 
        and COLUMN_NAME!='inv_no'");  



        while($s=mysqli_fetch_array($sql2)){
?>


<th align="center"><?php echo $s['COLUMN_NAME']; ?></th>
  

<?php } ?>

<th align="center">Total</th>                

                </tr>
     
      
     </thead>  
         
     <?php
        /*
        $sql2 = mysqli_query($con,"SELECT COLUMN_NAME,SUBSTRING_INDEX(COLUMN_COMMENT, '.', -1) as COLUMN_COMMENT
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = 'apis2021_goa' 
        AND TABLE_NAME like 'tbl_menu_status%'
        and COLUMN_NAME!='Id' 
        and COLUMN_NAME!='User_ID'
        and COLUMN_NAME like '$number_a%'
        ORDER BY
        CAST(SUBSTRING_INDEX(COLUMN_COMMENT, '.', 1) AS DECIMAL)
      ASC
        ");  
*/

    	  @$sp=mysqli_query($con,"
        SELECT tb_statement_E.*,customers.customer_name from tb_statement_E 
        left join customers on customers.customer_id=tb_statement_E.customer_id
        order by tb_statement_E.inv_date, tb_statement_E.inv_no asc
          ");
	
           $i=0;
	  
            while($s=mysqli_fetch_array($sp)){
            $i++;
			?>
            	<tr>
            <td><?php echo $i;?></td>	
<td><?php echo $s["inv_no"];?></td>
<td><?php $date=date_create($s["inv_date"]); echo date_format($date,"d/m/Y");?></td>
<td><?php if($s["inv_amt"]==0){echo "-";}else{echo number_format($s["inv_amt"]);};?></td>
<td><?php echo $s["customer_id"];?></td>
<td><?php echo $s["customer_name"];?></td>
<td><?php if($s["EHD"]==0){echo "-";}else{echo $s["EHD"];};?></td>
<td><?php if($s["EHP"]==0){echo "-";}else{echo $s["EHP"];};?></td>
<td><?php if($s["EHP1"]==0){echo "-";}else{echo $s["EHP1"];};?></td>
<td><?php if($s["EHP2"]==0){echo "-";}else{echo $s["EHP2"];};?></td>
<td><?php if($s["EHQ"]==0){echo "-";}else{echo $s["EHQ"];};?></td>
<td><?php if($s["EHQ1"]==0){echo "-";}else{echo $s["EHQ1"];};?></td>
<td><?php if($s["EHQ2"]==0){echo "-";}else{echo $s["EHQ2"];};?></td>
<td><?php if($s["ENQ"]==0){echo "-";}else{echo $s["ENQ"];};?></td>
<td><?php if($s["ENQ1"]==0){echo "-";}else{echo $s["ENQ1"];};?></td>
<td><?php if($s["ENQ2"]==0){echo "-";}else{echo $s["ENQ2"];};?></td>
<td><?php if($s["ERP"]==0){echo "-";}else{echo $s["ERP"];};?></td>
<td><?php if($s["ERP1"]==0){echo "-";}else{echo $s["ERP1"];};?></td>
<td><?php if($s["ERQ"]==0){echo "-";}else{echo $s["ERQ"];};?></td>
<td><?php if($s["ERQ1"]==0){echo "-";}else{echo $s["ERQ1"];};?></td>
<td><?php if($s["ETQ"]==0){echo "-";}else{echo $s["ETQ"];};?></td>
<td><?php if($s["ETQ1"]==0){echo "-";}else{echo $s["ETQ1"];};?></td>
<td><?php if($s["ETQ2"]==0){echo "-";}else{echo $s["ETQ2"];};?></td>

<?php
$sum=
$s["EHD"]+
$s["EHP"]+
$s["EHP1"]+
$s["EHP2"]+
$s["EHQ"]+
$s["EHQ1"]+
$s["EHQ2"]+
$s["ENQ"]+
$s["ENQ1"]+
$s["ENQ2"]+
$s["ERP"]+
$s["ERP1"]+
$s["ERQ"]+
$s["ERQ1"]+
$s["ETQ"]+
$s["ETQ1"]+
$s["ETQ2"];
?>
<td><?php if($sum==0){echo "-";}else{echo @number_format($sum);} ?></td>
 
	</tr>

      <?php
	@$t_inv_amt+=$s["inv_amt"];	
  @$t_EHD+=$s["EHD"];
  @$t_EHP+=$s["EHP"];
  @$t_EHP1+=$s["EHP1"];
  @$t_EHP2+=$s["EHP2"];
  @$t_EHQ+=$s["EHQ"];
  @$t_EHQ1+=$s["EHQ1"];
  @$t_EHQ2+=$s["EHQ2"];
  @$t_ENQ+=$s["ENQ"];
  @$t_ENQ1+=$s["ENQ1"];
  @$t_ENQ2+=$s["ENQ2"];
  @$t_ERP+=$s["ERP"];
  @$t_ERP1+=$s["ERP1"];
  @$t_ERQ+=$s["ERQ"];
  @$t_ERQ1+=$s["ERQ1"];
  @$t_ETQ+=$s["ETQ"];
  @$t_ETQ1+=$s["ETQ1"];
  @$t_ETQ2+=$s["ETQ2"];
  

@$T_sum_all=
@$t_EHD+
@$t_EHP+
@$t_EHP1+
@$t_EHP2+
@$t_EHQ+
@$t_EHQ1+
@$t_EHQ2+
@$t_ENQ+
@$t_ENQ1+
@$t_ENQ2+
@$t_ERP+
@$t_ERP1+
@$t_ERQ+
@$t_ERQ1+
@$t_ETQ+
@$t_ETQ1+
@$t_ETQ2;

		  } ?>
  <tr style="background-color:#99ff99;">	
<td colspan="3" align="center"><strong>ລວມ</strong></td>
<td colspan="1"><?php if($t_inv_amt==0){echo "-";}else{echo @number_format($t_inv_amt);}?></td>
<td colspan="2">&nbsp;</td>
<td colspan="1"><?php if($t_EHD==0){echo "-";}else{echo @number_format($t_EHD);}?></td>
<td colspan="1"><?php if($t_EHP==0){echo "-";}else{echo @number_format($t_EHP);}?></td>
<td colspan="1"><?php if($t_EHP1==0){echo "-";}else{echo @number_format($t_EHP1);}?></td>
<td colspan="1"><?php if($t_EHP2==0){echo "-";}else{echo @number_format($t_EHP2);}?></td>
<td colspan="1"><?php if($t_EHQ==0){echo "-";}else{echo @number_format($t_EHQ);}?></td>
<td colspan="1"><?php if($t_EHQ1==0){echo "-";}else{echo @number_format($t_EHQ1);}?></td>
<td colspan="1"><?php if($t_EHQ2==0){echo "-";}else{echo @number_format($t_EHQ2);}?></td>
<td colspan="1"><?php if($t_ENQ==0){echo "-";}else{echo @number_format($t_ENQ);}?></td>
<td colspan="1"><?php if($t_ENQ1==0){echo "-";}else{echo @number_format($t_ENQ1);}?></td>
<td colspan="1"><?php if($t_ENQ2==0){echo "-";}else{echo @number_format($t_ENQ2);}?></td>
<td colspan="1"><?php if($t_ERP==0){echo "-";}else{echo @number_format($t_ERP);}?></td>
<td colspan="1"><?php if($t_ERP1==0){echo "-";}else{echo @number_format($t_ERP1);}?></td>
<td colspan="1"><?php if($t_ERQ==0){echo "-";}else{echo @number_format($t_ERQ);}?></td>
<td colspan="1"><?php if($t_ERQ1==0){echo "-";}else{echo @number_format($t_ERQ1);}?></td>
<td colspan="1"><?php if($t_ETQ==0){echo "-";}else{echo @number_format($t_ETQ);}?></td>
<td colspan="1"><?php if($t_ETQ1==0){echo "-";}else{echo @number_format($t_ETQ1);}?></td>
<td colspan="1"><?php if($t_ETQ2==0){echo "-";}else{echo @number_format($t_ETQ2);}?></td>

<td colspan="1"><?php if($T_sum_all==0){echo "-";}else{echo @number_format($T_sum_all);}?></td>
</tr>	
</table>  
	</div>
<!---- add product --->



<!----->
 <?php /*  
 if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); }
  */ ?>
 
 
	


    <br>
    <br>
</html>




