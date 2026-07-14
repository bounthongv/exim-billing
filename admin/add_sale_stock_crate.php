<?php 
include("init.php");

?>


<!DOCTYPE html>
<title>pakpasack</title>
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
    <!-- Navigation -->
<style>
.bgtd{background-color: #EBEBEB;
		
}
#barcode{ width:190px; height:35px; text-align:center;}




</style>
 <script src="js/numeral.min.js"></script>

<div class="container">
    <br>
    <h3 align="center">ຂາຍໜ້າຮ້ານ</h3><br>
  </div> 



 <div class="container">   
    	<form action="insert_sale_stock_crate.php" method="post" onsubmit="return ch_qty()"  onkeydown="return event.key != 'Enter';" enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
    <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
      <a href="add_sale_stock_crate.php"><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
      
      <button type="submit" name="save"  class="btn btn-primary" ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      
      <a href="cart_sale_stock_crate.php?action=empty" ><button type="button" name="reset" value="reset" class="btn btn-warning"><i class="fa fa-trash-o"></i>&nbsp;ລືບ</button></a>
     
  
    </div>
   
  </div>
  

  
<table border="0" >

  <tr>
    <td align="right">ເລກທີ:</td>
    <td>
     
    <input type="text" class="form-control ss" name="refer_no" id="refer_no" >    
 
    
    </td>
   <td align="right">ວັນທີ:</td>
    <td ><input type="date" class="form-control" name="sale_date" id="sale_date" value="<?php echo @date('Y-m-d');  ?>"  required> </td>
  
 <!-- <td>LAK:</td><td>

  <input type="text"  class="form-control" name="LAK" id="LAK" value="1" style="width:50px; text-align:right;" >
  </td>
    <td>THB:</td><td>

  <input type="text"  class="form-control" name="THB" id="THB" value="310" style="width:50px; text-align:right;" >
  </td>
    <td>USD:</td><td>

  <input type="text"  class="form-control" name="USD" id="USD" value="9050" style="width:50px; text-align:right;" >
  </td>-->
 
 
  </tr>
 <tr>

  </tr>
  <tr>
    <td align="right">ລູກຄ້າ: </td>
    <td>
    
    <div class="input-group input-group-sm">
    <input type="text" class="form-control ss" name="customer_name" id="customer_name"  >      
    <span class="input-group-addon">
   <button type="button" name="cc" class="btn btn-sm " data-toggle="modal" data-target="#customer_add" onclick="get_customer()"  ><i class="fa fa-search"></i>   </button> </span>   
    </div>
    <input type="hidden" class="form-control" name="customer_id"   id="customer_id"  >    
   
    </td>
     <td>ລາຄາ:</td>  
     <td><select name="price_type" id="price_type" class="form-control select2" required>    	
 
		<option value="003">ລາຄາຂາຍ</option>
        <option value="002">ລາຄາຂາຍພິເສດ</option>        
	    <option value="001">ຂາຄາຂາຍຍົກ</option>
    </select></td>
  <!--  <td align="right" colspan="1">ສາງ:</td>
    <td colspan="3">  
    <select name="stock_id" id="stock_id" class="form-control " required>    	
    <?PHP 
	
	//$stock_id=$_SESSION["stock_id"];
	
	 $sql=mysqli_query($con,"select * from stocks  ");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select>
    </td>-->
     
  
  </tr>

  
  
</table>

 


<table >
	<tr>
    	<td>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#select_product" onclick="click_get_list()" >
        <i class="fa fa-cart-plus"></i> &nbsp; ເລືອກລາຍການສີນຄ້າ</button>
        </td>
        <td>
        <input type="text" name="barcode" id="barcode" class="form-control" style="text-align:left;" placeholder=" 12345678..."   >
        </td>
      
	</tr>
</table>
<div id="display_cart_receipt"></div>

<!--<div id="error"></div>-->

</td>
</table>


<table width="100%">
<td valign="top">


<div id="show_payment_tab">
</div>
</td>
<td valign="top">


</td>
</table>


</form>



  </div>
    <br>
    <br>



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
                <th>ລະຫັດປະເພດ</th>
                <th>ຊື່ປະເພດ</th>
              </tr>
             <td colspan="2">
              <input type="button" name="show" id="" value="ທັງຫມົດ" class="btn  btn-sm show_add" ></td> 
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
		 		echo "<tr>";
		 	//	echo "<td>".$p['group_id']."</td>";?>
               
              	<td colspan="2">
              <button type="button" name="show" id="<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_ID'];?>" class="btn  btn-sm show_add" > 
			  <?php echo $p['Group_ID'].'&nbsp;'.$p['Group_Name'];?></button></td>
              
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
      
        
        <!-- Modal footer -->
        
       <div> &nbsp;
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button></div>
       
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
          <!--   <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>-->
        </table> 
        
        
        <div id="show_customer">
    
         </div>
        
         </div>
        
        <!-- Modal footer -->
        <div align="left" > &nbsp;  &nbsp;
    
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
          <br><br>
        </div>
        
      </div>
    </div>
  </div>






 
<script type="text/javascript"></script>
<script>
 

	
 function click_get_list(){
	 
		var stock_id = $('#stock_id').val();
		var price_type = $('#price_type').val();
			$.ajax({
			url:"fetch_product_sale_crate_list.php",
			method:"POST",
			data:{  stock_id:stock_id,price_type:price_type },
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}
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
	


 load_order_receipt();
 load_product();

 
// show_payment_tab();
 
 $("#barcode").focus();
 
 
 
 
 
 
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
	
        var c_name=customer_id+' '+customer_name;
		
		$('#customer_id').val(customer_id);
		$('#customer_name').val(customer_name);
		
	});
 
 
 
 
 
 
 function load_product()
	{
		var stock_id = $('#stock_id').val();
		var price_type = $('#price_type').val();
		
			$.ajax({
			url:"fetch_product_sale_crate_list.php",
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
			url:"fetch_cart_sale_stock_crate.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_cart_receipt').html(data);
				show_payment_tab();
				
			}
		});
	}
/*
function show_payment_tab()
	{
		//alert();
			$.ajax({
			url:"payment_tab.php",
			method:"POST",
		//	data:{  stock_id:stock_id,price_type:price_type },
			success:function(data)
			{
				$('#show_payment_tab').html(data);
				show_pay_currency();
			}
		});
	}
function show_pay_currency(){
	    
		var amount = $('#total').val();
		
		var a = $('#LAK').val();
		var b = $('#THB').val();
		var c = $('#USD').val();
		
		
		var LAK=Number(a.replace(/[^0-9\.-]+/g,""));
		var THB=Number(b.replace(/[^0-9\.-]+/g,""));
		var USD=Number(c.replace(/[^0-9\.-]+/g,""));
		
		var total=Number(amount.replace(/[^0-9\.-]+/g,""));
		
		
		$('#total_lak').val(numeral(total/LAK).format('0,000.00'));
		$('#total_thb').val(numeral(total/THB).format('0,000.00'));
		$('#total_usd').val(numeral(total/USD).format('0,000.00'));
		
		
			
	}*/
 $(document).on('click', '.show_add', function(){
	  
		var gr_id = $(this).attr("id");	
		var stock_id = $('#stock_id').val();
		var price_type = $('#price_type').val();
		var action = "show";
	
	
			$.ajax({
				url:"fetch_product_sale_crate_list.php",
				method:"POST",
				data:{   gr_id:gr_id,action:action,stock_id:stock_id,price_type:price_type },
				success:function(data)
				{
					$('#display_product').html(data);
				
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
				url:"cart_sale_stock_crate.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action,product_name:product_name,product_quantity:product_quantity,product_price:product_price,qty_limit:qty_limit },
				success:function(data)
				{
				//	$('#error').html(data);
					load_order_receipt();
					
				//	alert( data,"Item has been Added into Cart");
				}
			});
		
	});
	
	
	
	

/*	
$(document).on('click', '.update_cart_item', function(){
	   
	     var Product_ID = $(this).attr("id");
		// alert(Product_ID);		
		 var qty =$('#e_qty'+Product_ID+'').val();		 	
		 var price =$('#e_price'+Product_ID+'').val();
		 var dis_per =$('#percent_dis'+Product_ID+'').val();		 	
		 var dis_amount =$('#discount'+Product_ID+'').val();			 			  		   
		
		var status ='1';
		var action = "update_caculate";

			$.ajax({
				url:"cart_sale_stock_crate.php",
				method:"POST",
data:{  Product_ID:Product_ID,qty:qty,action:action,price:price,status:status,dis_per:dis_per,dis_amount:dis_amount },
				success:function(data)
				{
					
			//	$('#error').html(data);
					load_order_receipt();
					

				
				}
			});
		
	});		
*/





$(document).on('keyup', '.qty_enters', function(event){
	 if(event.which == 13) {
		 
		
	     var Product_ID = $(this).attr("data-Product_ID"); 				
		 var qty =$('#e_qty'+Product_ID+'').val();
		 var price =$('#e_price'+Product_ID+'').val();		 	
		 var dis_per =$('#percent_dis'+Product_ID+'').val();
		 var dis_amount =$('#discount'+Product_ID+'').val();
					 			  		   
		
		var status ='1';
		var action = "update_x1";

			$.ajax({
				url:"cart_sale_stock_crate.php",
				method:"POST",
         data:{  Product_ID:Product_ID,qty:qty,price:price,action:action,dis_per:dis_per,dis_amount:dis_amount,status:status },
				success:function(data)
				{
					
					
			//	$('#error').html(data);
					load_order_receipt();
					

				
				}
			});
}
});




$(document).on('keyup', '.discount_enter', function(event){
	 if(event.which == 13) {
		 
		
	     var Product_ID = $(this).attr("data-Product_ID"); 				
		 var qty =$('#e_qty'+Product_ID+'').val();
		 var price =$('#e_price'+Product_ID+'').val();		 	
		 var dis_per =$('#percent_dis'+Product_ID+'').val();
		 
		
		 var d_c =$('#discount'+Product_ID+'').val();
		 var dis_amount   =Number(d_c.replace(/[^0-9\.-]+/g,""));
		 
		
					 			  		   
		
		var status ='1';
		var action = "update_x2";

			$.ajax({
				url:"cart_sale_stock_crate.php",
				method:"POST",
         data:{  Product_ID:Product_ID,qty:qty,price:price,action:action,dis_per:dis_per,dis_amount:dis_amount,status:status },
				success:function(data)
				{
					
					
			//	$('#error').html(data);
					load_order_receipt();
					

				
				}
			});
}
});




/*

$(document).on('keyup', '#all_dis', function(event){
	 if(event.which == 13) {
		 

		 var all_a =$('#all_per').val();		 	
		 var all_b =$('#all_dis').val();
		 
		 var all_per     =Number(all_a.replace(/[^0-9\.-]+/g,""));
		 var all_dis     =Number(all_b.replace(/[^0-9\.-]+/g,""));
		 
		 
		 var action = "update_all_dis";
		 

			$.ajax({
				url:"cart_payment_tab.php",
				method:"POST",
         data:{  all_per:all_per,all_dis:all_dis,action:action },
				success:function(data)
				{
										

					show_payment_tab();
					

				
				}
			});
}
});
$(document).on('keyup', '#all_per', function(event){
	 if(event.which == 13) {
		 

		 var all_a =$('#all_per').val();		 	
		 var all_b =$('#all_dis').val();
		 
		 var all_per     =Number(all_a.replace(/[^0-9\.-]+/g,""));
		 var all_dis     =Number(all_b.replace(/[^0-9\.-]+/g,""));
		 
		 
		 var action = "update_all_per";
		 

			$.ajax({
				url:"cart_payment_tab.php",
				method:"POST",
         data:{  all_per:all_per,all_dis:all_dis,action:action },
				success:function(data)
				{
										

					show_payment_tab();
					

				
				}
			});
}
});


$(document).on('keyup', '.input_pay', function(event){
	 if(event.which == 13) {
		 
         var total_a =$('#total_lak').val();		 	
		 var total_b =$('#total_thb').val();
		 var total_c =$('#total_usd').val();
		 
		 var all_a =$('#payment_lak').val();		 	
		 var all_b =$('#payment_thb').val();
		 var all_c =$('#payment_usd').val();
		 
		 var total_lak     =Number(total_a.replace(/[^0-9\.-]+/g,""));
		 var total_thb     =Number(total_b.replace(/[^0-9\.-]+/g,""));
		 var total_usd     =Number(total_c.replace(/[^0-9\.-]+/g,""));
		 
		 var payment_lak     =Number(all_a.replace(/[^0-9\.-]+/g,""));
		 var payment_thb     =Number(all_b.replace(/[^0-9\.-]+/g,""));
		 var payment_usd     =Number(all_c.replace(/[^0-9\.-]+/g,""));
		 
		 
		 var action = "update_pay";
		 

			$.ajax({
				url:"cart_payment_tab.php",
				method:"POST",
         data:{  total_lak:total_lak,total_thb:total_thb,total_usd:total_usd,payment_lak:payment_lak,payment_thb:payment_thb,payment_usd:payment_usd,action:action },
				success:function(data)
				{
										

					show_payment_tab();
					

				
				}
			});
}
});
*/

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
				url:"cart_barcode_sale_stock_crate.php",
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
				url:"cart_sale_stock_crate.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action },
				success:function(data)
				{
				
					load_order_receipt();
				
				}
			});
		
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
 });






function ch_qty() {
	
	////////////////////////////////////////////////////

    var x = Number(document.me.total.value.replace(/[^0-9\.-]+/g,""));
    var y = Number(document.me.payment.value.replace(/[^0-9\.-]+/g,""));
	var change = Number(document.me.change.value.replace(/[^0-9\.-]+/g,""));
	
	var pid = Number(document.me.total.value.replace(/[^0-9\.-]+/g,""));
	 
	
	
    var x = document.getElementsByName("QTY[]");
	var m = document.getElementsByName("qty_limit[]");
	
	for (i = 0; i < x.length; i++) {
		aa=Number(x[i].value.replace(/[^0-9\.-]+/g,""));
		bb=Number(m[i].value.replace(/[^0-9\.-]+/g,""))
		
        if (aa > bb) {
        alert("ກະລຸນາກວດເບີ່ງຈຳນວນສີນຄ້າໃນສາງກ່ອນ");
		
		x[i].focus();
        return false;
        }
		
		
	}
}


////////////////////////////
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


</body>

</html>


