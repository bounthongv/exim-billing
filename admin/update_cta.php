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
    $Number_bills            = mysqli_real_escape_string($con, $_POST['Number_bills']);
    $limited_amount         = mysqli_real_escape_string($con, $_POST['Limited_Amount']);
    $validation_date        = mysqli_real_escape_string($con, $_POST['Validation_Date']);

    // Checkbox - ຖ້າບໍ່ໄດ້ຕິກ ຈະບໍ່ຖືກສົ່ງມາໃນ $_POST ເລີຍ ຈຶ່ງຕ້ອງກວດສອບດ້ວຍ isset
    $mont = isset($_POST['MONT']) ? 1 : 0;
    $moft = isset($_POST['MOFT']) ? 1 : 0;
    $tont = isset($_POST['TONT']) ? 1 : 0;
    $toft = isset($_POST['TOFT']) ? 1 : 0;

    // ກວດສອບຄ່າວັນທີ (ຖ້າຫວ່າງ ໃຫ້ເປັນ NULL ແທນ string ຫວ່າງ ເພື່ອບໍ່ໃຫ້ error ກັບ column ປະເພດ date)
    $date_value = !empty($date) ? "'$date'" : "NULL";

    // ==== ສ່ວນທີ່ເພີ່ມ: ຈັດການ upload ໄຟລ໌ສັນຍາທີ່ເຊັນແລ້ວ (ຮູບພາບ/PDF) ====
    $file_sql_part = ""; // ຖ້າບໍ່ມີໄຟລ໌ໃໝ່ ຈະບໍ່ແກ້ column File_CTA ເລີຍ

    if (isset($_FILES['File_CTA']) && $_FILES['File_CTA']['error'] === 0) {

        $targetDir = __DIR__ . "/pdf_file/"; // ຕ້ອງສ້າງໂຟນເດີນີ້ໄວ້ກ່ອນ ແລະໃຫ້ writable

        // ສ້າງໂຟນເດີອັດຕະໂນມັດຖ້າຍັງບໍ່ມີ
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $originalName = $_FILES['File_CTA']['name'];
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowedExt = ["jpg", "jpeg", "png", "pdf"];

        // ຈຳກັດຂະໜາດໄຟລ໌ ບໍ່ໃຫ້ເກີນ 5MB
        $maxSize = 5 * 1024 * 1024;

        if (in_array($ext, $allowedExt) && $_FILES['File_CTA']['size'] <= $maxSize) {

            // ຕັ້ງຊື່ໄຟລ໌ໃໝ່ ກັນຊື່ຊ້ຳກັນ
            $newFileName = "cta_" . $Id . "_" . time() . "." . $ext;
            $targetPath = $targetDir . $newFileName;

            if (move_uploaded_file($_FILES['File_CTA']['tmp_name'], $targetPath)) {
    $fileNameEscaped = mysqli_real_escape_string($con, $newFileName);
    $file_sql_part = ", File_CTA = '$fileNameEscaped'";
} else {
    // DEBUG: แสดงสาเหตุจริงชั่วคราว
    echo "<script>alert('Upload error: " . error_get_last()['message'] . " | targetPath: $targetPath | is_writable: " . (is_writable($targetDir) ? 'yes' : 'no') . "');</script>";
}
        } else {
            echo "<script>alert('ໄຟລ໌ບໍ່ຖືກຕ້ອງ: ອະນຸຍາດສະເພາະ jpg, jpeg, png, pdf ແລະຂະໜາດບໍ່ເກີນ 5MB');</script>";
        }
    }
    // ==== ຈົບສ່ວນທີ່ເພີ່ມ ====

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
Number_bills = '$Number_bills',
Limited_Amount = '$limited_amount',
Validation_Date = '$validation_date'
$file_sql_part

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