<?php 
include("init.php");


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
   
 window.open('print_statement_customers_1.php?customer_id='+customer_id +'&from_date='+from_date + '&to_date='+to_date+'&Detailed='+Detailed+'','_blank'); 

	});


	$(document).on('click', '#print_excel', function(){
	
   
    var customer_id = $('#customer_id').val();    
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var Detailed = $('#Detailed').val(); 

   window.open('print_statement_customers_1_excel.php?customer_id='+customer_id +'&from_date='+from_date + '&to_date='+to_date+'&Detailed='+Detailed+'','_blank'); 


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
    <h3 align="center">Statement Customers</h3><br>
   </div>
    <!-- /.container -->  
    <form action="insert_statement_customer.php" method="post" onkeydown="return event.key != 'Enter';"  enctype="multipart/form-data" name="me">
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
<th align="center">ລະຫັດ</th>
<th align="center" >ຊື່ລູກຄ້າ</th>
<th align="center">inv_amt</th>
<th align="center">ໄຮເນເກັນເບຍສົດ 20ລ</th>
 
<th align="center">ໄຮເນເກັນແກ້ວໃຫ່ຍ 12x640ມລ</th>

<th align="center">ໄຮເນເກັນແກ້ວນ້ອຍ 24x330ມລ</th>

<th align="center">ໄຮເນເກັນລັງແກ້ວໃຫ່ຍ 12x640ມລ</th>

<th align="center">ໄຮເນເກັນລັງແກ້ວນ້ອຍ 24x330ມລ</th>

<th align="center">ໄຮເນເກັນປ໋ອງນ້ອຍ 24x320ມລ</th>
<th align="center">ໄຮເນເກັນ ເບຍສົດ 30ລ</th>

<th align="center">ນ້ຳຂອງກະປ໋ອງ 24x330ມລ (ປີໃໝ່ລາວ)</th>
<th align="center">ນ້ຳຂອງກະປ໋ອງ 24x330ມລ</th>
<th align="center">ນ້ຳຂອງລັງແກ້ວໃຫຍ່ 12x640ມລ</th>

<th align="center">ຖັງບັນຈຸ CO2 10Kg</th>
<th align="center">Total</th>                
                    
                </tr>
     
      
     </thead>  
         
     <?php
        
    	  @$sp=mysqli_query($con,"SELECT tb_statement_customers.*,customer_import.outlet_name from tb_statement_customers 
            LEFT JOIN customer_import ON tb_statement_customers.customer_id=customer_import.external_id
            order by customer_id asc

/*
        (`tb_statement_customers`.`10031707` +
    `tb_statement_customers`.`10031707D` +
    `tb_statement_customers`.`10031708` +
    `tb_statement_customers`.`10031708D` +
    `tb_statement_customers`.`10031709` +
    `tb_statement_customers`.`10031709D` +
    `tb_statement_customers`.`10031710` +
    `tb_statement_customers`.`10031710D` +
    `tb_statement_customers`.`10031711` +
    `tb_statement_customers`.`10031711D` +
    `tb_statement_customers`.`10126756` +
    `tb_statement_customers`.`10128824` +
    `tb_statement_customers`.`10128824D` +
    `tb_statement_customers`.`10135854` +
    `tb_statement_customers`.`10031712` +
    `tb_statement_customers`.`10031713` +
    `tb_statement_customers`.`10031713D` +
    `tb_statement_customers`.`10031777` +
    `tb_statement_customers`.`10031777D`)
        desc
*/

          ");
	
           $i=0;
	  
            while($s=mysqli_fetch_array($sp)){
            $i++;
			?>
            	<tr>
            <td><?php echo $i;?></td>	
            <td><?php echo $s["customer_id"];?></td>
            <td><?php
            $customer_id_2=$s['customer_id'];
            $sp1="SELECT outlet_name FROM customer_import Where external_id='$customer_id_2' group by external_id";
            $sp_a=mysqli_query($con,$sp1);
            $s1=mysqli_fetch_array($sp_a);
            echo $s1['outlet_name'];
            ?></td>
<td><?php if($s["inv_amt"]=='0'){echo "-";}else{echo number_format($s["inv_amt"]);};?></td>
<td><?= ($s["10031707"]  == '0' || empty($s["10031707"]))  ? "-" : $s["10031707"]; ?></td>

<td><?= ($s["10031708"]  == '0' || empty($s["10031708"]))  ? "-" : $s["10031708"]; ?></td>

<td><?= ($s["10031709"]  == '0' || empty($s["10031709"]))  ? "-" : $s["10031709"]; ?></td>

<td><?= ($s["10031710"]  == '0' || empty($s["10031710"]))  ? "-" : $s["10031710"]; ?></td>

<td><?= ($s["10031711"]  == '0' || empty($s["10031711"]))  ? "-" : $s["10031711"]; ?></td>

<td><?= ($s["10126756"]  == '0' || empty($s["10126756"]))  ? "-" : $s["10126756"]; ?></td>
<td><?= ($s["10128824"]  == '0' || empty($s["10128824"]))  ? "-" : $s["10128824"]; ?></td>

<td><?= ($s["10135854"]  == '0' || empty($s["10135854"]))  ? "-" : $s["10135854"]; ?></td>
<td><?= ($s["10031712"]  == '0' || empty($s["10031712"]))  ? "-" : $s["10031712"]; ?></td>
<td><?= ($s["10031713"]  == '0' || empty($s["10031713"]))  ? "-" : $s["10031713"]; ?></td>

<td><?= ($s["10031777"]  == '0' || empty($s["10031777"]))  ? "-" : $s["10031777"]; ?></td>

<?php
$sum = $s["10031707"] +
    $s["10031708"] +
    $s["10031709"] +
    $s["10031710"] +
    $s["10031711"] +
    $s["10126756"] +
    $s["10128824"] +
    $s["10135854"] +
    $s["10031712"] +
    $s["10031713"] +
    $s["10031777"];
?>
<td><?php if($sum=='0'){echo "-";}else{echo @number_format($sum);} ?></td>
 
	</tr>

      <?php
	@$t_inv_amt+=$s["inv_amt"];	
	@$t_10031707  += $s["10031707"];

@$t_10031708  += $s["10031708"];

@$t_10031709  += $s["10031709"];

@$t_10031710  += $s["10031710"];

@$t_10031711  += $s["10031711"];

@$t_10126756  += $s["10126756"];
@$t_10128824  += $s["10128824"];

@$t_10135854  += $s["10135854"];
@$t_10031712  += $s["10031712"];
@$t_10031713  += $s["10031713"];

@$t_10031777  += $s["10031777"];


@$T_sum_all =$t_10031707 +

    $t_10031708 +

    $t_10031709 +

    $t_10031710 +

    $t_10031711 +

    $t_10126756 +
    $t_10128824 +

    $t_10135854 +
    $t_10031712 +
    $t_10031713 +
    $t_10031777;

		  } ?>
  <tr style="background-color:#99ff99;">	
<td colspan="3" align="center"><strong>ລວມ</strong></td>
<td colspan="1"><?php if($t_inv_amt=='0'){echo "-";}else{echo @number_format($t_inv_amt);}?></td>
<td colspan="1"><?= (empty($t_10031707)  || $t_10031707  == 0) ? "-" : number_format($t_10031707); ?></td>

<td colspan="1"><?= (empty($t_10031708)  || $t_10031708  == 0) ? "-" : number_format($t_10031708); ?></td>

<td colspan="1"><?= (empty($t_10031709)  || $t_10031709  == 0) ? "-" : number_format($t_10031709); ?></td>

<td colspan="1"><?= (empty($t_10031710)  || $t_10031710  == 0) ? "-" : number_format($t_10031710); ?></td>

<td colspan="1"><?= (empty($t_10031711)  || $t_10031711  == 0) ? "-" : number_format($t_10031711); ?></td>

<td colspan="1"><?= (empty($t_10126756)  || $t_10126756  == 0) ? "-" : number_format($t_10126756); ?></td>
<td colspan="1"><?= (empty($t_10128824)  || $t_10128824  == 0) ? "-" : number_format($t_10128824); ?></td>

<td colspan="1"><?= (empty($t_10135854)  || $t_10135854  == 0) ? "-" : number_format($t_10135854); ?></td>
<td colspan="1"><?= (empty($t_10031712)  || $t_10031712  == 0) ? "-" : number_format($t_10031712); ?></td>
<td colspan="1"><?= (empty($t_10031713)  || $t_10031713  == 0) ? "-" : number_format($t_10031713); ?></td>

<td colspan="1"><?= (empty($t_10031777)  || $t_10031777  == 0) ? "-" : number_format($t_10031777); ?></td>

<td colspan="1"><?php if($T_sum_all=='0'){echo "-";}else{echo @number_format($T_sum_all);}?></td>
</tr>	
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




