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
<th align="center">HD</th>
<th align="center">HM</th>
<th align="center">HP</th>
<th align="center">HP1</th>
<th align="center">HQ</th>
<th align="center">HQ1</th>
<th align="center">HS</th>
<th align="center">NC</th>
<th align="center">NQ</th>
<th align="center">RP</th>
<th align="center">RP1</th>
<th align="center">RS</th>
<th align="center">TC</th>
<th align="center">TQ</th>
<th align="center">HC</th>

      
                
                    
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
<td><?php if($s["HD"]=='0'){echo "-";}else{echo $s["HD"];};?></td>
<td><?php if($s["HM"]=='0'){echo "-";}else{echo $s["HM"];};?></td>
<td><?php if($s["HP"]=='0'){echo "-";}else{echo $s["HP"];};?></td>
<td><?php if($s["HP1"]=='0'){echo "-";}else{echo $s["HP1"];};?></td>
<td><?php if($s["HQ"]=='0'){echo "-";}else{echo $s["HQ"];};?></td>
<td><?php if($s["HQ1"]=='0'){echo "-";}else{echo $s["HQ1"];};?></td>
<td><?php if($s["HS"]=='0'){echo "-";}else{echo $s["HS"];};?></td>
<td><?php if($s["NC"]=='0'){echo "-";}else{echo $s["NC"];};?></td>
<td><?php if($s["NQ"]=='0'){echo "-";}else{echo $s["NQ"];};?></td>
<td><?php if($s["RP"]=='0'){echo "-";}else{echo $s["RP"];};?></td>
<td><?php if($s["RP1"]=='0'){echo "-";}else{echo $s["RP1"];};?></td>
<td><?php if($s["RS"]=='0'){echo "-";}else{echo $s["RS"];};?></td>
<td><?php if($s["TC"]=='0'){echo "-";}else{echo $s["TC"];};?></td>
<td><?php if($s["TQ"]=='0'){echo "-";}else{echo $s["TQ"];};?></td>
<td><?php if($s["CO2"]=='0'){echo "-";}else{echo $s["HC"];};?></td>
 
	</tr>

      <?php
	@$t_inv_amt+=$s["inv_amt"];	
	@$t_HD+=$s["HD"];
@$t_HM+=$s["HM"];
@$t_HP+=$s["HP"];
@$t_HP1+=$s["HP1"];
@$t_HQ+=$s["HQ"];
@$t_HQ1+=$s["HQ1"];
@$t_HS+=$s["HS"];
@$t_NC+=$s["NC"];
@$t_NQ+=$s["NQ"];
@$t_RP+=$s["RP"];
@$t_RP1+=$s["RP1"];
@$t_RS+=$s["RS"];
@$t_TC+=$s["TC"];
@$t_TQ+=$s["TQ"];
@$t_HC+=$s["HC"];	  
		  
		  } ?>
  <tr style="background-color:#99ff99;">	
<td colspan="3" align="center"><strong>ລວມ</strong></td>
<td colspan="1"><?php if($t_inv_amt=='0'){echo "-";}else{echo @number_format($t_inv_amt);}?></td>
<td colspan="1"><?php if($t_HD=='0'){echo "-";}else{echo @number_format($t_HD);}?></td>
<td colspan="1"><?php if($t_HM=='0'){echo "-";}else{echo @number_format($t_HM);}?></td>
<td colspan="1"><?php if($t_HP=='0'){echo "-";}else{echo @number_format($t_HP);}?></td>
<td colspan="1"><?php if($t_HP1=='0'){echo "-";}else{echo @number_format($t_HP1);}?></td>
<td colspan="1"><?php if($t_HQ=='0'){echo "-";}else{echo @number_format($t_HQ);}?></td>
<td colspan="1"><?php if($t_HQ1=='0'){echo "-";}else{echo @number_format($t_HQ1);}?></td>
<td colspan="1"><?php if($t_HS=='0'){echo "-";}else{echo @number_format($t_HS);}?></td>
<td colspan="1"><?php if($t_NC=='0'){echo "-";}else{echo @number_format($t_NC);}?></td>
<td colspan="1"><?php if($t_NQ=='0'){echo "-";}else{echo @number_format($t_NQ);}?></td>
<td colspan="1"><?php if($t_RP=='0'){echo "-";}else{echo @number_format($t_RP);}?></td>
<td colspan="1"><?php if($t_RP1=='0'){echo "-";}else{echo @number_format($t_RP1);}?></td>
<td colspan="1"><?php if($t_RS=='0'){echo "-";}else{echo @number_format($t_RS);}?></td>
<td colspan="1"><?php if($t_TC=='0'){echo "-";}else{echo @number_format($t_TC);}?></td>
<td colspan="1"><?php if($t_TQ=='0'){echo "-";}else{echo @number_format($t_TQ);}?></td>
<td colspan="1"><?php if($t_CO2=='0'){echo "-";}else{echo @number_format($t_HC);}?></td>

</tr>	
</table>  
	</div>
<!---- add product--->



<!----->
 <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?>
 
 
	


    <br>
    <br>
</html>




