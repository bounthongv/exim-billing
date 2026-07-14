<?php 
include("init.php");

?>
<style>
td{ padding:5px;
font-weight:!important;
height:40px;
 }
</style>




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
</style>
 <script src="js/numeral.min.js"></script>
  <script>



$(document).ready(function(){

 
 load_order_receipt();
 load_product();
 
 

 
 function load_product()
	{
			$.ajax({
			url:"fetch_product_receipt_list_add.php",
			method:"POST",
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
			url:"fetch_cart_edit_product_receipt.php",
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
				url:"fetch_product_receipt_list.php",
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
	
		var Product_ID = $(this).attr("id");
		var product_name = $('#product_name'+Product_ID+'').val();
		var product_price = $('#price'+Product_ID+'').val();
		var product_quantity =1;		
		var action = "add";
	
			$.ajax({
				url:"cart_edit_product_receipt_add.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action,product_name:product_name,product_quantity:product_quantity,product_price:product_price },
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
		var action = "remove";
	
			$.ajax({
				url:"cart_edit_product_receipt_add.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action },
				success:function(data)
				{
				
					load_order_receipt();
				
				}
			});
		
	});
	
	
		$(document).on('click', '.edit_cart', function(){
	
		var Product_ID = $(this).attr("id");
		var product_name = $('#e_name'+Product_ID+'').val();
		var price = $('#e_price'+Product_ID+'').val();			
		var qty = $(this).attr("value");
		var action = "remove";
		
		$(".modal-body #up_name").val( product_name );
		$(".modal-body #up_qty").val(qty);
        $(".modal-body #up_Product_ID").val( Product_ID );
		$(".modal-body #up_price").val(numeral(price).format('0,0.00'));
		
			});
			

			
		
//////////////////////////////////////	
$(document).on('click', '#update_qty', function(){
	
		    var Product_ID = $('#up_Product_ID').val();
		    var qty = $('#up_qty').val();
			var price = Number($('#up_price').val().replace(/[^0-9\.-]+/g,""));
		    var action = "update";
			      
			
		$.ajax({
				url:"cart_product_receipt.php",
				method:"POST",
				data:{   Product_ID:Product_ID,action:action,product_quantity:qty,product_price:price },
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

 $(function(){
  $('#search_product').click(function(){
   
 
   var phone = $('#phone').val();
   var product_id = $('#product_id').val();
  var product_name = $('#product_name').val();
 
         $.ajax({
				url:"s_supplier.php",
				method:"POST",
				data:{  product_id:product_id,phone:phone,product_name:product_name },
				success:function(data)
				{
					$('#s_supplier').html(data);

				}
			});

  });

 });
 
 function amount() {
    var qty = document.getElementsByName("QTY[]");	
	var Price = document.getElementsByName("Price[]");
	var amount = document.getElementsByName("amount[]");
	
	var sum =0;
	var sum_dis=0;
	for (i = 0; i < qty.length; i++) {
	
     	q=Number(qty[i].value.replace(/[^0-9\.-]+/g,""));
		p=Number(Price[i].value.replace(/[^0-9\.-]+/g,""));
		
		
	
	    amount[i].value=numeral(q*p).format('0,000.00');
		
		sum = sum + (q*p);
		
	
		
      $('#total_all').val(numeral(sum).format('0,000.00'));
	  
	  
	  
	
		
	 }
}

    </script>

<div class="container">
    <br>
    <h3 align="center">ຮັບເຂົ້າສີນຄ້າ</h3><br>
  </div> 

 



    <!-- /.container -->
 <div class="container">   
    	<form action="insert_edit_product_receipt.php" method="post" onkeydown="return event.key != 'Enter';"  enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
    <a href="product_receipt_list.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
      <a href="cart_product_receipt.php?action=empty"><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
      <button type="submit" name="save" class="btn btn-primary" value="save"><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
     <a href="cart_edit_product_receipt_add.php?action=empty">
      <button type="button" name="reset" value="reset" class="btn btn-warning"><i class="fa fa-trash-o"></i>&nbsp;ລືບ</button></a>
     
  
    </div>
  </div>
<table border="0">
  <tr>
    <td align="right">ເລກທີ:</td>
    <td ><input type="text" class="form-control" name="receipt_id" id="receipt_id" value="<?php if(isset($_SESSION["receipt_id"])){ echo $_SESSION["receipt_id"];} ?>" readonly ></td>
    <td></td>
    <td align="right">ວັນທີ:</td>
    <td >

    <input type="date" class="form-control" name="receipt_date" id="receipt_date" value="<?php if(isset($_SESSION["receipt_date"])){ echo $_SESSION["receipt_date"];} ?>" required> 
    
     </td>
  </tr>
  <tr>
    <td align="right">ເລກທີອ້າງອີງ:</td>
    <td><input type="text" class="form-control ss" name="refer_no" id="refer_no" value="<?php if(isset($_SESSION["refer_no"])){ echo $_SESSION["refer_no"];} ?>" ></td>
    <td></td>
    <td align="right">ພະນັກງານ</td>
    <td><input type="text" class="form-control" name="staff_id" id="staff_id" value="<?php if(isset($_SESSION["staff_id"])){ echo $_SESSION["staff_id"];} ?>"  ></td>
  </tr>
 <tr>

  </tr>
  <tr>
    <td align="right">ຜູ້ສະໜອງ: </td>
    <td>
    <div class="input-group input-group-sm">
    <input type="text" class="form-control" name="supplier_name" id="supplier_name" value="<?php if(isset($_SESSION["supplier_id"])){ echo $_SESSION["supplier_name"];} ?>">
    <span class="input-group-addon">
    <input type="hidden" class="form-control" name="supplier_id"   id="supplier_id" value="<?php if(isset($_SESSION["supplier_id"])){ echo $_SESSION["supplier_id"];} ?>"  >
     <button type="button" name="cc" class="btn btn-sm " data-toggle="modal" data-target="#supplier_add" ><i class="fa fa-search"></i></button>
     </span>  
     </div>
    </td>
    <td>
   </td>
    <td align="right" colspan="1">  ສາງ</td>
    <td colspan="1">  
    <select name="stock_id" id="stock_id" class="form-control" required>    	
    <?PHP 
	$stock_id=$_SESSION["stock_id"];
	 $sql=mysqli_query($con,"select * from stocks where stock_id='$stock_id'");	
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

<?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 

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
			
			$vg=mysqli_query($con,"SELECT * FROM groups");
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
              <button name="show" id="<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_ID'];?>" class="btn  btn-sm show_add" > <?php echo $p['Group_ID'].'&nbsp;'.$p['Group_Name'];?></button></td>
              
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
        <div >
       &nbsp;  <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
        </div>
        <br>
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
        <th>ຊື່ລາຍການສິນຄ້າ</th>
        <th>ຈຳນວນ</th>
        <th>ລາຄາ</th>
        </tr>
        <tr>
        <td><input type="text" name="e_name" id="up_name" class="form-control" ></td>
        <td><input type="text" name="e_qty" id="up_qty" class="form-control" ></td>
         <td><input type="text" name="e_price" id="up_price" class="form-control" ></td>
         
         <input type="hidden" name="e_Product_ID" id="up_Product_ID" class="form-control" >
         </table>
         </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="update_qty" data-dismiss="modal" >Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


 <div class="modal" id="supplier_add">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ລາຍການຜູ້ສະໜອງ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
       
        <!-- Modal body -->
        <div class="modal-body">
        
        <table>
             <td>ລະຫັດ<br><input  type="text" name="product_id" id="product_id" class="form-control"  ></td> 
             <td>ຊື່ຜູ້ສະໜອງ<br><input  type="text" name="product_name" id="product_name" class="form-control"  ></td> 
             <td>ເບີໂທ<br><input  type="text" name="phone" id="phone" class="form-control"  ></td> 
             <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>
        </table> 
        
        
        <div id="s_supplier">
        
        <table class="table-bordered" >
        <tr align="center">
         <th>ລະຫັດ</th>
         <th>ຊື່ຜູ້ສະໜອງ</th>
         <th>ເບີໂທ</th>
      
         <th>ເລືອກ</th>
        </tr>
        
        <?php
		
		@$sp=mysqli_query($con,"  SELECT * from suppliers    ");
		   while($f=mysqli_fetch_array($sp)){
		?>
        <tr>         
         <td><?php echo "$f[supplier_id]";?></td>
         <td><?php echo "$f[supplier_name]";?></td>
         <td><?php echo "$f[tel]";?></td>
        
         <td><a href="product_receipt.php?s_id=<?=$f['supplier_id'];?>&s_name=<?=$f['supplier_name'];?>"><button type="button" name="cc" class="btn btn-sm btn-success" >ເລືອກ</button></a></td>
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


</body>

</html>


