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
			url:"fetch_exchange_list.php",
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
	
		var eid = $(this).attr("id");
				
		var date_exchang = $('#date_exchang'+eid+'').val();
		var kip_baht = $('#kip_baht'+eid+'').val();
		var dollar_baht = $('#dollar_baht'+eid+'').val();		
		var remark = $('#remark'+eid+'').val();
		
	

	   $('#eid').val(eid);
	   $('#date_exchang').val(date_exchang);
	   $("#kip_baht").val( kip_baht );
	   $("#dollar_baht").val( dollar_baht );;
	   $("#remark").val( remark );
	   
		 
			$("#action").val('Update');
			
			});	
			/////////////////////////////////////
	

});
	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("id");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_exchange.php?Id='+Id;
  } 
 

	});
	
	
	
$(function(){
  $('#search_product').click(function(){
   
 
   var start_date = $('#start_date').val();
   var to_date = $('#to_date').val();
 // var product_name = $('#product_name').val();
 
         $.ajax({
				url:"fetch_exchange_list.php",
				method:"POST",
				data:{  start_date:start_date,to_date:to_date },
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
    <h3 align="center">ລາຍການອັດຕາແລກປ່ຽນ</h3><br>
   


          
            

             <table>
       <tr>
           <td><br><button type="button" class="btn btn-success" data-toggle="modal" 
           data-target="#add_stock"><i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມອັດຕາແລກປ່ຽນ</button></td> 
      
      
    
            
      
      
    
             <td>ລະຫັດ<br><input  type="date" name="start_date" id="start_date" value="<?php echo date('Y-m-d'); ?>" class="form-control"  ></td> 
             <td>ຊື່ລູກຄ້າ<br><input  type="text" name="to_date" id="to_date" value="<?php echo date('Y-m-d'); ?>" class="form-control"  ></td> 
            
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
          <h4 class="modal-title">ລາຍການອັດຕາແລກປ່ຽນ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
   	
	<form action="insert_exchange.php" method="post" enctype="multipart/form-data">

    <button type="reset" class="btn btn-success"  >ເພີ່ມໃຫມ່</button>
          <button type="submit" class="btn btn-primary" name="action" id="action" value="Add"  >ບັນທືກ</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
<table border="0">
  <tr>
    <td width="118" align="right">ວັນທີ:</td>
    <td width="222">
    <input type="hidden" class="form-control" name="eid" id="eid" >
    <input type="date" class="form-control"  name="date_exchang" id="date_exchang" value="<?PHP echo date("Y-m-d");?>"></td>
    
  </tr>
  <tr>
    <td align="right">ບາດ :</td>
    <td><input type="text" class="form-control" name="kip_baht" id="kip_baht" >
    </td>
   
  </tr>
    <tr>
    <td align="right">ໂດລາ :</td>
    <td><input type="text" class="form-control" name="dollar_baht" id="dollar_baht" ></td>
   
  </tr>

  
  <tr>
  	<td align="right">ໜາຍເຫດ:</td>
    <td><input type="text" class="form-control" name="remark" id="remark" ></td>
  </tr>
</table>




</form>
         </div>
        
        <!-- Modal footer -->
       
        
      </div>
    </div>
  </div>
  
</div>


 
 
 


</div>
<?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
    <!-- /.container -->
    <br>
    <br>


</html>

