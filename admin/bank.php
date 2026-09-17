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



?> 
<script>
	
	$(document).on('click', '.edit_bank', function(){
	
	
		var Bank_Name_EN = $('#g_name_en'+Id+'').val();
		var Bank_Name = $('#g_name'+Id+'').val();
		
	
	
	   $("#Bank_Name_en").val( Bank_Name_EN );
	   $("#Bank_Name").val( Bank_Name ); 
			$("#action").val('update');
			
			});
	
	
	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("id");
	

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_group.php?Id='+Id;
  } 
 

	});
</script>
<div class="container">
    <br>
    <h3 align="center">ລາຍການທະນາຄານ</h3><br>
   


           <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a> 
            <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add_pro"><i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ ທະນາຄານ</button>

        <!-- Content Row -->
        <div class="row">
        <div class="col-lg-12">
        
<br>

 			
            <?PHP
			
			$vg=mysqli_query($con,"SELECT * FROM tb_bank");
				if($vg){ ?>
            <table border='1'  class="table-bordered">
              <tr class="bgtd">
                <th>ບັນຊີທະນາຄານ</th>
                <th>ຊື່ ທະນາຄານ</th>
                <th>ຊື່ ທະນາຄານອັງກິດ</th>
                <th>ແກ້ໄຂ</th>
                 <th>ລົບ</th>
              </tr>
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
		 		echo "<tr>";
                ?>
                <td ><?php echo $p['Bank_account'];?></td>
              	<td ><?php echo $p['Bank_Name'];?></td>
                <td ><?php echo $p['Bank_Name_EN'];?></td>
                <input type="hidden" name="g_name" id="g_name<?php echo $p['Id'];?>" value="<?php echo $p['Bank_Name'];?>">
                <input type="hidden" name="g_name_en" id="g_name_en<?php echo $p['Id'];?>" value="<?php echo $p['Bank_Name_EN'];?>">
                <input type="hidden" name="g_name_en" id="g_name_en<?php echo $p['Id'];?>" value="<?php echo $p['Bank_Name_EN'];?>">
              	<td ><button class="btn btn-success btn-sm edit_bank"  data-toggle="modal" data-target="#add_pro"
                id="<?php echo $p['Id'];?>" value="<?php echo $p['Id'];?>">ແກ້ໄຂ</button></td>
                
                <td ><button class="btn btn-danger btn-sm delete_Id" value="<?php echo $p['Id'];?>"  id="<?php echo $p['Id'];?>" >ລົບ</button></td>
              <?PHP } ?>
            </table>
            <?PHP } ?>
  
  	



 
 <div class="modal" id="add_pro">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ເພີ່ມລາຍການສິນຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
      <form action="insert_bank.php" method="post" enctype="multipart/form-data">
      
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>ປິດ</button>
          <button type="reset" class="btn btn-success"  >ເພີມໃຫມ່</button>
          <button type="submit" class="btn btn-primary" name="action" id="action" value="add"  >ບັນທືກ</button>
          
<table border="0">


  
 <tr>
    <td align="right">ຊື່ທະນາຄານ(ລາວ):</td>
    <td ><input type="text" class="form-control nn" name="bank_name" id="bank_name" ></td>
  </tr>
   <tr>
    <td align="right">ຊື່ທະນາຄານ(ອັງກິດ):</td>
    <td ><input type="text" class="form-control nn" name="bank_name_en" id="bank_name_en" ></td>
  </tr>
  
  <tr>
    <td align="right">ບັນຊີທະນາຄານ:</td>
    <td ><input type="text" class="form-control nn" name="bank_account" id="bank_account" ></td>
  </tr>

 <tr>
    <td align="right">ໝາຍເຫດ:</td>
    <td ><input type="text" class="form-control nn" name="note" id="note" ></td>
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

</body>

</html>

