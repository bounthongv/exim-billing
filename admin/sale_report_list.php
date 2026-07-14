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



$(document).ready(function(){

 
 load_product();
 load_list();
 
 function load_list()
	{
			$.ajax({
			url:"fetch_sale_report_list.php",
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
		//('#Product_ID').val('22332')
	
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
   
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   
   var stock_id = $('#stock_id').val(); 
   var sale_id = $('#sale_id').val();   
  
   var product_id = $('#product_id').val(); 
   var group_id = $('#group_id').val(); 
   var customer_id = $('#customer_id').val(); 
   var select_mode = $('#select_mode').val();
   
   var user_id = $('#user_id').val(); 
   var sr_id = $('#sr_id').val();
 //  alert(stock_id);
   
         $.ajax({
				url:"fetch_sale_report_list.php",
				method:"POST",
				data:{ 
	 stock_id:stock_id,from_date:from_date,to_date:to_date,sale_id:sale_id,product_id:product_id,group_id:group_id,customer_id:customer_id,select_mode:select_mode,user_id:user_id,sr_id:sr_id },
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
     window.location = 'delete_product_sale.php?sale_id='+sale_id ;
  } 
 

	});

$(document).on('click', '.edit_Id', function(){
	
		var sale_id = $(this).attr("id");
		var action = "make_cart_edit";


     window.location = 'cart_edit_sale_customer_order_add.php?sale_id='+sale_id+'&action='+action ;
   
 

	});
$(document).on('click', '#print', function(){
	
   
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   
   var stock_id = $('#stock_id').val(); 
   var sale_id = $('#sale_id').val();   
  
   var product_id = $('#product_id').val(); 
   var group_id = $('#group_id').val(); 
   var customer_id = $('#customer_id').val(); 
   var select_mode = $('#select_mode').val();
	//	var action = $(this).attr("value");
	
	var user_id = $('#user_id').val(); 
   var sr_id = $('#sr_id').val();


     window.open('print_sale_report_list.php?stock_id='+stock_id + '&from_date='+from_date  + '&to_date='+to_date+'&product_id='+product_id+'&group_id='+group_id+'&customer_id='+customer_id+'&sale_id='+sale_id+'&select_mode='+select_mode+'&user_id='+user_id+'&sr_id='+sr_id+' ','_blank'); 
   
 

	});
	
	
$(document).on('click', '#print_excel', function(){
	
   
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   
   var stock_id = $('#stock_id').val(); 
   var sale_id = $('#sale_id').val();   
  
   var product_id = $('#product_id').val(); 
   var group_id = $('#group_id').val(); 
   var customer_id = $('#customer_id').val(); 
   var select_mode = $('#select_mode').val(); 
   
	//	var action = $(this).attr("value");
	
	var user_id = $('#user_id').val(); 
   var sr_id = $('#sr_id').val();


     window.open('print_sale_report_excel_list.php?stock_id='+stock_id + '&from_date='+from_date  + '&to_date='+to_date+'&product_id='+product_id+'&group_id='+group_id+'&customer_id='+customer_id+'&sale_id='+sale_id+'&select_mode='+select_mode+'&user_id='+user_id+'&sr_id='+sr_id+' ','_blank'); 
   
 

	});
</script>


    <br>
    <h3 align="center">ລາຍງານການຂາຍສິນຄ້າ</h3><br>
   <div style="overflow-x:auto;">
<table align="center" width="100%">
       <tr>
    <!--   
     <td> <br>  <a href="product_qty_list.php"> <button type="button" name="reset" value="reset" class="btn btn-danger"><i class="fa fa-times"></i></button></a></td>
       -->
            
            
            <td>ວັນທີ<br><input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date("Y-m-d"); ?>"></td> 
            
            <td>ຫາ<br><input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d"); ?>"></td> 
      
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
   
            <td>ໝວດສິນຄ້າ<br>
      <select name="group_id" id="group_id" class="form-control" required>   
  	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from tb_groups");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['Group_ID']?>"><?php echo $f['Group_Name']?> &nbsp; <?php echo $f['Group_Name_EN']?></option>
	<?PHP } ?>
    
 
    </select> </td> 
    
            <td>ຂໍ້ມູນລູກຄ້າ<br><!--<input  type="text" name="customer_id" id="customer_id" class="form-control" placeholder="ຊື່ ລະຫັດ"  >-->
            <select name="customer_id" id="customer_id" class="form-control select2" style="width:180px;" >
            <option value="">ທັງຫມົດ</option>
            <?PHP 
	 $sql=mysqli_query($con,"select * from customers");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['customer_id']?>"><?php echo $f['customer_name']?></option>
	<?PHP } ?>
            </select>
            </td> 
             <td>ຜູ້ເປີດຈ໊ອບ<br>
            <select name="user_id" id="user_id" class="form-control select2" style="width:180px;" >
            <option value="">ທັງຫມົດ</option>
            <?PHP 
	 $sql=mysqli_query($con,"select * from users");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['User_ID']?>"><?php echo $f['fname']?></option>
	<?PHP } ?>
            </select>
            </td> 
            <td>ພ/ງ ຂາຍ<br>
            <select name="sr_id" id="sr_id" class="form-control select2" style="width:180px;" >
            <option value="">ທັງຫມົດ</option>
            <?PHP 
	 $sql=mysqli_query($con,"select * from sr_list");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['sr_id']?>"><?php echo $f['sr_fname']?></option>
	<?PHP } ?>
            </select>
            </td> 
            
    
             <td>ເລກທີຂາຍ<br><input  type="text" name="sale_id" id="sale_id" class="form-control"  ></td> 
              <td>ລະຫັດສິນຄ້າ<br><input  type="text" name="product_id" id="product_id" class="form-control"  ></td> 
              
             <td>ຮູບແບບ<br><select  name="select_mode" id="select_mode" class="form-control"  >
             <option value="3">ມາດຕະຖານ</option> 
             <option value="1">ລະອຽດ</option>
              <option value="2">ສັງລວມ</option>
              
             </select>
             </td>
      
              <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i></button></td> 
              <td><br><button type="button" class="btn btn-warning" id="print"><i class="fa fa-print" aria-hidden="true"></i></button>
              </td>
              <td><br>
       <button type="button" class="btn btn-success" id="print_excel"><i class="fa fa-file-excel" aria-hidden="true"></i></button></td>
               </tr>
     <!-- <tr>  
      <td></td> 
      <td><button type="button" class="btn btn-warning" id="print"><i class="fa fa-print" aria-hidden="true"></i></button>
       <button type="button" class="btn btn-success" id="print_excel"><i class="fa fa-file-excel" aria-hidden="true"></i></button></td> </tr>-->
              
       </table>
      </div>
        
 <div class="container">          
             <div id="head_list"></div>	
              <br>
    <br>          
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
 <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?>
 
 
 



    <!-- /.container -->
    <br>
    <br>
     <br>
    <br>

</body>

</html>

