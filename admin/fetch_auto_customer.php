<?php 

 include "init.php";


if(isset($_POST['search'])){
    $search = $_POST['search'];

  
    $sql = mysqli_query($con,"SELECT *,concat(customer_id,'    ',customer_name) as full_name FROM customers WHERE customer_id like'%".$search."%' or customer_name like'%".$search."%'");
    
    while($row = mysqli_fetch_array($sql) ){
		
		
        $response[] = array("value"=>$row['customer_id'],"label"=>$row['full_name'],"customer_type"=>$row['customer_type']);
    }

    echo json_encode($response);
}

exit;


