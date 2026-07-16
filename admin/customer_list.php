<?php 
include("init.php");

?>
<style>
td{ padding:10px;
font-weight:!important;
height:40px;
 }
</style>




<!DOCTYPE html>



<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
<!--	<link href="//fonts.googleapis.com/css?family=Poppins:100i,200,200i,300,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">-->
	<link href="js/iconic.css" rel="stylesheet">
  <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

 

<?php
$sql_max=mysqli_query($con,"    select max(SUBSTRING(customer_id, 2, 7)) as id from customers");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='C000'.'1';  
 
 $id2=(int)$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $suppliers_id=$id1;     }

 else if($max_id<9){  $suppliers_id='C000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $suppliers_id='C00'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $suppliers_id='C0'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $suppliers_id='C'.$id2;} 
  else if($max_id<99999){  $suppliers_id='C'.$id2;}
  
   $suppliers_id;

?>


<?php  include("header.php");?>
<style>
#search{border:1px solid #008000; border-radius:4px; background-color:#008000; padding:5px; color:#FFF; font-family:"Phetsarath OT";}

input{padding:4px; border:1px solid #D8D8D8; border-radius:4px;}


</style>
<style>
td{ padding:10px;
font-weight:!important;
height:20px;
 }
</style>

    <!-- Navigation -->
<style>
.save1{
	    color:#000;
	    border:1px solid #E4E4E4;
		border-radius:3px;
		padding:5px;
}
.bgtd{background-color: #EBEBEB;
		
}
.container_new{ padding-left:10px;}
</style>

 <link rel="stylesheet" href="select2/select2.min.css">
<script src="select2/select2.full.min.js"></script>
<script>

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

<div class="container_new">
    <br>
    <h3 align="center">ລາຍການລູກຄ້າ</h3><br>
   


          
            

             <table>
       <tr>
           <td><br><button type="button" class="btn btn-success" data-toggle="modal" 
           data-target="#add_stock2"><i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ </button></td> 
      
      
    
            
      
       <td>ປະເພດ<br><select name="c_type" id="c_type" class="form-control s_customer "  >
             <option value="">ທັງໝົດ</option>
             <option value="002">wholesaler</option>
             <option value="003">outlet</option>
             </select>
             </td> 
    
             <td>ລະຫັດ<br><input  type="text" name="c_id" id="c_id" class="form-control s_customer"  ></td> 
             <td>ຊື່ລູກຄ້າ<br><input  type="text" name="c_name" id="c_name" class="form-control s_customer"  ></td>
             <td>ບ້ານ<br><input  type="text" name="c_village" id="c_village" class="form-control s_customer"  ></td>
             <td>ເມືອງ<br><input  type="text" name="c_district" id="c_district" class="form-control s_customer"  ></td> 
             <td>ຈຳນວນສະແດງ<br><input  type="text" name="limit_row" id="limit_row" class="form-control s_customer" value="1000"  ></td> 
            
             <!--<td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>-->
             <td><br>
       <button type="button" class="btn btn-success" id="print_excel"><i class="fa fa-file-excel" aria-hidden="true"></i></button></td>

<td>
  <?php /*
<form action="import_customer_file_2.php" method="POST" enctype="multipart/form-data">
        <label>เลือกไฟล์ Excel (.xlsx):</label>
        <input type="file" name="excel_file" accept=".xlsx, .xls" required>
        <button type="submit" name="import">อัปโหลดและนำเข้าข้อมูล</button>
    </form>
*/ ?>



 
<form action="import_customer_file.php" method="post" enctype="multipart/form-data">
    <input type="file" name="excel_file" accept=".csv" required> 
    
    <button type="submit" name="import">นำเข้าข้อมูล</button>
</form>

</td> 
       </tr>
       </table>
       
       
    
        <!-- Content Row -->
        <div class="row">
        <div class="col-lg-12">
        
<br>





 			<div id="display_stock_list"></div>
  





  	
<div class="modal" id="add_stock">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ແກ້ໄຂລາຍການລູກຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
   	
	<form action="insert_customer.php" method="post" enctype="multipart/form-data">

  
          <button type="submit" class="btn btn-primary" name="action" id="action" value="Update"  >ບັນທືກ</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
<table border="0">
  <tr>
    <td  align="right">ລະຫັດ:</td>
    <td ><input type="text" class="form-control"  name="customer_id" id="customer_id" value="<?PHP echo $suppliers_id;?>" readonly></td>
    <input type="hidden" name="id" id="id" >
    
   
    
  </tr>
  <tr>
    <td align="right">ຊື່ ລູກຄ້າ :</td>
    <td><input type="text" class="form-control" name="customer_name" id="customer_name" ></td>
    <!--<td width="132" align="right">ຊື່ ທະນາຄານ(1):</td>
    <td width="308"><input type="text" class="form-control" name="bank_name1" id="bank_name1"></td>-->
    
         <td align="right">latitude:</td>
    <td>  
<input type="text" class="form-control" name="latitude" id="latitude" >
    </td>

<td align="right">Sale_Id:</td>
    <td>  
<input type="text" class="form-control" name="Sale_Id" id="Sale_Id" >
    </td>


  </tr>
  

  
  <tr>
     <td align="right">ຊື່ ລູກຄ້າ ລາວ:</td>
    <td><input type="text" class="form-control" name="outlet_name_la" id="outlet_name_la" ></td>
    
    
       <td align="right">longitude :</td>
    <td><input type="text" class="form-control" name="longitude" id="longitude" ></td>
    

    <td align="right">Sale_full_name :</td>
    <td><input type="text" class="form-control" name="Sale_full_name" id="Sale_full_name" ></td>


  </tr>
  
  <tr>
        <td align="right">ເບີໂທລະສັບ:</td>
    <td><input type="text" class="form-control" name="phone" id="phone" ></td>
    


<td align="right">business_segment_code:</td>
 <td><input type="text" class="form-control" name="business_segment_code" id="business_segment_code" ></td>


    <td align="right">ເຄຣດິດ :</td>
    <td>
 <input type="checkbox" class="form-control" id="credit" name="credit" value="NO">
  </td>

  </tr>
  <tr>
   <td align="right">ບ້ານ:</td>
    <td><input type="text" class="form-control" name="village" id="village" ></td>

 <td align="right">channel_code:</td>
    <td><input type="text" class="form-control" name="channel_code" id="channel_code" ></td>

<td align="right">ວົງເງິນຕິດໜີ້:</td>
 <td><input type="text" class="form-control" name="Debt_collection" id="Debt_collection" disabled></td>


</tr>

 <tr>
<td align="right">ເມືອງ:</td>
    <td><input type="text" class="form-control" name="district" id="district" ></td>

<td align="right">sub_channel_full:</td>
    <td><input type="text" class="form-control" name="sub_channel_full" id="sub_channel_full" ></td>

  <td align="right">ຈໍານວນມື້ຕິດໜີ້ :</td>
    <td><input type="text" class="form-control" name="Number_of_days_overdue" id="Number_of_days_overdue" disabled></td>

  </tr>

 <tr>
<td align="right">ແຂວງ:</td>
    <td><input type="text" class="form-control" name="Province" id="Province" ></td>


<td align="right">classification_code:</td>
    <td><input type="text" class="form-control" name="classification_code" id="classification_code" ></td>

<td align="right">ວັນທີໝົດອາຍຸສັນຍາ:</td>
    <td><input type="date" class="form-control" name="Contract_expiration_date" id="Contract_expiration_date" value="" disabled></td>

  </tr>


</table>





         </div>
        
        <!-- Modal footer -->
       
        </form>
      </div>
    </div>
  </div>
  
  
  <div class="modal" id="add_stock2">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ແກ້ໄຂລາຍການລູກຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
   	
	<form action="insert_customer.php" method="post" enctype="multipart/form-data">

  
          <button type="submit" class="btn btn-primary" name="action" id="action" value="Add"  >ບັນທືກ</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
<table border="0">
  <tr>
    <td  align="right">ລະຫັດ:</td>
    <td ><input type="text" class="form-control"  name="customer_id" id="customer_id" value="<?PHP echo $suppliers_id;?>" readonly></td>
    <input type="hidden" name="id" id="id" >
    
   
    
  </tr>
  <tr>
    <td align="right">ຊື່ ລູກຄ້າ :</td>
    <td><input type="text" class="form-control" name="customer_name" id="customer_name" ></td>
    <!--<td width="132" align="right">ຊື່ ທະນາຄານ(1):</td>
    <td width="308"><input type="text" class="form-control" name="bank_name1" id="bank_name1"></td>-->
    
         <td align="right">latitude:</td>
    <td>  
<input type="text" class="form-control" name="latitude" id="latitude" >
    </td>

<td align="right">Sale_Id:</td>
    <td>  
<input type="text" class="form-control" name="Sale_Id" id="Sale_Id" >
    </td>


  </tr>
  

  
  <tr>
     <td align="right">ຊື່ ລູກຄ້າ ລາວ:</td>
    <td><input type="text" class="form-control" name="outlet_name_la" id="outlet_name_la" ></td>
    
    
       <td align="right">longitude :</td>
    <td><input type="text" class="form-control" name="longitude" id="longitude" ></td>
    

    <td align="right">Sale_full_name :</td>
    <td><input type="text" class="form-control" name="Sale_full_name" id="Sale_full_name" ></td>


  </tr>
  
  <tr>
        <td align="right">ເບີໂທລະສັບ:</td>
    <td><input type="text" class="form-control" name="phone" id="phone" ></td>
    


<td align="right">business_segment_code:</td>
 <td><input type="text" class="form-control" name="business_segment_code" id="business_segment_code" ></td>


    <td align="right">ເຄຣດິດ :</td>
    <td>
 <input type="checkbox" class="form-control" id="credit" name="credit" value="NO">
  </td>

  </tr>
  <tr>
   <td align="right">ບ້ານ:</td>
    <td><input type="text" class="form-control" name="village" id="village" ></td>

 <td align="right">channel_code:</td>
    <td><input type="text" class="form-control" name="channel_code" id="channel_code" ></td>

<td align="right">ວົງເງິນຕິດໜີ້:</td>
 <td><input type="text" class="form-control" name="Debt_collection" id="Debt_collection" disabled></td>


</tr>

 <tr>
<td align="right">ເມືອງ:</td>
    <td><input type="text" class="form-control" name="district" id="district" ></td>

<td align="right">sub_channel_full:</td>
    <td><input type="text" class="form-control" name="sub_channel_full" id="sub_channel_full" ></td>

  <td align="right">ຈໍານວນມື້ຕິດໜີ້ :</td>
    <td><input type="text" class="form-control" name="Number_of_days_overdue" id="Number_of_days_overdue" disabled></td>

  </tr>

 <tr>
<td align="right">ແຂວງ:</td>
    <td><input type="text" class="form-control" name="Province" id="Province" ></td>


<td align="right">classification_code:</td>
    <td><input type="text" class="form-control" name="classification_code" id="classification_code" ></td>

<td align="right">ວັນທີໝົດອາຍຸສັນຍາ:</td>
    <td><input type="date" class="form-control" name="Contract_expiration_date" id="Contract_expiration_date" value="" disabled></td>

  </tr>


</table>





         </div>
        
        <!-- Modal footer -->
       
        </form>
      </div>
    </div>
  </div>
  
</div>


 
 
 


</div>



<?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
    <!-- /.container -->
    <br>
    <br>

  <script src="js/numeral.min.js"></script>



  <script>


$(document).ready(function(){

 
 load_stock_list();
 
function load_stock_list()
	{

			$.ajax({
			url:"fetch_customer_list.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
       
				$('#display_stock_list').html(data);
        
			}
		});
	}

});


$(document).on('keyup change', '.s_customer', function(){
    

    var c_type = $('#c_type').val();
    var c_id = $('#c_id').val();
    var c_name = $('#c_name').val();
    var c_v = $('#c_village').val();
    var c_d = $('#c_district').val();
    var limit_row = $('#limit_row').val();

        $.ajax({
            url: "fetch_customer_list.php",
            method: "POST",
            data: { c_id:c_id,c_type:c_type,c_name:c_name,c_v:c_v,c_d:c_d,limit_row:limit_row },
            success: function(data) {
                $('#display_stock_list').html(data);
            }
        });
});
</script>


<script>

// =========================================================================
// ส่วนที่ 1: ประกาศตัวแปร และ ฟังก์ชันสำหรับผู้ใช้คลิกเลือกเองหน้าจอ
// =========================================================================
const creditCheckbox = document.getElementById('credit');
const debtInput = document.getElementById('Debt_collection');
const debtInput_2 = document.getElementById('Number_of_days_overdue');
const debtInput_3 = document.getElementById('Contract_expiration_date');

// ฟังก์ชันควบคุมเปิด-ปิดช่องทั่วไป (ใช้ตอนผู้ใช้คลิก Checkbox เอง)
function userToggleCredit() {
    const isDisabled = !creditCheckbox.checked;
    debtInput.disabled = isDisabled;
    debtInput_2.disabled = isDisabled;
    debtInput_3.disabled = isDisabled;
    
    if (!creditCheckbox.checked) {
        // ถ้าผู้ใช้เคลียร์เครื่องหมายถูกออก ให้ล้างค่าทิ้งทั้งหมด
        debtInput.value = '';
        debtInput_2.value = '';
        debtInput_3.value = '';
        creditCheckbox.value = 'NO';
    } else {
        // ถ้าผู้ใช้ติ๊กถูกเอง ให้ตั้งค่าเริ่มต้นเป็น 0 และใส่วันที่ปัจจุบันให้ทำงานง่ายขึ้น
        creditCheckbox.value = 'YES';
        if (debtInput.value === '') debtInput.value = '0';
        if (debtInput_2.value === '') debtInput_2.value = '0';
        if (debtInput_3.value === '') {
            debtInput_3.value = '<?php echo date("Y-m-d"); ?>';
        }
    }
}

// ผูกเหตุการณ์เฉพาะตอนที่ "ผู้ใช้คลิกเปลี่ยนค่าเอง" บนหน้าเว็บ
creditCheckbox.addEventListener('change', userToggleCredit);


// =========================================================================
// ส่วนที่ 2: ฟังก์ชันเมื่อมีการคลิกปุ่มแก้ไข (.edit_supplier) เพื่อดึงค่าเก่า
// =========================================================================
$(document).on('click', '.edit_supplier', function(){
    
    var customer_id = $(this).attr("id");   
    var customer_name = $('#e_customer_name'+customer_id+'').val();
    var e_outlet_name_la = $('#e_outlet_name_la'+customer_id+'').val();
    var e_phone_number = $('#e_phone_number'+customer_id+'').val();
    var e_Province = $('#e_Province'+customer_id+'').val();
    var e_district = $('#e_district'+customer_id+'').val();
    var e_village = $('#e_village'+customer_id+'').val();
    var e_region_LA = $('#e_region_LA'+customer_id+'').val();
    var e_Province_LA = $('#e_Province_LA'+customer_id+'').val();
    var e_Village_LA = $('#e_Village_LA'+customer_id+'').val();
    var e_latitude = $('#e_latitude'+customer_id+'').val();
    var e_longitude = $('#e_longitude'+customer_id+'').val();
    var e_business_segment_code = $('#e_business_segment_code'+customer_id+'').val();
    var e_channel_code = $('#e_channel_code'+customer_id+'').val();
    var e_sub_channel_full = $('#e_sub_channel_full'+customer_id+'').val();
    var e_classification_code = $('#e_classification_code'+customer_id+'').val();
    var e_Sale_Id = $('#e_Sale_Id'+customer_id+'').val();
    var e_Sale_full_name = $('#e_Sale_full_name'+customer_id+'').val();
    
    // ชุดข้อมูลเครดิตเดิมจากตารางฐานข้อมูล
    var credit = $('#e_credit'+customer_id+'').val();
    var Debt_collection = $('#e_Debt_collection'+customer_id+'').val();
    var Number_of_days_overdue = $('#e_Number_of_days_overdue'+customer_id+'').val();
    var Contract_expiration_date = $('#e_Contract_expiration_date'+customer_id+'').val();

    var id = $('#id'+customer_id+'').val();
    var remark = $('#e_remark'+customer_id+'').val(); 

    // นำข้อมูลทั่วไปแสดงผลใน Modal 
    $('#customer_id').val(customer_id);
    $("#customer_name").val(customer_name);
    $("#outlet_name_la").val(e_outlet_name_la);
    $("#phone").val(e_phone_number);
    $("#Province").val(e_Province);
    $("#district").val(e_district);
    $("#village").val(e_village);
    $("#region_LA").val(e_region_LA);
    $("#Province_LA").val(e_Province_LA);
    $("#Village_LA").val(e_Village_LA);
    $("#latitude").val(e_latitude);
    $("#longitude").val(e_longitude);
    $("#business_segment_code").val(e_business_segment_code);
    $("#channel_code").val(e_channel_code);
    $("#sub_channel_full").val(e_sub_channel_full);
    $("#classification_code").val(e_classification_code);
    $("#Sale_Id").val(e_Sale_Id);
    $("#Sale_full_name").val(e_Sale_full_name);

    // [แก้ไขจุดบกพร่อง] ตรวจสอบสถานะเครดิตเก่าของลูกค้าเพื่อทำงานแยกขาดจากกัน
    if (credit === 'YES') {
        creditCheckbox.checked = true; // ติ๊กถูกที่หน้าฟอร์ม
        
        // เปิดช่องกรอกข้อมูลให้พร้อมทำงาน (Disabled = false)
        debtInput.disabled = false;
        debtInput_2.disabled = false;
        debtInput_3.disabled = false;
        
        // ยัดข้อมูลจริงจากฐานข้อมูลลงไปตรง ๆ (ข้อมูลจะไม่หายหรือโดนเขียนทับ)
        $("#credit").val(credit);
        $("#Debt_collection").val(Debt_collection);
        $("#Number_of_days_overdue").val(Number_of_days_overdue);
        $("#Contract_expiration_date").val(Contract_expiration_date);
    } else {
        creditCheckbox.checked = false; // เอาติ๊กถูกออกที่หน้าฟอร์ม
        
        // ล็อคช่องกรอกข้อมูลไม่ให้ใช้งาน (Disabled = true)
        debtInput.disabled = true;
        debtInput_2.disabled = true;
        debtInput_3.disabled = true;
        
        // ล้างข้อมูลเก่าของรายก่อนหน้าทิ้งป้องกันข้อมูลผีตกค้าง
        $("#credit").val('NO');
        $("#Debt_collection").val('');
        $("#Number_of_days_overdue").val('');
        $("#Contract_expiration_date").val('');
    }
    
    // กำหนดค่าส่วนที่เหลือท้ายฟังก์ชัน
    $("#remark").val(remark);
    $("#id").val(id);
    $("#action").val('Update');
     
});




$(document).ready(function(){





 /*
 load_stock_list();
 
function load_stock_list()
	{

			$.ajax({
			url:"fetch_customer_list.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_stock_list').html(data);
			}
		});
	}
*/

/////////////////////////////////////
	// =========================================================================
// ส่วนที่ 2: โค้ดการทำงานเมื่อมีการคลิกปุ่มแก้ไข (.edit_supplier)
// =========================================================================
/*
$(document).on('click', '.edit_supplier', function(){
    
    // 2.1 ดึงรหัสไอดีของแถวที่ถูกกด
    var customer_id = $(this).attr("id");   
    
    // 2.2 ดึงข้อมูลเดิมจาก Element ซ่อน (Hidden fields) ในตารางมาเก็บลงตัวแปร JavaScript
    var customer_name = $('#e_customer_name'+customer_id+'').val();
    var e_outlet_name_la = $('#e_outlet_name_la'+customer_id+'').val();
    var e_phone_number = $('#e_phone_number'+customer_id+'').val();
    var e_Province = $('#e_Province'+customer_id+'').val();
    var e_district = $('#e_district'+customer_id+'').val();
    var e_village = $('#e_village'+customer_id+'').val();
    var e_region_LA = $('#e_region_LA'+customer_id+'').val();
    var e_Province_LA = $('#e_Province_LA'+customer_id+'').val();
    var e_Village_LA = $('#e_Village_LA'+customer_id+'').val();
    var e_latitude = $('#e_latitude'+customer_id+'').val();
    var e_longitude = $('#e_longitude'+customer_id+'').val();
    var e_business_segment_code = $('#e_business_segment_code'+customer_id+'').val();
    var e_channel_code = $('#e_channel_code'+customer_id+'').val();
    var e_sub_channel_full = $('#e_sub_channel_full'+customer_id+'').val();
    var e_classification_code = $('#e_classification_code'+customer_id+'').val();
    var e_Sale_Id = $('#e_Sale_Id'+customer_id+'').val();
    var e_Sale_full_name = $('#e_Sale_full_name'+customer_id+'').val();
    
    // (ตัวแปรชุดข้อมูลเครดิตเดิม)
    var credit = $('#e_credit'+customer_id+'').val();
    var Debt_collection = $('#e_Debt_collection'+customer_id+'').val();
    var Number_of_days_overdue = $('#e_Number_of_days_overdue'+customer_id+'').val();
    var Contract_expiration_date = $('#e_Contract_expiration_date'+customer_id+'').val();

    var id = $('#id'+customer_id+'').val();
    var remark = $('#e_remark'+customer_id+'').val(); // ป้องกัน Error: ดึงค่า remark มารองรับไว้



    // 2.3 นำข้อมูลที่ดึงได้ ยัดกลับเข้าไปแสดงผลในฟอร์มของ Modal แก้ไข
    $('#customer_id').val(customer_id);
    $("#customer_name").val(customer_name);
    $("#outlet_name_la").val(e_outlet_name_la);
    $("#phone").val(e_phone_number);
    $("#Province").val(e_Province);
    $("#district").val(e_district);
    $("#village").val(e_village);
    $("#region_LA").val(e_region_LA);
    $("#Province_LA").val(e_Province_LA);
    $("#Village_LA").val(e_Village_LA);
    $("#latitude").val(e_latitude);
    $("#longitude").val(e_longitude);
    $("#business_segment_code").val(e_business_segment_code);
    $("#channel_code").val(e_channel_code);
    $("#sub_channel_full").val(e_sub_channel_full);
    $("#classification_code").val(e_classification_code);
    $("#Sale_Id").val(e_Sale_Id);
    $("#Sale_full_name").val(e_Sale_full_name);

    // 2.4 [หัวใจสำคัญ] จัดการ Logic เครดิตตามข้อมูลเก่าของลูกค้ารายนี้
    if (credit === 'YES') {
        creditCheckbox.checked = true; // ติ๊กถูกที่หน้าจอ
        
        // ยัดข้อมูลเครดิตเดิมลงฟอร์ม
        $("#credit").val(credit);
        $("#Debt_collection").val(Debt_collection);
        $("#Number_of_days_overdue").val(Number_of_days_overdue);
        $("#Contract_expiration_date").val(Contract_expiration_date);
    } else {
        creditCheckbox.checked = false; // เอาติ๊กถูกออกที่หน้าจอ
        
        // ล้างข้อมูลเก่าออกทันที เพื่อป้องกันค่าของลูกค้ารายก่อนหน้าค้างบนหน้าจอ
        $("#credit").val('NO');
        $("#Debt_collection").val('');
        $("#Number_of_days_overdue").val('');
        $("#Contract_expiration_date").val('');
    }

    // 2.5 เรียกใช้งานฟังก์ชันควบคุมทันที เพื่อสั่งเปิด/ปิดช่องอินพุตให้สอดคล้องกับค่า credit
    handleCreditToggle();
    
    // 2.6 กำหนดค่าส่วนที่เหลือท้ายฟังก์ชัน
    $("#remark").val(remark);
    $("#id").val(id);
    $("#action").val('Update');
     
});
*/


			/////////////////////////////////////
});


	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("id");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_customer.php?Id='+Id;
  } 
 

	});
	
	
	/*
$(function(){
  $('#search_product').click(function(){
   
 
   var c_type = $('#c_type').val();
   var c_id = $('#c_id').val();
  var c_name = $('#c_name').val();
 
         $.ajax({
				url:"fetch_customer_list.php",
				method:"POST",
				data:{  c_id:c_id,c_type:c_type,c_name:c_name },
				success:function(data)
				{
					$('#display_stock_list').html(data);
				}
			});

  });

 });
*/




	$(document).on('click', '#print_excel', function(){
	
   
        var c_type = $('#c_type').val();
        var c_id = $('#c_id').val();
        var c_name = $('#c_name').val();
		var c_v = $('#c_village').val();
		var c_d = $('#c_district').val();
		var limit_row = $('#limit_row').val();

   window.open('customer_list_excel.php?c_type='+c_type + '&c_id='+c_id  + '&c_name='+c_name+'&c_v='+c_v+'&c_d='+c_d+'&limit_row='+limit_row+' ','_blank'); 
   
 

	});

/*
	 $(document).on('change', '#c_type', function(){
	
		var c_type = $('#c_type').val();
        var c_id = $('#c_id').val();
        var c_name = $('#c_name').val();
		var c_v = $('#c_village').val();
		var c_d = $('#c_district').val();
		var limit_row = $('#limit_row').val();
 

         $.ajax({
				url:"fetch_customer_list.php",
				method:"POST",
				data:{  c_id:c_id,c_type:c_type,c_name:c_name,c_v:c_v,c_d:c_d,limit_row:limit_row },
				success:function(data)
				{
					$('#display_stock_list').html(data);

				}
			});
 

	});
*/

	
</script>
  <script>
$('input.number').keyup(function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
 $(this).val(function(index, value) {
      value = value.replace(/,/g,''); // remove commas from existing input
      return numberWithCommas(value); // add commas back in
  });
});

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

  
 
 </script>
</html>

