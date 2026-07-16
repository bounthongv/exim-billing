<?php
// ປັບບໍ່ຊື່ file connection ໃຫ້ຖືກຕ້ອງກັບລະບົບຂອງທ່ານ
include("init.php"); // ຕ້ອງມີຕົວແປ $con (mysqli connection) ຢູ່ໃນ file ນີ້

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ດຶງ ແລະ escape ຄ່າຈາກ form (ຕົວອັກສອນ)

$Id           = mysqli_real_escape_string($con, $_POST['Id']);


    $outlet_name           = mysqli_real_escape_string($con, $_POST['Outlet_Name']);
    $address                = mysqli_real_escape_string($con, $_POST['Address']);
    $contact_person         = mysqli_real_escape_string($con, $_POST['Contact_Person']);
    $tel                    = mysqli_real_escape_string($con, $_POST['Tel']);
    $customer_id            = mysqli_real_escape_string($con, $_POST['Customer_ID']);
    $date                   = mysqli_real_escape_string($con, $_POST['Date']);
    $outlet_sales_channels  = mysqli_real_escape_string($con, $_POST['Outlet_Sales_Channels']);
    $route_number           = mysqli_real_escape_string($con, $_POST['Route_Number']);
    $number_days            = mysqli_real_escape_string($con, $_POST['Number_days']);
    $limited_amount         = mysqli_real_escape_string($con, $_POST['Limited_Amount']);
    $validation_date        = mysqli_real_escape_string($con, $_POST['Validation_Date']);

    // Checkbox - ຖ້າບໍ່ໄດ້ຕິກ ຈະບໍ່ຖືກສົ່ງມາໃນ $_POST ເລີຍ ຈຶ່ງຕ້ອງກວດສອບດ້ວຍ isset
    $mont = isset($_POST['MONT']) ? 1 : 0;
    $moft = isset($_POST['MOFT']) ? 1 : 0;
    $tont = isset($_POST['TONT']) ? 1 : 0;
    $toft = isset($_POST['TOFT']) ? 1 : 0;

    // ກວດສອບຄ່າວັນທີ (ຖ້າຫວ່າງ ໃຫ້ເປັນ NULL ແທນ string ຫວ່າງ ເພື່ອບໍ່ໃຫ້ error ກັບ column ປະເພດ date)
    $date_value = !empty($date) ? "'$date'" : "NULL";

    $sql = "UPDATE `tb_cta` SET 
Outlet_Name = '$outlet_name',
`Address` = '$address',
Contact_Person = '$contact_person',
Tel = '$tel',
Customer_ID = '$customer_id',
`Date` = '$date',
Outlet_Sales_Channels = '$outlet_sales_channels',
MONT_SEP = '$mont',
MOFT_SEP = '$moft',
TONT = '$tont',
TOFT_SPP_SLP = '$toft',
Route_Number = '$route_number',
Number_days = '$number_days',
Limited_Amount = '$limited_amount',
Validation_Date = '$validation_date'

    WHERE `tb_cta`.`Id` = '$Id'";

    if (mysqli_query($con, $sql)) {

    echo "<script>
            alert('ບັນທືກຂໍ້ມູນຜ່ານ');
             window.location.href = 'Credit_Term_Agreement.php?status=success';
          </script>";


      //  header("Location: Credit_Term_Agreement.php?status=success");
        exit();
    } else {
        echo "ເກີດຂໍ້ຜິດພາດ: " . mysqli_error($con);
    }

} else {
 echo "<script>
            alert('ກະລຸນາບັນທືກຂໍ້ມູນຜ່ານແບບຟອມກ່ອນ');
            window.location.href = 'index.php';
          </script>";
    exit();
}