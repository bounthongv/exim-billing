<?php 
include("init.php");
$office1=$_SESSION['office'];
?>
<style>
td{ padding:10px;
font-weight:!important;
height:40px;
 }
</style>




<!DOCTYPE html>



<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
<!--	<link href="//fonts.googleapis.com/css?family=Poppins:100i,200,200i,300,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">-->
	<link href="js/iconic.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

  

<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />




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
.nn{ width:250px;}
.nnn{ width:100px;}
</style>

<?php
//$sql_max=mysqli_query($con,"SELECT max(`certificate`) from tb1_aipp");


$sql_max=mysqli_query($con,"SELECT max(`no`) from tbl_emp_pay_out_no where office_id='$office1'");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='00000'.'1';  
 
 $id2=$max_id+1;
 
 $lge_id='';
if($max_id<1){    $lge_id=$id1;     }

  
  else if($max_id<9){  $lge_id='00000'.$id2;} 
  else if($max_id<99){  $lge_id='0000'.$id2;} 
  else if($max_id<999){  $lge_id='000'.$id2;} 
  else if($max_id<9999){  $lge_id='00'.$id2;} 
  else if($max_id<99999){  $lge_id='0'.$id2;} 
  else if($max_id<999999){  $lge_id=$id2;}
  
   $lge_id;
?>

<script>


	
	
	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("id");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_empty_pay_out_note.php?Id='+Id+'';
  } 
 

	});


	$(document).on('click', '.print_Id', function(){
	


window.open('print_empty_pay_out_note.php','_blank');



});	  	  


</script>
<div class="container">
    <br>
    <h3 align="center">ລາຍການ ໃບສົ່ງລັງແລະແກ້ວເປົ່າ</h3><br>
   




        <!-- Content Row -->

<form action="insert_emp_pay_out.php" method="post" enctype="multipart/form-data">  
<br>
<td><a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
<td><button type="submit" name="update" value="update" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp; ບັນທຶກ</button></td>

<table border="0">

<tr>
<td align="center">ເລກທີສົ່ງ: <br><input type="text" class="form-control ss" name="no" id="no" value="<?php echo $_SESSION["no"]; ?>" readonly></td>
<td align="center">ວັນທີສົ່ງ: <br><input type="date" class="form-control ss" name="Sending_date" id="Sending_date" value="<?php echo $_SESSION["Sending_date"]; ?>" ></td>

<td align="center">ເລກລົດ: <br>



<input type="text" class="form-control Truck_Number_change" name="Truck_Number" id="Truck_Number" value=""  >

<?php /*
<select name="Truck_Number" id="Truck_Number" class="form-control Truck_Number_change"  required> 
    <option value="<?php echo $_SESSION["Truck_Number"]; ?>"><?php echo $_SESSION["Truck_Number"]; ?></option>
    <?php 
    $sql =mysqli_query($con,"SELECT stocks.stock_name,sr_list.sr_fname
    FROM stocks 
    LEFT JOIN sr_list ON stocks.stock_name=sr_list.truck_registration
    where stocks.office_id='$office1'");
      while($f = mysqli_fetch_array($sql)){
    ?>
        <option value="<?php echo $f['stock_name'];?>"
        data-sr_fname="<?php echo $f['sr_fname']; ?>"
        
        ><?php echo $f['stock_name'];?></option>
        <?php } ?>
    </select>
*/ ?>
</td>

<td align="center">ຊື້ຄົນຂິບລົດ: <br><input type="text" class="form-control" name="Driver_Name" id="Driver_Name" value="<?php echo $_SESSION["Driver_Name"]; ?>"  ></td>
</tr>

<tr>
<td align="center" colspan="2">ຊື່ຕົວແທນສົ່ງ: <br><input type="text" class="form-control" name="Distributor_Name" id="Distributor_Name" value="<?php echo $_SESSION["Distributor_Name"]; ?>" ></td>
</tr>

</table>


<table>
	<tr>
    	<td>
        <button type="button" class="btn btn-success add_pro" data-toggle="modal">+</button>
        </td>
	</tr>
</table>

<div id="display_cart_receipt" ></div>



</form>

<script>
$(document).ready(function(){


load_order_receipt();

  $(document).on('click', '.add_pro', function(){

    var action = 'add';
    var fomu_id = $('#fomu_id_item').val();


			$.ajax({
			url:"c_emp_pay_out.php",
			method:"POST",
			data:{  action:action,fomu_id:fomu_id },
			success:function(data)
			{
			
        load_order_receipt()
				
			}
		});
  
  })


  function load_order_receipt()
	{
			$.ajax({
			url:"fetch_emp_pay_out.php",
			//dataType:"json",
			success:function(data)
			{
				$('#display_cart_receipt').html(data);
	
				
			}
		});
	}


  $(document).on('click', '.delete_or', function(){
	
  //var account_id = $(this).attr("id");
  var fomu_id = $(this).attr("id");
  var action = "remove";

    $.ajax({
      url:"c_emp_pay_out.php",
      method:"POST",
      data:{   fomu_id:fomu_id,action:action },
      success:function(data)
      {
      
        load_order_receipt();
      
      }
    });
  
});




});



/*

$(document).on('change', '.Truck_Number_change', function(){

// var sr_fname = $(this).attr("data-sr_fname"); 	

 var sr_fname = $(this).find(':selected').attr('data-sr_fname');
 $('#Driver_Name').val(sr_fname);

});
*/


$(document).on('change', '.Description_change', function(){


 var e = $(this).find(':selected').attr('data-e');
 var Product_ID = $(this).find(':selected').attr('data-Product_ID');
 var Unit = $(this).find(':selected').attr('data-Unit');
 var Description = $(this).find(':selected').attr('data-Product_Name');

 $('#Product_ID'+e).val(Product_ID);
 $('#Description'+e).val(Description);
 $('#UOM'+e).val(Unit);

});



</script>