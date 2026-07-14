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



 $sql_max=mysqli_query($con,"select max(Group_ID) from tb_groups");
$row_max=mysqli_fetch_row($sql_max);

$max_id=$row_max['0'];
 $id1='00'.'1';  
 
 $id2=$max_id+1;
 
 $group_id='';
if($max_id<1){    $group_id=$id1;     }

 else if($max_id<9){  $group_id='00'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $group_id='0'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $group_id=$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $group_id=$id2;} 
  else if($max_id<99999){  $group_id= $id2;}
  
   $group_id;

?> 
<script>
	
	$(document).on('click', '.edit_group', function(){
	
		var Group_ID = $(this).attr("id");
		var Group_Name_EN = $('#g_name_en'+Group_ID+'').val();
		var Group_Name = $('#g_name'+Group_ID+'').val();
		
	
	   $('#group_id').val(Group_ID);
	   $("#group_name_en").val( Group_Name_EN );
	   $("#group_name").val( Group_Name ); 
			$("#action").val('update');
			
			});
	
	
	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("id");
		var group_id = $(this).attr("value");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_group.php?Id='+Id+'&group_id='+group_id;
  } 
 

	});
</script>
<div class="container">
    <br>
    <h3 align="center">ລາຍການ ໜວດສິນຄ້າ</h3><br>
   


           <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a> 
            <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add_pro"><i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ ໜວດສິນຄ້າ</button>

        <!-- Content Row -->
        <div class="row">
        <div class="col-lg-12">
        
<br>

 			
            <?PHP
			
			$vg=mysqli_query($con,"SELECT * FROM tb_groups order by Group_ID");
				if($vg){ ?>
            <table border='1'  class="table-bordered">
              <tr class="bgtd">
                <th>ລະຫັດໜວດ</th>
                <th>ຊື່ ໜວດສິນຄ້າ</th>
                <th>ຊື່ ໜວດສິນຄ້າອັງກິດ</th>
                <th>ແກ້ໄຂ</th>
                 <th>ລົບ</th>
              </tr>
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
		 		echo "<tr>";
		 		echo "<td>".$p['Group_ID']."</td>";?>
              	<td ><?php echo $p['Group_Name'];?></td>
                <td ><?php echo $p['Group_Name_EN'];?></td>
                <input type="hidden" name="g_name" id="g_name<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_Name'];?>">
                <input type="hidden" name="g_name_en" id="g_name_en<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_Name_EN'];?>">
              	<td ><button class="btn btn-success btn-sm edit_group"  data-toggle="modal" data-target="#add_pro"
                id="<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_ID'];?>">ແກ້ໄຂ</button></td>
                
                <td ><button class="btn btn-danger btn-sm delete_Id" value="<?php echo $p['Group_ID'];?>"  id="<?php echo $p['Id'];?>" >ລົບ</button></td>
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
        
      <form action="insert_groups.php" method="post" enctype="multipart/form-data">
      
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>ປິດ</button>
          <button type="reset" class="btn btn-success"  >ເພີມໃຫມ່</button>
          <button type="submit" class="btn btn-primary" name="action" id="action" value="add"  >ບັນທືກ</button>
          
<table border="0">

  <tr>
    <td align="right">ລະຫັດໜວດສິນຄ້າ:</td>
    <td ><input type="text" class="form-control nnn" name="group_id" id="group_id" value="<?php echo $group_id;?>"></td>
  </tr>
  
 <tr>
    <td align="right">ຊື່ໜວດສິນຄ້າ(ລາວ):</td>
    <td ><input type="text" class="form-control nn" name="group_name" id="group_name" placeholder="Group Name" ></td>
  </tr>
   <tr>
    <td align="right">ຊື່ໜວດສິນຄ້າ(ອັງກິດ):</td>
    <td ><input type="text" class="form-control nn" name="group_name_en" id="group_name_en" placeholder="Group Name EN"  ></td>
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

