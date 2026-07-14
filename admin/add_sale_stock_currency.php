<?php 
include("init.php");
//unset($_SESSION['cart_trnasfer_mini_stock']);
?>
<style>
td{ padding:10px;
font-weight:!important;
height:40px;
 }
</style>




<!DOCTYPE html>
<html lang="en">

<title>SPD</title>
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
#barcode{ width:190px; height:35px; text-align:center;}

.ss{ width:180px;}


.s{width:370px;}

.sinput{width:200px; text-align:right;}
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
<script>



 function insert(num){
	var x =document.me.payment.value+num;
	
	 document.me.payment.value=numeral(x).format('0,000');
	 
	 var tt = Number(document.me.total.value.replace(/[^0-9\.-]+/g,""));
	 var toui = Number(document.me.payment.value.replace(/[^0-9\.-]+/g,""));
	
	
	document.me.over_pay.value=numeral(tt-toui).format('0,000');
	document.me.change.value=numeral(toui-tt).format('0,000');
	
	var change = Number(document.me.change.value.replace(/[^0-9\.-]+/g,""));
	if(change<0){
		document.me.change.value="";
		}
	
	 }
function insert_plus(plus){
	
	
	 document.me.payment.value=numeral((Number(document.me.payment.value.replace(/[^0-9\.-]+/g,""))*1)+(plus*1)).format('0,000');
	 var tt = Number(document.me.total.value.replace(/[^0-9\.-]+/g,""));
	 var toui = Number(document.me.payment.value.replace(/[^0-9\.-]+/g,""));
	
	
	document.me.over_pay.value=numeral(tt-toui).format('0,000');
	document.me.change.value=numeral(toui-tt).format('0,000');
	
	var change = Number(document.me.change.value.replace(/[^0-9\.-]+/g,""));
	if(change<0){
		document.me.change.value="";
		}
	
	 }
	 
 function full_amount(){
	 document.me.payment.value=document.me.total.value;
	 
	 var tt = Number(document.me.total.value.replace(/[^0-9\.-]+/g,""));
	 var toui = Number(document.me.payment.value.replace(/[^0-9\.-]+/g,""));
	
	
	document.me.over_pay.value=numeral(tt-toui).format('0,000');
	document.me.change.value=numeral(toui-tt).format('0,000');
	
	
	 
	 }
 function clean(){
	 document.me.payment.value="";
	 document.me.change.value="";
	  document.me.over_pay.value="";
     }
 function back(){
	 var exp = document.me.payment.value;
	 document.me.payment.value=exp.substring(0,exp.length-1);
	 
	  var tt = Number(document.me.total.value.replace(/[^0-9\.-]+/g,""));
	 var toui = Number(document.me.payment.value.replace(/[^0-9\.-]+/g,""));
	
	
	document.me.over_pay.value=numeral(tt-toui).format('0,000');
	document.me.change.value=numeral(toui-tt).format('0,000');
	
	var change = Number(document.me.change.value.replace(/[^0-9\.-]+/g,""));
	if(change<0){
		document.me.change.value="";
		}
	 
	 }
	function focus_barcode() {
    document.getElementById("barcode").focus();
}
function focus_payment() {
    document.getElementById("payment").focus();
}
function key_press() {
	//alert('aaa');
	 var tt = Number(document.me.total.value.replace(/[^0-9\.-]+/g,""));
	 var toui = Number(document.me.payment.value.replace(/[^0-9\.-]+/g,""));
	
	
	document.me.over_pay.value=numeral(tt-toui).format('0,000');
	document.me.change.value=numeral(toui-tt).format('0,000');
	
	var change = Number(document.me.change.value.replace(/[^0-9\.-]+/g,""));
	if(change<0){
		document.me.change.value="";
		}
	
	}
</script>
<div class="container">
    <br>
    <h3 align="center">ຂາຍສິນຄ້າຈາກສາງລົດ</h3><br>
  </div> 

 
<div class="container">



<!---
<form action="cart_barcode_sale_stock.php" method="post" enctype="multipart/form-data" name="bar">
-->
<table  >
 <tr>

    <td>Barcode:</td><td colspan="5"><input type="text" name="barcode" id="barcode" style="text-align:left;" placeholder=" 12345678..."  onkeyup="this.value=this.value.replace(/[^\d]/,'')" >
    
    </td>
 </tr>
</table>

<!--</form>-->
</div>
    <!-- /.container -->
 <div class="container">   
    	<form action="insert_sale_stock.php" method="post" onsubmit="return ch_qty()" enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
    <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
      <a href="add_sale_stock.php"><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
      
      <button type="submit" name="save"  class="btn btn-primary" ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      
      <a href="cart_sale_stock.php?action=empty" ><button type="button" name="reset" value="reset" class="btn btn-warning"><i class="fa fa-trash-o"></i>&nbsp;ລືບ</button></a>
     
  
    </div>
   
  </div>
  

  
<table border="0">

  <tr>
    <td align="right">ເລກທີ:</td>
    <td><input type="text" class="form-control ss" name="refer_no" id="refer_no" ></td>
   <td align="right">ວັນທີ:</td>
    <td ><input type="date" class="form-control" name="sale_date" id="sale_date" value="<?php echo @date('Y-m-d');  ?>" required> </td>
  
  <td>ສະກຸນເງີນ</td><td>
  <select name="cur" id="cur" class="form-control" onchange="get_currency()">
     <option value="LAK">LAK</option>
     <option value="THB">THB</option>
     <option value="USD">USD</option>
  </select>
  <input type="hidden" name="currency" id="currency" value="1">
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
     <td>ລາຄາ</td>  
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
    <td align="right" colspan="1">ສາງ</td>
    <td colspan="1">  
    <select name="stock_id" id="stock_id" class="form-control" required>    	
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


<table>
<td valign="top">


<table  border="0" >
  <tr>
    <td  align="right">ສ່ວນຫຼູດ:</td>
    <td  align="right">
     <div class="input-group input-group-sm sinput_per">
    <input type="text" name="all_per" id="all_per"   class="form-control sinput_per" onkeyup="gand_total_per()"  >
   <span class="input-group-addon">%</span>   
    </div>
    </td>
     <td  align="right">
    <input type="text" name="all_dis" id="all_dis" onkeyup="gand_total()"   class="form-control sinput2"  >
   
    </td>
  </tr>
    <tr>
    <td  align="right">ລວມມູນຄ່າຕ້ອງຊຳລະ:</td>
    <td  colspan="2" align="right">
    <div class="input-group input-group-sm ">
    <input type="text" name="total" id="total"   class="form-control sinput"  readonly>
   <span class="input-group-addon" id="t_cur">LAK</span>   
    </div>
    </td>
  
   
  <tr>
    <td align="right">ລວມມູນຄ່າຊຳລະ:</td>
    <td  colspan="2" align="right">
    <input type="text" name="payment" id="payment" onkeyup="key_press()"  required class="form-control sinput">
      </td>
  </tr>
  <tr>
    <td   align="right">ຍອດເຫຼືອ:</td>
    <td colspan="2" align="right"><input type="text" name="over_pay" id="over_pay" class="form-control sinput"  readonly></td>
  </tr>
  <tr>
    <td align="right">ມູນຄ່າຕ້ອງທອນ:</td>
    <td  colspan="2" align="right"><input type="text" name="change" id="change" class="form-control sinput" readonly></td>
  </tr>
</table>
</td>
<td valign="top">
<table >

<input class="textview" type="hidden"  name="toui"/>
 

   <tr>
    <td><input class="but" type="button" value="7" onclick="insert(7)"/></td>
    <td><input class="but" type="button" value="8" onclick="insert(8)"/></td>
    <td><input class="but" type="button" value="9" onclick="insert(9)"/></td>
    <td><input class="but w" type="button" value="Barcode" onclick="focus_barcode()"/></td>    
  </tr>
    <tr>
    <td><input class="but" type="button" value="4" onclick="insert(4)"/></td>
    <td><input class="but" type="button" value="5" onclick="insert(5)"/></td>
    <td><input class="but" type="button" value="6" onclick="insert(6)"/></td>
    <td  rowspan="2"><input class="but sz w" type="button" value="Check" onclick="focus_payment()"/></td>    
  </tr>
    <tr>
    <td><input class="but" type="button" value="1" onclick="insert(1)" /></td>
    <td><input class="but" type="button" value="2" onclick="insert(2)" /></td>
    <td><input class="but" type="button" value="3" onclick="insert(3)"/></td>
       
  </tr>

    <tr>
    <td><input class="but" type="button" value="0" onclick="insert(0)" /></td>
   
    <td colspan="2"><input class="but w" type="button" value="<" onclick="back()" /></td>
    <td><input class="but w" type="button" value="Clean" onclick="clean()" /></td> 
  </tr>
  
    <tr>
    <td colspan="4"><input type="button" class="btn btn-info sw" onclick="full_amount()" value="ຈ່າຍເຕັມ" ></td>
  </tr>
  <tr>
  	<td colspan="4"></td>
   </tr>
 
</table>
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
              <input type="button" name="show" id="" value="ທັງຫມົດ" class="btn show_add" ></td> 
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
		 		echo "<tr>";
		 	//	echo "<td>".$p['group_id']."</td>";?>
               
              	<td colspan="2">
              <button type="button" name="show" id="<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_ID'];?>" class="btn show_add" > 
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
		   where 1=1 
		    ");
		   while($f=mysqli_fetch_array($sp)){
		?>
        <tr>         
         <td><?php echo "$f[customer_id]";?></td>
         <td><?php echo "$f[customer_name]";?></td>
         <td><?php echo "$f[phone]";?></td>
         <td><?php echo "$f[ct_name]";?></td>
         <td><a href="add_sale_stock.php?c_id=<?=$f['customer_id'];?>&c_name=<?=$f['customer_name'];?>&c_t=<?=$f['customer_type'];?>"><button type="button" name="cc" class="btn btn-sm btn-success" >ເລືອກ</button></a></td>
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
 $(function(){
  $('#search_product').click(function(){
   
 
   var phone = $('#phone').val();
   var product_id = $('#product_id').val();
  var product_name = $('#product_name').val();
 
         $.ajax({
				url:"s_customer.php",
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
total_all();
function total_all(){
	
			var total_all = $('#total_all').val();

		$("#total").val(numeral(total_all).format('0,0.00'));
	
	}
 
 load_order_receipt();
 load_product();
 
 $("#barcode").focus();

 
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
 function load_order_receipt()
	{
			$.ajax({
			url:"fetch_cart_sale_stock_currency.php",
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
				url:"cart_sale_stock.php",
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
				url:"cart_sale_stock.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action },
				success:function(data)
				{
				
					load_order_receipt();
				
				}
			});
		
	});
	
	
		$(document).on('click', '.edit_cart_qty', function(){
	 
		var ID = $(this).attr("id");
	
		var product_name = $('#e_name'+ID+'').val();
		var Product_ID = $('#Product_ID'+ID+'').val();		
		var product_lot_id = $('#product_lot_id'+ID+'').val();	
		var price = $('#e_price'+ID+'').val();		
			
		var qty = $('#e_qty'+ID+'').val();
		
		var action = "remove";
		
		$(".modal-body #up_name").val( product_name );
		$(".modal-body #up_qty").val(qty);
		
        $(".modal-body #up_Product_ID").val( Product_ID );
		 $(".modal-body #up_product_lot_id").val( product_lot_id );
		$(".modal-body #up_price").val(numeral(price).format('0,0.00'));
		
			});
			

			
		
//////////////////////////////////////	
$(document).on('click', '#update_qty', function(){
	       // var product_lot_id = $(this).attr("value");
		   
		    var product_lot_id = $('#up_product_lot_id').val();
		    var Product_ID = $('#up_Product_ID').val();
		    var qty = $('#up_qty').val();
			var price = Number($('#up_price').val().replace(/[^0-9\.-]+/g,""));
		    var action = "update";
			      
			
		$.ajax({
				url:"cart_sale_stock.php",
				method:"POST",
				data:{  product_lot_id:product_lot_id,Product_ID:Product_ID,action:action,product_quantity:qty,product_price:price },
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
	
	////////////////////////////////////////////////////

    var x = Number(document.me.total.value.replace(/[^0-9\.-]+/g,""));
    var y = Number(document.me.payment.value.replace(/[^0-9\.-]+/g,""));
	var change = Number(document.me.change.value.replace(/[^0-9\.-]+/g,""));
	
	var pid = Number(document.me.total.value.replace(/[^0-9\.-]+/g,""));
	 
	/* if (y<x) {
        alert("ກະລູູນາຈ່າຍໃຫ້ຄົບ");
        return false;
    }
	else if (change<0) {
        alert("ກະລູູນາຈ່າຍໃຫ້ຄົບ");
        return false;
    }
	else if(pid<=0){ 
	alert("ກະລູູນາເລືອກສີນຄ້າກ່ອນ");
        return false;  }
		*/
	////////////////////////////////////////////
	
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
	//var total_all = document.getElementsById("total_all");
	var sum =0;
	var sum_dis=0;
	for (i = 0; i < qty.length; i++) {
	
     	q=Number(qty[i].value.replace(/[^0-9\.-]+/g,""));
		p=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		qq=Number(q_l[i].value.replace(/[^0-9\.-]+/g,""));
		dis=Number(discount[i].value.replace(/[^0-9\.-]+/g,""));
	
	    amount[i].value=numeral(q*p).format('0,000');
		
		sum = sum + (q*p);
		sum_dis = sum_dis + (q*p)-dis; 
		 if (q > qq) {
       
		alert('ຈຳນວນສີນຄ້າໃນສາງຂອງທ່ານຍັງມີ:'+qq+'');
		qty[i].value=qq;
		
		q=Number(qty[i].value.replace(/[^0-9\.-]+/g,""));
		p=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		d=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		 amount[i].value=numeral(q*p).format('0,000');
	
	 //   $('#total_all').val(numeral(q*p).format('0,0'));
    //   return false;
        }
		
      $('#total_all').val(numeral(sum).format('0,000'));
	  $('#total_all_amount').val(numeral(sum).format('0,000'));
	  $('#total').val(numeral(sum_dis).format('0,000'));
		
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
	  
	  
	  total_dis=Number(discount[i].value.replace(/[^0-9\.-]+/g,""));
	  sum_all_dis = sum_all_dis + total_dis;
	  $('#all_dis').val(numeral(sum_all_dis).format('0,000.00'));
	  
	  
	  
	    //////////////////////
	var t   = $('#total_all').val();
	var dis = $('#all_dis').val();
		
	var total   =Number(t.replace(/[^0-9\.-]+/g,""));	
	var all_dis =Number(dis.replace(/[^0-9\.-]+/g,""));

	tt =(all_dis/total)*100;
	$('#all_per').val(numeral(tt).format('0,000.00'));
	
	 //////////////////////
	  
	  
	   sum_dis = sum_dis + total_amt;	
		$('#total').val(numeral(sum_dis).format('0,000.00'));
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
	  
	  
	  total_dis=Number(discount[i].value.replace(/[^0-9\.-]+/g,""));
	  sum_all_dis = sum_all_dis + total_dis;
	  $('#all_dis').val(numeral(sum_all_dis).format('0,000.00'));
	  
	  
	  //////////////////////
	var t   = $('#total_all').val();
	var dis = $('#all_dis').val();
		
	var total   =Number(t.replace(/[^0-9\.-]+/g,""));	
	var all_dis =Number(dis.replace(/[^0-9\.-]+/g,""));

	tt =(all_dis/total)*100;
	$('#all_per').val(numeral(tt).format('0,000.00'));
	
	 //////////////////////
	  
	  
	   sum_dis = sum_dis + total_amt;	
		$('#total').val(numeral(sum_dis).format('0,000.00'));
	 }
	 
	
	  
}
function gand_total(){
	
	var t   = $('#total_all').val();
	var per = $('#all_per').val();
	var dis = $('#all_dis').val();
	
	
	var total   =Number(t.replace(/[^0-9\.-]+/g,""));
	var all_per =Number(per.replace(/[^0-9\.-]+/g,""));
	var all_dis =Number(dis.replace(/[^0-9\.-]+/g,""));
//	alert(total2);


	tt =(all_dis/total)*100;
	$('#all_per').val(numeral(tt).format('0,000.00'));
	
	
	
	xxx = total-all_dis;	
	$('#total').val(numeral(xxx).format('0,000.00'));
	
	
	
	var discount = document.getElementsByName("discount[]");	
	var percent_dis = document.getElementsByName("percent_dis[]");
	for (i = 0; i < discount.length; i++) {
	   percent_dis[i].value=0;
		discount[i].value=0;
	}
	
	
}
function gand_total_per(){
	
	var t   = $('#total_all').val();
	var per = $('#all_per').val();
	var dis = $('#all_dis').val();
	
	
	var total   =Number(t.replace(/[^0-9\.-]+/g,""));
	var all_per =Number(per.replace(/[^0-9\.-]+/g,""));
	var all_dis =Number(dis.replace(/[^0-9\.-]+/g,""));
//	alert(total2);


	tt =(total*all_per)/100;	
	$('#all_dis').val(numeral(tt).format('0,000.00'));
	
	
	
	xxx = total-all_dis;	
	$('#total').val(numeral(xxx).format('0,000.00'));
	
	
	var discount = document.getElementsByName("discount[]");	
	var percent_dis = document.getElementsByName("percent_dis[]");
	for (i = 0; i < discount.length; i++) {
	    percent_dis[i].value=0;
		discount[i].value=0;
	}
	
}

function get_currency(){
	
	var cur  = $('#cur').val();	
	$.ajax({
				url:"get_currency.php",
				method:"POST",
				data:{  cur:cur },
				success:function(data)
				{
					
				$('#currency').val(data);
	
	
			           $.ajax({
			           url:"fetch_cart_sale_stock_currency.php",
			           method:"POST",
			//dataType:"json",
			           success:function(data)
			           {
				       $('#display_cart_receipt').html(data);
					   
				              var total_all = $('#total_all').val();
		                      $("#total").val(numeral(total_all).format('0,0.00'));
							  
							   var cur = $('#cur').val();
				              $("#t_cur").html(cur)
			           }
		                   });
	
	

				}
			});	
}
    </script>


</body>

</html>


