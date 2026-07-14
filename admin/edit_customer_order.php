<?php 
include("init.php");
//unset($_SESSION['cart_trnasfer_mini_stock']);
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




<?php  include("header.php");?>



    <!-- Navigation -->
<style>

.bgtd{background-color: #EBEBEB;
		
}
#barcode{ width:190px; height:35px; text-align:center;}

 .box_qty{
 
  padding: 3px 10px;
  margin: 4px 0;
  box-sizing: border-box;
}
th{ text-align:center;}
 @media{
  body{ font-size:10px;}
  }
</style>
 <script src="js/numeral.min.js"></script>
 <link rel="stylesheet" href="select2/select2.min.css">
<script src="select2/select2.full.min.js"></script>
<script>

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
<div class="container">
    <br>
    <h3 align="center">ລູກຄ້າສັ່ງຊື້ສິນຄ້າ</h3><br>
  </div> 

 
<div class="container">



<!---
<form action="cart_barcode_sale_stock.php" method="post" enctype="multipart/form-data" name="bar">
-->
<table  >
 <tr>

    <td></td><td colspan="5"><input type="hidden" name="barcode" id="barcode" style="text-align:left;" placeholder=" 12345678..."  onkeyup="this.value=this.value.replace(/[^\d]/,'')" >
    
    </td>
 </tr>
</table>

<!--</form>-->
</div>
    <!-- /.container -->
 <div class="container">   
    	<form action="update_customer_order.php" method="post"  onkeydown="return event.key != 'Enter';" onsubmit="return ch_qty()" enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
    <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
     <a href="cart_edit_customer_order.php?action=empty" ><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
      
      <button type="submit" name="save"  class="btn btn-primary" ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      
      <a href="cart_edit_customer_order.php?action=empty" ><button type="button" name="reset" value="reset" class="btn btn-warning"><i class="fa fa-trash-o"></i>&nbsp;ລືບ</button></a>
     </div>
     </div>
  
  
  

  
<table border="0">

  <tr>
    <td align="center">ເລກທີ: <br><input type="text" class="form-control ss" name="sale_id" id="sale_id"
     value="<?php echo @$_SESSION['edit_sale_order_id'];  ?>" readonly></td>
  <td align="center">ວັນທີສັ່ງ: <br><input type="date" class="form-control" name="sale_date" id="sale_date" value="<?php echo @$_SESSION['od_sale_date'];  ?>"  required></td>
  <td align="center">ເວລາ: <br> <input type="time" class="form-control" name="sale_time" id="sale_time" value="<?php echo @$_SESSION['od_sale_time'];  ?>"  required> </td>
    <td align="center">ວັນທີຕ້ອງການສົ່ງ: <br><input type="date" class="form-control" name="send_date" id="send_date" value="<?php echo @$_SESSION['od_send_date'];  ?>" 
     required> </td>
   <td align="center">ເວລາ: <br>  <input type="time" class="form-control" name="send_time" id="send_time" value="<?php echo @$_SESSION['od_send_time'];  ?>"  required></td>
  
 
  </tr>
 <tr>

  </tr>
  <tr>
    <td align="center">ລູກຄ້າ:  <br>
    <div class="input-group input-group-sm">
    <input type="text" class="form-control ss" name="customer_name" id="customer_name" value="<?php if($_SESSION['customer_name']!=''){ echo $_SESSION['customer_name'];} ?>" required  readonly>      
   <span class="input-group-addon">
   <button type="button" name="cc" class="btn btn-sm " data-toggle="modal" data-target="#customer_add" onclick="get_customer()" ><i class="fa fa-search"></i></button> </span>   
    </div>
    <input type="hidden" class="form-control" name="customer_id"   id="customer_id" value="<?php if($_SESSION['customer_id']!=''){ echo $_SESSION['customer_id'];} ?>"  >
   <!-- <input type="hidden" class="form-control" name="customer_type"   id="customer_type"  >-->
   
   
    </td>
     <td align="center">ປະເພດລູກຄ້າ: <br><input type="text" name="customer_type" id="customer_type" class="form-control" value="<?php if($_SESSION['customer_type']!=''){ echo $_SESSION['customer_type'];} ?>" required readonly>   
     <input type="hidden" name="price_type" id="price_type" value="<?php if($_SESSION['price_type']!=''){ echo $_SESSION['price_type'];} ?>" class="form-control" required>    	
   
    </td>
    <td align="center" >ສາຍທາງ: <br>  
    <select name="route_id" id="route_id" class="form-control " required>    	
    <?PHP 
	
	$stock_id=$_SESSION["stock_id"];
	
	 $sql=mysqli_query($con,"select * from routes  ");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['route_id']?>"><?php echo $f['route_id']?> &nbsp; <?php echo $f['route_name']?></option>
	<?PHP } ?>
    </select>
    
    <input type="hidden" name="stock_id" id="stock_id" class="form-control " value="<?php echo $_SESSION["stock_id"]; ?>" required> 
    </td>
  
  <td>ພະນັກງານຂາຍ: <br><?PHP 
	
	$sql=mysqli_query($con,"select * from sr_list");
	
	?>
    <select name="sr" id="sr" class="form-control select2" style="width:220px;" >
    <?php if(isset($_SESSION['od_sr_id'])){ ?> 
	      <option value="<?php echo $_SESSION['od_sr_id'];?>" ><?php echo $_SESSION['od_sr_fname']; ?> <?php echo $_SESSION['od_sr_lname']; ?></option>
	<? }else{  ?>
    	<option value="" >ເລືອກ</option>
    <?php } ?>
    <?PHP 
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['sr_id']?>"><?php echo $f['sr_fname']?> &nbsp; <?php echo $f['sr_lname']?></option>
	<?PHP } ?>
    </select></td>
    <td>ໝາຍເຫດ: <br><input type="text"  name="remark" id="remark" class="form-control" value="<?php echo $_SESSION['s_remark']; ?>" ></td>
  </tr>

  
  
</table>

 


<table >
	<tr>
    	<td>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#select_product" onclick="click_get_list()" >
        <i class="fa fa-cart-plus"></i> ລາຍການສີນຄ້າ</button>
        </td>
      
	</tr>
</table>




</td>
</table>



<div id="display_cart_receipt" ></div>

<div id="error"></div>

</form>
</div>
 



 
<br>
<br><br>



<div class="modal" id="select_product">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ລາຍການສິນຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
       <form action="cart_edit_customer_order_form.php" method="post" enctype="multipart/form-data">
       <input type="hidden" name="action" value="select_item">
       <div align="center"><button type="submit" class="btn btn-success btn-sm" name="save">ຕົກລົງ</button></div>
         <table >
          <tr>
          <td valign="top">
              
            <?PHP
			
			$vg=mysqli_query($con,"SELECT * FROM tb_groups");
				if($vg){ ?>
            <table border='1'  align="center" class="table-bordered">
              <tr>
                <th>ຊື່ປະເພດ</th>
              </tr>
             <td>
              <input type="button" name="show" id="" value="ທັງຫມົດ" class="btn  btn-sm show_add" >
              </td> 
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
		 		
		 	       ?>
            <tr>
              	<td >
              <button type="button" name="show" id="<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_ID'];?>" class="btn  btn-sm show_add" > 
			  <?php echo $p['Group_ID'].'&nbsp;'.$p['Group_Name'];?></button>
              </td>
              </tr>
              <?PHP } ?>
            </table>
            <?PHP } ?>
          </td>
   
          <td valign="top">
          
          <div id="display_product">
          
          </div>
      
          </td>
          </tr>
         </table>
         
          </form>
        </div>
        
        <!-- Modal footer -->
        
       <div> &nbsp;
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button> </div>
       
       <br>
        </div>
        
      </div>
     
    </div>
      
  </div>

    <!-- jQuery -->
    
   
 <div class="modal" id="edit_cart">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ລາຍການສິນຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
       
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table-bordered" >
        <tr>
        <th>ລະຫັດສິນຄ້າ</th>
        <th>ຊື່ລາຍການສິນຄ້າ</th>
        <th>ຈຳນວນ</th>
        <th>ລາຄາ</th>
        </tr>
        <tr>
        <td><input type="hidden" name="e_product_lot_id" id="up_product_lot_id" class="form-control" >
        <input type="text" name="e_Product_ID" id="up_Product_ID" class="form-control" >
        </td>
        
        <td><input type="text" name="e_name" id="up_name" class="form-control" ></td>
        <td><input type="text" name="e_qty" id="up_qty" class="form-control" ></td>
         <td><input type="text" name="e_price" id="up_price" class="form-control" ></td>
         
        
         </table>
         </div>
        
        <!-- Modal footer -->
        <div align="left" > &nbsp;  &nbsp;
          <button  type="button" class="btn btn-success" id="update_qty" data-dismiss="modal" >ບັນທືກ</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
          <br><br>
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


 function click_get_list()
	{
		var stock_id = $('#stock_id').val();
		var price_type = $('#price_type').val();
			$.ajax({
			url:"fetch_product_order_mini_list.php",
			method:"POST",
			data:{  stock_id:stock_id,price_type:price_type },
			success:function(data)
			{
				$('#display_product').html(data);
				
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
        var route_id = $(this).attr("data-route_id");
		
		var sr_id = $(this).attr("data-sr_id");
		var sr_fname = $(this).attr("data-sr_fname");
		var sr_lname = $(this).attr("data-sr_lname");
		
		$('#customer_id').val(customer_id);
		$('#customer_name').val(customer_name);
		
		$('#price_type').val(ct_id);
		$('#customer_type').val(ct_name);
		$('#route_id').val(route_id);
		
		$('#sr').val(sr_id).trigger('change');
		
		$.ajax({
				url:"session_customer.php",
			method:"POST",
			data:{  customer_id:customer_id,customer_name:customer_name,ct_id:ct_id,ct_name:ct_name,route_id:route_id,sr_id:sr_id,sr_fname:sr_fname,sr_lname:sr_lname },
			success:function(data)
			{
				make_order_list();
			}
			});
		
	 	//make_order_list();
		
	});
 
	

 load_order_receipt();
 load_product();
 
 $("#barcode").focus();
 function make_order_list()
	{
		/*var stock_id = $('#stock_id').val();
		var price_type = $('#price_type').val();
		var action ='make_cart';
		
			$.ajax({
				url:"cart_edit_customer_order.php",
			method:"POST",
			data:{  stock_id:stock_id,price_type:price_type,action:action },
			success:function(data)
			{
				$('#error').html(data);
				 load_order_receipt();
			}
		});*/
		var action ='reset';
		$.ajax({
				url:"cart_edit_customer_order.php",
			method:"POST",
			data:{ action:action },
			success:function(data)
			{
				$('#error').html(data);
				 load_order_receipt();
			}
			});
	}
	
	
	
 
 function load_product()
	{
		var stock_id = $('#stock_id').val();
		var price_type = $('#price_type').val();
		
			$.ajax({
			url:"fetch_product_order_mini_list.php",
			method:"POST",
			data:{  stock_id:stock_id,price_type:price_type },
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}
 function load_order_receipt()
	{
			$.ajax({
			url:"fetch_cart_edit_customer_order.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_cart_receipt').html(data);
				total_all();
				
			}
		});
	}


 $(document).on('click', '.show_add', function(){
	
		var gr_id = $(this).attr("id");	
		var stock_id = $('#stock_id').val();
		var price_type = $('#price_type').val();
		var action = "show";
		//alert(gr_id);
			$.ajax({
				url:"fetch_product_order_mini_list.php",
				method:"POST",
				data:{   gr_id:gr_id,action:action,stock_id:stock_id,price_type:price_type },
				success:function(data)
				{
					$('#display_product').html(data);
				//	load_product();
				//	alert( data,"Item has been Added into Cart");
				}
			});
		
	}); 
	
	
 $(document).on('click', '.add_pro', function(){
	
		var ID = $(this).attr("id");
		
		var Product_ID = $(this).attr("value");
		var product_name = $('#product_name'+ID+'').val();
		var product_price = $('#price'+ID+'').val();
		var qty_limit = $('#qty_limit'+ID+'').val();
		
		var pic = $('#pic'+ID+'').val();
		var pic_url = $('#pic_url'+ID+'').val();
		
		var product_quantity =1;		
		var action = "add";
	
			$.ajax({
				url:"cart_edit_customer_order.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action,product_name:product_name,product_quantity:product_quantity,product_price:product_price,qty_limit:qty_limit,pic:pic,pic_url:pic_url },
				success:function(data)
				{
					$('#error').html(data);
					load_order_receipt();
					
				//	alert( data,"Item has been Added into Cart");
				}
			});
		
	});


$(document).on('keyup', '.qty_enters', function(event){
	 if(event.which == 13) {
		 
		
	     var Product_ID = $(this).attr("data-Product_ID"); 				
		 var qty =$('#e_qty'+Product_ID+'').val();
		 var price =$('#e_price'+Product_ID+'').val();		 	
		 var qty_limit = $('#qty_limit'+Product_ID+'').val();
					 			  		   
		
		var status ='1';
		var action = "update_x1";

			$.ajax({
				url:"cart_edit_customer_order.php",
				method:"POST",
         data:{  Product_ID:Product_ID,qty:qty,price:price,action:action,status:status,qty_limit:qty_limit },
				success:function(data)
				{
					
					
			//	$('#error').html(data);
					load_order_receipt();
					

				
				}
			});
}
});

 $(document).on('click', '.qty_plus', function(){
		 
		
	     var Product_ID = $(this).attr("data-Product_ID"); 				
		 var qty_limit = $('#qty_limit'+Product_ID+'').val();
				 			  		   
		
		var status ='1';
		var action = "update_plus";

			$.ajax({
				url:"cart_edit_customer_order.php",
				method:"POST",
         data:{  Product_ID:Product_ID,action:action,status:status,qty_limit:qty_limit },
				success:function(data)
				{
					
					
			//	$('#error').html(data);
					load_order_receipt();
					

				
				}
			});

});
 $(document).on('click', '.qty_minus', function(){
		 
		
	     var Product_ID = $(this).attr("data-Product_ID"); 				
		 var qty_limit = $('#qty_limit'+Product_ID+'').val();
				 			  		   
		
		var status ='1';
		var action = "update_minus";

			$.ajax({
				url:"cart_edit_customer_order.php",
				method:"POST",
         data:{  Product_ID:Product_ID,action:action,status:status,qty_limit:qty_limit },
				success:function(data)
				{
					
					
			//	$('#error').html(data);
					load_order_receipt();
					

				
				}
			});
			
});



var barcode_key = document.getElementById("barcode");
barcode_key.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
  // document.getElementById("myBtn").click();
    var stock_id = document.getElementById("stock_id").value; 
    var barcode = document.getElementById("barcode").value; 
	var price_type = document.getElementById("price_type").value; 
	var action = 'add'; 
  

			 $.ajax({
				url:"cart_barcode_sale_stock.php",
				method:"POST",
				data:{   barcode:barcode,price_type:price_type,stock_id:stock_id,action:action},
				success:function(data)
				{
				
				$('#error').html(data);
				
					load_order_receipt();
					$("#barcode").val("");
				
				}
			});

  
  
  }
});	
	
	 $(document).on('click', '.delete_or', function(){
	
		var Product_ID = $(this).attr("id");
		
		var action = "remove";
	
			$.ajax({
				url:"cart_edit_customer_order.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action },
				success:function(data)
				{
				
					load_order_receipt();
				
				}
			});
		
	});
	

	
	
	
	
 });
</script>
  <script type='text/javascript' >
   function amount() {
    var qty = document.getElementsByName("QTY[]");	
	var Price = document.getElementsByName("Price[]");
	var crate_price = document.getElementsByName("crate_price[]");
	var amount_crate= document.getElementsByName("amount_crate[]");
	var amount = document.getElementsByName("amount[]");
	var total_amount_crate = document.getElementsByName("total_amount_crate[]");
	
	
	
	var sum =0;
	var sum_dis=0;
	var sum_qty=0;
	var sum_crate=0;
	// var sum_amount_crate=0;
	for (i = 0; i < qty.length; i++) {
	
     	q=Number(qty[i].value.replace(/[^0-9\.-]+/g,""));
		p=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		
		
		pc=Number(crate_price[i].value.replace(/[^0-9\.-]+/g,""));
		
		
	
	    amount[i].value=numeral(q*p).format('0,000');
		amount_crate[i].value=numeral(q*pc).format('0,000');
		total_amount_crate[i].value=numeral((q*pc)+(q*p)).format('0,000');
		
		sum_qty = sum_qty + (q);
		sum = sum + (q*p);
		sum_crate = sum_crate + (q*pc);
		
	//    sum_amount_crate=sum_amount_crate+sum_crate+sum
		
      $('#total_all').val(numeral(sum).format('0,000'));
	  $('#total_qty').val(numeral(sum_qty).format('0,000'));
	  $('#total_crate_price').val(numeral(sum_crate).format('0,000'));
	   $('#last_total').val(numeral(sum+sum_crate).format('0,000'));
	  
	  
	  
	
		
	 }
}


/*function amount() {
            var qty = document.getElementsByName("QTY[]");	
	      var Price = document.getElementsByName("Price[]");
	     var amount = document.getElementsByName("amount[]");
	
	        var q_l = document.getElementsByName("qty_limit[]");
	var crate_amount = document.getElementsByName("crate_amount[]");
	var total_amount_crate = document.getElementsByName("total_amount_crate[]");
            	var cr_price = document.getElementsByName("cr_price[]");
	
	
	var sum =0;
	var sum_dis=0;
	for (i = 0; i < qty.length; i++) {
		
	
     	       q=Number(qty[i].value.replace(/[^0-9\.-]+/g,""));
		       p=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		      qq=Number(q_l[i].value.replace(/[^0-9\.-]+/g,""));
	         crp=Number(cr_price[i].value.replace(/[^0-9\.-]+/g,""));
		
		
	
	          amount[i].value=numeral(q*p).format('0,000');
			  
			  alert(p);
		//crate_amount[i].value=numeral(q*cp).format('0,000');
		
	//	total_amount_crate[i].value=numeral('ddd').format('0,000');
		
		sum = sum + (q*p);
		sum_dis = sum_dis + (q*p)-dis; 
		/* if (q > qq) {
       
		alert('ຈຳນວນສີນຄ້າໃນສາງຂອງທ່ານຍັງມີ:'+qq+'');
		qty[i].value=qq;
		
		q=Number(qty[i].value.replace(/[^0-9\.-]+/g,""));
		p=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		d=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		 amount[i].value=numeral(q*p).format('0,000.00');
	

        }*/
		
 /*     $('#total_all').val(numeral(sum).format('0,000'));
	  $('#total_all_amount').val(numeral(sum).format('0,000'));
	  $('#total').val(numeral(sum_dis).format('0,000'));
	  
	
		
	 }
}

*/







/*
	function focus_barcode() {
    document.getElementById("barcode").focus();
}
*/
    </script>


</body>

</html>


