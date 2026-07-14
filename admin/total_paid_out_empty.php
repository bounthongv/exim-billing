<?php 
include("init.php");
$office1=$_SESSION['office'];


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

    <script src="js/jquery.js"></script>

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
	/*
   var customer_id = $('#customer_id').val();    
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var Detailed = $('#Detailed').val(); 

 window.open('print_statement_1.php?customer_id='+customer_id +'&from_date='+from_date + '&to_date='+to_date+'&Detailed='+Detailed+'','_blank'); 
*/


	});


	$(document).on('click', '#print_excel', function(){
	
   /*
    var customer_id = $('#customer_id').val();    
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var Detailed = $('#Detailed').val(); 

   window.open('print_statement_1_excel.php?customer_id='+customer_id +'&from_date='+from_date + '&to_date='+to_date+'&Detailed='+Detailed+'','_blank'); 
*/

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
    <form action="insert_statement.php" method="post" onkeydown="return event.key != 'Enter';"  enctype="multipart/form-data" name="me">
<table>
       <tr>

            
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
    <td><br><button type="button" id="add_paid_out_empty" class="btn btn-success"><i class="fa fa-user" aria-hidden="true"></i> ຄິດໄລ່</button></td>


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
<th align="center">ລ/ດ</th>
<th align="center">ທະບຽນລົດ</th>
<th align="center">ສົງລັງເປົ່າ</th>

<th align="center">HQ/ລັງ</th>
<th align="center">HQ/ແກ້ວ</th>
<th align="center">HP/ລັງ</th>
<th align="center">HP/ແກ້ວ</th>
<th align="center">NQ/ລັງ</th>
<th align="center">NQ/ແກ້ວ</th>
<th align="center">RP/ລັງ</th>
<th align="center">RP/ແກ້ວ</th>
<th align="center">RQ/ລັງ</th>
<th align="center">RQ/ແກ້ວ</th>
<th align="center">HD 20L/ຖັງ</th>
<th align="center">HD 30L/ຖັງ</th>
<th align="center">EmptyCO2</th>
<th align="center">Pallet</th>
<th align="center">ລວມ</th>
<th align="center">ຫມາຍເຫດ</th>
             
                    
                </tr>
     
      
     </thead>  
         
     <?php
        
    	  @$sp=mysqli_query($con,"SELECT * from tb_total_paid_out_empty
        
         where office_id='$office1'");
	
           $i=0;
	  
            while($s=mysqli_fetch_array($sp)){
            $i++;
			?>
            	<tr>
            <td><?php echo $i;?></td>	


        <td width="100" align="center"><?php echo $f['Truck_Number']; ?></td>
        <td width="100" align="center"><?php echo $f['Empty']; ?></td>

        <td width="100" align="center"><?php echo $f['date']; ?></td>


        <td width="100" align="center"><input type="text" id="HQ_water_crate<?php echo $f['Id'];?>" name="HQ_water_crate" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['HQ_water_crate']==0 || $f['HQ_water_crate']==''){echo 0;}else{echo @number_format($f['HQ_water_crate'],0);} ?>"></td>
        <td width="100" align="center"><input type="text" id="HQ_glasses<?php echo $f['Id'];?>" name="HQ_glasses" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['HQ_glasses']==0 || $f['HQ_glasses']==''){echo 0;}else{echo @number_format($f['HQ_glasses'],0);} ?>"></td>
        <td width="100" align="center"><input type="text" id="HP_water_crate<?php echo $f['Id'];?>" name="HP_water_crate" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['HP_water_crate']==0 || $f['HP_water_crate']==''){echo 0;}else{echo @number_format($f['HP_water_crate'],0);} ?>"></td>
        <td width="100" align="center"><input type="text" id="HP_glasses<?php echo $f['Id'];?>" name="HP_glasses" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['HP_glasses']==0 || $f['HP_glasses']==''){echo 0;}else{echo @number_format($f['HP_glasses'],0);} ?>"></td>
        <td width="100" align="center"><input type="text" id="NQ_water_crate<?php echo $f['Id'];?>" name="NQ_water_crate" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['NQ_water_crate']==0 || $f['NQ_water_crate']==''){echo 0;}else{echo @number_format($f['NQ_water_crate'],0);} ?>"></td>
        <td width="100" align="center"><input type="text" id="NQ_glasses<?php echo $f['Id'];?>" name="NQ_glasses" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['NQ_glasses']==0 || $f['NQ_glasses']==''){echo 0;}else{echo @number_format($f['NQ_glasses'],0);} ?>"></td>
        
        <td width="100" align="center"><input type="text" id="RP_water_crate<?php echo $f['Id'];?>" name="RP_water_crate" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['RP_water_crate']==0 || $f['RP_water_crate']==''){echo 0;}else{echo @number_format($f['RP_water_crate'],0);} ?>"></td>
        <td width="100" align="center"><input type="text" id="RP_glasses<?php echo $f['Id'];?>" name="RP_glasses" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['RP_glasses']==0 || $f['RP_glasses']==''){echo 0;}else{echo @number_format($f['RP_glasses'],0);} ?>"></td>
        
        <td width="100" align="center"><input type="text" id="RQ_water_crate<?php echo $f['Id'];?>" name="RQ_water_crate" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['RQ_water_crate']==0 || $f['RQ_water_crate']==''){echo 0;}else{echo @number_format($f['RQ_water_crate'],0);} ?>"></td>
        <td width="100" align="center"><input type="text" id="RQ_glasses<?php echo $f['Id'];?>" name="RQ_glasses" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['RQ_glasses']==0 || $f['RQ_glasses']==''){echo 0;}else{echo @number_format($f['RQ_glasses'],0);} ?>"></td>
        
        <td width="100" align="center"><input type="text" id="HD20L<?php echo $f['Id'];?>" name="HD20L" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['HD20L']==0 || $f['HD20L']==''){echo 0;}else{echo @number_format($f['HD20L'],0);} ?>"></td>
        <td width="100" align="center"><input type="text" id="HD30L<?php echo $f['Id'];?>" name="HD30L" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['HD30L']==0 || $f['HD30L']==''){echo 0;}else{echo @number_format($f['HD30L'],0);} ?>"></td>
        
        <td width="100" align="center"><input type="text" id="EmptyCO2<?php echo $f['Id'];?>" name="EmptyCO2" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['EmptyCO2']==0 || $f['EmptyCO2']==''){echo 0;}else{echo @number_format($f['EmptyCO2'],0);} ?>"></td>
        <td width="100" align="center"><input type="text" id="Pallet<?php echo $f['Id'];?>" name="Pallet" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['Pallet']==0 || $f['Pallet']==''){echo 0;}else{echo @number_format($f['Pallet'],0);} ?>"></td>
        
        <td width="100" align="center"><input type="text" id="note<?php echo $f['Id'];?>" name="note" class="add_" size="10"  data-Id="<?php echo $f['Id'];?>" value="<?php if($f['note']==0 || $f['note']==''){echo 0;}else{echo @number_format($f['note'],0);} ?>"></td>


</tr>

<?php
    }
?>

</table>  
	</div>
 
	


    <br>
    <br>
</html>



<script src="jss/jquery.js"></script>
<script src="jss/jquery.dataTables.min.js.js"></script>
<script src="jss/dataTables.bootstrap.min.js"></script>


<script>
		$(document).ready( function () {
		$('#example').DataTable();
	} );

    $(document).on('click', '#add_paid_out_empty', function(){
	
  

var mm = $('#mm').val();
var yy = $('#yy').val();

	window.location.href='insert_total_paid_out_empty.php?mm='+mm+'&yy='+yy+'';





 });
 </script>