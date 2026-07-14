<?php 

 include "init.php";


if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($con,$_POST['search']);

  
    $sql = mysqli_query($con,"SELECT *,concat(supplier_id,'    ',supplier_name) as full_name FROM suppliers WHERE supplier_id like'%".$search."%' or supplier_name like'%".$search."%'");
    
    while($row = mysqli_fetch_array($sql) ){
		
		
        $response[] = array("value"=>$row['supplier_id'],"label"=>$row['full_name']);
    }

    echo json_encode($response);
}

exit;


