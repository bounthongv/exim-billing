<?php 
include("init.php");
//unset($_SESSION['cart_trnasfer_mini_stock']);
?>





<!DOCTYPE html>


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

.ss{ width:150px;}

.cur{ width:50px;}
.price{ width:90px;}
.s{width:250px;}

.sinput{width:150px; text-align:right;}
.sinput1{width:150px; text-align:right; height:35; }
.sinput2{width:150px; text-align:right; height:35; }
.sinput_per{width:80px; text-align:right; height:35; }

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
<?php
$sql_max=mysqli_query($con,"select max(pay_id) as id from payment_supplier ");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='0000'.'1';  
 
 $id2=$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $pay_id=$id1;     }

 else if($max_id<9){  $pay_id='0000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $pay_id='000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $pay_id='00'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $pay_id='0'.$id2;} 
  else if($max_id<99999){  $pay_id=$id2;}
  
  else if($max_id >=99999){   $pay_id=$id2; }
  
   $pay_id;
   
   
   
   foreach ($_GET as $key => $value) {
  $_GET[$key]=addslashes(strip_tags(trim($value)));
}

/*if ($_GET['sale_id'] !='') {
	   $sale_id=(string) $_GET['sale_id']; 
	    }*/
extract($_GET);	   
 
   
 $receipt_id=$_GET['receipt_id'];
   
   
   
   
   $sql_info=mysqli_query($con," select sum(product_receipt.amount) as total_amount, product_receipt.* ,suppliers.supplier_name,suppliers.supplier_id
   from product_receipt 
   left join suppliers on suppliers.supplier_id=product_receipt.supplier_id
   where receipt_id='$receipt_id' group by product_receipt.receipt_id ");
   $r=mysqli_fetch_array($sql_info);
   

?>

<div class="container">
    <br>
    <h3 align="center">ຊຳລະໜີ້ຜູ້ສະໜອງ</h3><br>
  </div> 

 
<div class="container">



<!---
<form action="cart_barcode_sale_stock.php" method="post" enctype="multipart/form-data" name="bar">
-->


<!--</form>-->
</div>
    <!-- /.container -->
 <div class="container">   
    	<form action="insert_payment_supplier.php" method="post" onsubmit="return ch_qty()" enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
    <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>

      
      <button type="submit" name="save"  class="btn btn-primary" ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      

     
  
    </div>
   
  </div>
  

  
<table border="0">

  <tr>
    <td align="center">ເລກທີ: <br>
    <input type="text" class="form-control ss" name="pay_id" id="pay_id" value="<?php echo $pay_id; ?>" ></td>
   <td align="center">ວັນທີ: <br><input type="date" class="form-control" name="pay_date" id="pay_date" value="<?php echo @date('Y-m-d');  ?>" onchange="get_currency2()" required> </td>
  
   <td >&nbsp;</td>  <td >&nbsp;</td>
  
  </tr>
  <tr>
  <td align="center">ເລກບິນ: <br>
    <input type="text" class="form-control ss" name="receipt_id" id="receipt_id" value="<?php echo $receipt_id; ?>" readonly ></td>
   <td align="center">ວັນທີ: <br><input type="date" class="form-control" name="receipt_date" id="receipt_date" value="<?php echo $r['receipt_date'];  ?>" onchange="get_currency2()" required readonly> </td>
  
  
  
 

  </tr>

  
  <tr>
  <td colspan="1" align="center">ມູນຄ່າທັງໝົດ
    <input type="text" name="totals" id="totals" value="<?php  echo @number_format($r['total_amount'],2); ?>"  style="text-align:right" readonly class="form-control"></td>
 
  <td colspan="1" align="center">ສ່ວນຫຼຸດ
    <input type="text" name="dd" id="dd" value="<?php  echo @number_format($r['bill_discount'],2); ?>"  style="text-align:right" readonly class="form-control"></td>
    
  <td colspan="2" align="center">ຜູ້ສະໜອງ:
    
    <input type="text" class="form-control ss" name="customer_name" id="customer_name" value="<?php echo $r['supplier_id'].'&nbsp;'.$r['supplier_name']; ?>" readonly >      
  
  
    <input type="hidden" class="form-control" name="customer_id"   id="customer_id" value="<?php  echo $r['supplier_id']; ?>"  >
   <!-- <input type="hidden" class="form-control" name="customer_type"   id="customer_type"  >-->
   
   
    </td>
  </tr>
  <tr>
  <td colspan="1" align="center">ຊຳລະແລ້ວ
  <input type="text" name="payment" id="payment" value="<?php  echo @number_format($r['payment'],2); ?>" style="text-align:right" class="form-control" readonly></td>
  
  
  <td colspan="1" align="center">ຍັງເຫລືອ
  <input type="text" name="total_all" id="total_all" value="<?php  echo @number_format($r['total_amount']-$r['payment'],2); ?>"  style="text-align:right" class="form-control" readonly></td>  
 

   <td align="center">ກິບ: <br>

  <input type="text"  class="form-control cur" name="kip_baht" id="kip_baht"  readonly >
  </td>
  <td align="center">ໂດລາ: <br>

  <input type="text"  class="form-control cur" name="dollar_baht" id="dollar_baht" readonly >
  </td>
   
  </tr>
  
  
</table>

 
<br><br>




</td>
</table>


<table >

  <tr>
    
    <td    align="right">
     <div class="input-group input-group-sm sinput1">
    <input type="text" name="all_per" id="all_per" value="0"   class="form-control " style="text-align:right;" onkeyup="gand_total_per()"  >
   <span class="input-group-addon">%</span>   
    </div>
    </td>
     <td colspan="2" align="right">
    <input type="text" name="all_dis" id="all_dis"  value="0" onkeyup="gand_total()"  style="text-align:right;"  class="form-control"  >
   
    </td>
    <td  align="left">ສ່ວນຫຼູດ</td>
     
  </tr>
    <tr>
    
    <td colspan="3">
      <div class="input-group input-group-sm ">
    <input type="text" name="total" id="total"  style="text-align:right;"   class="form-control s" readonly  >
   <span class="input-group-addon" id="t_cur">THB</span>   
    </div>
    </td>
    
     <td  align="left">ລວມ</td>
  </tr>
    <tr>
   
    <td   align="right">
    <div class="input-group input-group-sm sinput1">
    <input type="text" name="total_thb" id="total_thb"   class="form-control sinput2"  readonly>
   <span class="input-group-addon" id="t_cur">THB</span>   
    </div>
    </td>
    
      <td   align="right">
    <div class="input-group input-group-sm sinput1">
    <input type="text" name="total_lak" id="total_lak"   class="form-control sinput2"  readonly>
   <span class="input-group-addon" id="t_cur">LAK</span>   
    </div>
    </td>
    
    
      <td   align="right">
    <div class="input-group input-group-sm sinput1">
    <input type="text" name="total_usd" id="total_usd"   class="form-control sinput2"  readonly>
   <span class="input-group-addon" id="t_cur">USD</span>   
    </div>
    </td>
    
    
     <td  align="left">ຕ້ອງຊຳລະ</td>
  </tr>
  
   
  <tr>
    
    <td   align="right">
    <input type="text" name="payment_thb" id="payment_thb" onkeyup="key_press()"  required value="0" class="form-control sinput">
      </td>
      <td   align="right">
    <input type="text" name="payment_lak" id="payment_lak" onkeyup="key_press()"  required value="0" class="form-control sinput">
      </td>
       <td   align="right">
    <input type="text" name="payment_usd" id="payment_usd" onkeyup="key_press()"  required value="0" class="form-control sinput">
      </td>
      
      <td align="left">ຊຳລະ</td>
  </tr>
  <tr>
   
    <td  align="right"><input type="text" name="over_pay_thb" id="over_pay_thb" class="form-control sinput"  readonly></td>
     <td  align="right"><input type="text" name="over_pay_lak" id="over_pay_lak" class="form-control sinput"  readonly></td>
      <td  align="right"><input type="text" name="over_pay_usd" id="over_pay_usd" class="form-control sinput"  readonly></td>
      
       <td   align="left">ຍອດເຫຼືອ</td>
  </tr>
  <tr>
   
    <td   align="right"><input type="text" name="change_thb" id="change_thb" class="form-control sinput" readonly></td>
     <td   align="right"><input type="text" name="change_lak" id="change_lak" class="form-control sinput" readonly></td>
     <td   align="right"><input type="text" name="change_usd" id="change_usd" class="form-control sinput" readonly></td>
     
      <td align="left">ທອນ</td>
  </tr>
</table>



</form>



  </div>
    <br>
    <br>



    <!-- jQuery -->
    
   
 
  
  
  

 <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
  <script>
  function get_currency2()
{
		var cur_date = $('#pay_date').val();
		
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
					
					var t = $('#total').val();									  
					var c_k = $('#kip_baht').val();
					var c_u = $('#dollar_baht').val();
		
					var tt   =Number(t.replace(/[^0-9\.-]+/g,""));
					var cck =Number(c_k.replace(/[^0-9\.-]+/g,""));
	   				var ccu =Number(c_u.replace(/[^0-9\.-]+/g,""));
					
					 $('#total_thb').val(numeral(tt).format('0,000.00'));
	 				 $('#total_lak').val(numeral(tt*cck).format('0,000.00'));
	 				 $('#total_usd').val(numeral(tt/ccu).format('0,000.00'));
					 
					 key_press();
                              
                }else{
                   
                } 
            
				
			}
		});

	} 


	
	</script> 
 <script> 


$(document).ready(function(){
	
 get_currency();	
function get_currency()
	{ 

		var cur_date = $('#pay_date').val();
		
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
					
					    
                       total_all();
					          
                }else{
                   
                } 
            
				
			}
		});
		
	} 
// total_all();
 function total_all(){

	  var total_all = $('#total_all').val();

		$("#total").val(numeral(total_all).format('0,000.00'));
		
		
		var t = $('#total').val();	
											  
		var c_k = $('#kip_baht').val(); 		
		var c_u = $('#dollar_baht').val();
		//alert(c_u);
		var tt   =Number(t.replace(/[^0-9\.-]+/g,""));
		var cck =Number(c_k.replace(/[^0-9\.-]+/g,""));
	    var ccu =Number(c_u.replace(/[^0-9\.-]+/g,""));
		
			    
	  $('#total_thb').val(numeral(tt).format('0,000.00'));
	  $('#total_lak').val(numeral(tt*cck).format('0,000.00'));
	  $('#total_usd').val(numeral(tt/ccu).format('0,000.00'));
	  
	 
    key_press();
	  
	//gand_total();
	}
	// key_press();
	// gand_total();
	
});
</script>
<script>
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
	
	var t = $('#total').val();
									  
		var c_k = $('#kip_baht').val();
		var c_u = $('#dollar_baht').val();
		
		var tt   =Number(t.replace(/[^0-9\.-]+/g,""));
		var cck =Number(c_k.replace(/[^0-9\.-]+/g,""));
	    var ccu =Number(c_u.replace(/[^0-9\.-]+/g,""));
		
			    
	  $('#total_thb').val(numeral(tt).format('0,000.00'));
	  $('#total_lak').val(numeral(tt*cck).format('0,000.00'));
	  $('#total_usd').val(numeral(tt/ccu).format('0,000.00'));
	
	  key_press();
	  
	
	
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
	
	var dis2 = $('#all_dis').val();
	var all_dis =Number(dis2.replace(/[^0-9\.-]+/g,""));

	
	
	
	xxx = total-all_dis;	
	$('#total').val(numeral(xxx).format('0,000.00'));
	
	    var t = $('#total').val();									  
		var c_k = $('#kip_baht').val();
		var c_u = $('#dollar_baht').val();
		
		var tt   =Number(t.replace(/[^0-9\.-]+/g,""));
		var cck =Number(c_k.replace(/[^0-9\.-]+/g,""));
	    var ccu =Number(c_u.replace(/[^0-9\.-]+/g,""));
		
			    
	  $('#total_thb').val(numeral(tt).format('0,000.00'));
	  $('#total_lak').val(numeral(tt*cck).format('0,000.00'));
	  $('#total_usd').val(numeral(tt/ccu).format('0,000.00'));
	
	
	key_press();
	
	
}

function key_press() {
	
	    var cur_lak = $('#kip_baht').val();
		var cur_usd = $('#dollar_baht').val();
		
		var c_thb =1;
		var c_lak =Number(cur_lak.replace(/[^0-9\.-]+/g,""));
		var c_usd =Number(cur_usd.replace(/[^0-9\.-]+/g,""));
		
		
			
	    var t_thb = $('#total_thb').val();	
		var t_lak = $('#total_lak').val();
		var t_usd = $('#total_usd').val();
								  
		var p_thb = $('#payment_thb').val();
		var p_lak = $('#payment_lak').val();
		var p_usd = $('#payment_usd').val();
	
		var tt_thb =Number(t_thb.replace(/[^0-9\.-]+/g,""));		
		var tt_lak =Number(t_lak.replace(/[^0-9\.-]+/g,""));
		var tt_usd =Number(t_usd.replace(/[^0-9\.-]+/g,""));
	
	    var pp_thb =Number(p_thb.replace(/[^0-9\.-]+/g,""));
		var pp_lak =Number(p_lak.replace(/[^0-9\.-]+/g,""));
		var pp_usd =Number(p_usd.replace(/[^0-9\.-]+/g,""));
		
		var total_thb = pp_thb;
		var total_lak = pp_lak/c_lak;
		var total_usd = pp_usd*c_usd;
		
		var total_thb_lak_usd = total_thb + total_lak + total_usd; // gen to thai baht
		
		var total_pay_thb = tt_thb-total_thb_lak_usd;
		var total_pay_lak = tt_lak-(total_thb_lak_usd * c_lak);
		var total_pay_usd = tt_usd-(total_thb_lak_usd/ c_usd);
			    
	  $('#over_pay_thb').val(numeral(total_pay_thb).format('0,000.00'));
	  $('#over_pay_lak').val(numeral(total_pay_lak).format('0,000.00'));
	  $('#over_pay_usd').val(numeral(total_pay_usd).format('0,000.00'));
	  
	  $('#change_thb').val(numeral(total_thb_lak_usd-tt_thb).format('0,000.00'));
	  $('#change_lak').val(numeral((total_thb_lak_usd * c_lak)-tt_lak).format('0,000.00'));
	  $('#change_usd').val(numeral((total_thb_lak_usd/ c_usd)-tt_usd).format('0,000.00'));
	  

	  var c_thb = $('#change_thb').val();
	  var c_lak = $('#change_lak').val();
	  var c_usd = $('#change_usd').val();
	  var ch_thb = Number(c_thb.replace(/[^0-9\.-]+/g,""));
	  var ch_lak = Number(c_lak.replace(/[^0-9\.-]+/g,""));
	  var ch_usd = Number(c_usd.replace(/[^0-9\.-]+/g,""));
	  
	  
	if(ch_thb<0){
	
		$('#change_thb').val('');
		}
	if(ch_lak<0){
	
	    $('#change_lak').val('');
		}
	if(ch_usd<0){
	
		$('#change_usd').val('');
		}
	
	}

    </script>

</body>

</html>


