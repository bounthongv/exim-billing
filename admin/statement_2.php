<?php 
include("init.php");


	$receipt_id = mysqli_real_escape_string($con,$_GET['receipt_id']);
$sql_h = mysqli_query($con," select DISTINCT(receipt_id)as receipt_id from product_receipt where receipt_id='$receipt_id'");
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
   
 window.open('print_statement_1.php?customer_id='+customer_id +'&from_date='+from_date + '&to_date='+to_date+'&Detailed='+Detailed+'','_blank'); 

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
    <h3 align="center">Statement</h3><br>
   </div>
    <!-- /.container -->  
    <form action="insert_statement_2.php" method="post" onkeydown="return event.key != 'Enter';"  enctype="multipart/form-data" name="me">
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
      <select name="receipt_id" id="receipt_id" class="form-control select2" style="width: 200px;">   
       	<option value="<?php if($ff['receipt_id']==''){echo "";}else{echo $ff['receipt_id'];}?>">
       	<?php if($ff['receipt_id']==''){echo "ທັງຫມົດ";}else{echo $ff['receipt_id'];}?></option>
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select DISTINCT(receipt_id)as receipt_id from product_receipt");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['receipt_id'];?>"><?php echo $f['receipt_id'];?></option>
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

      
                
                    
                </tr>
     
      
     </thead>  
         
     <?php
        
    	  @$sp=mysqli_query($con,"SELECT * from tb_statement order by inv_date, inv_no asc
          ");
	
           $i=0;
	  
            while($s=mysqli_fetch_array($sp)){
            $i++;
			?>
            	<tr>
            <td><?php echo $i;?></td>	
<td><?php echo $s["inv_no"];?></td>
<td><?php $date=date_create($s["inv_date"]); echo date_format($date,"d/m/Y");?></td>
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
 
	</tr>

      <?php
	@$t_inv_amt+=$s["inv_amt"];	
	@$t_10031707  += $s["10031707"];
@$t_10031707D += $s["10031707D"]; 
@$t_10031708  += $s["10031708"];
@$t_10031708D += $s["10031708D"];
@$t_10031709  += $s["10031709"];
@$t_10031709D += $s["10031709D"];
@$t_10031710  += $s["10031710"];
@$t_10031710D += $s["10031710D"];
@$t_10031711  += $s["10031711"];
@$t_10031711D += $s["10031711D"];
@$t_10126756  += $s["10126756"];
@$t_10128824  += $s["10128824"];
@$t_10128824D += $s["10128824D"];
@$t_10135854  += $s["10135854"];
@$t_10031712  += $s["10031712"];
@$t_10031713  += $s["10031713"];
@$t_10031713D += $s["10031713D"];
@$t_10031777  += $s["10031777"];
@$t_10031777D += $s["10031777D"]; 
		  
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

</tr>	
</table>  
	</div>
<!---- add product--->



<!----->
 <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?>
 
 
	


    <br>
    <br>
</html>




