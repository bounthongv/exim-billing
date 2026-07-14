<?php 
include("init.php");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

   $year_id=date('ymd');
      $id_y=date('Y');
	  $id_m=date('m');

$sql_max=mysqli_query($con,"select IFNULL(max(SUBSTRING(lg_id,8, 5)),0) as lg_id  from logistics where year(lg_date)='$id_y'   ");
@$row_max=mysqli_fetch_array($sql_max);

 $max_id=$row_max['lg_id'];
 $id1=$year_id.'.'.'0000'.'1';  
 
 $id2=$max_id+1;
 
 $s_id='';
if($max_id<1){    $s_id=$id1;     }

 else if($max_id<9){  $s_id=$year_id.'.'.'0000'.$id2;}  // 0000.2-0000.9
 else if($max_id<99){  $s_id=$year_id.'.'.'000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $s_id=$year_id.'.'.'00'.$id2;} // 0010-00999  //   0100 - 999

  else if($max_id<9999){  $s_id=$year_id.'.'.'0'.$id2;} 
  else if($max_id<99999){  $s_id=$year_id.'.'.$id2;}
   else if($max_id<999999){  $s_id=$year_id.'.'.$id2;}
  
date_default_timezone_set("Asia/Bangkok");




          $lg_date = mysqli_real_escape_string($con,$_POST['lg_date']);
     
         $route_id = mysqli_real_escape_string($con,$_POST['route_id']);
	     $regis_id = mysqli_real_escape_string($con,$_POST['regis_id']);
	  $driver_name = mysqli_real_escape_string($con,$_POST['driver_name']);
	$accounting_name = mysqli_real_escape_string($con,$_POST['accounting_name']);	
	  $worker_name = mysqli_real_escape_string($con,$_POST['worker_name']);
   
   
  
	
	


if(isset($_POST['save'])){
for ($i = 0; $i < count($_POST['sale_id']); $i++) {
			
			
		       $sale_id = mysqli_real_escape_string($con,$_POST['sale_id'][$i]);
			   $sale_date = mysqli_real_escape_string($con,$_POST['sale_date'][$i]);
	         
			  
			
			  
		
			  
		 $user_id=$_SESSION['user_id']; 
		 
		 $sql_in=mysqli_query($con,"INSERT INTO logistics 
		        (lg_id,lg_date,route_id,regis_id,driver_name,accounting_name,worker_name,order_id,order_date) 
		values('$s_id','$lg_date','$route_id','$regis_id','$driver_name','$accounting_name','$worker_name','$sale_id','$sale_date') ");
		
	
		

	  } /// end while product lot id
	   
		
}

			unset($_SESSION['cart_logistic']);
			unset($_SESSION["cart_name"]);
			
   if($sql_in){
		
		   if(isset($_SESSION['smg'])){    }
		   else{
		        $_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		        }
				
		       header("location:add_logistic.php");
		}
		
   else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
	 	header("location:add_logistic.php");
	    }
			

    



?>
</html>

 
