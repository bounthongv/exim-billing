<?php

include("init.php");
$office1=$_SESSION['office'];

$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];
if(isset($_POST['save'])){


$no=mysqli_real_escape_string($con,@$_POST['no']);
$Sending_date=mysqli_real_escape_string($con,@$_POST['Sending_date']);
$Truck_Number=mysqli_real_escape_string($con,@$_POST['Truck_Number']);
$Driver_Name=mysqli_real_escape_string($con,@$_POST['Driver_Name']);
$Distributor_Name=mysqli_real_escape_string($con,@$_POST['Distributor_Name']);


$sad1=mysqli_query($con,"INSERT into tbl_emp_pay_out_no(
    `no`,
    Sending_date,
    Truck_Number,
    Driver_Name,
    Distributor_Name,
    office_id,
    username
    )
    VALUES('$no','$Sending_date','$Truck_Number','$Driver_Name','$Distributor_Name','$office1','$username')");




if(isset($_POST['fomu_id_1'])){
	


    for ($i = 0; $i < count($_POST['fomu_id_1']); $i++) {

    $Description=mysqli_real_escape_string($con,@$_POST['Description'][$i]);
    $Item_number=mysqli_real_escape_string($con,@$_POST['Item_number'][$i]);
    $UOM=mysqli_real_escape_string($con,@$_POST['UOM'][$i]);
    $amount_received=mysqli_real_escape_string($con,@$_POST['amount_received'][$i]);


 

    $sad2=mysqli_query($con,"INSERT into tbl_empty_pay_out_note(
        `no`,
        `Description`, 
        Item_number,
        UOM,
        amount_received,
        fomu_id,
        office_id,
        username
 )VALUES('$no','$Description','$Item_number','$UOM','$amount_received'
 ,'$i','$office1','$username')");


    }

    unset($_SESSION["emp_pay_out"]);
}

if($sad1 && $sad2 ){
    echo "<script>alert('ສຳເລັດ');window.location='empty_pay_out_note.php';</script>";}
    else {echo "<script>alert('ບໍ່ສຳເລັດ');window.location='empty_pay_out_note.php;</script>";
    }
}
else{  }	




if(isset($_POST['update'])){


    $no=mysqli_real_escape_string($con,@$_POST['no']);
    $Sending_date=mysqli_real_escape_string($con,@$_POST['Sending_date']);
    $Truck_Number=mysqli_real_escape_string($con,@$_POST['Truck_Number']);
    $Driver_Name=mysqli_real_escape_string($con,@$_POST['Driver_Name']);
    $Distributor_Name=mysqli_real_escape_string($con,@$_POST['Distributor_Name']);


    $sad1=mysqli_query($con,"UPDATE tbl_emp_pay_out_no
    SET 
    Sending_date = '$Sending_date',
    Truck_Number = '$Truck_Number',
    Driver_Name = '$Driver_Name',
    Distributor_Name = '$Distributor_Name'
    WHERE `no` = '$no'
    and office_id='$office1'
    and username='$username'
    ");


$sql_del=mysqli_query($con,"delete from tbl_empty_pay_out_note where no='$no' and office_id='$office1' and username='$username' ");
    if(isset($_POST['fomu_id_1'])){
	


        for ($i = 0; $i < count($_POST['fomu_id_1']); $i++) {
    
        $Description=mysqli_real_escape_string($con,@$_POST['Description'][$i]);
        $Item_number=mysqli_real_escape_string($con,@$_POST['Item_number'][$i]);
        $UOM=mysqli_real_escape_string($con,@$_POST['UOM'][$i]);

        $amount_received=mysqli_real_escape_string($con,@$_POST['amount_received'][$i]);
    
    
    
        $sad2=mysqli_query($con,"INSERT into tbl_empty_pay_out_note(
            `no`,
            `Description`, 
            Item_number,
            UOM,
            amount_received,
            fomu_id,
            office_id,
            username
     )VALUES('$no','$Description','$Item_number','$UOM','$amount_received',
     '$i','$office1','$username')");
    
    
        }
    
        unset($_SESSION["emp_pay_out"]);
    }

    if($sad1 && $sad2 ){
        echo "<script>alert('ສຳເລັດ');window.location='empty_pay_out_note.php';</script>";}
        else {echo "<script>alert('ບໍ່ສຳເລັດ');window.location='empty_pay_out_note.php;</script>";
        }
}
else{  }	





?>