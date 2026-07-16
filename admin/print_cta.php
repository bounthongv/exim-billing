<?php
include 'init.php'; // ຕ້ອງມີຕົວແປ $con (mysqli connection)


$id = mysqli_real_escape_string($con,$_GET['Id']);


$sql = "SELECT * FROM tb_cta WHERE Id = $id";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    die("ບໍ່ພົບຂໍ້ມູນສັນຍານີ້");
}

$row = mysqli_fetch_assoc($result);

// ຟັງຊັນຊ່ວຍໃສ່ເຄື່ອງໝາຍຖືກໃນ checkbox
function chk($value) {
    return ($value == 1) ? "&#9745;" : "&#9744;"; // ☑ : ☐
}

// ຟັງຊັນຈັດຮູບແບບວັນທີ
function fmt_date($date) {
    if (empty($date) || $date == "0000-00-00") return "";
    return date("d/m/Y", strtotime($date));
}
?>
<!DOCTYPE html>
<html lang="lo">
<head>
<meta charset="utf-8">
<title>ໃບສັນຍາການໃຫ້ເຄດິດຮ້ານຄ້າ - <?php echo htmlspecialchars($row['Outlet_Name']); ?></title>
<style>
    body {
        font-family: "Phetsarath OT", "Noto Sans Lao", Tahoma, sans-serif;
        font-size: 14px;
        color: #000;
        max-width: 800px;
        margin: 20px auto;
        padding: 0 20px;
    }
    .header-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }
    .header-table td { vertical-align: top; border: none; }
    .header-table img { width: 90px; }
    .company-info { font-weight: bold; line-height: 1.5; }
    h2, h3 { text-align: center; margin: 4px 0; }
    .intro { text-align: left; margin: 15px 0; line-height: 1.6; }

    table.info-table, table.credit-table, table.bank-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }
    table.info-table td, table.credit-table td, table.bank-table td,
    table.bank-table th {
        border: 1px solid #000;
        padding: 6px 8px;
        vertical-align: middle;
    }
    .label-cell { width: 30%; font-weight: normal; }
    .value-cell { font-weight: bold; }
    .bank-table th { text-align: center; }
    .bank-table td { text-align: center; font-weight: bold; }

    .checkbox-row td { border: 1px solid #000; }

    .signature-table { width: 100%; margin-top: 50px; border: none; }
    .signature-table td { border: none; text-align: center; width: 50%; }
    .signature-line { margin-top: 60px; border-top: 1px dotted #000; width: 80%; margin-left: auto; margin-right: auto; }

    .print-btn-wrap { text-align: center; margin: 20px 0; }
    .btn-print {
        padding: 8px 20px; font-size: 14px; cursor: pointer;
        background: #337ab7; color: #fff; border: none; border-radius: 4px;
    }

    @media print {
        .print-btn-wrap { display: none; }
        body { margin: 0; }
    }
</style>
</head>
<body>

<?php 
/*
<div class="print-btn-wrap">
    <button class="btn-print" onclick="window.print()">🖨️ ພິມ / Print</button>
</div>
*/
 ?>


<table class="header-table">
    <tr>
       
        <td class="company-info">
            EXIM SERVICES SOLE CO., LTD.<br>
            #888 Hom 22, Unit 46 Nakhuay Tai Village, Xaysettha District, Vientiane, Lao PDR<br>
            Tel: +856-21-264087 &nbsp; website: www.exim.la
        </td>
         <td style="width:100px;"><img src="images/EXIM_logo.png" alt="logo"></td>
    </tr>
</table>


<div align="Right" style="width:100%">ເລກທີ: <?php echo $row['number_cta']; ?></div>



<h2>ໃບສັນຍາການໃຫ້ເຄດິດຮ້ານຄ້າ</h2>
<h3>Credit Term Agreement</h3>

<p class="intro">
ສັນຍາສະບັບນີ້ ແມ່ນເຮັດຂື້ນມາເພື່ອເປັນການຢັ້ງຢືນການຕົກລົງເຫັນດີຮ່ວມກັນທັງສອງຝ່າຍກ່ຽວກັບເງື່ອນໄຂຕ່າງໆ
ໃນການໃຫ້ Credit Term ສຳລັບການຊື້ຂາຍຜະລິດຕະພັນຂອງບໍລິສັດ Heineken Brewery Laos
ລະຫວ່າງຕົວແທນ Exim ແລະຮ້ານຄ້າ (ລູກຄ້າ), ດັ່ງລາຍລະອຽດລຸ່ມນີ້
</p>

<table class="info-table">
    <tr>
        <td class="label-cell">ຊື່ຮ້ານລູກຄ້າ Outlet Name:</td>
        <td class="value-cell" colspan="3"><?php echo htmlspecialchars($row['Outlet_Name']); ?></td>
    </tr>
    <tr>
        <td class="label-cell">ທີ່ຢູ່ Address</td>
        <td class="value-cell" colspan="3"><?php echo htmlspecialchars($row['Address']); ?></td>
    </tr>
    <tr>
        <td class="label-cell">ຜູ້ຕິດຕໍ່ Contact Person:</td>
        <td class="value-cell" colspan="3"><?php echo htmlspecialchars($row['Contact_Person']); ?></td>
    </tr>
    <tr>
        <td class="label-cell">ເບີໂທ Tel:</td>
        <td class="value-cell" colspan="3"><?php echo htmlspecialchars($row['Tel']); ?></td>
    </tr>
    <tr>
        <td class="label-cell">ລະຫັດລູກຄ້າ Customer ID (OMNI) ຫລື ເລກທີ່ສັນຍາ</td>
        <td class="value-cell"><?php echo htmlspecialchars($row['Customer_ID']); ?></td>
        <td class="label-cell" style="width:15%;">ວັນທີ່ເຊັນສັນຍາ Date</td>
        <td class="value-cell"><?php echo fmt_date($row['Date']); ?></td>
    </tr>
    <tr class="checkbox-row">
        <td class="label-cell">ຊ່ອງທາງການຈຳໜ່າຍ<br>Outlet Sales Channels:</td>
        <td colspan="3">
            <?php echo chk($row['MONT_SEP']); ?> MONT (SEP) &nbsp;&nbsp;
            <?php echo chk($row['MOFT_SEP']); ?> MOFT (SEP) &nbsp;&nbsp;
            <?php echo chk($row['TONT']); ?> TONT &nbsp;&nbsp;
            <?php echo chk($row['TOFT_SPP_SLP']); ?> TOFT (SPP/SLP)
        </td>
    </tr>
    <tr>
        <td class="label-cell">ລະຫັດສາຍທາງ Route Number:</td>
        <td class="value-cell" colspan="3"><?php echo htmlspecialchars($row['Route_Number']); ?></td>
    </tr>
</table>

<table class="credit-table">
    <tr>
        <td colspan="2" style="text-align:center; font-weight:bold;">ເງື່ອນໄຂການໃຫ້ເຄດິດ Credit Terms</td>
    </tr>
    <tr>
        <td class="label-cell">ຈຳນວນວັນ ຫລື ຈຳນວນໃບບິນ</td>
        <td class="value-cell"><?php echo htmlspecialchars($row['Number_days']); ?></td>
    </tr>
    <tr>
        <td class="label-cell">ວົງເງິນເຄດິດສູງສຸດ Limited Amount</td>
        <td class="value-cell"><?php echo htmlspecialchars($row['Limited_Amount']); ?></td>
    </tr>
    <tr>
        <td class="label-cell">ກຳນົດມື້ໝົດສັນຍາ Validation Date</td>
        <td class="value-cell"><?php echo htmlspecialchars($row['Validation_Date']); ?></td>
    </tr>
</table>

<table class="bank-table">
    <tr>
        <th colspan="3">ຊ່ອງທາງການຊຳລະ:</th>
    </tr>
    <tr>
        <th>ເລກບັນຊີ Account #</th>
        <th>Account Name</th>
        <th>Bank Name</th>
    </tr>
    <tr>
        <td>162.12.00.00335568.001</td>
        <td>EXIM SOLE CO., LTD</td>
        <td>BCEL</td>
    </tr>
    <tr>
        <td>910801118888</td>
        <td>EXIM SERVICES SOLE CO., LTD</td>
        <td>Vietin Bank</td>
    </tr>
    <tr>
        <td>0302300010000131</td>
        <td>EXIM SERVICES SOLE CO., LTD</td>
        <td>LDB</td>
    </tr>
</table>

<table class="signature-table">
    <tr>
        <td>
            <div class="signature-line"></div>
            ລາຍເຊັນ-ຊື່ແຈ້ງ ຂອງພະນັກງານຂາຍຕົວແທນ
        </td>
        <td>
            <div class="signature-line"></div>
            ລາຍເຊັນ-ຊື່ແຈ້ງ ຂອງລູກຄ້າ
        </td>
    </tr>
</table>

<script>
    // ພິມອັດຕະໂນມັດທັນທີທີ່ໜ້າໂຫລດສຳເລັດ
    window.onload = function () {
        window.print();
    };
</script>

</body>
</html>