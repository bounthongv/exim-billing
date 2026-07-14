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
<html lang="en">


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
$sql_max=mysqli_query($con,"select max(supplier_id) from suppliers");
@$row_max=mysqli_fetch_row($sql_max);

$max_id=$row_max['0'];
 $id1='00'.'1';  
 
 $id2=$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $suppliers_id=$id1;     }

 else if($max_id<9){  $suppliers_id='00'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $suppliers_id='0'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $suppliers_id=$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $suppliers_id=$id2;} 
  else if($max_id<99999){  $suppliers_id= $id2;}
  
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
</style>
  <script src="js/numeral.min.js"></script>
  <script>



$(document).ready(function(){

 
 load_stock_list();
 
function load_stock_list()
	{
			$.ajax({
			url:"fetch_supplier_list.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_stock_list').html(data);
				
			}
		});
	}
/////////////////////////////////////
	$(document).on('click', '.edit_supplier', function(){
	
		var supplier_id = $(this).attr("id");		
		var supplier_name = $('#supplier_name'+supplier_id+'').val();
		var address = $('#address'+supplier_id+'').val();
		var tel = $('#tel'+supplier_id+'').val();
		var fax = $('#fax'+supplier_id+'').val();
		var emails = $('#emails'+supplier_id+'').val();
		var bank_no = $('#bank_no'+supplier_id+'').val();
		var remark = $('#remark'+supplier_id+'').val();
		var spid = $('#spid'+supplier_id+'').val();
	

	
	   $('#supplier_id').val(supplier_id);
	   $("#supplier_name").val( supplier_name );
	   $("#address").val( address );
	   $("#tel").val( tel );
	   $("#fax").val( fax );
	   $("#emails").val( emails );
	   $("#bank_no").val( bank_no );
	   $("#remark").val( remark );
	    $("#spid").val( spid );
		 
			$("#action").val('Update');
			
			});	
			/////////////////////////////////////
	

});
	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("id");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_supplier.php?Id='+Id;
  } 
 

	});
	

$(function(){
  $('#search_product').click(function(){
   
 
   var email = $('#email').val();
   var product_id = $('#product_id').val();
  var product_name = $('#product_name').val();
 
         $.ajax({
				url:"fetch_supplier_list.php",
				method:"POST",
				data:{  product_id:product_id,email:email,product_name:product_name },
				success:function(data)
				{
					$('#display_stock_list').html(data);

				}
			});

  });

 });
</script> 
<div class="container">
    <br>
    <h3 align="center">ລາຍການຜູ້ສະໜອງ</h3><br>
   


          
           

   <table>
       <tr>
           <td><br> <button type="button" class="btn btn-success" data-toggle="modal" 
           data-target="#add_stock"><i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ ລາຍການຜູ້ສະໜອງ</button></td> 
      
             <td>ລະຫັດ<br><input  type="text" name="product_id" id="product_id" class="form-control"  ></td> 
             <td>ຊື່ຜູ້ສະໜອງ<br><input  type="text" name="product_name" id="product_name" class="form-control"  ></td> 
             <td>ອີເມວ<br><input  type="text" name="email" id="email" class="form-control"  ></td> 
             <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>
       </tr>
       </table>
        <!-- Content Row -->
        <div class="row">
        <div class="col-lg-12">
        
<br>

 			<div id="display_stock_list">
           </div>
  
  	
<div class="modal" id="add_stock">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ເພີ່ມລາຍການຜູ້ສະໜອງ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
   	
	<form action="insert_suppliers.php" method="post" enctype="multipart/form-data">
                <button type="reset" class="btn btn-success"  >ເພີ່ມໃຫມ່</button>
          <button type="submit" class="btn btn-primary" name="action" id="action" value="Add"  >ບັນທືກ</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>

<table border="0">
  <tr>
    <td width="118" align="right">ລະຫັດ:</td>
    <td width="222"><input type="text" class="form-control" readonly name="supplier_id" id="supplier_id" value="<?PHP echo $suppliers_id;?>"></td>
    <input type="hidden" name="spid" id="spid" >
  </tr>
  <tr>
    <td align="right">ຊື່ ຜູ້ສະໜອງ :</td>
    <td><input type="text" class="form-control" name="supplier_name" id="supplier_name" ></td>
    <!--<td width="132" align="right">ຊື່ ທະນາຄານ(1):</td>
    <td width="308"><input type="text" class="form-control" name="bank_name1" id="bank_name1"></td>-->
  </tr>
  
  
  <tr>
    <td align="right">ທີ່ຢູ່:</td>
    <td><input type="text" class="form-control" name="address" id="address" ></td>
    <!--<td align="right">ເລກບັນຊີ(2):</td>
    <td><input type="text" class="form-control" name="bank_no2" id="bank_no2" ></td>-->
  </tr>
  <tr>
    <td align="right">ເບີໂທລະສັບ:</td>
    <td><input type="text" class="form-control" name="tel" id="tel" ></td>
    <!--<td align="right">ຊື່ ທະນາຄານ(3):</td>
    <td><input type="text" class="form-control" name="bank_name3" id="bank_name3"></td>-->
  </tr>
  <tr>
    <td align="right">ແຟັກ:</td>
    <td><input type="text" class="form-control" name="fax" id="fax"></td>
    <!--<td align="right">ເລກບັນຊີ(3):</td>
    <td><input type="text" class="form-control" name="bank_no3" id="bank_no3" ></td>-->
  </tr>
  <tr>
    <td align="right">ອີເມວ:</td>
    <td><input type="text" class="form-control" name="emails" id="emails" ></td>
    <!--<td align="right">ຮູບ:</td>
    <td><input type="file" class="form-control" name="company_pic" id="company_pic" ></td>-->
  </tr>
  <tr>
  	<td align="right">ເລກບັນຊີທະນາຄານ:</td>
    <td><input type="text" class="form-control" name="bank_no" id="bank_no" ></td>
  </tr>
  <tr>
  	<td align="right">ໜາຍເຫດ:</td>
    <td><input type="text" class="form-control" name="remark" id="remark" ></td>
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

</body>

</html>

