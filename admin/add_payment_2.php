<?php 
include("init.php");
//unset($_SESSION['cart_trnasfer_mini_stock']);

//$list_id = isset($_GET['list_id']) ? $_GET['list_id'] : '';
//echo $_SESSION['list_id_e'];
?>

<?php
/*
    $year_id=date('y');
      $id_y=date('Y');
	  $id_m=date('m');

$sql_max=mysqli_query($con,"select IFNULL(max(SUBSTRING(sale_id,4, 6)),0) as m_id 
 from product_sale where year(sale_date)='$id_y'   ");
@$row_max=mysqli_fetch_array($sql_max);

 $max_id=$row_max['m_id'];
 $id1=$year_id.'.'.'00000'.'1';  
 
 $id2=$max_id+1;
 
 $sale_id='';
if($max_id<1){    $sale_id=$id1;     }

 else if($max_id<9){  $sale_id=$year_id.'.'.'00000'.$id2;}  // 0000.2-0000.9
 else if($max_id<99){  $sale_id=$year_id.'.'.'0000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $sale_id=$year_id.'.'.'000'.$id2;} // 0010-00999  //   0100 - 999

  else if($max_id<9999){  $sale_id=$year_id.'.'.'00'.$id2;} 
  else if($max_id<99999){  $sale_id=$year_id.'.'.'0'.$id2;}
   else if($max_id<999999){  $sale_id=$year_id.'.'.$id2;}
   
   */
   
     $sql_id_auto= mysqli_query($con,"SELECT MAX(pay_id) AS id_max FROM  payment ");
                  $ff = mysqli_fetch_array($sql_id_auto);
   $id_number = $ff['id_max']+1;
   $width = 6;
 $auto_id = str_pad((string)$id_number, $width, "0", STR_PAD_LEFT); 


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
 @media{
  body{ font-size:10px;}
  }
</style>


 <script src="js/numeral.min.js"></script>

<div class="container">
    <br>
    <h3 align="center">ລາຍການມອບເງິນສົດ</h3><br>
  </div> 


    <!-- /.container -->
 <div class="container">   
    	<form action="insert_payment_2_2.php" method="post"  onkeydown="return event.key != 'Enter';"  enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">

<a href="cart_payment_2.php?action=close_and_clear">
    <button type="button" name="close" class="btn btn-danger">
        <i class="fa fa-times"></i>&nbsp;ປິດ
    </button>
</a>



      <button type="submit" name="save" class="btn btn-primary" value="save"  ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      <a href="" ><button type="button" name="reset" value="reset" class="btn btn-warning"><i class="fa fa-trash"></i>&nbsp;ລືບ</button></a>
     
  </div>


    <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
  </div>



<table border="0">
  <tr>
    <td align="right">ເລກທີ:</td>
    <td ><input type="text" class="form-control" name="pay_id" id="pay_id" value="<?php echo $auto_id; ?>" readonly ></td>
    <td align="right">ວັນທີ:</td>
    <td ><input type="date" class="form-control" name="pay_date" id="pay_date" onchange="get_currency()" 
   value="<?php /*if($_SESSION['payment_date']!==''){ echo $_SESSION['payment_date'];}else{ echo @date('Y-m-d'); }*/ echo @date('Y-m-d'); ?>"  required> </td>
  </tr>
  



   <td align="right">ຜູ້ມອບ:</td>
    <td>
    
    <div class="input-group input-group-sm">
    <input type="text" class="form-control ss" name="username" id="username" value="<?php if($_SESSION['username']!==''){ echo $_SESSION['username'];}else{} ?>" readonly >    
    <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php if($_SESSION['user_id']!==''){ echo $_SESSION['user_id'];}else{} ?>" > 

<?php
    /*
    <span class="input-group-addon">
   <button type="button" name="cc" class="btn btn-sm " data-toggle="modal" data-target="#customer_add" ><i class="fa fa-search"></i></button> </span>   
   */
?>
    </div>







</td>




<td align="right"> ບັນຊີທະນາຄານ:</td>
    <td>

<select name="Bank_account" id="Bank_account" class="form-control" onchange="syncToSecondForm(this)">  
    <option value="<?php echo $_SESSION['Bank_account'].'|'.$_SESSION['Bank_Name']?>">
        <?php echo $_SESSION['Bank_account']?> &nbsp; <?php echo $_SESSION['Bank_Name']?>
    </option>
    <?php 
    $sql = mysqli_query($con, "SELECT * from tb_bank");   
    while($f = mysqli_fetch_array($sql)){ ?>
        <!-- ส่งค่าในรูปแบบ: เลขบัญชี|ชื่อธนาคาร -->
        <option value="<?php echo $f['Bank_account'].'|'.$f['Bank_Name']?>">
            <?php echo $f['Bank_account']?> &nbsp; <?php echo $f['Bank_Name']?>
        </option>
    <?php } ?>
</select>



    </td>


</table>


<table>
	<tr>
    	<td>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#select_product" onclick="load_product()" >
        <i class="fa fa-cart-plus"></i> &nbsp; ເລືອກລາຍການບິນຂາຍສິນຄ້າ</button>
        </td>
      
	</tr>
</table>

<div id="display_cart_receipt"></div>

</form>

</div>






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
        
         <form action="cart_payment_2.php" method="post" id="paymentForm" enctype="multipart/form-data">
       <input type="hidden" name="action" value="select_item">

<input type="hidden" name="Bank_info_2" id="Bank_info_2" value="<?php echo $_SESSION['Bank_account'].'|'.$_SESSION['Bank_Name']?>" >

       <div align="left"><button type="submit" class="btn btn-success btn-sm" name="save">ຕົກລົງ</button></div>
       

<table>
  <tr>
<td>ເລກທີ</td><td><input type="text" name="sale_id" id="sale_id" class="form-control" ></td>
</tr>
</table>


       
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




  
<script>
function syncToSecondForm(selectElement) {
    // นำค่าที่เลือกไปอัปเดตให้ input hidden ใน paymentForm_2
    document.getElementById('Bank_info_2').value = selectElement.value;
}
</script>
<script>






 load_order_receipt();
 load_customer();
 load_product();

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


$(document).on('keyup', '#sale_id', function(){
var sale_id = $('#sale_id').val();
			$.ajax({
			url:"fetch_payment_sale_list_2.php",
			method:"POST",
			data:{  sale_id:sale_id },
			//dataType:"json",
			success:function(data)
			{
				$('#display_product').html(data);
				
				//member_data();
				
			}
		});
});




 function load_product(){
		var sale_id = $('#sale_id').val();
			$.ajax({
			url:"fetch_payment_sale_list_2.php",
			method:"POST",
			data:{  sale_id:sale_id },
			//dataType:"json",
			success:function(data)
			{
				$('#display_product').html(data);
				
				//member_data();
				
			}
		});
	}




 function load_order_receipt(){
			$.ajax({
			url:"fetch_cart_payment_2.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_cart_receipt').html(data);
				load_total_payment();
			}
		});
	}


	 $(document).on('click', '.delete_or', function(){
	
		var Product_ID = $(this).attr("id");
		var product_lot_id = $(this).attr("value");
		var action = "remove";
	
			$.ajax({
				url:"cart_payment_2.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action },
				success:function(data)
				{
				
					load_order_receipt();
				
				}
			});
		
	});



$(document).ready(function(){

	$(document).on('click', '.add_customer', function(){
	 
		var customer_id = $(this).attr("id");
		var customer_name = $(this).attr("data-customer_name");
	
	  
		$("#customer_id").val(customer_id);
		$("#customer_name").val(customer_name);
		$("#payment_name").val(customer_name);
      	$("#receipt_name").val('<?php echo $_SESSION['username']; ?>');
		
			});

});

  function load_total_payment()
	{
		
	  var total_all = $('#total_r').val();
	  
	  $('#pay_lak').val(total_all);
	  $('#total_lak').val(total_all);

	}
    </script>