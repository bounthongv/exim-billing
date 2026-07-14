<?php 

 include "init.php";


if(isset($_POST['search'])){
    $search = $_POST['search'];

  
    $sql = mysqli_query($con,"SELECT *,concat(Product_ID,'    ',Product_Name) as full_name FROM products WHERE Product_ID like'%".$search."%' or Product_Name like'%".$search."%'");
    
    while($row = mysqli_fetch_array($sql) ){
		
		
        $response[] = array("value"=>$row['Product_ID'],"label"=>$row['full_name'],"units"=>$row['Unit'],"ups"=>$row['ups'],"sell_price"=>$row['s3_price']);
    }

    echo json_encode($response);
}

exit;


