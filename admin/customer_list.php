<?php 
include("init.php");

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

 

<?php
$sql_max=mysqli_query($con,"    select max(SUBSTRING(customer_id, 2, 7)) as id from customers");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='C000'.'1';  
 
 $id2=(int)$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $suppliers_id=$id1;     }

 else if($max_id<9){  $suppliers_id='C000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $suppliers_id='C00'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $suppliers_id='C0'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $suppliers_id='C'.$id2;} 
  else if($max_id<99999){  $suppliers_id='C'.$id2;}
  
   $suppliers_id;

?>


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
.container_new{ padding-left:10px;}
</style>

 <link rel="stylesheet" href="select2/select2.min.css">
<script src="select2/select2.full.min.js"></script>
<script>

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

<div class="container_new">
    <br>
    <h3 align="center">ລາຍການລູກຄ້າ</h3><br>
   


          
            

             <table>
       <tr>
           <td><br><button type="button" class="btn btn-success" data-toggle="modal" 
           data-target="#add_stock2"><i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ </button></td> 
      
      
    
            
      
       <td>ປະເພດ<br><select name="c_type" id="c_type" class="form-control s_customer "  >
             <option value="">ທັງໝົດ</option>
             <option value="002">wholesaler</option>
             <option value="003">outlet</option>
             </select>
             </td> 
    
             <td>ລະຫັດ<br><input  type="text" name="c_id" id="c_id" class="form-control s_customer"  ></td> 
             <td>ຊື່ລູກຄ້າ<br><input  type="text" name="c_name" id="c_name" class="form-control s_customer"  ></td>
             <td>ບ້ານ<br><input  type="text" name="c_village" id="c_village" class="form-control s_customer"  ></td>
             <td>ເມືອງ<br><input  type="text" name="c_district" id="c_district" class="form-control s_customer"  ></td> 
             <td>ຈຳນວນສະແດງ<br><input  type="text" name="limit_row" id="limit_row" class="form-control s_customer" value="1000"  ></td> 
            
             <!--<td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>-->
             <td><br>
       <button type="button" class="btn btn-success" id="print_excel"><i class="fa fa-file-excel" aria-hidden="true"></i></button></td>

<td>
  <?php /*
<form action="import_customer_file_2.php" method="POST" enctype="multipart/form-data">
        <label>เลือกไฟล์ Excel (.xlsx):</label>
        <input type="file" name="excel_file" accept=".xlsx, .xls" required>
        <button type="submit" name="import">อัปโหลดและนำเข้าข้อมูล</button>
    </form>
*/ ?>



 
<form action="import_customer_file.php" method="post" enctype="multipart/form-data">
    <input type="file" name="excel_file" accept=".csv" required> 
    
    <button type="submit" name="import">นำเข้าข้อมูล</button>
</form>

</td> 
       </tr>
       </table>
       
       
    
        <!-- Content Row -->
        <div class="row">
        <div class="col-lg-12">
        
<br>





 			<div id="display_stock_list"></div>
  





  	
<div class="modal" id="add_stock">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ແກ້ໄຂລາຍການລູກຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
   	
	<form action="insert_customer.php" method="post" enctype="multipart/form-data">

  
          <button type="submit" class="btn btn-primary" name="action" id="action" value="Update"  >ບັນທືກ</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
<table border="0">
  <tr>
    <td  align="right">ລະຫັດ:</td>
    <td ><input type="text" class="form-control"  name="customer_id" id="customer_id" value="<?PHP echo $suppliers_id;?>" readonly></td>
    <input type="hidden" name="id" id="id" >
    
    <td  align="right">ເພດານໜີ້:</td>
    <td ><input type="text" class="form-control number" style="text-align:right;" name="debit_amt" id="debit_amt"></td>
     <td  align="right">ຍອດໜີ້ທັງໝົດ:</td>
    <td ><h1 id="total_debit_amt"></h1></td>
    
  </tr>
  <tr>
    <td align="right">ຊື່ ລູກຄ້າ :</td>
    <td><input type="text" class="form-control" name="customer_name" id="customer_name" ></td>
    <!--<td width="132" align="right">ຊື່ ທະນາຄານ(1):</td>
    <td width="308"><input type="text" class="form-control" name="bank_name1" id="bank_name1"></td>-->
    
    
     <td align="right">ເສັ້ນທາງ:</td>
    <td>  
	<?PHP 
	
	$sql=mysqli_query($con,"select * from routes");
	
	?>
    <select name="route_id" id="route_id" class="form-control" required>
    	<option value="" >ເລືອກ</option>
    <?PHP 
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['route_id']?>"><?php echo $f['route_id']?> &nbsp; <?php echo $f['route_name']?></option>
	<?PHP } ?>
    </select>
    </td>
  <td align="right">Up:</td>
    <td><input type="text" class="form-control" name="up" id="up" ></td>
  </tr>
  
  
  
  <tr>
     <td align="right">ປະເພດລາຄາ :</td>
    <td>  
	<?PHP 
	
	$sql=mysqli_query($con,"select * from customer_type");
	
	?>
    <select name="customer_type" id="customer_type" class="form-control" required>
    	<option value="" >ເລືອກ</option>
    <?PHP 
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['ct_id']?>"><?php echo $f['ct_id']?> &nbsp; <?php echo $f['ct_name']?></option>
	<?PHP } ?>
    </select>
    </td>
    
    
    <td align="right">ປະເພດລູກຄ້າ:</td>
    <td><input type="text" class="form-control" name="customer_level" id="customer_level" ></td>
    
     <td align="right">Brand:</td>
    <td><input type="text" class="form-control" name="brand" id="brand" ></td>
  </tr>
  
  <tr>
    <td align="right">ທີ່ຢູ່:</td>
    <td><input type="text" class="form-control" name="address" id="address" ></td>
   <td align="right">ບ້ານ:</td>
    <td><input type="text" class="form-control" name="village" id="village" ></td>
     <td align="right">Class:</td>
    <td><input type="text" class="form-control" name="class" id="class" ></td>
  </tr>
  <tr>
    <td align="right">ເບີໂທລະສັບ:</td>
    <td><input type="text" class="form-control" name="phone" id="phone" ></td>
    <td align="right">ເມືອງ:</td>
    <td><input type="text" class="form-control" name="district" id="district" ></td>
  </tr>
  <tr>
    <td align="right">ແຟັກ:</td>
    <td><input type="text" class="form-control" name="fax" id="fax"></td>
   <td align="right">SR:</td>
    <td>
    
    	<?PHP 
	
	$sql=mysqli_query($con,"select * from sr_list");
	
	?>
    <select name="sr" id="sr" class="form-control select2" style="width:250px;" >
    	<option value="" >ເລືອກ</option>
    <?PHP 
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['sr_id']?>"><?php echo $f['sr_fname']?> &nbsp; <?php echo $f['sr_lname']?></option>
	<?PHP } ?>
    </select>
   <!-- <input type="text" class="form-control" name="sr" id="sr" >--></td>
  </tr>
  <tr>
    <td align="right">ອີເມວ:</td>
    <td><input type="text" class="form-control" name="email" id="email" ></td>
    <td align="right">Segment:</td>
    <td><input type="text" class="form-control" name="segment" id="segment" ></td>
  </tr>
  
  <tr>
  	<td align="right">ໜາຍເຫດ:</td>
    <td><input type="text" class="form-control" name="remark" id="remark" ></td>
    <td align="right">Grade:</td>
    <td><input type="text" class="form-control" name="grade" id="grade" ></td>
  </tr>
</table>





         </div>
        
        <!-- Modal footer -->
       
        </form>
      </div>
    </div>
  </div>
  
  
  <div class="modal" id="add_stock2">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ແກ້ໄຂລາຍການລູກຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
   	
	<form action="insert_customer.php" method="post" enctype="multipart/form-data">

  
          <button type="submit" class="btn btn-primary" name="action" id="action" value="Add"  >ບັນທືກ</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
<table border="0">
  <tr>
    <td  align="right">ລະຫັດ:</td>
    <td ><input type="text" class="form-control"  name="customer_id" id="customer_id" value="<?PHP echo $suppliers_id;?>" ></td>
    <input type="hidden" name="id" id="id" >
    
    <td  align="right">ເພດານໜີ້:</td>
    <td ><input type="text" class="form-control number" style="text-align:right;" name="debit_amt" id="debit_amt"></td>
     <td  align="right">ຍອດໜີ້ທັງໝົດ:</td>
    <td ><h1 id="total_debit_amt"></h1></td>
    
  </tr>
  <tr>
    <td align="right">ຊື່ ລູກຄ້າ :</td>
    <td><input type="text" class="form-control" name="customer_name" id="customer_name" ></td>
    <!--<td width="132" align="right">ຊື່ ທະນາຄານ(1):</td>
    <td width="308"><input type="text" class="form-control" name="bank_name1" id="bank_name1"></td>-->
    
    
     <td align="right">ເສັ້ນທາງ:</td>
    <td>  
	<?PHP 
	
	$sql=mysqli_query($con,"select * from routes");
	
	?>
    <select name="route_id" id="route_id" class="form-control" required>
    	<option value="" >ເລືອກ</option>
    <?PHP 
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['route_id']?>"><?php echo $f['route_id']?> &nbsp; <?php echo $f['route_name']?></option>
	<?PHP } ?>
    </select>
    </td>
  <td align="right">Up:</td>
    <td><input type="text" class="form-control" name="up" id="up" ></td>
  </tr>
  
  
  
  <tr>
     <td align="right">ປະເພດລາຄາ :</td>
    <td>  
	<?PHP 
	
	$sql=mysqli_query($con,"select * from customer_type");
	
	?>
    <select name="customer_type" id="customer_type" class="form-control" required>
    	<option value="" >ເລືອກ</option>
    <?PHP 
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['ct_id']?>"><?php echo $f['ct_id']?> &nbsp; <?php echo $f['ct_name']?></option>
	<?PHP } ?>
    </select>
    </td>
    
    
    <td align="right">ປະເພດລູກຄ້າ:</td>
    <td><input type="text" class="form-control" name="customer_level" id="customer_level" ></td>
    
     <td align="right">Brand:</td>
    <td><input type="text" class="form-control" name="brand" id="brand" ></td>
  </tr>
  
  <tr>
    <td align="right">ທີ່ຢູ່:</td>
    <td><input type="text" class="form-control" name="address" id="address" ></td>
   <td align="right">ບ້ານ:</td>
    <td><input type="text" class="form-control" name="village" id="village" ></td>
     <td align="right">Class:</td>
    <td><input type="text" class="form-control" name="class" id="class" ></td>
  </tr>
  <tr>
    <td align="right">ເບີໂທລະສັບ:</td>
    <td><input type="text" class="form-control" name="phone" id="phone" ></td>
    <td align="right">ເມືອງ:</td>
    <td><input type="text" class="form-control" name="district" id="district" ></td>
  </tr>
  <tr>
    <td align="right">ແຟັກ:</td>
    <td><input type="text" class="form-control" name="fax" id="fax"></td>
   <td align="right">SR:</td>
    <td>
    
    	<?PHP 
	
	$sql=mysqli_query($con,"select * from sr_list");
	
	?>
    <select name="sr" id="sr" class="form-control select2" style="width:250px;" >
    	<option value="" >ເລືອກ</option>
    <?PHP 
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['sr_id']?>"><?php echo $f['sr_fname']?> &nbsp; <?php echo $f['sr_lname']?></option>
	<?PHP } ?>
    </select>
   <!-- <input type="text" class="form-control" name="sr" id="sr" >--></td>
  </tr>
  <tr>
    <td align="right">ອີເມວ:</td>
    <td><input type="text" class="form-control" name="email" id="email" ></td>
    <td align="right">Segment:</td>
    <td><input type="text" class="form-control" name="segment" id="segment" ></td>
  </tr>
  
  <tr>
  	<td align="right">ໜາຍເຫດ:</td>
    <td><input type="text" class="form-control" name="remark" id="remark" ></td>
    <td align="right">Grade:</td>
    <td><input type="text" class="form-control" name="grade" id="grade" ></td>
  </tr>
</table>





         </div>
        
        <!-- Modal footer -->
       
        </form>
      </div>
    </div>
  </div>
  
</div>


 
 
 


</div>



<?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
    <!-- /.container -->
    <br>
    <br>

  <script src="js/numeral.min.js"></script>



  <script>


$(document).ready(function(){

 
 load_stock_list();
 
function load_stock_list()
	{

			$.ajax({
			url:"fetch_customer_list.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
       
				$('#display_stock_list').html(data);
        
			}
		});
	}

});


$(document).on('keyup change', '.s_customer', function(){
    

    var c_type = $('#c_type').val();
    var c_id = $('#c_id').val();
    var c_name = $('#c_name').val();
    var c_v = $('#c_village').val();
    var c_d = $('#c_district').val();
    var limit_row = $('#limit_row').val();

        $.ajax({
            url: "fetch_customer_list.php",
            method: "POST",
            data: { c_id:c_id,c_type:c_type,c_name:c_name,c_v:c_v,c_d:c_d,limit_row:limit_row },
            success: function(data) {
                $('#display_stock_list').html(data);
            }
        });
});
</script>


<script>

$(document).ready(function(){

 /*
 load_stock_list();
 
function load_stock_list()
	{

			$.ajax({
			url:"fetch_customer_list.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_stock_list').html(data);
			}
		});
	}
*/

/////////////////////////////////////
	$(document).on('click', '.edit_supplier', function(){
	
		var customer_id = $(this).attr("id");		
		var customer_name = $('#customer_name'+customer_id+'').val();
		var customer_type = $('#customer_type'+customer_id+'').val();
		var address = $('#address'+customer_id+'').val();
		var phone = $('#phone'+customer_id+'').val();
		var fax = $('#fax'+customer_id+'').val();
		var email = $('#email'+customer_id+'').val();
		var customer_level = $('#customer_level'+customer_id+'').val();
		var route_id = $('#route_id'+customer_id+'').val();
		
		var e_village = $('#e_village'+customer_id+'').val();
		var e_district = $('#e_district'+customer_id+'').val();
		
		var e_sr = $('#e_sr'+customer_id+'').val();
		
		
		var e_segment = $('#e_segment'+customer_id+'').val();
		var e_grade = $('#e_grade'+customer_id+'').val();
		
		var e_up = $('#e_up'+customer_id+'').val();
		var e_brand = $('#e_brand'+customer_id+'').val();
		var e_class = $('#e_class'+customer_id+'').val();
		
		var debit_amt = $('#e_debit_amt'+customer_id+'').val();
		var total_debit_amt = $('#e_total_debit_amt'+customer_id+'').val();
		
		var remark = $('#remark'+customer_id+'').val();
		var id = $('#id'+customer_id+'').val();
	

	   $('#village').val(e_village);
	   $('#district').val(e_district);
	   
	    $('#sr').val(e_sr).trigger('change');
	
		
	   $('#segment').val(e_segment);
	   $('#grade').val(e_grade);
	   
	    $('#up').val(e_up);
	   $('#brand').val(e_brand);
	   $('#class').val(e_class);
	   
	   
	   $('#debit_amt').val(numeral(debit_amt).format('0,000'));
	   $('#total_debit_amt').html(numeral(total_debit_amt).format('0,000'));
		
		
	   $('#customer_id').val(customer_id);
	   $("#customer_name").val( customer_name );
	   $("#address").val( address );
	   $("#phone").val( phone );
	   $("#fax").val( fax );
	   $("#email").val( email );
	   $("#customer_type").val( customer_type );
	   $("#customer_level").val( customer_level );
	    $("#route_id").val( route_id );
		
		
		
		
	   $("#remark").val( remark );
	    $("#id").val( id );
		 
			$("#action").val('Update');
			
			});	
			/////////////////////////////////////
	

});
	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("id");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_customer.php?Id='+Id;
  } 
 

	});
	
	
	/*
$(function(){
  $('#search_product').click(function(){
   
 
   var c_type = $('#c_type').val();
   var c_id = $('#c_id').val();
  var c_name = $('#c_name').val();
 
         $.ajax({
				url:"fetch_customer_list.php",
				method:"POST",
				data:{  c_id:c_id,c_type:c_type,c_name:c_name },
				success:function(data)
				{
					$('#display_stock_list').html(data);
				}
			});

  });

 });
*/




	$(document).on('click', '#print_excel', function(){
	
   
        var c_type = $('#c_type').val();
        var c_id = $('#c_id').val();
        var c_name = $('#c_name').val();
		var c_v = $('#c_village').val();
		var c_d = $('#c_district').val();
		var limit_row = $('#limit_row').val();

   window.open('customer_list_excel.php?c_type='+c_type + '&c_id='+c_id  + '&c_name='+c_name+'&c_v='+c_v+'&c_d='+c_d+'&limit_row='+limit_row+' ','_blank'); 
   
 

	});

/*
	 $(document).on('change', '#c_type', function(){
	
		var c_type = $('#c_type').val();
        var c_id = $('#c_id').val();
        var c_name = $('#c_name').val();
		var c_v = $('#c_village').val();
		var c_d = $('#c_district').val();
		var limit_row = $('#limit_row').val();
 

         $.ajax({
				url:"fetch_customer_list.php",
				method:"POST",
				data:{  c_id:c_id,c_type:c_type,c_name:c_name,c_v:c_v,c_d:c_d,limit_row:limit_row },
				success:function(data)
				{
					$('#display_stock_list').html(data);

				}
			});
 

	});
*/

	
</script>
  <script>
$('input.number').keyup(function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
 $(this).val(function(index, value) {
      value = value.replace(/,/g,''); // remove commas from existing input
      return numberWithCommas(value); // add commas back in
  });
});

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

  
 
 </script>
</html>

