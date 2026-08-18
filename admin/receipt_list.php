<?php 
include("init.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
  
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/fontawesome-all.css" rel="stylesheet">

<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<?php include("header.php");?>

<style>
/* บังคับให้พื้นที่หลักและตารางขยับชิดซ้ายสุด ปล่อยขอบเล็กน้อยเพื่อความสวยงาม */
.main-wrapper {
    padding-left: 15px;
    padding-right: 15px;
    text-align: left !important;
}

#search {
    border: 1px solid #008000; 
    border-radius: 4px; 
    background-color: #008000; 
    padding: 5px; 
    color: #FFF; 
    font-family: "Phetsarath OT";
}

input {
    padding: 4px; 
    border: 1px solid #D8D8D8; 
    border-radius: 4px;
}

.save1 {
    color: #000;
    border: 1px solid #E4E4E4;
    border-radius: 3px;
    padding: 5px;
}

.bgtd {
    background-color: #EBEBEB;
}

td { 
    padding: 10px;
    height: 40px;
}

th { 
    background-color: #E0E0E0; 
    text-align: center;
    padding: 10px;
    height: 40px;
}

/* ลบ Padding ของ Container เพื่อให้ชิดซ้ายสุด */
.no-gutter {
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
}
</style>

<link rel="stylesheet" href="select2/select2.min.css">
<script src="select2/select2.full.min.js"></script>
<script>
  $(function () {
    $('.select2').select2()
  })
</script>
<script src="js/numeral.min.js"></script>

</head>
<body>

<!-- ใช้ Wrapper ช่วยดันทุกอย่างชิดซ้าย -->
<div class="main-wrapper">
    <br>
    <h3 style="text-align: left;">ລາຍການຮັບເງີນ</h3>
    <br>

    <table style="margin-left: 0; margin-right: auto;">
      <tr>
        <td><a href="add_receipt.php"><button type="button" name="add" value="add" class="btn btn-success" style="width: 100px;"><i class="fa fa-plus-square"></i> ເພີ່ມ</button></a></td>
        <td><button type="button" class="btn btn-info" style="width: 100px;" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>
        <td><button type="button" class="btn btn-warning" style="width: 100px;" id="print">ພິມ</button></td> 
        <td><button type="button" class="btn btn-success" style="width: 100px;" id="print_excel">ພິມ EXCEL</button></td> 
      </tr>
    </table>

    <table style="margin-left: 0; margin-right: auto;">
       <tr>
            <td>ວັນທີ<br><input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date("Y-m-d"); ?>"></td> 
            <td>ຫາ<br><input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d"); ?>"></td> 
            <td>ຊື່ລູກຄ້າ<br>
                <select name="customer_id" id="customer_id" class="form-control select2" style="width:210px;">
                    <option value="">ທັງຫມົດ</option>
                    <?php 
                    $sql_c=mysqli_query($con,"select * from customers ");
                    while($f=mysqli_fetch_array($sql_c)){
                    ?>    
                    <option value="<?php echo $f['customer_id'];?>"><?php echo $f['customer_name'];?></option>
                    <?php } ?>    
                </select>   
            </td> 
            <td>ເລກທີຮັບ<br><input type="text" name="sale_id" id="sale_id" class="form-control"></td> 
            <td>ປະເພດຊຳລະ<br>
                <select name="payment_type" id="payment_type" class="form-control">
                    <option value="1">ເງີນສົດ</option>
                    <option value="2">ເງີນໂອນ</option>
                </select>
            </td>
            <td>ຮູບແບບ<br>
                <select name="select_mode" id="select_mode" class="form-control">
                    <option value="1">ລະອຽດ</option>
                    <option value="2">ສັງລວມ</option>
                </select>
            </td>
       </tr>
    </table>

    <br>
               
    <!-- เปลี่ยนจาก container เป็น container-fluid พร้อมลบระยะขอบเพื่อให้ชิดซ้ายสุด -->
    <div class="container-fluid no-gutter">          
        <div id="head_list" style="text-align: left;"></div>  
        <br><br>          
    </div>
</div>

<br><br><br>

<!---- add product--->
<div class="modal" id="pro_detail">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ລາຍການຂາຍສິນຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div id="display_product"></div>
            <br>
        </div>
        
        <div>
           &nbsp; <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
        </div>
        <br>
      </div>
    </div>
</div>

<?php if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?>

<script>
load_list();

function load_list(){
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var sale_id = $('#sale_id').val();   
   var customer_id = $('#customer_id').val();  
   var select_mode = $('#select_mode').val();

   $.ajax({
        url:"fetch_receipt_list.php",
        method:"POST",
        data:{ from_date:from_date,to_date:to_date,sale_id:sale_id,customer_id:customer_id,select_mode:select_mode },
        success:function(data) {
            $('#head_list').html(data);
        }
   });
}

$(function(){
  $('#search_product').click(function(){
       var from_date = $('#from_date').val();
       var to_date = $('#to_date').val();
       var sale_id = $('#sale_id').val();   
       var customer_id = $('#customer_id').val();  
       var select_mode = $('#select_mode').val();
       var payment_type = $('#payment_type').val();

       $.ajax({
            url:"fetch_receipt_list.php",
            method:"POST",
            data:{ from_date:from_date,to_date:to_date,sale_id:sale_id,customer_id:customer_id,select_mode:select_mode,payment_type:payment_type },
            success:function(data) {
                $('#head_list').html(data);
            }
       });
  });
});

$(document).on('click', '#print', function(){
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var sale_id = $('#sale_id').val();   
   var customer_id = $('#customer_id').val();  
   var select_mode = $('#select_mode').val();
   var payment_type = $('#payment_type').val();

   window.open('print_fetch_receipt_list.php?from_date='+from_date+'&to_date='+to_date+'&customer_id='+customer_id+'&payment_type='+payment_type+'&sale_id='+sale_id+'&select_mode='+select_mode+' ','_blank'); 
});

$(document).on('click', '#print_excel', function(){
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var sale_id = $('#sale_id').val();   
   var customer_id = $('#customer_id').val();  
   var select_mode = $('#select_mode').val();
   var payment_type = $('#payment_type').val();

   window.open('print_fetch_receipt_list_excel.php?from_date='+from_date+'&to_date='+to_date+'&customer_id='+customer_id+'&payment_type='+payment_type+'&sale_id='+sale_id+'&select_mode='+select_mode+' ','_blank'); 
});
</script>

</body>
</html>