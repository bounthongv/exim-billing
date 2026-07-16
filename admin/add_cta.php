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



<?php  include("header.php"); ?>

 <script src="js/numeral.min.js"></script>

<div class="container">
    <br>
    <h3 align="center">ໃບສັນຍາການໃຫ້ເຄດິດຮ້ານຄ້າ</h3><br>


<form action="insert_cta.php" method="post">

  <div class="col-sm-10">
<button type="button" name="close" class="btn btn-danger" onclick="window.history.back()"><i class="fa fa-times"></i>&nbsp;ປິດ</button>
    <button type="submit" name="save"  class="btn btn-primary" ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
  </div>

<br>
<table>
<tr>
    <td>ຊື່ຮ້ານລູກຄ້າ Outlet Name:</td>
    <td><input type="text" class="form-control" style="width:500px" name="Outlet_Name" id="Outlet_Name" value=""></td>
</tr>


<tr>
    <td>ທີ່ຢູ່ Address:</td>
    <td><input type="text" class="form-control" style="width:500px" name="Address" id="Address" value=""></td>
</tr>



<tr>
    <td>ຜູ້ຕິດຕໍ່ Contact Person:</td>
    <td><input type="text" class="form-control" style="width:500px" name="Contact_Person" id="Contact_Person" value=""></td>
</tr>

<tr>
    <td>ເບີໂທ Tel:</td>
    <td><input type="text" class="form-control" style="width:500px" name="Tel" id="Tel" value=""></td>
</tr>




<tr>
    <td>ລະຫັດລູກຄ້າ Customer ID (OMNI) ຫລື ເລກທີ່ສັນຍາ</td>
    <td><input type="text" class="form-control" style="width:500px" name="Customer_ID" id="Customer_ID" value=""></td>
</tr>

<tr>
    <td>ວັນທີ່ເຊັນສັນຍາ Date</td>
    <td><input type="date" class="form-control" style="width:500px" name="Date" id="Date" value="<?php echo date('Y-m-d'); ?>"></td>
</tr>



<tr>
    <td>ຊ່ອງທາງການຈຳໜ່າຍ Outlet Sales Channels:</td>
    <td><input type="text" class="form-control" style="width:500px" name="Outlet_Sales_Channels" id="Outlet_Sales_Channels" value=""></td>
</tr>


<tr><td colspan="2">
<table>
<tr>
    <td><input type="checkbox" class="form-control" name="MONT" id="MONT" value=""></td><td>MONT (SEP)</td>
    <td><input type="checkbox" class="form-control" name="MOFT" id="MOFT" value=""></td><td>MOFT (SEP)</td>
    <td><input type="checkbox" class="form-control" name="TONT" id="TONT" value=""></td><td>TONT</td>
    <td><input type="checkbox" class="form-control" name="TOFT" id="TOFT" value=""></td><td>TOFT (SPP/SLP)</td>
</tr>
</table>
</td></tr>


<tr>
    <td>ລະຫັດສາຍທາງ Route Number:</td>
    <td><input type="text" class="form-control" style="width:500px" name="Route_Number" id="Route_Number" value=""></td>
</tr>

<tr>
    <td>ຈຳນວນວັນ ຫລື ຈຳນວນໃບບິນ:</td>
    <td><input type="text" class="form-control" style="width:500px" name="Number_days" id="Number_days" value=""></td>
</tr>

<tr>
    <td>ວົງເງິນເຄດິດສູງສຸດ Limited Amount:</td>
    <td><input type="text" class="form-control" style="width:500px" name="Limited_Amount" id="Limited_Amount" value=""></td>
</tr>
	
<tr>
    <td>ກຳນົດມື້ໝົດສັນຍາ Validation Date</td>
    <td><input type="text" class="form-control" style="width:500px" name="Validation_Date" id="Validation_Date" value=""></td>
</tr>


</table>



</form>





</div>