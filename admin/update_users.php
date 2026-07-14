
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
include("init.php");
      @$Id =mysqli_real_escape_string($con,$_POST['ID']);
	  
         $User_ID =mysqli_real_escape_string($con, $_POST['User_ID']);
	    $User_Name = mysqli_real_escape_string($con,$_POST['User_Name']);
	     $Password = mysqli_real_escape_string($con,$_POST['Password']);
		 $enpassword=md5($Password);
		   $status = mysqli_real_escape_string($con,$_POST['status']);
		   
		    $office = mysqli_real_escape_string($con,$_POST['office']);
			
			if($Password==''){ $sp="";}else{ $sp=",Password='$enpassword'";}



    $sql="UPDATE login SET User_Name='$User_Name',User_ID='$User_ID',status='$status' $sp WHERE ID='$Id'";
    $sql_query=mysqli_query($con,$sql);
	
	
	
    if($sql_query) {
        echo "<script type='text/javascript'>alert('ແກ້ໄຂຂໍ້ມູນສຳເລັດແລ້ວ')</script>";
        echo "<meta http-equiv ='refresh'content='0;URL=users_list.php'>";
    }else{
        echo "<script type='text/javascript'>alert('ແກ້ໄຂຂໍ້ມູນບໍ່ສຳເລັດ');window.history.go(-1);</script>" ;
    }

?>
