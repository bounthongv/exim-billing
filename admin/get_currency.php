<?php
include("init.php");


   $sql_exchange=mysqli_query($con,"select * from exchang where status='ok'");
	$g=mysqli_fetch_array($sql_exchange);
		
	$lak='1';
	$thb=$g['kip_baht'];
	$usd=$g['dollar_kip'];	
	
//	$cur=mysql_real_escape_string($_POST['cur']);
	
	
if(isset($_POST['cur'])){
		
		
	
	
		
	 $cur=mysqli_real_escape_string($con,$_POST['cur']);
	
	
	if($cur=='THB'){ echo $cur; $_SESSION['cur']=$thb; $_SESSION['cur_name']='THB';}
	else if ($cur=='USD'){ echo $cur; $_SESSION['cur']=$usd; $_SESSION['cur_name']='USD';}
	else{    echo $cur; $_SESSION['cur']=$lak; $_SESSION['cur_name']='LAK'; } 
	
	
	
	}
    ?>