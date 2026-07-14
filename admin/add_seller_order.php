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
#barcode{ width:190px; height:35px; text-align:center;}

.ss{ width:180px;}

.cur{ width:50px;}
.price{ width:90px;}
.s{width:370px;}

.sinput{width:180px; text-align:right;}
.sinput2{width:100px; text-align:right; height:35; }
.sinput_per{width:90px; text-align:right; height:35; }

.sw{width:245px; height:47px; font-size:22px; font-family:"LAOS";

}

td{padding:3px;}
.td{background-color:#0080C0; color:#FFF;}

.fm{width:135px; font-size:20px;}


	*{ margin:0;
	   padding:0;}
	   .but{
		   width:40px;
		   height:40px;
		   font-size:20px;
		   margin:1px;
		   cursor:pointer;
		   color:#00F;
		   /*border-collapse:collapse;
		   border:1px solid #EBEBEB;*/
		  
		   
		   }
		.textview{
			width:240px;
			margin:3px;
			font-size:25px;
			padding:3px;
		}
		
		.sz{height:90px;}
		.w{width:90px;}
.text_right { text-align: right; }
</style>
 <script src="js/numeral.min.js"></script>

<div class="container">
    <br>
    <h3 align="center">ໃບສັ່ງຊື້ສິນຄ້າ</h3><br>
  </div> 

 
<div class="container">



<!---
<form action="cart_barcode_sale_stock.php" method="post" enctype="multipart/form-data" name="bar">
-->
<!--<table  >
 <tr>

    <td>Barcode:</td><td colspan="5"><input type="text" name="barcode" id="barcode" style="text-align:left;" placeholder=" 12345678..."  onkeyup="this.value=this.value.replace(/[^\d]/,'')" >
    
    </td>
 </tr>
</table>-->

<!--</form>-->
</div>
    <!-- /.container -->
 <div class="container">   
    	<form action="insert_add_seller_order.php" method="post" onsubmit="return ch_qty()" enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
    <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
      <a href="add_seller_order.php"><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
      
      <button type="submit" name="save"  class="btn btn-primary" ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      
      <a href="cart_seller_order.php?action=empty" ><button type="button" name="reset" value="reset" class="btn btn-warning"><i class="fa fa-trash-o"></i>&nbsp;ລືບ</button></a>
     
  
    </div>
   
  </div>
  
<?php
$sql_max=mysqli_query($con,"select  max(SUBSTRING(order_id, 2, 5)) as id from seller_orders");
@$row_max=mysql_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='S00000'.'1';  
 
 $id2=$max_id+1;
 
 $order_id='';
if($max_id<1){    $order_id=$id1;     }

 else if($max_id<9){  $order_id='S00000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $order_id='S0000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $order_id='S000'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $order_id='S00'.$id2;} 
  else if($max_id<99999){  $order_id='S0'.$id2;}
  
  else if($max_id >=99999){   $order_id='S'.$id2; }
  
   $order_id;

?>
  
<table border="0">

  <tr>
    <td align="right">ເລກທີ:</td>
    <td><input type="text" class="form-control ss" name="order_id" id="order_id" value="<?php echo $order_id; ?>" required></td>
   <td align="right">ວັນທີ:</td>
    <td ><input type="date" class="form-control" name="order_date" id="order_date" value="<?php echo @date('Y-m-d');  ?>" onchange="get_currency2()" required> </td>
  
  <td>ກິບ-ບາດ:</td><td>

  <input type="text"  class="form-control cur" name="kip_baht" id="kip_baht"  readonly >
  </td>
  <td>ໂດລາ-ບາດ:</td><td>

  <input type="text"  class="form-control cur" name="dollar_baht" id="dollar_baht" readonly >
  </td>
  </tr>
 <tr>

  </tr>
  <tr>
    <td align="right">ລູກຄ້າ: </td>
    <td><div class="input-group input-group-sm">
    <input type="text" class="form-control ss" name="customer_name" id="customer_name" value="<?php if(isset($_GET['c_id'])){ echo $_GET['c_id'].'&nbsp;'.$_GET['c_name']; } ?>" >      
   <span class="input-group-addon">
   <button type="button" name="cc" class="btn btn-sm " data-toggle="modal" data-target="#customer_add" ><i class="fa fa-search"></i></button> </span>   
    </div>
    <input type="hidden" class="form-control" name="customer_id"   id="customer_id" value="<?php if(isset($_GET['c_id'])){ echo $_GET['c_id']; }else{ echo 'C0001';} ?>"  >
   <!-- <input type="hidden" class="form-control" name="customer_type"   id="customer_type"  >-->
   
   
    </td>
     <td>ລາຄາ:</td>  
     <td><select name="price_type" id="price_type" class="form-control" required>    	
   <?php if(isset($_GET['c_id'])){ 
	    
       if($_GET['c_t']=='001'){ echo ' <option value="001">ຂາຄາຂາຍຍົກ</option>';}
   elseif($_GET['c_t']=='002'){ echo ' <option value="002">ລາຄາຂາຍພິເສດ</option>';}
   elseif($_GET['c_t']=='003'){ echo ' <option value="003">ລາຄາຂາຍ</option>';}
	   
	   } ?>
		<option value="003">ລາຄາຂາຍ</option>
        <option value="002">ລາຄາຂາຍພິເສດ</option>        
	    <option value="001">ຂາຄາຂາຍຍົກ</option>
    </select></td>
    <td align="right" colspan="1">ສາງ:</td>
    <td colspan="3">  
    <select name="stock_id" id="stock_id" class="form-control " required>    	
    <?PHP 
	
	$stock_id=$_SESSION["stock_id"];
	
	 $sql=mysqli_query($con,"select * from stocks where stock_id='$stock_id' ");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select>
    </td>
     <td align="right" colspan="1">ພະນັກງານຂາຍ:</td>
    <td colspan="1">  
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']; ?>" class="form-control " required>    	
     <input type="text" name="user_name" id="user_name" value="<?php echo $_SESSION['username']; ?>" class="form-control " required>  
    </td>
  
  </tr>

  
  
</table>

 


<table >
	<tr>
    	<td>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#select_product" onclick="click_get_list()" >
        <i class="fa fa-cart-plus"></i> &nbsp; ເລືອກລາຍການສີນຄ້າ</button>
        </td>
      
	</tr>
</table>
<div id="display_cart_receipt"></div>

<div id="error"></div>

</td>
</table>




</form>



  </div>
    <br>
    <br>


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
         <input type="hidden" name="action" value="add">
          </td>
          </tr>
         </table>
        </div>
        
        <!-- Modal footer -->
        
       <div> &nbsp; <input type="submit" class="btn btn-success" name="add" value="ຕົກລົງ">
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
             <td>ລະຫັດ<br><input  type="text" name="product_id" id="product_id" class="form-control"  ></td> 
             <td>ຊື່ລູກຄ້າ<br><input  type="text" name="product_name" id="product_name" class="form-control"  ></td> 
             <td>ເບີໂທ<br><input  type="text" name="phone" id="phone" class="form-control"  ></td> 
             <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>
        </table> 
        
        
        <div id="s_customer">
        
        <table class="table-bordered" >
        <tr align="center">
         <th>ລະຫັດ</th>
         <th>ຊື່ລູກຄ້າ</th>
         <th>ເບີໂທ</th>
         <th>ປະເພດ</th>
         <th>ເລືອກ</th>
        </tr>
        
        <?php
		
		@$sp=mysqli_query($con,"  SELECT customers.*,customer_type.ct_id,customer_type.ct_name
		   FROM  customers 
		   left join customer_type on customer_type.ct_id=customers.customer_type
		   where 1=1    limit 50
		    ");
		   while($f=mysqli_fetch_array($sp)){
		?>
        <tr>         
         <td><?php echo "$f[customer_id]";?></td>
         <td><?php echo "$f[customer_name]";?></td>
         <td><?php echo "$f[phone]";?></td>
         <td><?php echo "$f[ct_name]";?></td>
         <td><a href="add_seller_order.php?c_id=<?=$f['customer_id'];?>&c_name=<?=$f['customer_name'];?>&c_t=<?=$f['customer_type'];?>"><button type="button" name="cc" class="btn btn-sm btn-success" >ເລືອກ</button></a></td>
        </tr>
        <?php } ?>
        
       
         </table> 
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
  function get_currency2()
{
		var cur_date = $('#order_date').val();
		
			$.ajax({
			url:"fetch_currency.php",
			method:"POST",
			 dataType: "json",
			data:{  cur_date:cur_date },
			success:function(data)
			{
				if(data.status == 'ok'){
                       $('#kip_baht').val(data.result.kip_baht);
                       $('#dollar_baht').val(data.result.dollar_baht);
					
				
                              
                }else{
                   
                } 
            
				
			}
		});

	} 
 $(function(){
  $('#search_product').click(function(){
   
 
   var phone = $('#phone').val();
   var product_id = $('#product_id').val();
   var product_name = $('#product_name').val();
 
         $.ajax({
				url:"seller_customer.php",
				method:"POST",
				data:{  product_id:product_id,phone:phone,product_name:product_name },
				success:function(data)
				{
					$('#s_customer').html(data);

				}
			});

  });

 });
 function click_get_list()
	{
		var stock_id = $('#stock_id').val();
		var price_type = $('#price_type').val();
			$.ajax({
			url:"fetch_product_sale_list.php",
			method:"POST",
			data:{  stock_id:stock_id,price_type:price_type },
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}

 

$(document).ready(function(){
	
get_currency();	
function get_currency()
	{ 

		var cur_date = $('#order_date').val();
		
			$.ajax({
			url:"fetch_currency.php",
			method:"POST",
			 dataType: "json",
			data:{  cur_date:cur_date },
			success:function(data)
			{
				if(data.status == 'ok'){
                       $('#kip_baht').val(data.result.kip_baht);
                       $('#dollar_baht').val(data.result.dollar_baht);
					
					    
                              
                }else{
                   
                } 
            
				
			}
		});
		
	} 
	
	



 load_product();


 
 function load_product()
	{
		var stock_id = $('#stock_id').val();
		var price_type = $('#price_type').val();
		
			$.ajax({
			url:"fetch_product_sale_list.php",
			method:"POST",
			data:{  stock_id:stock_id,price_type:price_type },
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}
  load_order_receipt();
 function load_order_receipt()
	{
			$.ajax({
			url:"fetch_cart_seller.php",
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
	//	alert(gr_id);
			$.ajax({
				url:"fetch_product_sale_list.php",
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
				url:"cart_seller_order.php",
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
				url:"cart_seller_order.php",
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
    $( function() {
  
        $( "#customer_name" ).autocomplete({
			
            source: function( request, response ) {
                
                $.ajax({
                    url: "fetch_auto_customer.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
					
                    },
                    success: function( data ) {
                        response( data );
						
                    }
                });
            },
            select: function (event, ui) {
                $('#customer_name').val(ui.item.label); // display the selected text
                $('#customer_id').val(ui.item.value); // save selected id to input
				$('#customer_type').val(ui.item.customer_type);
				$('#price_type').val(ui.item.customer_type);
                return false;
            }
        });

        // Multiple select
      
    });




function ch_qty() {
	
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

function amount() {
    var qty = document.getElementsByName("QTY[]");	
	var Price = document.getElementsByName("Price[]");
	var amount = document.getElementsByName("amount[]");
	var discount = document.getElementsByName("discount[]");
	var q_l = document.getElementsByName("qty_limit[]");
	var total_amount = document.getElementsByName("total_amount[]");
	var sum =0;
	var sum_dis=0;
	for (i = 0; i < qty.length; i++) {
	
     	q=Number(qty[i].value.replace(/[^0-9\.-]+/g,""));
		p=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		qq=Number(q_l[i].value.replace(/[^0-9\.-]+/g,""));
		dis=Number(discount[i].value.replace(/[^0-9\.-]+/g,""));
	
	    amount[i].value=numeral(q*p).format('0,000.00');
		 total_amount[i].value=numeral(q*p-dis).format('0,000.00');
		
		sum = sum + (q*p);
		sum_dis = sum_dis + (q*p)-dis; 
		
		 if (q > qq) {
       
		alert('ຈຳນວນສີນຄ້າໃນສາງຂອງທ່ານຍັງມີ:'+qq+'');
		qty[i].value=qq;
		
		q=Number(qty[i].value.replace(/[^0-9\.-]+/g,""));
		p=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		d=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		 amount[i].value=numeral(q*p).format('0,000.00');
		  total_amount[i].value=numeral(q*p-dis).format('0,000.00');
	
	 //   $('#total_all').val(numeral(q*p).format('0,0'));
    //   return false;
        }
		
      $('#total_all').val(numeral(sum).format('0,000.00'));
	  $('#total_all_amount').val(numeral(sum).format('0,000.00'));

	 }
}

function discount_per() {
	
    var amount = document.getElementsByName("amount[]");
	
	var percent_dis = document.getElementsByName("percent_dis[]");	
	
	var discount = document.getElementsByName("discount[]");
	var total_amount = document.getElementsByName("total_amount[]");
	//var q_l = document.getElementsByName("qty_limit[]");
	//var total_all = document.getElementsById("total_all");
	
//	var pp = document.me.passs.value.replace(/[&\/\\#,+()$~%.'":;*?<>{}]/g,'');

//	document.me.passs.value=pp;
	
   var sum=0;
   var sum_dis=0;
   
   var sum_all_dis=0;
	for (i = 0; i < amount.length; i++) {
	
	var pd = percent_dis[i].value.replace(/[&\/\\#,+()$~%'":;*?<>{}]/g,'');
	 percent_dis[i].value=pd;
	
     	a=Number(amount[i].value.replace(/[^0-9\.-]+/g,""));		
		p=Number(percent_dis[i].value.replace(/[^0-9\.-]+/g,""));
		
	
		
	     
		 tt =(a*p)/100;
		 
	    discount[i].value=numeral(tt).format('0,000.00');
		d=Number(discount[i].value.replace(/[^0-9\.-]+/g,""));
		
		xtt =a-d;
		
		total_amount[i].value=numeral(xtt).format('0,000.00');
	  
		
		
		total_amt=Number(total_amount[i].value.replace(/[^0-9\.-]+/g,""));
		sum = sum + total_amt;		
      $('#total_all_amount').val(numeral(sum).format('0,000.00'));
	  

	
	
	 }
	 
	
	 
	  
}
function discount_d() {
	
    var amount = document.getElementsByName("amount[]");	
	var percent_dis = document.getElementsByName("percent_dis[]");	
	var discount = document.getElementsByName("discount[]");
	var total_amount = document.getElementsByName("total_amount[]");

	
   var sum=0;
   var sum_dis=0;
    var sum_all_dis=0;
	
	for (i = 0; i < amount.length; i++) {
	
	
     	a=Number(amount[i].value.replace(/[^0-9\.-]+/g,""));		
		d=Number(discount[i].value.replace(/[^0-9\.-]+/g,""));
		
	
		
	     
		 tt =(d/a)*100;
		 
	    percent_dis[i].value=numeral(tt).format('0,000.00');
		
		
	  d=Number(discount[i].value.replace(/[^0-9\.-]+/g,""));		
		xtt =a-d;		
		total_amount[i].value=numeral(xtt).format('0,000.00');
	  
		
		
		total_amt=Number(total_amount[i].value.replace(/[^0-9\.-]+/g,""));
		sum = sum + total_amt;		
      $('#total_all_amount').val(numeral(sum).format('0,000.00'));
	  
	  
	 
	 

	 }
	 
	
	  
}

/////////////////////////////////////



    </script>


</body>

</html>


