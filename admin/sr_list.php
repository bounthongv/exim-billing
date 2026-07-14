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

     $sql_id_auto= mysqli_query($con,"SELECT MAX(sr_id) AS id_max FROM  sr_list ");
                  $ff = mysqli_fetch_array($sql_id_auto);
   $id_number = $ff['id_max']+1;
   $width = 3;
 $auto_id = str_pad((string)$id_number, $width, "0", STR_PAD_LEFT); 
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

.my-custom-scrollbar {
position: relative;
height: 450px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}



</style>
  <script src="js/numeral.min.js"></script>
  <script>



$(document).ready(function(){

 
 load_stock_list();
 
function load_stock_list()
	{
			$.ajax({
			url:"fetch_sr_list.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_stock_list').html(data);
				
			}
		});
	}
/////////////////////////////////////
	$(document).on('click', '.edit_list', function(){
		
		
	
		var id = $(this).attr("id");		
		var sr_id = $('#e_sr_id'+id+'').val();
		var sr_fname = $('#e_sr_fname'+id+'').val();
		var sr_lname = $('#e_sr_lname'+id+'').val();
		var sr_phone = $('#e_sr_phone'+id+'').val();
		var sr_email = $('#e_sr_email'+id+'').val();
	   
		
	

	
	   $('#id').val(id);
	   $("#sr_id").val( sr_id );
	   $("#sr_fname").val( sr_fname );
	   $("#sr_lname").val( sr_lname );
	   $("#sr_phone").val( sr_phone );
	   $("#sr_email").val( sr_email );
	  
	  
		 
	   $("#action").val('Update');
	   
	    
	   
	
			});	
			/////////////////////////////////////
	

});

	
       
				

</script> 
<div class="container">
    <br>
    <h3 align="center">ລາຍການພະນັກງານຂາຍ</h3><br>
   


            <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_stock"><i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ </button>

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
          <h4 class="modal-title">ລາຍການພະນັກງານຂາຍ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
        <form action="insert_sr.php" method="post" enctype="multipart/form-data" >
        
     <button type="submit" class="btn btn-primary" name="action" id="action" value="Add"  >ບັນທືກ</button>
          <button type="reset" class="btn btn-success"  >ເພີ່ມໃຫມ່</button>
          <button type="button" class="btn btn-danger clear" data-dismiss="modal">ປິດ</button>    
   	
    



<table border="0">
  <tr>
    <td width="118" align="right">ລະຫັດ:</td>
    <td width="222"><input type="text" class="form-control" readonly name="sr_id" id="sr_id" value="<?PHP echo $auto_id;?>"></td>
    <input type="hidden" name="id" id="id" >
  </tr>

  <tr>
    <td align="right">ຊື່:</td>
    <td><input type="text" class="form-control" name="sr_fname" id="sr_fname" ></td>
   
  </tr>
   <tr>
    <td align="right">ນາມສະກຸນ:</td>
    <td><input type="text" class="form-control" name="sr_lname" id="sr_lname" ></td>
   
  </tr>

   <tr>
    <td align="right">Tel:</td>
    <td><input type="text" class="form-control" name="sr_phone" id="sr_phone" ></td>
   
  </tr>
   <tr>
    <td align="right">Email:</td>
    <td><input type="text" class="form-control" name="sr_email" id="sr_email" ></td>
   
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

<?php 
 if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } 

 

?> 
    <!-- /.container -->
    <br>
    <br>

</body>



