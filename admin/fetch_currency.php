<?php
include("init.php");


    $cur_date=mysqli_real_escape_string($con,$_POST['cur_date']);
$sql_exchange=mysqli_query($con,"select * from exchang where date_exchang <= '$cur_date'  order by date_exchang desc limit 1");
	
		 $data = array();
		 
	$ch=mysqli_num_rows($sql_exchange);
	if($ch>0){
    $g=mysqli_fetch_array($sql_exchange);
	
	     $data['status'] = 'ok';
        $data['result'] = $g;
    }else{
        $data['status'] = 'err';
        $data['result'] = '';
    }
	 echo json_encode($data);

	
	
    ?>