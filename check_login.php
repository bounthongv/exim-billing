<?php   
session_start();
include("dblink.php");


	if(isset($_POST['login'])){
		
		
		foreach ($_POST as $key => $value) {
    $_POST[$key]=addslashes(strip_tags(trim($value)));
       }
	   
	   if ($_POST['username'] !='') { 
	   $_POST['username']=(string)$_POST['username'];
	   $_POST['passs']=(string)$_POST['passs']; 
	    }
	  
       extract($_POST);
	   
    $username = addslashes(trim($_POST['username']));
	$mypassword = addslashes(trim($_POST['passs']));
	$stock_id = addslashes(trim($_POST['stock_id']));	

   // $myusername = stripslashes($_POST['username']);
    // $mypassword = stripslashes($_POST['passs']);
//	$username = mysql_real_escape_string($myusername);
//	$password =md5( mysql_real_escape_string($mypassword));
	
	$password =mysqli_real_escape_string($con,$mypassword);
	
//    $stock_id = stripslashes($_POST['stock_id']);
//	$stock_id = mysql_real_escape_string($stock_id);
	
		$sql="SELECT * FROM users WHERE User_Name='$username' and Password='$password'";
		$query = mysqli_query($con,$sql) or die("error=$sql");
		$mysql = mysqli_fetch_array($query);
		$num = mysqli_num_rows($query);
		
		if($num ==0 )
		
		
		 {  
			header('location:index.php');	
			         exit();
			
			}
			
			else{
			
				
				$_SESSION['user_id']=$mysql['User_ID'] ;
				$_SESSION['username']=$mysql['User_Name'] ;
				$_SESSION['status']=$mysql['status'];
				$_SESSION['menu']=$mysql['user_type'];
				$_SESSION['fname']=$mysql['fname'];
				$_SESSION['stock_id']=$stock_id;
				
				
				
				header('location:admin/index.php');	
	//	echo	$_SESSION['menu'] ;
			
	
				}
	}  ///
	else{
	header('location:index.php');	
	}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
