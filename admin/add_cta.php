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
    <h3 align="center">ໃບສັນຍາການໃຫ້ເຄດິດຮ້ານຄ້າ</h3><br>


<form action="insert_cta.php" method="post">

  <div class="col-sm-10">
<button type="button" name="close" class="btn btn-danger" onclick="window.history.back()"><i class="fa fa-times"></i>&nbsp;ປິດ</button>
    <button type="submit" name="save"  class="btn btn-primary" ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
  </div>

<br>
<table>

<tr>
    <td>ເລກທີສັນຍາ:</td>
    <td><input type="text" class="form-control" style="width:500px" name="number_cta" id="number_cta" value="<?php echo $sale_id; ?>" readonly></td>
</tr>

<tr>
    <td>ຊື່ຮ້ານລູກຄ້າ Outlet Name:</td>
<td>
  <div class="input-group input-group-sm">
    <input type="text" class="form-control ss" name="Outlet_Name" id="Outlet_Name" value="" required  readonly>      
   <span class="input-group-addon">
   <button type="button" name="cc" class="btn btn-sm " data-toggle="modal" data-target="#customer_add" onclick="get_customer()" ><i class="fa fa-search"></i></button> </span>   
    </div>
</td>
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
    <td><input type="text" class="form-control" style="width:500px" name="Tel" id="Tel" value="" readonly></td>
</tr>




<tr>
    <td>ລະຫັດລູກຄ້າ Customer ID (OMNI) ຫລື ເລກທີ່ສັນຍາ</td>
    <td><input type="text" class="form-control" style="width:500px" name="Customer_ID" id="Customer_ID" value="" readonly></td>
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
    <td>ຈຳນວນວັນ:</td>
    <td><input type="text" class="form-control" style="width:500px" name="Number_days" id="Number_days" value=""></td>
</tr>

<tr>
    <td>ຈຳນວນໃບບິນ:</td>
    <td><input type="text" class="form-control" style="width:500px" name="Number_bills" id="Number_bills" value=""></td>
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







   <div class="modal" id="customer_add">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ລາຍການລູຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
       
        <!-- Modal body -->
        <div class="modal-body">
        
        <table>
             <td>ລະຫັດ<br><input  type="text" name="customer_id_s" id="customer_id_s" class="form-control customer_id_s"  ></td> 
             <td>ຊື່ລູກຄ້າ<br><input  type="text" name="customer_name_s" id="customer_name_s" class="form-control customer_id_s"  ></td> 
             <td>ເບີໂທ<br><input  type="text" name="customer_phone_s" id="customer_phone_s" class="form-control customer_id_s"  ></td> 
            <!-- <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>-->
        </table> 
        
        
        <div id="show_customer">
        
     
         </div>
        
         </div>
        
        <!-- Modal footer -->
        <div align="left" > &nbsp;  &nbsp;
          <!--<button  type="button" class="btn btn-success" id="update_qty" data-dismiss="modal" >ບັນທືກ</button>-->
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
          <br><br>
        </div>
        
      </div>
    </div>
  </div>



<script>


  function get_customer(){	 
		
			$.ajax({
			url:"search_customer.php",
			method:"POST",
		    //	data:{  stock_id:stock_id,price_type:price_type },
			success:function(data)
			{
				$('#show_customer').html(data);
				
			}
		});
	}



$(document).on('keyup', '.customer_id_s', function(){
	  
		
		var customer_id = $('#customer_id_s').val();
	    var customer_name = $('#customer_name_s').val();
		var customer_phone = $('#customer_phone_s').val();
		var action = "show";
		
		
		$.ajax({
			url:"search_customer.php",
			method:"POST",
		  data:{  action:action,customer_id:customer_id,customer_name:customer_name,customer_phone:customer_phone },
			success:function(data)
			{
				$('#show_customer').html(data);
				
			}
		});
		
	}); 


  $(document).on('click', '.add_customer', function(){


        var customer_id = $(this).attr("id");		
		var customer_name = $(this).attr("data-customer_name");
        var customer_phone = $(this).attr("data-customer_phone");

   
var village = $(this).attr("data-village");
var district = $(this).attr("data-district");
var Province = $(this).attr("data-Province");




		$('#Customer_ID').val(customer_id);
		$('#Outlet_Name').val(customer_name);
		$('#Tel').val(customer_phone);

$('#Address').val(village+'    '+district+'    '+Province);

  });

</script>