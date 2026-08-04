<?php 
include("init.php");
?>

<!DOCTYPE html><head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
<!--	<link href="//fonts.googleapis.com/css?family=Poppins:100i,200,200i,300,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">-->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">	
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
  
<!-- jQuery UI -->
<script src='jquery-3.1.1.min.js' type='text/javascript'></script>
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>



<?php  include("header.php"); 

    $year_id=date('Y');
      $id_y=date('Y');
	  $id_m=date('m');
/*
$sql_max=mysqli_query($con,"SELECT IFNULL(max(SUBSTRING(number_cta,4, 6)),0) as m_id 
 from tb_cta where year(Date)='$id_y'");
*/

$sql_max=mysqli_query($con,"SELECT
 IFNULL(max(SUBSTRING(number_cta,5, 6)),0) as m_id
 from tb_cta where year(Date)='$id_y'");

@$row_max=mysqli_fetch_array($sql_max);

 $max_id=$row_max['m_id'];
 $id1=$year_id.'00000'.'1';  
 
 $id2=$max_id+1;
 
 $sale_id='';
if($max_id<1){    $sale_id=$id1;     }

 else if($max_id<9){  $sale_id=$year_id.'00000'.$id2;}  // 0000.2-0000.9
 else if($max_id<99){  $sale_id=$year_id.'0000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $sale_id=$year_id.'000'.$id2;} // 0010-00999  //   0100 - 999

  else if($max_id<9999){  $sale_id=$year_id.'00'.$id2;} 
  else if($max_id<99999){  $sale_id=$year_id.'0'.$id2;}
   else if($max_id<999999){  $sale_id=$year_id.$id2;}




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

    <td><button type="button" class="form-control check_button" name="check" id="check" class="btn btn-sm" style="background-color:#FED8B1;" >ກວດ/Check</button></td>
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
			url:"search_check_customer.php",
			method:"POST",
		  data:{  customer_id:customer_id,customer_name:customer_name },
			success:function(data)
			{
		
$('#customer_id').val(data.customer_id);     
$('#customer_name').val(data.customer_name);


//$('#Debt_collection').val(data.Debt_collection);

let numberString = data.Debt_collection.toString();
let formattedNumber = numberString.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

$('#Debt_collection').val(formattedNumber);

$('#Number_of_days_outstanding').val(data.Number_of_days_overdue);
$('#Number_of_bills').val(data.Number_of_bills);

//$('#Contract_expiration_date').val(data.Contract_expiration_date);

var dateObj = new Date(data.Contract_expiration_date);
var day = ("0" + dateObj.getDate()).slice(-2);
var month = ("0" + (dateObj.getMonth() + 1)).slice(-2);
var year = dateObj.getFullYear();

var formattedDate = day + '/' + month + '/' + year; // จะได้ "DD/MM/YYYY"
$('#Contract_expiration_date').val(formattedDate);



$('#Outstanding_debt').val(Number(data.Outstanding_debt).toLocaleString('en-US'));
$('#Actual_number_of_days_of_infection').val(data.Actual_number_of_days_of_infection);
$('#Actual_number_of_outstanding_bills').val(data.Actual_number_of_outstanding_bills);



// เช็คสถานะหนี้ แล้วสลับสีปุ่ม
if(Number(data.Outstanding_debt) == 0 
   && Number(data.Actual_number_of_days_of_infection) == 0 
   && Number(data.Actual_number_of_outstanding_bills) == 0){

    $('#button1')
        .removeClass('btn-danger')
        .addClass('btn-success')
        .text('ບໍ່ຕິດໜີ້');   // ไม่มีหนี้ค้าง

} else {

    $('#button1')
        .removeClass('btn-success')
        .addClass('btn-danger')
        .text('ຕິດໜີ້');   // ติดหนี้

}



			}
		});



});


</script>