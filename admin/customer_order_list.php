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
 .container_x{
	 padding-left:20px;
	 
	 }
</style>
 <script src="js/numeral.min.js"></script>
 
<div class="container">
    <br>
    <h3 align="center">ລາຍການລູກຄ້າສັ່ງຊື້</h3><br>
   
<table>
       <tr>
     <td> <br>  <a href="index.php"> <button type="button" name="reset" value="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
       <td> <br><a href="add_customer_order.php"  ><button type="button" class="btn btn-success" >
            <i class="fa fa-plus-square"></i>&nbsp; ສ້າງໃບສັ່ງຊື້</button></a></td>
            
            
            <td>ວັນທີ<br><input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date("Y-m-d"); ?>"></td> 
            
            <td>ຫາ<br><input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d"); ?>"></td> 
      
      <td>ສາງ<br>
      <select name="stock_id" id="stock_id" class="form-control" required>   
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from stocks");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select> </td>    
   
      
    
             <td>ເລກທີ<br><input  type="text" name="order_id" id="order_id" class="form-control"  ></td> 
             
             <td align="center">ລູກຄ້າ:  <br>
    <div class="input-group input-group-sm">
    <input type="text" class="form-control ss" name="customer_name" id="customer_name" required >      
   <span class="input-group-addon">
   <button type="button" name="cc" class="btn btn-sm " data-toggle="modal" data-target="#customer_add" onclick="get_customer()" ><i class="fa fa-search"></i></button> </span>   
    </div>
    <input type="hidden" class="form-control" name="customer_id"   id="customer_id"   >
   <!-- <input type="hidden" class="form-control" name="customer_type"   id="customer_type"  >-->
   
   
    </td> 
    
      <!-- <td>ພະນັກງານຂາຍ<br>
 <input  type="text" name="staff_id" id="staff_id" 
 value="<?php echo $_SESSION['user_id']; ?>" <?php if($_SESSION['status']=='0'){}else{ echo "readonly"; } ?>   class="form-control"  ></td> -->
               <!--<td><br> <button type="button" class="btn btn-warning" id="print">ພິມ</button></td> -->
               
             <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>
       </tr>
       </table>
</div>
           <br>
           
 <div class="container_x" align="center">          
             <div id="head_list"></div>	          
         </div>
           
 
            

  
  	

<!---- add product--->


 <div class="modal" id="pro_detail">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ລາຍການໃບສັ່ງຊື້</h4>
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
<!----->
 <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?>
 
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


$(document).ready(function(){
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
	    var ct_id = $(this).attr("data-ct_id");
		 var ct_name = $(this).attr("data-ct_name");
     
		
		$('#customer_id').val(customer_id);
		$('#customer_name').val(customer_name);
		
		$('#price_type').val(ct_id);
		$('#customer_type').val(ct_name);
		
		
		make_order_list();
		
	});
 
 load_product();
 load_list();
 
 function load_list()
	{
   var stock_id = $('#stock_id').val(); 
   var order_id = $('#order_id').val();   
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var customer_id = $('#customer_id').val();
 //  alert(stock_id);
   
         $.ajax({
				url:"fetch_customer_order_list.php",
				method:"POST",
				data:{  stock_id:stock_id,from_date:from_date,to_date:to_date,order_id:order_id,customer_id:customer_id },
				success:function(data)
				{
					$('#head_list').html(data);

				}
			});
	}

function load_product()
	{
			$.ajax({
			url:"fetch_customer_order_detail.php",
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
	
		var order_id = $(this).attr("id");		
		var action = "show";

			$.ajax({
				url:"fetch_customer_order_detail.php",
				method:"POST",
				data:{   order_id:order_id,action:action },
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
   
 
   var stock_id = $('#stock_id').val(); 
   var order_id = $('#order_id').val();   
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var staff_id = $('#staff_id').val();
 //  alert(stock_id);
   
         $.ajax({
				url:"fetch_customer_order_list.php",
				method:"POST",
				data:{  stock_id:stock_id,from_date:from_date,to_date:to_date,order_id:order_id,staff_id:staff_id },
				success:function(data)
				{
					$('#head_list').html(data);

				}
			});

  });

 });
$(document).on('click', '.delete_Id', function(){
	
		var order_id = $(this).attr("id");
	//	var action = $(this).attr("value");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_customer_order.php?order_id='+order_id ;
  } 
 

	});
	
	$(document).on('click', '.print_Id', function(){
		
	 
         //var sale_date = $('#sale_date').val();
		var sale_id = $(this).attr("id");
	//	var action = $(this).attr("value");
window.open('print_product_customer_order.php?sale_id='+sale_id+'','_blank');
	});
	
	

$(document).on('click', '.edit_Id', function(){
	
		var order_id = $(this).attr("id");
	//	var action = $(this).attr("value");


     window.location = 'cart_edit_customer_order_add.php?order_id='+order_id ;
   
 

	});
$(document).on('click', '#print', function(){
	
   var stock_id = $('#stock_id').val();    
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
  // var product_id = $('#product_id').val(); 
  // var group_id = $('#group_id').val(); 
	//	var action = $(this).attr("value");


     window.open('print_customer_order_list.php?stock_id='+stock_id + '&from_date='+from_date  + '&to_date='+to_date+' ','_blank'); 
   
 

	});
</script>

 


    <!-- /.container -->
    <br>
    <br>

</body>

</html>