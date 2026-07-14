<?php 
include("init.php");

  $office_name=mysqli_real_escape_string($con,$_POST["office_name"]);
  $office_logo=mysqli_real_escape_string($con,$_POST["office_logo"]);
  $signature1=mysqli_real_escape_string($con,$_POST["signature1"]);
  $signature2=mysqli_real_escape_string($con,$_POST["signature2"]);
  $signature3=mysqli_real_escape_string($con,$_POST["signature3"]);
  $signature4=mysqli_real_escape_string($con,$_POST["signature4"]);

	if(isset($_POST['action'])){
	   if($_POST['action']=="add"){
		   
	  $fileinfo=PATHINFO($_FILES["office_logo"]["name"]);	  
	  $newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
		$location="upload/" . $newFilename;
				
				move_uploaded_file($_FILES["office_logo"]["tmp_name"],"upload/" . $newFilename);
				
		$sql_in=mysqli_query($con,"INSERT INTO office 
		(office_name,office_logo,path,signature1,signature2,signature3,signature4) 
		values('$office_name','$newFilename','$location','$signature1','$signature2','$signature3','$signature4') ");
				
			if($sql_in){
				$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
				 header("location:office_detail.php");
				}
				else{
					$_SESSION['smg']="<div class='alert alert-danger'><strong>ບັນທືກບໍ່ສຳເລັດ!</strong></div>";
				 header("location:office_detail.php");					
					}
				
			
				
		
	   }
	   if($_POST['action']=="update"){
		   
		    $Id=mysqli_real_escape_string($con,$_POST["Id"]);
		   
		  
		  
		  
		  
		    $fileinfo=PATHINFO($_FILES["office_logo"]["name"]);	
			
			  
	  $newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
		$location="upload/" . $newFilename;
				
		if(move_uploaded_file($_FILES["office_logo"]["tmp_name"],"upload/" . $newFilename)){
			
			$lg=",office_logo='$newFilename',path='$location'";
			}
		else{
			
			$lg="";
			}
				
				
				
				
		$sql_in=mysqli_query($con,"update office set
		office_name='$office_name' $lg ,signature1='$signature1',signature2='$signature2',signature3='$signature3'
		,signature4='$signature4' where Id='$Id'
		");
				
			if($sql_in){
				$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
				 header("location:office_detail.php");
				}
				else{
					$_SESSION['smg']="<div class='alert alert-danger'><strong>ບັນທືກບໍ່ສຳເລັດ!</strong></div>";
				 header("location:office_detail.php");					
					}
		   
	   }
	  
	}
?>

