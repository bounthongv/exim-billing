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
 
<script>
	
	$(document).on('click', '.edit_office', function(){
	
		var Id = $(this).attr("id");
		var office_name = $(this).attr("data-office_name");
		var s1 = $(this).attr("data-s1");
		var s2 = $(this).attr("data-s2");
		var s3 = $(this).attr("data-s3");
		var s4 = $(this).attr("data-s4");
		
	
	   $('#Id').val(Id);
	   $('#office_name').val(office_name);
	   $("#signature1").val( s1 );
	   $("#signature2").val( s2 ); 
	   $("#signature3").val( s3 );
	   $("#signature4").val( s4 ); 
	   
			$("#action").val('update');
			
			});
	
	
	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("id");
	//	var group_id = $(this).attr("value");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_office.php?Id='+Id;
  } 
 

	});
</script>
<div class="container">
    <br>
    <h3 align="center">ຂໍ້ມູນສຳນັກງານ</h3><br>
   


           <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a> 
            <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add_pro"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມ ຂໍ້ມູນສຳນັກງານ</button>

        <!-- Content Row -->
        <div class="row">
        <div class="col-lg-12">
        
<br>


            <table border='1'  class="table-bordered">
              <tr class="bgtd">
               
                <th>ຊື່ສຳນັກງານ</th>
                <th>ໂລໂກ້</th>
                <th>ລາຍເຊັນ1</th>
                <th>ລາຍເຊັນ2</th>
                <th>ລາຍເຊັນ3</th>
                <th>ລາຍເຊັນ4</th>
                <th>ແກ້ໄຂ</th>
                 <th>ລົບ</th>
              </tr>
              <?PHP
			  
			  $vg=mysqli_query($con,"SELECT * FROM office order by Id");
			 	while($p=mysqli_fetch_array($vg)){
		 		echo "<tr>";
		 		echo "<td>".$p['office_name']."</td>";?>
              	<td ><img src="<?php echo $p['path'];?>"></td>
                <td ><?php echo $p['signature1'];?></td>
                <td ><?php echo $p['signature2'];?></td>
                <td ><?php echo $p['signature3'];?></td>
                <td ><?php echo $p['signature4'];?></td>
                
               
              	<td ><button class="btn btn-success btn-sm edit_office"  data-toggle="modal" data-target="#add_pro"
                id="<?php echo $p['Id'];?>" value="<?php echo $p['Id'];?>" data-office_name="<?php echo $p['office_name'];?>" data-s1="<?php echo $p['signature1'];?>" data-s2="<?php echo $p['signature2'];?>"data-s3="<?php echo $p['signature3'];?>" data-s4="<?php echo $p['signature4'];?>">ແກ້ໄຂ</button></td>
                
                <td ><button class="btn btn-danger btn-sm delete_Id" value="<?php echo $p['Id'];?>"  id="<?php echo $p['Id'];?>"
                 >ລົບ</button></td>
              <?PHP } ?>
            </table>
            <?PHP ?>
  
  	



 
 <div class="modal" id="add_pro">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ຂໍ້ມູນສຳນັກງານ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
      <form action="insert_office.php" method="post" enctype="multipart/form-data">
      
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> ປິດ</button>
          <button type="reset" class="btn btn-success"  >ເພີ່ມໃຫມ່</button>
          <button type="submit" class="btn btn-primary" name="action" id="action" value="add"  >ບັນທືກ</button>
          <input type="hidden" class="form-control nn" name="Id" id="Id" >
<table border="0">

  <tr>
    <td align="right">ຊື່ບໍລິສັດ:</td>
    <td ><input type="text" class="form-control nn" name="office_name" id="office_name" ></td>
  </tr>
  
 <tr>
    <td align="right">ໂລໂກ້:</td>
    <td ><input type="file" class="form-control nn" name="office_logo" id="office_logo" accept="image/*" ></td>
  </tr>
   <tr>
    <td align="right">ລາຍເຊັນ1:</td>
    <td ><input type="text" class="form-control nn" name="signature1" id="signature1"   ></td>
  </tr>
  <tr>
    <td align="right">ລາຍເຊັນ2:</td>
    <td ><input type="text" class="form-control nn" name="signature2" id="signature2"   ></td>
  </tr>
  <tr>
    <td align="right">ລາຍເຊັນ3:</td>
    <td ><input type="text" class="form-control nn" name="signature3" id="signature3"   ></td>
  </tr>
  <tr>
    <td align="right">ລາຍເຊັນ4:</td>
    <td ><input type="text" class="form-control nn" name="signature4" id="signature4"   ></td>
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

