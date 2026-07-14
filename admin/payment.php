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
<!--	<link href="//fonts.googleapis.com/css?family=Poppins:100i,000,200i,300,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">-->
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
$sql_max=mysqli_query($con,"select max(SUBSTRING(pay_id, 1, 5)) as id from payment ");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='0000'.'1';  
 
 $id2=$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $receipt_id=$id1;     }

 else if($max_id<9){  $receipt_id='0000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $receipt_id='000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $receipt_id='00'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $receipt_id='0'.$id2;} 
  else if($max_id<99999){  $receipt_id=$id2;}
  
  else if($max_id >=99999){   $receipt_id=$id2; }
  
   $receipt_id;
   
   
   
   foreach ($_GET as $key => $value) {
  $_GET[$key]=addslashes(strip_tags(trim($value)));
}

/*if ($_GET['sale_id'] !='') {
	   $sale_id=(string) $_GET['sale_id']; 
	    }*/
extract($_GET);	   
 
   
 $sale_id=$_GET['sale_id'];
   
   
   
   
   $sql_info=mysqli_query($con,"select sum(product_sale.amount) as total_amount,
    product_sale.* 
   ,customers.customer_name,customers.customer_id,customers.phone,customers.address
   from product_sale 
   left join customers on customers.customer_id=product_sale.customer_id
   where sale_id='$sale_id' group by sale_id");
   $r=mysqli_fetch_array($sql_info);
   

?>





<div class="container">
    <br>
    <h3 align="center">ຊຳລະໜີ້ລູກຄ້າ</h3><br>
  </div> 

 
<div class="container">



<!---
<form action="cart_barcode_sale_stock.php" method="post" enctype="multipart/form-data" name="bar">
-->


<!--</form>-->
</div>
    <!-- /.container -->
 <div class="container">   
    	<form action="insert_payment.php" method="post" onsubmit="return ch_qty()" enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
    <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>

      
      <button type="submit" name="save"  class="btn btn-primary" ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      

     
  
    </div>
   
  </div>
  

  
<table border="0">

  <tr>
    <td align="center">ເລກທີຊຳລະ: <?php echo $receipt_id; ?><br>
    <input type="hidden" class="form-control ss" name="pay_id" id="pay_id" value="<?php echo $receipt_id; ?>" ></td>
   <td align="center">ວັນທີ: <br><input type="date" class="form-control" name="pay_date" id="pay_date" value="<?php echo @date('Y-m-d');  ?>" onchange="get_currency2()" required> </td>
  
   <td >&nbsp;</td>  <td >&nbsp;</td>
  
  </tr>
  <tr>
  <td align="center">ເລກບິນ: <?php echo $sale_id; ?><br>
    <input type="hidden" class="form-control ss" name="sale_id" id="sale_id" value="<?php echo $sale_id; ?>" readonly ></td>
   <td align="center">ວັນທີ: <?php echo $r['sale_date'];  ?><br><input type="hidden" class="form-control" name="sale_date" id="sale_date" value="<?php echo $r['sale_date'];  ?>" onchange="get_currency2()" required readonly> </td>
  
  
  
 

  </tr>
  <tr>
  <td colspan="1" align="right">ລູກຄ້າ: </td><td colspan="3"> <?php echo $r['customer_id'].'&nbsp;'.$r['customer_name']; ?>
    ເບີໂທ: <?php echo $r['phone'].'&nbsp;'.$r['address']; ?>
    <input type="hidden" class="form-control ss" name="customer_name" id="customer_name" value="<?php echo $r['customer_id'].'&nbsp;'.$r['customer_name']; ?>" readonly >      
  
  
    <input type="hidden" class="form-control" name="customer_id"   id="customer_id" value="<?php  echo $r['customer_id']; ?>"  >
   <!-- <input type="hidden" class="form-control" name="customer_type"   id="customer_type"  >-->
   
   
    </td>
  </tr>
  
  <tr>
  <td colspan="1" align="right">ມູນຄ່າທັງໝົດ</td>
    <td><input type="text" name="total" id="total" value="<?php  echo @number_format($r['total'],0); ?>"  style="text-align:right" readonly class="form-control"></td>
 
  <!--<td colspan="1" align="center">ສ່ວນຫຼຸດ</td>-->
    <input type="hidden" name="dd" id="dd" value="<?php  echo @number_format($r['bill_discount'],0); ?>"  style="text-align:right" readonly class="form-control">
    
  
  </tr>
  <tr>
  <td colspan="1" align="right">ຊຳລະແລ້ວ</td><td>
  <input type="text" name="payment" id="payment" value="<?php  echo @number_format($r['payment'],0); ?>" style="text-align:right" class="form-control" readonly></td>
  
  </tr>
  <tr>
  <td colspan="1" align="right">ຍັງເຫລືອ </td><td>
  <input type="text" name="remain" id="remain" value="<?php  echo @number_format($r['remain'],0); ?>"  style="text-align:right" class="form-control" readonly></td>  
 

   
  </tr>
  <tr>
  <td align="right">ມູນຄ່າຮັບ</td>
  <td colspan="4"><input type="text" name="receipt" id="receipt" class="form-control number" onKeyUp="receipt_money()" style="text-align:right; height:50px; font-size:36px;color:#00F;font-family:'Times New Roman', Times, serif;"></td>
  </tr>
  <tr>
  <td align="right">ຍັງເຫຼືອ</td>
  <td colspan="4"><input type="text" name="receipt_remain" id="receipt_remain" class="form-control number" style="text-align:right; height:40px; font-size:18px;  font-family:'Times New Roman', Times, serif;" readonly></td>
  </tr>
  <tr>
  <td align="right">ເງີນທອນ</td>
  <td colspan="4"><input type="text" name="cash_back" id="cash_back" class="form-control number" style="text-align:right; height:40px; font-size:18px;font-family:'Times New Roman', Times, serif;" readonly></td>
  </tr>
  
  
</table>

 
<br><br>




</td>
</table>






</form>



  </div>
    <br>
    <br>



    <!-- jQuery -->
    
   
 
  
  
  

 <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
  <script>
  function receipt_money(){

	  var remain = $('#remain').val();
	  var receipt = $('#receipt').val();


		//$("#total").val(numeral(total_all).format('0,000'));
	
		
		var re =Number(remain.replace(/[^0-9\.-]+/g,""));
		var rp =Number(receipt.replace(/[^0-9\.-]+/g,""));
	   // var ccu =Number(c_u.replace(/[^0-9\.-]+/g,""));
   // alert(re);
	//alert(rp);
	  if(rp<re){
		  $('#receipt_remain').val(numeral(re-rp).format('0,000'));
		  } else{$('#receipt_remain').val('');}   
	  
	  if(rp>re){
	      $('#cash_back').val(numeral(rp-re).format('0,000'));
	  }else{$('#cash_back').val();}   
	 // $('#total_usd').val(numeral(tt/ccu).format('0,000'));
  }
/*  function get_currency2()
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
					
					 $('#total_thb').val(numeral(tt).format('0,000'));
	 				 $('#total_lak').val(numeral(tt*cck).format('0,000'));
	 				 $('#total_usd').val(numeral(tt/ccu).format('0,000'));
					 
					 key_press();
                              
                }else{
                   
                } 
            
				
			}
		});

	} 

*/
	
	</script> 
 <script> 

/*
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

		$("#total").val(numeral(total_all).format('0,000'));
		
		
		var t = $('#total').val();	
											  
		var c_k = $('#kip_baht').val(); 		
		var c_u = $('#dollar_baht').val();
		//alert(c_u);
		var tt   =Number(t.replace(/[^0-9\.-]+/g,""));
		var cck =Number(c_k.replace(/[^0-9\.-]+/g,""));
	    var ccu =Number(c_u.replace(/[^0-9\.-]+/g,""));
		
			    
	  $('#total_thb').val(numeral(tt).format('0,000'));
	  $('#total_lak').val(numeral(tt*cck).format('0,000'));
	  $('#total_usd').val(numeral(tt/ccu).format('0,000'));
	  
	 
    key_press();
	  
	//gand_total();
	}
	// key_press();
	// gand_total();
	
});*/
</script>
<script>
/*  function gand_total(){
	
	var t   = $('#total_all').val();
	var per = $('#all_per').val();
	var dis = $('#all_dis').val();
	
	
	var total   =Number(t.replace(/[^0-9\.-]+/g,""));
	var all_per =Number(per.replace(/[^0-9\.-]+/g,""));
	var all_dis =Number(dis.replace(/[^0-9\.-]+/g,""));
//	alert(total2);


	tt =(all_dis/total)*100;
	$('#all_per').val(numeral(tt).format('0,000'));
	
	
	
	xxx = total-all_dis;	
	$('#total').val(numeral(xxx).format('0,000'));
	
	var t = $('#total').val();
									  
		var c_k = $('#kip_baht').val();
		var c_u = $('#dollar_baht').val();
		
		var tt   =Number(t.replace(/[^0-9\.-]+/g,""));
		var cck =Number(c_k.replace(/[^0-9\.-]+/g,""));
	    var ccu =Number(c_u.replace(/[^0-9\.-]+/g,""));
		
			    
	  $('#total_thb').val(numeral(tt).format('0,000'));
	  $('#total_lak').val(numeral(tt*cck).format('0,000'));
	  $('#total_usd').val(numeral(tt/ccu).format('0,000'));
	
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
	
	
	$('#all_dis').val(numeral(tt).format('0,000'));
	
	var dis2 = $('#all_dis').val();
	var all_dis =Number(dis2.replace(/[^0-9\.-]+/g,""));

	
	
	
	xxx = total-all_dis;	
	$('#total').val(numeral(xxx).format('0,000'));
	
	    var t = $('#total').val();									  
		var c_k = $('#kip_baht').val();
		var c_u = $('#dollar_baht').val();
		
		var tt   =Number(t.replace(/[^0-9\.-]+/g,""));
		var cck =Number(c_k.replace(/[^0-9\.-]+/g,""));
	    var ccu =Number(c_u.replace(/[^0-9\.-]+/g,""));
		
			    
	  $('#total_thb').val(numeral(tt).format('0,000'));
	  $('#total_lak').val(numeral(tt*cck).format('0,000'));
	  $('#total_usd').val(numeral(tt/ccu).format('0,000'));
	
	
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
			    
	  $('#over_pay_thb').val(numeral(total_pay_thb).format('0,000'));
	  $('#over_pay_lak').val(numeral(total_pay_lak).format('0,000'));
	  $('#over_pay_usd').val(numeral(total_pay_usd).format('0,000'));
	  
	  $('#change_thb').val(numeral(total_thb_lak_usd-tt_thb).format('0,000'));
	  $('#change_lak').val(numeral((total_thb_lak_usd * c_lak)-tt_lak).format('0,000'));
	  $('#change_usd').val(numeral((total_thb_lak_usd/ c_usd)-tt_usd).format('0,000'));
	  

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
*/
    </script>
  <script>
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


