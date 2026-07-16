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
	
.tableFixHead {
		overflow-y: auto;
		height: 600px;
	}

	.tableFixHead thead th {
		position: sticky;
		top: 0;
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



td{ padding:10px;
font-weight:!important;
height:40px;
 }
 th{ background-color:#E0E0E0; text-align:center;
 padding:10px;
font-weight:!important;
height:40px;
 }
 .container_xx{ padding-left:20px;}
</style>
 <link rel="stylesheet" href="select2/select2.min.css">
<script src="select2/select2.full.min.js"></script>
<script>

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
 <script src="js/numeral.min.js"></script>
  <script>

 load_product();
 load_list();
 
 function load_list()
	{
			$.ajax({
			url:"fetch_sale_list.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#head_list').html(data);
				
			}
		});
	}

function load_product()
	{
			$.ajax({
			url:"fetch_product_sale_detail.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}


$(document).ready(function(){

 

$(document).on('keyup', '#Quantity', function(){
			
   var qty = $('#Quantity').val();
   var price = $('#Price').val();

   var total=Number(qty.replace(/[^0-9\.-]+/g,""))* Number(price.replace(/[^0-9\.-]+/g,""))

   $('#Amount').val(numeral(total).format('0,0'));
		
	
});
$(document).on('keyup', '#Price', function(){
		
		
   var qty = $('#Quantity').val();
   var price = $('#Price').val();
    var total=Number(qty.replace(/[^0-9\.-]+/g,""))* Number(price.replace(/[^0-9\.-]+/g,""))
   $('#Amount').val(numeral(total).format('0,0'));
		
	
});

$(document).on('click', '.show_detail', function(){
	
		var sale_id = $(this).attr("id");		
		var action = "show";

			$.ajax({
				url:"fetch_product_sale_detail.php",
				method:"POST",
				data:{   sale_id:sale_id,action:action },
				success:function(data)
				{
					$('#display_product').html(data);
				
				}
			});
		
	});
	
	
	$(document).on('click', '.edit_pro', function(){
	
		var Product_ID = $(this).attr("id");
		
		var Group_ID = $('#Group_ID'+Product_ID+'').val();
		var Id = $('#Id'+Product_ID+'').val();
		var Price = $('#price'+Product_ID+'').val();
		var Product_Name = $('#name'+Product_ID+'').val();		
		var Bar_Code = $('#Bar_Code'+Product_ID+'').val();	
		var Quantity = $('#Quantity'+Product_ID+'').val();
		var Unit = $('#Unit'+Product_ID+'').val();	
		var Amount = $('#Amount'+Product_ID+'').val();	
	//	var gr_id = $(this).attr("id");		
		
		
	
//	document.getElementById('Group_ID').value = Group_ID;
	
	   $('#Group_ID').val(Group_ID);
	   $("#Product_ID").val( Product_ID );
		 $("#Price").val( Price );
		  $("#Product_Name").val( Product_Name );
		  $("#Bar_Code").val( Bar_Code );
		   $("#Quantity").val( Quantity );
		   $("#Unit").val( Unit );
		  $("#Id").val( Id );
		   $("#Amount").val( Amount );
			$("#action").val('Update');
			
			});
	








});

$(function(){
  $('#search_product').click(function(){
   
 
  // var stock_id = $('#stock_id').val(); 
   var sale_id = $('#sale_id').val();   
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var status_payment = $('#status_payment').val();
   var customer_id = $('#customer_id').val();
    var status = $('#status').val();
	
	var sale_order_id = $('#sale_order_id').val();
   
   
 //  alert(stock_id);
   
         $.ajax({
				url:"fetch_sale_list.php",
				method:"POST",
data:{  from_date:from_date,to_date:to_date,sale_id:sale_id,status_payment:status_payment,customer_id:customer_id,status:status,sale_order_id:sale_order_id },
				success:function(data)
				{
					$('#head_list').html(data);

				}
			});

  });

 });
$(document).on('click', '.delete_Id', function(){
	
		var sale_id = $(this).attr("id");
		
	//	var action = $(this).attr("value");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_product_sale.php?sale_id='+sale_id;
  } 
 

	});

$(document).on('click', '.edit_Id', function(){
	
		var sale_id = $(this).attr("id");
		var action = "make_cart_edit";


     window.location = 'cart_edit_sale_customer_order_add.php?sale_id='+sale_id+'&action='+action;
   
 

	});
$(document).on('click', '#print', function(){
	
   var stock_id = $('#stock_id').val();    
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
  // var product_id = $('#product_id').val(); 
  // var group_id = $('#group_id').val(); 
	//	var action = $(this).attr("value");


     window.open('print_sale_list.php?from_date='+from_date  + '&to_date='+to_date+' ','_blank'); 
   
 

	});
</script>

<div class="container">
    <br>
    <h3 align="center">ລາຍການຂາຍສິນຄ້າ</h3><br>
   </div>
    <!-- /.container -->  
<table>
       <tr>
     <td> <br>  <a href="index.php"> <button type="button" name="reset" value="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
       <td> <br><a href="add_sale_customer_order.php"  ><button type="button" class="btn btn-success" >
            <i class="fa fa-plus-square"></i>&nbsp; ຂາຍ</button></a></td>
            
            
            <td>ວັນທີ<br><input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date("Y-m-d"); ?>"></td> 
            
            <td>ຫາ<br><input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d"); ?>"></td> 
      

<?php /*

      <td>ສາງ<br>
      <select name="stock_id" id="stock_id" class="form-control" required>   
   <?php
 $user_status=$_SESSION['status'];
 $user_stock_id=$_SESSION['stock_id'];
  if($user_status=='0'){     ?>
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from stocks");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    
    <?php }else{ 
	
	 $sql=mysqli_query($con,"select * from stocks where stock_id='$user_stock_id'");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP }
	
		} ?>
    </select> </td>    
    

*/ ?>


<?php /*
    <td>ສະຖານະ<br>
      <select name="status_payment" id="status_payment" class="form-control" required>   
        <option value="">ທັງຫມົດ</option>
       	<option value="2">ສົດ</option>
        <option value="3">ເງີນໂອນ</option>
        <option value="1">ຕິດຫນີ້</option>
  
    </select> </td> 
    
        <td>ການຈ່າຍ<br>
      <select name="status" id="status" class="form-control" required>   
        <option value="">ທັງຫມົດ</option>
       	<option value="2">ຈ່າຍແລ້ວ</option>      
        <option value="1">ຕິດຫນີ້</option>
  
    </select> </td> 
   */ ?>
      
    
             <td>ເລກທີ<br><input  type="text" name="sale_id" id="sale_id" class="form-control"  ></td> 
             <td>ເລກທີສັ່ງຊື້<br><input  type="text" name="sale_order_id" id="sale_order_id" class="form-control"  ></td> 
              <td>ຂໍ້ມູນລູກຄ້າ<br><!--<input  type="text" name="customer_id" id="customer_id" class="form-control"  >-->
              
                <select  name="customer_id" id="customer_id" class="form-control select2" style="width:210px;"  >
              <option value="">ທັງຫມົດ</option>
         <?php 
		 $sql_c=mysqli_query($con,"SELECT * FROM
		  (
		  SELECT 
		  external_id as customer_id,
		  outlet_name as customer_name,
		  phone_number as phone,
		  village as village,
		  district as district
		  FROM customer_import
		  ) as customer_import ");
		 while($f=mysqli_fetch_array($sql_c)){
		  ?>     
              <option value="<?php echo $f['customer_id'];?>"><?php echo $f['customer_id'].' '.$f['customer_name'];?></option>
          <?php } ?>   
             </select> 
              </td> 
               <td><br> <button type="button" class="btn btn-warning" id="print">ພິມ</button></td> 
               
             <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>



<td>
<?php /*
<form action="import_sale_file_2.php" method="POST" enctype="multipart/form-data">
        <label>เลือกไฟล์ Excel (.xlsx):</label>
        <input type="file" name="excel_file" accept=".xlsx, .xls" required>
        <button type="submit" name="import">อัปโหลดและนำเข้าข้อมูล</button>
    </form>
*/ ?>
 
<form action="import_sale_file.php" method="post" enctype="multipart/form-data">
    <input type="file" name="excel_file" accept=".csv" required> 
    
    <button type="submit" name="import">นำเข้าข้อมูล</button>
</form>
</td>



       </tr>
       </table>

           <br>
         <div class="tableFixHead">  
 <div class="container_xx">          
             <div id="head_list" align="center"></div>	          
         </div>
           
	</div>
            

  
  	

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
        
        
        <div id="display_product">     </div>
    
    <br>
    
   
    
    </div>
    
     <div  >
       &nbsp;   <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
        </div>
    
    <br>
      </div>
      

    </div>
  </div>
</div>




<!----->
   <div class="modal" id="order_add">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ປ່ຽນສະຖານະ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
    
  <td>ສະຖານະ<br>
      <select name="status_payment" id="status_select" class="form-control">  
       	<option value="2">ສົດ</option>
        <option value="3">ເງີນໂອນ</option>
        <option value="1">ຕິດຫນີ້</option>
    </select> </td> 
        
   
    
    </div>
    
     <div>
       &nbsp;   <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
        </div>
    
    <br>
      </div>
      

    </div>
  </div>
</div>




 <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?>
 
 
 



    <br>
    <br>

</body>

</html>





<script>
$(document).ready(function() {
    $('.btn-status').on('click', function() {
        // 1. ดึงข้อมูลจากปุ่มที่คลิก
        var statusValue = $(this).data('value');
        var statusText = $(this).data('text');
        
        // 2. ส่งค่าไปเลือกใน Dropdown (Select) อัตโนมัติ
        $('#status_select').val(statusValue).change();
       
        // 3. ส่งข้อความไปแสดงใน Modal ให้ผู้ใช้เห็นข้อความตัวหนังสือด้วย
        $('#current_status_text').text(statusText);



    });



});

////

// ตัวแปรส่วนกลางสำหรับจำว่า "ปุ่มไหนในตาราง" ที่เป็นคนกดเปิด Modal นี้ขึ้นมา
let $activeButtonInRow = null;

// 1. กำหนดรูปแบบข้อมูลสำหรับ "ปุ่มหลัก (ปุ่มซ้าย)"
const configMain = {
    '1': { text: 'ຕິດໜີ້',    colorClass: 'btn-danger' },  // เปลี่ยนจาก '' เป็น '1' ตาม HTML ของคุณ
    '2': { text: 'ສົດ',      colorClass: 'btn-success' },
    '3': { text: 'ເງີນໂອນ',   colorClass: 'btn-info' }
};

// 2. กำหนดรูปแบบข้อมูลสำหรับ "ปุ่มสถานะภาพรวม (ปุ่มขวา)"
const configStatus = {
    '1': { text: 'ຕິດໜີ້',    colorClass: 'btn-danger' },
    '2': { text: 'ຈ່າຍແລ້ວ',   colorClass: 'btn-success' },
    '3': { text: 'ຈ່າຍແລ້ວ',   colorClass: 'btn-success' }
};

// 3. จังหวะที่ผู้ใช้ "คลิกปุ่มในตาราง" เพื่อเปิด Modal
$(document).on('click', '.btn-status', function() {
    // เก็บจำตำแหน่งปุ่มที่ถูกกดไว้ในตัวแปรส่วนกลาง
    $activeButtonInRow = $(this);
    
    // ดึงค่า value ล่าสุดของปุ่มนั้นมาเซ็ตให้ตัว Dropdown ใน Modal เลือกค่านั้นรอไว้ล่วงหน้า
    var currentBtnValue = $activeButtonInRow.attr('data-value') || $activeButtonInRow.val();
    $('#status_select').val(currentBtnValue);


 

});

// 4. จังหวะที่ผู้ใช้ "เลือกเปลี่ยนค่าใน Dropdown" บนหน้าต่าง Modal
$('#status_select').on('change', function() {
    var selectedValue = $(this).val(); // ได้ค่า '1', '2' หรือ '3'
    var selectedText = $(this).find('option:selected').text();
    
var sale_id = $activeButtonInRow.attr('data-sale_id');

    // ตรวจสอบความปลอดภัยว่ามีปุ่มต้นทางส่งมาจริงไหม
    if ($activeButtonInRow && $activeButtonInRow.length) {
        
        if (confirm("ທ່ານຕ້ອງການປ່ຽນສະຖານະເປັນ " + selectedText + " ບໍ່")) {
            
            // ดึงสไตล์ตามค่าที่เลือกจากตัวแปร Config
            const mainStyle = configMain[selectedValue];
            const statusStyle = configStatus[selectedValue];




            // -------------------------------------------
            // ส่วนที่ 1: อัปเดตปุ่มหลักที่กดเปิด Modal ตัวนั้น
            // -------------------------------------------
            $activeButtonInRow.attr('data-value', selectedValue); // เปลี่ยน data-value
            $activeButtonInRow.val(selectedValue);                // เปลี่ยน value
            $activeButtonInRow.text(mainStyle.text);             // เปลี่ยนข้อความ
            $activeButtonInRow.removeClass('btn-danger btn-success btn-info').addClass(mainStyle.colorClass); // เปลี่ยนสี

            // -------------------------------------------
            // ส่วนที่ 2: วิ่งไปอัปเดตปุ่มสถานะขวา (ในแถวเดียวกันในตาราง)
            // -------------------------------------------
            var $currentRow = $activeButtonInRow.closest('tr');
            if ($currentRow.length) {
                var $statusButton = $currentRow.find('.btn-status-text'); // ค้นหาปุ่มขวาผ่าน class
                
                if ($statusButton.length) {
                    $statusButton.text(statusStyle.text); // เปลี่ยนข้อความ
                    $statusButton.removeClass('btn-danger btn-success').addClass(statusStyle.colorClass); // เปลี่ยนสี
                }
            }

            // เมื่อเปลี่ยนค่าเสร็จเรียบร้อย สั่งให้ปิดหน้าต่าง Modal อัตโนมัติได้เลย
            $('#order_add').modal('hide');

            // [เพิ่มเติม] สามารถเขียนโค้ด AJAX ส่งไปบันทึกในฐานข้อมูลตรงนี้ได้เลยโดยใช้ selectedValue



    $.ajax({
        url: "sale_status.php",
        method: "POST",
        data: { sale_id:sale_id,selectedValue:selectedValue },
        success: function() {
          
        }
    });






        } else {
            // ถ้ากดยกเลิก ให้ดีดค่าใน Dropdown กลับไปเป็นค่าเดิมของปุ่มตัวนั้น
            var originalValue = $activeButtonInRow.attr('data-value') || $activeButtonInRow.val();
            $(this).val(originalValue);
        }
    }
});



</script>






<script>
// 1. กำหนดรูปแบบข้อมูล (Mapping) ว่าแต่ละ Value จะให้ใช้ข้อความอะไร และคลาสสีอะไร
const statusConfig = {
    '':  { text: 'ຕິດໜີ້',   colorClass: 'btn-danger' },
    '2': { text: 'ສົດ',      colorClass: 'btn-success' },
    '3': { text: 'ເງີນໂອນ',  colorClass: 'btn-info' }
};

// 2. เลือกปุ่มทั้งหมดที่มีคลาส btn-toggle
const buttons = document.querySelectorAll('.btn-toggle');

buttons.forEach(button => {
    button.addEventListener('click', function() {
        let currentValue = this.value;
        let nextValue = '';

        // 3. กำหนดเงื่อนไขการลูปเปลี่ยนค่า ('' -> '2' -> '3' -> '')
        if (currentValue === '') {
            nextValue = '2';
        } else if (currentValue === '2') {
            nextValue = '3';
        } else if (currentValue === '3') {
            nextValue = '';
        }

        // 4. ดึงข้อมูลชุดใหม่จากสถานะถัดไป
        const nextConfig = statusConfig[nextValue];

        // 5. ลบคลาสสีเก่าออกทั้งหมดก่อน เพื่อไม่ให้สีตีกัน
        this.classList.remove('btn-danger', 'btn-success', 'btn-info');

        // 6. อัปเดตค่า Value, ข้อความ และคลาสสีใหม่ลงไปที่ปุ่ม
        this.value = nextValue;
        this.textContent = nextConfig.text;
        this.classList.add(nextConfig.colorClass);
    });
});


/*

$.ajax({
				url:"update_OT_n_Benefit.php",
				method:"POST",
				data:{  
          Id:Id,mm:mm,yy:yy,Active_Money:Active_Money,Sale_Ticket_holiday:Sale_Ticket_holiday,Payback:Payback,Meal_Allowance:Meal_Allowance,Accommodati:Accommodati,Other:Other,Lunch_Allowance:Lunch_Allowance,Total_Balance:Total_Balance
        },
				success:function(data)
				{

				}
			});
         
*/

</script>