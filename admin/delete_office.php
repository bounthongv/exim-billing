
<meta charset="utf-8" />

<?php 

include("init.php");

if(isset($_GET['Id'])){
$Id=mysqli_real_escape_string($con,$_GET['Id']);

$sql=mysqli_query($con,"DELETE FROM office WHERE Id = '$Id'");

 if($sql){  echo "<script>alert('ຂໍ້ມູນຖືກລົບອອກແລ້ວ');window.location='office_detail.php';</script>"; }
 		else{   echo "<script>alert('ລົບຂໍ້ມູນບໍໄດ້');window.location='office_detail.php';</script>"; }
}

?>