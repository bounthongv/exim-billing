<?php
include("init.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>ລະບົບບໍລິຫານເງີນເດືອນ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/png" href="images/shopping-cart.png">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
	
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
    	
	<style type="text/css">
.style10 {color: #FF6666}
.style11 {font-size: 24px}
.style12 {color: #FF0000}
</style>

</head>
<body>
	
<?PHP 
		
		include("header.php");
?>
<?php

include("init.php");

 $sql_max=mysqli_query($con,"select max(User_ID) from login");
$row_max=mysqli_fetch_row($sql_max);

$max_id=$row_max['0'];
 $id1='000'.'1';  
 
 $id2=$max_id+1;
 
 $User_ID='';
if($max_id<1){    $User_ID=$id1;     }

 else if($max_id<9){  $User_ID='000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $User_ID='00'.$id2;}  // 000.2-000.9
 else if($max_id<999){  $User_ID='0'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $User_ID='0'.$id2;} 
  else if($max_id<99999){  $User_ID= $id2;}
  
  $User_ID;



$Id = mysqli_real_escape_string($con,$_GET['Id']);

@$select=mysqli_query($con,"SELECT * from login WHERE Id='$Id'");
$f=mysqli_fetch_array($select);
$status = $f['status'];




?>



<div class="container">

<div class="row">
    <div class="col-lg-12">
                <h1 class="page-header">
                    <small>ເພີ່ມ ລາຍການຜູ້ນຳໃຊ້</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><font color="#000000">ຫນ້າຫລັກ</font></a>
                    </li>
                    <li class="active"><a href="users_list.php"><font color="#000000">ລາຍການ ຜູ້ນຳໃຊ້</font></a></li>
                </ol>
            </div>
        </div>


<form action="update_users.php" method="post" enctype="multipart/form-data">

	<div class="form-group row">
    <div class="col-sm-10">
      <a href="add_users.php"><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
          <button type="submit" class="btn btn-info" name="action" id="action" value="Add">ບັນທືກ</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button></td>
  
    </div>
  </div>
        
        <table width="352" border="0">
          <tr>
            <td width="81" align="right">ລະຫັດ:</td>
            <td width="261" ><input type="text" class="form-control" name="User_ID" value="<?PHP echo $f['User_ID'];?>" readonly>
            <input type="hidden" class="form-control" name="ID" value="<?PHP echo $f['ID'];?>" ></td>
          </tr>
          <tr>
            <td align="right">ລະຫັດຜູ້ໃຊ້:</td>
            <td><input type="text" class="form-control" name="User_Name" value="<?PHP echo $f['User_Name'];?>"></td>
          </tr>
         
          <tr>
            <td align="right">ລະຫັດຜ່ານ:</td>
            <td><input type="password" class="form-control" name="Password" value="..."></td>
          </tr>
          <tr>
               <td align="right">ສະຖານະ</td>
            <td><select name="status" class="form-control" required>
				<option value="<?PHP echo $status;?>"><?PHP if($status=='0'){echo 'Admin';} elseif($status=='1'){echo 'User';}else{}?></option>
				<option value="0">Admin</option>
				<option value="1">User</option>
				</select></td>
          </tr>
          <tr>
            <td align="right">office:</td>
            <td><input type="text" class="form-control" name="office" value="<?PHP echo $f['office'];?>"></td>
          </tr>
        </table>

</form>


<br><br>
</body>
</html>
<script type="text/javascript">
					jQuery(document).ready(function($) {
						$(".scroll").click(function(event){		
							event.preventDefault();
							$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
						});
					});
				</script>

