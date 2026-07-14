
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("init.php");
	$User_IDD = mysqli_real_escape_string($con,$_POST['User_ID']);
    $User_Namee = mysqli_real_escape_string($con,$_POST['User_Name']);
	$Password = mysqli_real_escape_string($con,$_POST['Password']);
	$statuss = mysqli_real_escape_string($con,$_POST['status']);
	$officee = mysqli_real_escape_string($con,$_POST['office']);
	$enpass=md5($Password);

$sad111=mysqli_query($con,"insert into login (User_ID, User_Name, Password, status, office)values
                                            ('$User_IDD', '$User_Namee', '$enpass', '$statuss', '$officee')");
	if($sad111){

        echo "<script type='text/javascript'>alert('ບັນນທືກໍ້ມູນສຳເລັດແລ້ວ')</script>";
        echo "<meta http-equiv ='refresh'content='0;URL=users_list.php'>";
    }else{
        echo "<script type='text/javascript'>alert('ບັນທືກຂໍ້ມູນບໍ່ສຳເລັດ');window.history.go(-1);</script>" ;
    }
	
	

?>
</html>
