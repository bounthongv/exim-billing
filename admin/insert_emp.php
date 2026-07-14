<?php

include("init.php");

if(isset($_POST['save'])){


$no=mysqli_real_escape_string($con,@$_POST['no']);
$Sending_date=mysqli_real_escape_string($con,@$_POST['Sending_date']);
$Truck_Number=mysqli_real_escape_string($con,@$_POST['Truck_Number']);
$Driver_Name=mysqli_real_escape_string($con,@$_POST['Driver_Name']);
$Distributor_Name=mysqli_real_escape_string($con,@$_POST['Distributor_Name']);


$sad1=mysqli_query($con,"INSERT into tbl_emp_no(
    `no`,
    Sending_date,
    Truck_Number,
    Driver_Name,
    Distributor_Name
    )
    VALUES('$no','$Sending_date','$Truck_Number','$Driver_Name','$Distributor_Name')");




if(isset($_POST['fomu_id_1'])){
	


    for ($i = 0; $i < count($_POST['fomu_id_1']); $i++) {

    $Description=mysqli_real_escape_string($con,@$_POST['Description'][$i]);
    $Item_number=mysqli_real_escape_string($con,@$_POST['Item_number'][$i]);
    $UOM=mysqli_real_escape_string($con,@$_POST['UOM'][$i]);
    $Customer_Count=mysqli_real_escape_string($con,@$_POST['Customer_Count'][$i]);

    $Driver_Count=mysqli_real_escape_string($con,@$_POST['Driver_Count'][$i]);
    $Driver_Count_in_WareHouse=mysqli_real_escape_string($con,@$_POST['Driver_Count_in_WareHouse'][$i]);
    $Storekeeper_Count=mysqli_real_escape_string($con,@$_POST['Storekeeper_Count'][$i]);
    $Detall_of_Information=mysqli_real_escape_string($con,@$_POST['Detall_of_Information'][$i]);


 

    $sad2=mysqli_query($con,"INSERT into tbl_empty_return_note(
        `no`,
        `Description`, 
        Item_number,
        UOM,
        Customer_Count,
        Driver_Count,
        Driver_Count_in_WareHouse,
        Storekeeper_Count,
        Detall_of_Information,
        fomu_id
 )VALUES('$no','$Description','$Item_number','$UOM','$Customer_Count','$Driver_Count'
 ,'$Driver_Count_in_WareHouse','$Storekeeper_Count','$Detall_of_Information',
 '$i')");


    }

    unset($_SESSION["emp"]);
}

if($sad1 && $sad2 ){
    echo "<script>alert('ສຳເລັດ');window.location='empty_return_note.php';</script>";}
    else {echo "<script>alert('ບໍ່ສຳເລັດ');window.location='empty_return_note.php;</script>";
    }
}
else{  }	




if(isset($_POST['update'])){


    $no=mysqli_real_escape_string($con,@$_POST['no']);
    $Sending_date=mysqli_real_escape_string($con,@$_POST['Sending_date']);
    $Truck_Number=mysqli_real_escape_string($con,@$_POST['Truck_Number']);
    $Driver_Name=mysqli_real_escape_string($con,@$_POST['Driver_Name']);
    $Distributor_Name=mysqli_real_escape_string($con,@$_POST['Distributor_Name']);


    $sad1=mysqli_query($con,"UPDATE tbl_emp_no
    SET 
    Sending_date = '$Sending_date',
    Truck_Number = '$Truck_Number',
    Driver_Name = '$Driver_Name',
    Distributor_Name = '$Distributor_Name'
    WHERE `no` = '$no'");


$sql_del=mysqli_query($con,"delete from tbl_empty_return_note where no='$no' ");
    if(isset($_POST['fomu_id_1'])){
	


        for ($i = 0; $i < count($_POST['fomu_id_1']); $i++) {
    
        $Description=mysqli_real_escape_string($con,@$_POST['Description'][$i]);
        $Item_number=mysqli_real_escape_string($con,@$_POST['Item_number'][$i]);
        $UOM=mysqli_real_escape_string($con,@$_POST['UOM'][$i]);
        $Customer_Count=mysqli_real_escape_string($con,@$_POST['Customer_Count'][$i]);
    
        $Driver_Count=mysqli_real_escape_string($con,@$_POST['Driver_Count'][$i]);
        $Driver_Count_in_WareHouse=mysqli_real_escape_string($con,@$_POST['Driver_Count_in_WareHouse'][$i]);
        $Storekeeper_Count=mysqli_real_escape_string($con,@$_POST['Storekeeper_Count'][$i]);
        $Detall_of_Information=mysqli_real_escape_string($con,@$_POST['Detall_of_Information'][$i]);
    
    
        $sad2=mysqli_query($con,"INSERT into tbl_empty_return_note(
            `no`,
            `Description`, 
            Item_number,
            UOM,
            Customer_Count,
            Driver_Count,
            Driver_Count_in_WareHouse,
            Storekeeper_Count,
            Detall_of_Information,
            fomu_id
     )VALUES('$no','$Description','$Item_number','$UOM','$Customer_Count','$Driver_Count','$Driver_Count_in_WareHouse','$Storekeeper_Count','$Detall_of_Information',
     '$i')");
    
    
        }
    
        unset($_SESSION["emp"]);
    }

    if($sad1 && $sad2 ){
        echo "<script>alert('ສຳເລັດ');window.location='empty_return_note.php';</script>";}
        else {echo "<script>alert('ບໍ່ສຳເລັດ');window.location='empty_return_note.php;</script>";
        }
}
else{  }	





?>