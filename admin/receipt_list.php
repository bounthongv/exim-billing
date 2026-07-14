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



    <br>
    <h3 align="center">ລາຍການຮັບເງີນ</h3><br>
   
<table align="center">
       <tr>
       
     <td> <br>  <a href="add_receipt.php"> <button type="button" name="add" value="add" class="btn btn-success"><i class="fa fa-plus-square"></i> ເພີ່ມ</button></a></td>
       
            
            
            <td>ວັນທີ<br><input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date("Y-m-d"); ?>"></td> 
            
            <td>ຫາ<br><input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d"); ?>"></td> 
      
     
   
            <td>ຊື່ລູກຄ້າ<br>
        <select  name="customer_id" id="customer_id" class="form-control select2" style="width:210px;"  >
              <option value="">ທັງຫມົດ</option>
         <?php 
		 $sql_c=mysqli_query($con,"select * from customers ");
		 while($f=mysqli_fetch_array($sql_c)){
		  ?>     
              <option value="<?php echo $f['customer_id'];?>"><?php echo $f['customer_name'];?></option>
          <?php } ?>   
             </select>   
  	 </td> 
    
         <!--   <td>ຂໍ້ມູນລູກຄ້າ<br><input  type="text" name="customer_id" id="customer_id" class="form-control" placeholder="ຊື່ ລະຫັດ"  ></td> -->
    
             <td>ເລກທີຮັບ<br><input  type="text" name="sale_id" id="sale_id" class="form-control"  ></td> 
             
             <td>ປະເພດຊຳລະ<br><select  name="payment_type" id="payment_type" class="form-control"  >
             <option value="1">ເງີນສົດ</option>
              <option value="2">ເງີນໂອນ</option>
             </select>
             </td>
             <td>ຮູບແບບ<br><select  name="select_mode" id="select_mode" class="form-control"  >
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

           <br>
           
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
    <br>
    <br>
     <br>
    <br>
  <script>

// load_product();
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
				data:{ 
	 from_date:from_date,to_date:to_date,sale_id:sale_id,customer_id:customer_id,select_mode:select_mode },
				success:function(data)
				{
					$('#head_list').html(data);

				}
			});
	}

/*function load_product()
	{
			$.ajax({
			url:"fetch_product_receipt_report_detail.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}*/


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
				data:{ 
	 from_date:from_date,to_date:to_date,sale_id:sale_id,customer_id:customer_id,select_mode:select_mode,payment_type:payment_type },
				success:function(data)
				{
					$('#head_list').html(data);

				}
			});

  });

 });

$(document).ready(function(){
/*$(document).on('click', '.show_detail', function(){
	
		var sale_id = $(this).attr("id");		
		var action = "show";

			$.ajax({
				url:"fetch_product_receipt_report_detail.php",
				method:"POST",
				data:{   sale_id:sale_id,action:action },
				success:function(data)
				{
					$('#display_product').html(data);
				
				}
			});
		
	});
	

*/


});


/*$(document).on('click', '.delete_Id', function(){
	
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
   
 

	});*/
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