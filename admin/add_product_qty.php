<?php 
include("init.php");

?>
<style>
td{ padding:5px;
font-weight:!important;
height:20px;
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

 

 load_product();
 
 

 
 function load_product()
	{
			$.ajax({
			url:"fetch_product_qty_list_add.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}



 $(document).on('click', '.show_add', function(){
	
		var gr_id = $(this).attr("id");		
		var action = "show";
	//	alert(gr_id);
			$.ajax({
				url:"fetch_product_qty_list_add.php",
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
	
	
 $(document).on('click', '.add_pro_ee', function(){
	
		var Product_ID = $(this).attr("id");
		var product_name = $('#product_name'+Product_ID+'').val();
		var product_price = $('#price'+Product_ID+'').val();
		var product_quantity =1;		
		var action = "add";
	
			$.ajax({
				url:"cart_product_receipt.php",
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
				url:"cart_product_receipt.php",
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
  
        $( "#product_id" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "fetch_auto_product.php",
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
                $('#product_name').val(ui.item.label); // display the selected text
                $('#product_id').val(ui.item.value); // save selected id to input
				$('#unit').val(ui.item.units); // save selected id to input
				$('#ups').val(ui.item.ups); // save selected id to input
				$('#sell_price').val(ui.item.sell_price); // save selected id to input
                return false;
            }
        });

        // Multiple select
      
    });


    </script>
<?php
$sql_max=mysqli_query($con,"select max(SUBSTRING(receipt_id, 2, 6)) as id from product_receipt");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='R0000'.'1';  
 
 $id2=$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $receipt_id=$id1;     }

 else if($max_id<9){  $receipt_id='R0000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $receipt_id='R000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $receipt_id='R00'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $receipt_id='R0'.$id2;} 
  else if($max_id<99999){  $receipt_id='R'. $id2;}
  
  else if($max_id >=99999){   $receipt_id='R'.$id2; }
  
   $receipt_id;

?>
<div class="container">
    <br>
    <h3 align="center">ຈຳນວນສີນຄ້າ</h3><br>
  </div> 

 



    <!-- /.container -->
 <div class="container">   
    	<form action="insert_product_qty.php" method="post" enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
    <a href="product_qty_list.php"> <button type="button" name="reset" value="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
     <a href="add_product_qty.php"> <button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
      <button type="submit" name="action" class="btn btn-primary" value="Add"><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
     
     
  
    </div>
  </div>
  
  <table >
	<tr>
    	<td>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#select_product" >
        <i class="fa fa-cart-plus"></i> &nbsp; ເລືອກລາຍການສີນຄ້າ</button>
        </td>
      
	</tr>
</table>
<table border="0">
  <tr>
    <td align="right">ລະຫັດສິນຄ້າ:</td>
    <td ><input type="text" class="form-control" name="product_id" id="product_id" value="<?php if(isset($_GET['product_id'])){ echo mysqli_real_escape_string($con,$_GET['product_id']);}else{} ?>" >
  
    </td>
    <td align="right">ຊື່ສິນຄ້າ:</td>
    <td ><input type="text" class="form-control" name="product_name" id="product_name" value="<?php if(isset($_GET['product_name'])){ echo mysqli_real_escape_string($con,$_GET['product_name']);}else{} ?>" ></td>
    
  </tr>
  <tr>
    <td align="right">ຫົວໜ່ວຍ:</td>
    <td><input type="text" class="form-control" name="unit" id="unit" value="<?php if(isset($_GET['unit'])){ echo mysqli_real_escape_string($con,$_GET['unit']);}else{} ?>" ></td>
    <td align="right">ຂະໜາດບັນຈຸ</td>
    <td><input type="text" class="form-control" name="ups" id="ups"  value="<?php if(isset($_GET['ups'])){ echo mysqli_real_escape_string($con,$_GET['ups']);}else{} ?>" ></td>
  </tr>
    <tr>
    <td align="right">ລາຄາຂາຍ:</td>
    <td><input type="text" class="form-control" name="sell_price" id="sell_price" value="<?php if(isset($_GET['sell_price'])){ echo mysqli_real_escape_string($con,$_GET['sell_price']);}else{} ?>" ></td>
    <td align="right">ລາຄາຕົ້ນທືນ</td>
    <td><input type="text" class="form-control" name="price" id="price" required  ></td>
  </tr>
 <tr>

  </tr>
 
 <tr>
 <td align="right">ຈຳນວນ:</td>
    <td >

    <input type="text" class="form-control" name="qty" id="qty"  required> 
    
     </td>
     <td align="right">ວັນທີຫມົດອາຍຸ:</td>
    <td >

    <input type="date" class="form-control" name="expert_date" id="expert_date" value="<?php echo @date('Y-m-d');  ?>" required> 
    
     </td>
 </tr>
 
  <tr>
 <td align="right">ສາງ:</td>
    <td >

   <select name="stock_id" id="stock_id" class="form-control" required>   
     
    <?PHP 
	 $sql=mysqli_query($con,"select * from stocks");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select> 
    
     </td>
     <td align="right"></td>
    <td >

   
    
     </td>
 </tr>
  
  
  
</table>

 







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
			
			$vg=mysqli_query($con,"SELECT * FROM tb_groups");
				if($vg){ ?>
            <table border='1'  align="center" class="table-bordered">
              <tr>
                <th>ລະຫັດປະເພດ</th>
                <th>ຊື່ປະເພດ</th>
              </tr>
             <td colspan="2">
              <input type="button" name="show" id="" value="ທັງຫມົດ" class="btn show_add btn-sm" ></td> 
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
		 		echo "<tr>";
		 	//	echo "<td>".$p['group_id']."</td>";?>
               
              	<td colspan="2">
              <button name="show" id="<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_ID'];?>" class="btn show_add  btn-sm" > <?php echo $p['Group_ID'].'&nbsp;'.$p['Group_Name'];?></button></td>
              
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
       &nbsp;   <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
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



</body>

</html>


