<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

    


	$User_ID = mysqli_real_escape_string($con,$_POST['User_ID']);
	$User_Name = mysqli_real_escape_string($con,$_POST['User_Name']);
	$stock_id = mysqli_real_escape_string($con,$_POST['stock_id']);
	$status = mysqli_real_escape_string($con,$_POST['status']);
	$fname = mysqli_real_escape_string($con,$_POST['fname']);
	$user_type = mysqli_real_escape_string($con,$_POST['user_type']);
	
    $password = mysqli_real_escape_string($con,$_POST['password']);
	$en_pass=md5($password);
	
    $action = mysqli_real_escape_string($con,$_POST['action']);
	$id = mysqli_real_escape_string($con,$_POST['id']);
	
	
	
if(isset($_POST['menu_list'])){
	$sql_cc=mysqli_query($con,"delete from menu_user where user_id='$User_ID'");
	
	$sql_in=mysqli_query($con," insert into menu_user (user_id,list_id,status)
    select  '$User_ID',menu_list.list_id,'off'
     from menu_list");
     
	 for ($i = 0; $i < count($_POST['menu_list']); $i++) {
	
	echo $list_id= mysqli_real_escape_string($con,$_POST['menu_list'][$i]);
	
	
	$sql_in=mysqli_query($con,"update menu_user set status='on' where user_id='$User_ID' and list_id='$list_id'");
	
         }

     }


	
if($action=="Add"){

$sql=mysqli_query($con,"INSERT INTO users(User_ID, User_Name,Password, stock_id,status,fname,user_type)values('$User_ID', '$User_Name',  '$password', '$stock_id', '$status','$fname','$user_type')");


	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:user_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:user_list.php");}
		
}
else if($action=="Update"){
	

if($password==''){$ppw="";}else{$ppw=",Password='$password'";}

$sql=mysqli_query($con,"UPDATE users SET User_ID='$User_ID',User_Name='$User_Name',stock_id='$stock_id',status='$status'
,fname='$fname',user_type='$user_type' $ppw  WHERE id='$id' ");


	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:user_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:user_list.php");
	}
	
	
	}
else{
	
	
	
	
	}

?>
</html>

 