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

<center>
<form action="update_new_code_customer.php" method="post" enctype="multipart/form-data">
<table>
<tr>
 <td><button type="submit" class="btn btn-primary" name="action" id="action">ບັນທືກ</button></td>
         <td><button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button></td>
  </tr>
  </table> 
  
  <table>
<tr>
  <td>ຊື່ລູກຄ້າ<br>
        <select  name="customer_id" id="customer_id" class="form-control select2 select_custom" style="width:300px;"  >
              <option value="">ທັງຫມົດ</option>
         <?php 
		 $sql_c=mysqli_query($con,"select * from customers");
		 while($f=mysqli_fetch_array($sql_c)){
		  ?>     
              <option value="<?php echo $f['customer_id'];?>"  data-customer_id="<?php echo $f['customer_id'];?>"><?php echo $f['customer_id'];?>&nbsp;<?php echo $f['customer_name'];?></option>
          <?php } ?>   
             </select>   
  	 </td>

  	 
	  </tr>
	  

	  <tr>  	 

	</table>
  <table>
  <tr>
  	<td>ລະຫັດເກົ່າ</td>
	<td><input type="text" class="form-control" name="customer_id_old" id="customer_id_old" readonly></td>
	 </tr>
	 <tr>
 	 <td>ລະຫັດໃໝ່</td>
 	 <td><input type="text" class="form-control" name="customer_id_new" id="customer_id_new" ></td>
	  </tr>	  
  	</table>  	  
	</form>	  	  	  	  
</center>





<script src="js/numeral.min.js"></script>        
<script>
$(document).on('change', '.select_custom', function(){

	
		//var gr_id = $(this).attr("id");	
	var customer_id_old = $(this).find(':selected').attr('data-customer_id');
	
	$("#customer_id_old").val(customer_id_old).trigger('change');
});
</script>
  <script src="js/jquery-3.4.1.min.js"></script>
		

		<script src="js/superfish.min.js"></script>		
		<script src="js/jquery.magnific-popup.min.js"></script>		
		<script src="js/main.js"></script> 

