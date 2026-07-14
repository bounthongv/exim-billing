<?php 
include("init.php");
//unset($_SESSION['cart_trnasfer_mini_stock']);
?>
<style>
td{ padding:5px;
font-weight:!important;
height:40px;
 }
</style>




<!DOCTYPE html>


<head>


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
  


 
<?php  include("header.php");?>
<style>
#search{border:1px solid #008000; border-radius:4px; background-color:#008000; padding:5px; color:#FFF; font-family:"Phetsarath OT";}

input{padding:4px; border:1px solid #D8D8D8; border-radius:4px;}


</style>
<style>
td{ padding:5px;
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
#barcode{ width:190px; height:35px;}
th{ text-align:center;}


</style>
 <script src="js/numeral.min.js"></script>
 <?php

     $sql_id_auto= mysqli_query($con,"SELECT MAX(payment_id) AS id_max FROM  customer_payment ");
                  $ff = mysqli_fetch_array($sql_id_auto);
   $id_number = $ff['id_max']+1;
   $width = 6;
 $auto_id = str_pad((string)$id_number, $width, "0", STR_PAD_LEFT); 
?>

<div class="container">
    <br>
    <h3 align="center">ໃບຮັບເງີນ</h3><br>
  </div> 

 

    <!-- /.container -->
 <div class="container">   
    	<form action="insert_receipt.php" method="post"  onkeydown="return event.key != 'Enter';"  enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
      <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
      <a href="add_receipt.php"><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
      <button type="submit" name="save" class="btn btn-primary" value="save"  ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      <a href="cart_receipt_edit.php?action=empty" ><button type="button" name="reset" value="reset" class="btn btn-warning"><i class="fa fa-trash"></i>&nbsp;ລືບ</button></a>
     
  
    </div>
    <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
  </div>
<table border="0">
  <tr>
    <td align="right">ເລກທີ:</td>
    <td ><input type="text" class="form-control" name="payment_id" id="payment_id" value="<?php if($_SESSION['payment_id']!==''){ echo $_SESSION['payment_id'];}else{} ?>" readonly ></td>
    <td align="right">ວັນທີ:</td>
    <td ><input type="date" class="form-control" name="payment_date" id="payment_date" onchange="get_currency()" 
   value="<?php if($_SESSION['payment_date']!==''){ echo $_SESSION['payment_date'];}else{ echo @date('Y-m-d'); } ?>"  required> </td>
  </tr>
  <tr>
    <td align="right">ລູກຄ້າ:</td>
    <td>
    
    <div class="input-group input-group-sm">
    <input type="text" class="form-control ss" name="customer_name" id="customer_name" value="<?php if($_SESSION['customer_name']!==''){ echo $_SESSION['customer_name'];}else{} ?>" readonly >    
   <span class="input-group-addon">
   <button type="button" name="cc" class="btn btn-sm " data-toggle="modal" data-target="#customer_add" ><i class="fa fa-search"></i></button> </span>    
    </div>
    <input type="hidden" class="form-control" name="customer_id" id="customer_id" value="<?php if($_SESSION['customer_id']!==''){ echo $_SESSION['customer_id'];}else{} ?>" > 
    </td>

  </tr>
 <tr>

  </tr>
   
  <tr>
    <td align="right">ຜູ້ຈ່າຍເງີນ:</td>
    <td>
   <input type="text" name="payment_name" id="payment_name" class="form-control" value="<?php if($_SESSION['payment_name']!==''){ echo $_SESSION['payment_name'];}else{} ?>" required>    	
    
    </td>
    <td align="right" colspan="1">ຜູ້ຮັບເງີນ</td>
    <td colspan="1">  
    
   <input type="text" name="receipt_name" id="receipt_name" class="form-control" value="<?php if($_SESSION['receipt_name']!==''){ echo $_SESSION['receipt_name'];}else{} ?>" required>
    </td>
  </tr>


 

  </table>
   <!-- <table>
  
<tr>
  <td align="right">Remark:</td>
    <td ><textarea name="remark" id="remark"  rows="6" style="width:400px;" class="form-control"></textarea> </td>
  </tr>

  
  
   </table>
-->
 


<table >
	<tr>
    	<td>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#select_product" onclick="load_product()" >
        <i class="fa fa-cart-plus"></i> &nbsp; ເລືອກລາຍການບິນຂາຍສິນຄ້າ</button>
        </td>
      
	</tr>
</table>

<div id="display_cart_receipt"></div>

<div id="error"></div>
<br>
<table>
<tr>
     <td align="right"> ປະເພດຊຳລະ:</td>
    <td>
   <select  name="payment_type" id="payment_type" class="form-control" required>  
   <option value="1">ເງີນສົດ</option>
    <option value="2">ເງີນໂອນ</option>
   </select>  	
    
    </td>

    <td align="right">THB:</td>
    <td>
   <input type="text" name="rate_thb" id="rate_thb"  class="form-control" style="text-align:right;"  value="300" readonly required>    	
    
    </td>
    <td align="right" colspan="1">USD</td>
    <td colspan="1">  
    
   <input type="text" name="rate_usd" id="rate_usd"  class="form-control" style="text-align:right;" value="9100" readonly >
    </td>
  </tr>
    <input type="hidden" name="rate_lak" id="rate_lak"  class="form-control" value="1" readonly required> 
</table>
<br>
<table class="table table-bordered ">
<tr bgcolor="#F0F0F0">
     <th align="center"> ຈ່າຍເງີນກີບ</th>
     <th align="center">ຈ່າຍເງີນບາດ</th>  
     <th align="center" >ຈ່າຍເງີນໂດລາ</th>
     <th align="center" >ທຽບເທົ່າເງີນກີບ</th>

  </tr>
  <tr>
  <td> <input type="text" name="pay_lak" id="pay_lak"  class="form-control number payments" style="text-align:right;"  ></td>
  <td> <input type="text" name="pay_thb" id="pay_thb"  class="form-control number payments" style="text-align:right;"></td>
  <td> <input type="text" name="pay_usd" id="pay_usd"  class="form-control number payments"  style="text-align:right;"></td>
  <td> <input type="text" name="total_lak" id="total_lak"  class="form-control" style="text-align:right;" readonly ></td>
  </tr>

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
          <h4 class="modal-title">ລາຍການບິນຂາຍສິນຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
         <form action="cart_receipt_edit.php" method="post" enctype="multipart/form-data">
       <input type="hidden" name="action" value="add">
       <div align="left"><button type="submit" class="btn btn-success btn-sm" name="save">ຕົກລົງ</button></div>
       
        <div id="display_product"></div>
          </form>
        </div>
        
        <!-- Modal footer -->
        <div>        
         &nbsp; <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
        </div>
        <br>
        
      </div>
    </div>
  </div>





  <div class="modal" id="customer_add">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ລາຍການລູກຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
       
        <!-- Modal body -->
        <div class="modal-body">
        
        <table>
             <td>ລະຫັດ<br><input  type="text" name="s_customer_id" id="s_customer_id"  class="form-control s_customer"  ></td> 
             <td>ຊື່<br><input  type="text" name="s_customer_name" id="s_customer_name"  class="form-control s_customer"  ></td> 
              
             
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

</body>

</html>

<script>
 get_currency();
 load_order_receipt();
 load_product();
  load_customer();
 

   function get_currency(){
		
		var cur_date = $('#payment_date').val();
		
			$.ajax({
			url:"fetch_currency.php",
			method:"POST",
			 dataType: "json",
			data:{  cur_date:cur_date },
			success:function(data)
			{
				if(data.status == 'ok'){
					
                       $('#rate_thb').val(data.result.kip_baht);
                       $('#rate_usd').val(data.result.dollar_baht);
					
				
					
                              
                }else{
                   
                } 
            
				
			}
		});

	} 
	
  function load_customer()
	{
		
	  var customer_id = $('#s_customer_id').val();
	  var customer_name = $('#s_customer_name').val();
			$.ajax({
			url:"fetch_customer_receipt.php",
			method:"POST",
			data:{  customer_id:customer_id,customer_name:customer_name },
			//dataType:"json",
			success:function(data)
			{
				$('#show_customer').html(data);
				
			}
		});
	}

 function load_order_receipt(){
			$.ajax({
			url:"fetch_cart_receipt_edit.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_cart_receipt').html(data);
				load_total_payment();
			}
		});
	}

 function load_product(){
		var customer_id = $('#customer_id').val();
			$.ajax({
			url:"fetch_receipt_sale_list.php",
			method:"POST",
			data:{  customer_id:customer_id },
			//dataType:"json",
			success:function(data)
			{
				$('#display_product').html(data);
				
				member_data();
				
			}
		});
	}
	 function member_data(){
	    
			var payment_date = $('#payment_date').val();
			var customer_id = $('#customer_id').val();
			var customer_name = $('#customer_name').val();
			var payment_name = $('#payment_name').val();
			var receipt_name = $('#receipt_name').val();
			
			
			$.ajax({
			url:"receipt_member.php",
			method:"POST",
			data:{  payment_date:payment_date,customer_id:customer_id,customer_name:customer_name,payment_name:payment_name,receipt_name:receipt_name            },
			//dataType:"json",
			success:function(data)
			{
				//$('#display_product').html(data);
				
			}
		});
	}
	
	  function load_total_payment()
	{
		
	  var total_all = $('#total_r').val();
	  
	  $('#pay_lak').val(total_all);
	  $('#total_lak').val(total_all);

	}
</script>
<script>
$(document).ready(function(){

   $(document).on('keyup', '.payments', function(){
	
	    var pay_lak = $('#pay_lak').val();
	    var pay_thb = $('#pay_thb').val();
		var pay_usd = $('#pay_usd').val();
		
		pl=Number(pay_lak.replace(/[^0-9\.-]+/g,""));
		pt=Number(pay_thb.replace(/[^0-9\.-]+/g,""));
		pu=Number(pay_usd.replace(/[^0-9\.-]+/g,""));
		
		var rate_lak = $('#rate_lak').val();
	    var rate_thb = $('#rate_thb').val();
		var rate_usd = $('#rate_usd').val();
		
		rl=Number(rate_lak.replace(/[^0-9\.-]+/g,""));
		rt=Number(rate_thb.replace(/[^0-9\.-]+/g,""));
		ru=Number(rate_usd.replace(/[^0-9\.-]+/g,""));
		
		var total_l=pl;
		var total_t=pt*rt;
		var total_u=pu*ru;
		
		var totalx=total_l+total_t+total_u;
		
		$('#total_lak').val(numeral(totalx).format('0,000'));
		
		
		
	});


  $(document).on('keyup', '.s_customer', function(){
	
	    var customer_id = $('#s_customer_id').val();
	    var customer_name = $('#s_customer_name').val();
		var action = "show";
	//	alert(gr_id);
			$.ajax({
				url:"fetch_customer_receipt.php",
				method:"POST",
				data:{  customer_id:customer_id, customer_name:customer_name,action:action },
				success:function(data)
				{
					$('#show_customer').html(data);
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
				url:"cart_receipt_edit.php",
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
	
	
	 $(document).on('click', '.delete_or', function(){
	
		var Product_ID = $(this).attr("id");
		var product_lot_id = $(this).attr("value");
		var action = "remove";
	
			$.ajax({
				url:"cart_receipt_edit.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action },
				success:function(data)
				{
				
					load_order_receipt();
				
				}
			});
		
	});
$(document).on('keyup', '.qty_enters', function(event){
	 if(event.which == 13) {
		 
		 
	     var Product_ID = $(this).attr("data-Product_ID"); 				
		 var total_x= $('#total'+Product_ID+'').val();  
		 total=Number(total_x.replace(/[^0-9\.-]+/g,""));
		    
		 var action = "update_x1";
        
			$.ajax({
				url:"cart_receipt_edit.php",
				method:"POST",
         data:{  Product_ID:Product_ID,total:total,action:action },
				success:function(data)
				{

					
				//	$('#error').html(data);
					load_order_receipt();

				
				}
			});
}
});	
	
	
		$(document).on('click', '.add_customer', function(){
	 
		var customer_id = $(this).attr("id");
		var customer_name = $(this).attr("data-customer_name");
	
	  
		$("#customer_id").val(customer_id);
		$("#customer_name").val(customer_name);
		
      
		
			});
			

			
		

	
	
	
 });





/*
function amount() {
    var qty = document.getElementsByName("QTY[]");	
	var Price = document.getElementsByName("Price[]");
	var amount = document.getElementsByName("amount[]");
	var q_l = document.getElementsByName("qty_limit[]");
	
	for (i = 0; i < qty.length; i++) {
	
     	q=Number(qty[i].value.replace(/[^0-9\.-]+/g,""));
		p=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		qq=Number(q_l[i].value.replace(/[^0-9\.-]+/g,""));
	
	    amount[i].value=numeral(q*p).format('0,0');
		
		 if (q > qq) {
       
		alert('ຈຳນວນສີນຄ້າໃນສາງຂອງທ່ານຍັງມີ:'+qq+'');
		qty[i].value=qq;
		
		q=Number(qty[i].value.replace(/[^0-9\.-]+/g,""));
		p=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		 amount[i].value=numeral(q*p).format('0,0');
	
       return false;
        }
		
		
	 }
}
*/	
	////////////////////////////
	</script>

 