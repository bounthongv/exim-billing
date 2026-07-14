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
$sql_max=mysqli_query($con,"select max(User_ID) from users ");
@$row_max=mysqli_fetch_row($sql_max);

$max_id=$row_max['0'];
 $id1='000'.'1';  
 
 $id2=$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $suppliers_id=$id1;     }

 else if($max_id<9){  $suppliers_id='000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $suppliers_id='00'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $suppliers_id='0'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $suppliers_id=$id2;} 
  else if($max_id<99999){  $suppliers_id= $id2;}
  
   $suppliers_id;
   
   
 // if(isset($_POST['User_ID'])){  $_SESSION['U_ID']=$_POST['User_ID'];}

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
			url:"fetch_user_list.php",
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
		
		
	
		var id = $(this).attr("id");		
		var User_ID = $('#User_ID'+id+'').val();
		var User_Name = $('#User_Name'+id+'').val();
		var stock_id = $('#stock_id'+id+'').val();
		var status = $('#status'+id+'').val();
		var fname = $('#fname'+id+'').val();
	    var user_type = $('#user_type'+id+'').val();
		
		$.ajax({url:"menu_list_select.php?User_ID="+User_ID,
		cache:false,
		success:function(result){
            $("#show_memu_select").html(result);
        }});

	
	   $('#id').val(id);
	   $("#User_ID").val( User_ID );
	   $("#User_Name").val( User_Name );
	   $("#stock_id").val( stock_id );
	   $("#status").val( status );
	   $("#fname").val( fname );
	   $("#user_type").val( user_type );
	  
		 
	   $("#action").val('Update');
	   
	    
	   
	
			});	
			/////////////////////////////////////
	

});

	
       
				
function check(){
	
	var pass = document.getElementById(password).value;
	var con_pass = document.getElementById(con_pass).value;
	
	if(con_pass!=pass){ alert("Plz Check Password And Confirm Password "); document.getElementById(con_pass).focus() }
	
	}
</script> 
<div class="container">
    <br>
    <h3 align="center">ລາຍການຜູ້ໃຊ້</h3><br>
   


            <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_stock"><i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ ລາຍການຜູ້ໃຊ້</button>

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
          <h4 class="modal-title">ເພີ່ມລາຍການຜູ້ໃຊ້</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
        <form action="insert_user.php" method="post" enctype="multipart/form-data" onsubmit="return check()">
        
     <button type="submit" class="btn btn-primary" name="action" id="action" value="Add"  >ບັນທືກ</button>
          <button type="reset" class="btn btn-success"  >ເພີ່ມໃຫມ່</button>
          <button type="button" class="btn btn-danger clear" data-dismiss="modal">ປິດ</button>    
   	
    
	
<table border="0">
<td width="400" valign="top">





<table border="0">
  <tr>
    <td width="118" align="right">ລຳດັບ:</td>
    <td width="222"><input type="text" class="form-control" readonly name="User_ID" id="User_ID" value="<?PHP echo $suppliers_id;?>"></td>
    <input type="hidden" name="id" id="id" >
  </tr>
  <tr>
    <td align="right">ລະຫັດຜູ້ໃຊ້:</td>
    <td><input type="text" class="form-control" name="User_Name" id="User_Name" ></td>
    <!--<td width="132" align="right">ຊື່ ທະນາຄານ(1):</td>
    <td width="308"><input type="text" class="form-control" name="bank_name1" id="bank_name1"></td>-->
  </tr>
  
  <tr>
    <td align="right">ຊື່ ຜູ້ໃຊ້ :</td>
    <td><input type="text" class="form-control" name="fname" id="fname" ></td>
    <!--<td width="132" align="right">ຊື່ ທະນາຄານ(1):</td>
    <td width="308"><input type="text" class="form-control" name="bank_name1" id="bank_name1"></td>-->
  </tr>
 
  <tr>
    <td align="right">ລະຫັດຜ່ານ:</td>
    <td><input type="password" class="form-control" name="password" id="password"  ></td>
    <!--<td align="right">ຊື່ ທະນາຄານ(3):</td>
    <td><input type="text" class="form-control" name="bank_name3" id="bank_name3"></td>-->
  </tr>
  <tr>
    <td align="right">ຢືນຍັນລະຫັດ:</td>
    <td><input type="password" class="form-control" name="con_pass" id="con_pass"  ></td>
    <!--<td align="right">ເລກບັນຊີ(3):</td>
    <td><input type="text" class="form-control" name="bank_no3" id="bank_no3" ></td>-->
  </tr>
  
 
  <tr>
  	<td align="right">ສະຖານະ:</td>
    <td><select name="status" id="status"  class="form-control">
    <option value="0">Admin</option>
    <option value="1">User</option>
    </select>
    </td>
  </tr>
  <tr>
  	<td align="right">ພະແນກ:</td>
    <td><select name="user_type" id="user_type"  class="form-control">
    <option value="0">Admin</option>
    <option value="1">ສາງ</option>
    <option value="2">ຈັດຊື້</option>
    <option value="3">ຂາຍ</option>
    </select>
    </td>
  </tr>
   <tr>
  	<td align="right">ສາງ:</td>
    <td><select name="stock_id" id="stock_id" class="form-control">
   
     <?PHP 
	 $sql=mysqli_query($con,"select * from stocks");
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select>
    </select>
    </td>
  </tr>
</table>
</td>

<td width="400" valign="top">


<div class="table-wrapper-scroll-y my-custom-scrollbar">
<div id="show_memu_select">



  <table class="table table-bordered  mb-0">
    <thead>
      <tr >
      
        <th scope="col">ລ/ດ</th>
        <th scope="col"><input type="checkbox" onclick="toggle(this)" /> All</th>
        <th scope="col">ລາຍການ</th>
       
        
      </tr>
    </thead>
    <tbody>
  <?php
    $sp=mysqli_query($con," select * from menu_header order by header_id  ");
  
	  $e=1;
	  
	while($s=mysqli_fetch_array($sp)){		?>
      <tr>
        <td width="5%" class="bgtd"><?php echo $e; ?></td>
        
        <td colspan="2"  class="bgtd"><?php echo $s['header_id']; ?> &nbsp;<?php echo $s['header_name']; ?></td>
    <?php    
        $spd=mysqli_query($con," select * from menu_list  where header_id='$s[header_id]' ");  
	
	 $e2=1;
	  while($sd=mysqli_fetch_array($spd)){
	  ?>
     
            <tr>
              <td width="15%"><?php echo $e.'.'.$e2; ?></td>
              <td>
   <input type="checkbox" name="menu_list[]" id="s_menu_list" class="select_product"  value="<?php echo $sd["list_id"];?>" >
             </td>
              <td><?php echo $sd['list_id']; ?> &nbsp;<?php echo $sd['list_name']; ?></td>
            </tr>
        <?php  $e2++; } ?>
      
      </tr>
<?php  $e++;
} ?>

    </tbody>
  </table>

</div>
</div>




</td>
</table>



</form>






         </div>
        
        <!-- Modal footer -->
       
        
      </div>
    </div>
  </div>
  
</div>


 
 
 


</div>
<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('menu_list[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } 

 

?> 
    <!-- /.container -->
    <br>
    <br>

</body>



