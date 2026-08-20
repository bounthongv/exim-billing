<?php 
include("init.php");
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">    
    
    <!-- jQuery UI & jQuery JS (โหลด jQuery แค่ตัวเดียวเพื่อลดความขัดแย้ง) -->
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>

<?php  
include("header.php"); 

$year_id = date('Y');
$id_y = date('Y');
$id_m = date('m');

$sql_max = mysqli_query($con, "SELECT IFNULL(max(SUBSTRING(number_cta,5, 6)),0) as m_id from tb_cta where year(Date)='$id_y'");
@$row_max = mysqli_fetch_array($sql_max);

$max_id = $row_max['m_id'];
$id1 = $year_id.'00000'.'1';  
$id2 = $max_id + 1;

$sale_id = '';
if($max_id < 1) {        
    $sale_id = $id1;     
} else if($max_id < 9) {  
    $sale_id = $year_id.'00000'.$id2;
} else if($max_id < 99) {  
    $sale_id = $year_id.'0000'.$id2;
} else if($max_id < 999) {  
    $sale_id = $year_id.'000'.$id2;
} else if($max_id < 9999) {  
    $sale_id = $year_id.'00'.$id2;
} else if($max_id < 99999) {  
    $sale_id = $year_id.'0'.$id2;
} else if($max_id < 999999) {  
    $sale_id = $year_id.$id2;
}
?>

<script src="js/numeral.min.js"></script>

<div class="container">
    <br>
    <h3 align="center">ກວດວົງເງິນ-ຍອດໜີ້</h3><br>

    <table>
        <tr>
            <td>ລະຫັດ:</td>
            <td><input type="text" class="form-control" name="customer_id" id="customer_id" value=""></td>
            <td>ຊື່ລູກຄ້າ</td>
            <td><input type="text" class="form-control" name="customer_name" id="customer_name" value=""></td>
            <td><button type="button" class="form-control check_button btn btn-sm" name="check" id="check" style="background-color:#FED8B1;">ກວດ/Check</button></td>
        </tr>
    </table>

    <br>

    <table>
        <tr>
            <td>ວົງເງິນຕິດໜີ້:</td>
            <td><input type="text" class="form-control" style="width:300px" name="Debt_collection" id="Debt_collection" value="" readonly></td>
            <td>ຍອດໜີ້ຄ້າງຈ່າຍ</td>
            <td><input type="text" class="form-control" style="width:300px" name="Outstanding_debt" id="Outstanding_debt" value="" readonly></td>
        </tr>
        <tr>
            <td>ຈຳນວນມື້ຕິດໜີ້:</td>
            <td><input type="text" class="form-control" style="width:300px" name="Number_of_days_outstanding" id="Number_of_days_outstanding" value="" readonly></td>
            <td>ຈຳນວນມື້ຕິດຕົວຈິງ</td>
            <td><input type="text" class="form-control" style="width:300px" name="Actual_number_of_days_of_infection" id="Actual_number_of_days_of_infection" value="" readonly></td>
        </tr>
        <tr>
            <td>ຈຳນວນໃບບິນ:</td>
            <td><input type="text" class="form-control" style="width:300px" name="Number_of_bills" id="Number_of_bills" value="" readonly></td>
            <td>ຈຳນວນໃບບິນຕິດໜີ້ຕົວຈິງ</td>
            <td><input type="text" class="form-control" style="width:300px" name="Actual_number_of_outstanding_bills" id="Actual_number_of_outstanding_bills" value="" readonly></td>
        </tr>
        <tr>
            <td>ວັນໝົດອາຍຸສັນຍາ:</td>
            <td><input type="text" class="form-control" style="width:300px" name="Contract_expiration_date" id="Contract_expiration_date" value="" readonly></td>
            <td>ສະຖານະ</td>
            <td><button type="button" id="button1" style="width:300px" class="btn btn-danger btn-sm btn-status">ຕິດໜີ້</button></td>
        </tr>
    </table>
</div>

<script>
$(document).on('click', '.check_button', function(){
    var customer_id = $('#customer_id').val();
    var customer_name = $('#customer_name').val();

    $.ajax({
        url: "search_check_customer.php",
        method: "POST",
        data: { customer_id: customer_id, customer_name: customer_name },
        dataType: "json", // กำหนดให้รับค่าเป็น JSON อัตโนมัติ
        success: function(data) {
            if (!data) return;

            $('#customer_id').val(data.customer_id || ''); 
            $('#customer_name').val(data.customer_name || '');

            // แปลงเป็นตัวเลข และรองรับกรณีที่ค่าส่งมาเป็น null
            let debtCollection = Number(data.Debt_collection || 0);
            $('#Debt_collection').val(debtCollection.toLocaleString('en-US'));

            $('#Number_of_days_outstanding').val(data.Number_of_days_overdue || 0);
            $('#Number_of_bills').val(data.Number_of_bills || 0);

            // จัดการวันที่ (เช็คว่ามีค่าส่งมาหรือไม่)
            if (data.Contract_expiration_date) {
                var dateObj = new Date(data.Contract_expiration_date);
                if (!isNaN(dateObj.getTime())) {
                    var day = ("0" + dateObj.getDate()).slice(-2);
                    var month = ("0" + (dateObj.getMonth() + 1)).slice(-2);
                    var year = dateObj.getFullYear();
                    $('#Contract_expiration_date').val(day + '/' + month + '/' + year);
                } else {
                    $('#Contract_expiration_date').val(data.Contract_expiration_date);
                }
            } else {
                $('#Contract_expiration_date').val('');
            }

            let outstandingDebt = Number(data.Outstanding_debt || 0);
            let actualDays = Number(data.Actual_number_of_days_of_infection || 0);
            let actualBills = Number(data.Actual_number_of_outstanding_bills || 0);

            $('#Outstanding_debt').val(outstandingDebt.toLocaleString('en-US'));
            $('#Actual_number_of_days_of_infection').val(actualDays);
            $('#Actual_number_of_outstanding_bills').val(actualBills);

            // เช็คสถานะหนี้
            if (outstandingDebt === 0 && actualDays === 0 && actualBills === 0) {
                $('#button1')
                    .removeClass('btn-danger')
                    .addClass('btn-success')
                    .text('ບໍ່ຕິດໜີ້');
            } else {
                $('#button1')
                    .removeClass('btn-success')
                    .addClass('btn-danger')
                    .text('ຕິດໜີ້');
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: ", error);
        }
    });
});
</script>