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
<script src='jquery-3.1.1.min.js' type='text/javascript'></script>
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>



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

</style>
 <script src="js/numeral.min.js"></script>

<div class="container">
    <br>
    <h3 align="center">ຂາຍສິນຄ້າ</h3><br>
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
   
    	<form action="insert_sale_stock.php" method="post"  onkeydown="return event.key != 'Enter';" onsubmit="return ch_qty()" enctype="multipart/form-data" name="me">
<div class="container"> 
	<div class="form-group row">
    <div class="col-sm-10">
    <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
     <a href="cart_sale_stock_mini.php?action=empty" ><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
      
      <button type="submit" name="save"  class="btn btn-primary" ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      
      <a href="cart_sale_stock_mini.php?action=empty" ><button type="button" name="reset" value="reset" class="btn btn-warning"><i class="fa fa-trash-o"></i>&nbsp;ລືບ</button></a>
     </div>
     </div>
  
 
  

  
<table border="0">

  <tr> 
    <td align="center">ເລກທີ: <br><input type="text" class="form-control ss" name="refer_no" id="refer_no" readonly ></td>
   <td align="center">ວັນທີ: <br><input type="date" class="form-control" name="sale_date" id="sale_date" value="<?php echo @date('Y-m-d');  ?>"  required> </td>
  
 
  </tr>
 <tr>

  </tr>
  <tr>
    <td align="center">ລູກຄ້າ:  <br>
    <div class="input-group input-group-sm">
    <input type="text" class="form-control ss" name="customer_name" id="customer_name" readonly >      
   <span class="input-group-addon">
   <button type="button" name="cc" class="btn btn-sm " data-toggle="modal" data-target="#customer_add" onclick="get_customer()" ><i class="fa fa-search"></i></button> </span>   
    </div>
    <input type="hidden" class="form-control" name="customer_id"   id="customer_id"   >
   <!-- <input type="hidden" class="form-control" name="customer_type"   id="customer_type"  >-->
   
   
    </td>
     <td align="center">ປະເພດລູກຄ້າ: <br><input type="text" name="customer_type" id="customer_type" class="form-control" required readonly>   
     <input type="hidden" name="price_type" id="price_type" class="form-control" required>    	
   
    </td>
    <td align="center" colspan="2">ສາງ: <br>  
    <select name="stock_id" id="stock_id" class="form-control " required>    	
    <?PHP 
	
	$stock_id=$_SESSION["stock_id"];
	
	 $sql=mysqli_query($con,"select * from stocks where stock_id='$stock_id' ");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select>
    </td>
  
  </tr>

  
  
</table>

  </div>


<!--<table >
	<tr>
    	<td>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#select_product" onclick="click_get_list()" >
        <i class="fa fa-cart-plus"></i> ລາຍການສີນຄ້າ</button>
        </td>
      
	</tr>
</table>-->




</td>
</table>



<div id="display_cart_receipt" ></div>

<div id="error"></div>

</form>

 



 
<br>
<br><br>


 <form action="cart_transfer_from_mini_stock.php" method="post"  enctype="multipart/form-data">
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
        </div>
        
        <!-- Modal footer -->
        
       <div> &nbsp;
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button></div>
       
       <br>
        </div>
        
      </div>
     
    </div>
      
  </div>
</form>
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
			url:"fetch_product_sale_mini_list.php",
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
     
		
		$('#customer_id').val(customer_id);
		$('#customer_name').val(customer_name);
		
		$('#price_type').val(ct_id);
		$('#customer_type').val(ct_name);
		
		
		make_order_list();
		
	});
 
	

 load_order_receipt();
 load_product();
 
 $("#barcode").focus();
 function make_order_list()
	{
		var stock_id = $('#stock_id').val();
		var price_type = $('#price_type').val();
		var action ='make_cart';
		
			$.ajax({
				url:"cart_sale_stock_mini.php",
			method:"POST",
			data:{  stock_id:stock_id,price_type:price_type,action:action },
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
			url:"fetch_product_sale_mini_list.php",
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
			url:"fetch_cart_sale_stock_mini.php",
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
				url:"fetch_product_sale_mini_list.php",
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
		var product_quantity =1;		
		var action = "add";
	
			$.ajax({
				url:"cart_sale_stock_mini.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action,product_name:product_name,product_quantity:product_quantity,product_price:product_price,qty_limit:qty_limit },
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
				url:"cart_sale_stock_mini.php",
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
				url:"cart_sale_stock_mini.php",
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
				url:"cart_sale_stock_mini.php",
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
				url:"cart_sale_stock_mini.php",
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


	function focus_barcode() {
    document.getElementById("barcode").focus();
}

    </script>


</body>

</html>


