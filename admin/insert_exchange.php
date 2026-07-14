<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php




	$date_exchang = mysqli_real_escape_string($con,$_POST['date_exchang']);
	$kip_baht = mysqli_real_escape_string($con,$_POST['kip_baht']);
	$dollar_baht = mysqli_real_escape_string($con,$_POST['dollar_baht']);	
	$remark = mysqli_real_escape_string($con,$_POST['remark']);
	
    $action = mysqli_real_escape_string($con,$_POST['action']);
	$id = mysqli_real_escape_string($con,$_POST['eid']);
	
if($action=="Add"){

$sql=mysqli_query($con,"INSERT INTO exchang(date_exchang,kip_baht,dollar_baht, remark)
values('$date_exchang', '$kip_baht',  '$dollar_baht', '$remark')");


	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:exchange_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:exchange_list.php");}
		
}
else if($action=="Update"){
	



if($date_exchang==""){ $ex="date_exchang=''";}
else{$ex="date_exchang='$date_exchang'";}

if($kip_baht==""){ $k=",kip_baht=''";}
else{$k=",kip_baht='$kip_baht'";}

if($dollar_baht==""){ $d=",dollar_baht='$dollar_baht'";}
else{$d=",dollar_baht='$dollar_baht'";}


if($remark==""){ $r=",remark=''";}
else{$r=",remark='$remark'";}



$sql=mysqli_query($con,"UPDATE exchang SET $ex $k   $d  $r WHERE eid='$id' ");


	if($sql){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:exchange_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:exchange_list.php");
	}
	
	
	}
else{
	
	
	
	
	}

?>
</html>

 