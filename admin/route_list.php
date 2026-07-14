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
 $sql_max=mysqli_query($con,"select max(route_id) from routes");
$row_max=mysqli_fetch_row($sql_max);

$max_id=$row_max['0'];
 $id1='000'.'1';  
 
 $id2=$max_id+1;
 
 $group_id='';
if($max_id<1){    $group_id=$id1;     }

 else if($max_id<9){  $group_id='000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $group_id='00'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $group_id='0'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $group_id=$id2;} 
  else if($max_id<99999){  $group_id= $id2;}
  
   $group_id;

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

 
 load_route_list();
 
function load_route_list()
	{
			$.ajax({
			url:"fetch_routes_list.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_route_list').html(data);
				
			}
		});
	}
/////////////////////////////////////
	$(document).on('click', '.edit_route', function(){
	
		var route_id = $(this).attr("id");		
		var route_name = $('#route_name'+route_id+'').val();
		var Id = $('#Id'+route_id+'').val();
	

	
	   $('#route_id').val(route_id);
	   $("#route_name").val( route_name );
	    $("#Id").val( Id );
		 
			$("#action").val('Update');
			
			});	
			/////////////////////////////////////
	

});
	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("id");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_routes.php?Id='+Id;
  } 
 

	});
</script> 
<div class="container">
    <br>
    <h3 align="center">ລາຍການເສັ້ນທາງ</h3><br>
   


          
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_route">
            <i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ ລາຍການ</button>

        <!-- Content Row -->
        <div class="row">
        <div class="col-lg-12">
        
<br>

 			<div id="display_route_list">
           </div>
  
  	
<div class="modal" id="add_route">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ເພີ່ມລາຍການ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
      <form action="insert_routes.php" method="post" enctype="multipart/form-data">
      <button type="reset" class="btn btn-success"  >ເພີ່ມໃຫມ່</button>
          <button type="submit" class="btn btn-primary" name="action" id="action" value="Add"  >ບັນທືກ</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
         <table border="0">


  
 
  
  <tr>
    <td align="right">ລະຫັດສາງ :</td>
    <td><input type="text" class="form-control" name="route_id" id="route_id" value="<?php echo $group_id; ?>"   >
    <input type="hidden" class="form-control" name="Id" id="Id" va >
    </td>
  </tr>

 
  <tr>
    <td align="right">ຊື່ສາງ:</td>
    <td><input type="text" class="form-control" name="route_name" id="route_name"  placeholder="route Name" ></td> 

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

