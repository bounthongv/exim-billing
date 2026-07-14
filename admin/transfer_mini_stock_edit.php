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
#barcode{ width:190px; height:35px;}


</style>
 <script src="js/numeral.min.js"></script>
 

<div class="container">
    <br>
    <h3 align="center">ຈ່າຍສີນຄ້າໃຫ້ສາງລົດ</h3><br>
  </div> 

 
<div class="container">
<form action="cart_barcode_transfer_mini_edit.php" method="post" enctype="multipart/form-data" name="bar">
<table  >
 <tr>
    <td>Barcode:</td><td colspan="5"><input type="text" name="barcode" id="barcode" placeholder=" 12345678..."  onkeyup="this.value=this.value.replace(/[^\d]/,'')" >
    <input type="hidden" name="action" id="action" value="add">
    </td>
 </tr>
</table>
</form>
</div>
    <!-- /.container -->
 <div class="container">   
    	<form action="insert_transfer_mini_stock_edit.php" method="post"  onkeydown="return event.key != 'Enter';" onsubmit="return ch_qty()" enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
      <a href="transfer_mini_stock_edit.php"><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
      <button type="submit" name="save" class="btn btn-primary" value="save"  ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      <a href="cart_transfer_mini_stock_edit_add.php?action=empty" ><button type="button" name="reset" value="reset" class="btn btn-danger"><i class="fa fa-trash-o"></i>&nbsp;ປິດ</button></a>
     
  
    </div>
    <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
  </div>
 
<table border="0">
 
  <tr>
    <td align="right">ເລກທີ:</td>
    <td ><input type="text" class="form-control" name="transfer_id" id="transfer_id" value="<?php echo @$_SESSION["transfer_id"]; ?>" readonly ></td>
    
  </tr>
  <tr>
    <td align="right">ເລກທີອ້າງອີງ:</td>
    <td><input type="text" class="form-control ss" name="refer_no" id="refer_no" value="<?php echo $_SESSION["refer_no"]; ?>" ></td>
   <td align="right">ວັນທີ:</td>
    <td ><input type="date" class="form-control" name="transfer_date" id="transfer_date" value="<?php  echo @$_SESSION["transfer_date"]; ?>" required> </td>
  </tr>
 <tr>

  </tr>
  <tr>
    <td align="right">ຈາກສາງ:</td>
    <td>
   <select name="f_stock_id" id="f_stock_id" class="form-control" required>    	
    <?PHP 
	 $sql=mysqli_query($con,"select * from stocks where stock_id ='$_SESSION[f_stock_id]'");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select>
    </td>
    <td align="right" colspan="1">ຫາສາງ</td>
    <td colspan="1">  
    <select name="t_stock_id" id="t_stock_id" class="form-control" required>    	
    <?PHP 
	 $sql=mysqli_query($con,"select * from stocks where stock_id !='$_SESSION[f_stock_id]'");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select>
    </td>
  </tr>


  
</table>
   <table>
  
  <tr>
  <td align="right">Remark:</td>
    <td ><textarea name="remark" id="remark"  rows="6" style="width:400px;" class="form-control"></textarea> </td>
  </tr>

  
  
   </table>
 


<table >
	<tr>
    	<td>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#select_product" >
        <i class="fa fa-cart-plus"></i> &nbsp; ເລືອກລາຍການສີນຄ້າ</button>
        </td>
      
	</tr>
</table>

<div id="display_cart_receipt"></div>


<br>

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
              <input type="button" name="show" id="" value="ທັງຫມົດ" class="btn show_add" ></td> 
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
		 		echo "<tr>";
		 	//	echo "<td>".$p['group_id']."</td>";?>
               
              	<td colspan="2">
              <button name="show" id="<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_ID'];?>" class="btn show_add" > <?php echo $p['Group_ID'].'&nbsp;'.$p['Group_Name'];?></button></td>
              
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
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
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
          <h4 class="modal-title">ລາຍການຈຳນວນສິນຄ້າ</h4>
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



</body>

</html>
 <script>



$(document).ready(function(){

 
 load_order_receipt();
 load_product();
 
 $("#barcode").focus();

 
 function load_product()
	{     
	//var stock_id = $('#f_stock_id').val();
			$.ajax({
			url:"fetch_product_transfer_list.php",
			method:"POST",
		//	data:{  stock_id:stock_id },
			//dataType:"json",
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}
 function load_order_receipt()
	{
			$.ajax({
			url:"fetch_cart_transfer_mini_stock_edit.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_cart_receipt').html(data);
				
			}
		});
	}


 $(document).on('click', '.show_add', function(){
	
		var gr_id = $(this).attr("id");		
		var action = "show";
	//	alert(gr_id);
			$.ajax({
				url:"fetch_product_transfer_list.php",
				method:"POST",
				data:{   gr_id:gr_id,action:action },
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
		var product_lot_id = $(this).attr("value");
		var Product_ID = $('#Product_ID'+ID+'').val();
		var product_name = $('#product_name'+ID+'').val();
		var product_price = $('#price'+ID+'').val();
		var qty_limit = $('#qty_limit'+ID+'').val();
		var product_quantity =1;		
		var action = "add";
	
			$.ajax({
				url:"cart_transfer_mini_stock_edit_add.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action,product_name:product_name,product_quantity:product_quantity,product_price:product_price,product_lot_id:product_lot_id,qty_limit:qty_limit },
				success:function(data)
				{
				//	$('#display_product').html(data);
					load_order_receipt();
				//	alert( data,"Item has been Added into Cart");
				}
			});
		
	});
	
	
	 $(document).on('click', '.delete_or', function(){
	
		var Product_ID = $(this).attr("id");
	//	var product_lot_id = $(this).attr("value");
		var action = "remove";
	
			$.ajax({
				url:"cart_transfer_mini_stock_edit_add.php",
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
				url:"cart_transfer_mini_stock_edit_add.php",
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
  
        $( "#supplier_name" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "fetch_auto_supplier.php",
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
                $('#supplier_name').val(ui.item.label); // display the selected text
                $('#supplier_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });

        // Multiple select
      
    });




function ch_qty() {
	var f_stock_id = $('#f_stock_id').val();
	var t_stock_id = $('#t_stock_id').val();
	
	if(f_stock_id==t_stock_id){
		 alert("ກະລຸນາກວດເບີ່ງສາງກ່ອນ");
		  $('#t_stock_id').focus();
		return false;
		}
	else{
	
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
}

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
	
    </script>

