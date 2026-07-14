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
#barcode{ width:190px; height:35px;}


</style>
 <script src="js/numeral.min.js"></script>
 
<?php
$sql_max=mysqli_query($con,"select IFNULL(max(SUBSTRING(transfer_id, 2, 6)),0) as id from transfer");
@$row_max=mysqli_fetch_row($sql_max);

 $max_id=$row_max['0'];
 $id1='T00000'.'1';  
 
 $id2=$max_id+1;
 
 $suppliers_id='';
if($max_id<1){    $receipt_id=$id1;     }

 else if($max_id<9){  $receipt_id='T00000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $receipt_id='T0000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $receipt_id='T000'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $receipt_id='T00'.$id2;} 
  else if($max_id<99999){  $receipt_id='T0'. $id2;}
  
  else if($max_id >=99999){   $receipt_id='T'.$id2; }
  
   $receipt_id;

?>
<div class="container">
    <br>
    <h3 align="center">ໂອນສີນຄ້າໃຫ້ສາງ</h3><br>
  </div> 

 
<div class="container">
<form action="cart_barcode_transfer_mini.php" method="post"  onkeydown="return event.key != 'Enter';" enctype="multipart/form-data" name="bar">
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
    	<form action="insert_transfer_mini_stock.php" method="post" onsubmit="return ch_qty()" onkeydown="return event.key != 'Enter';"  enctype="multipart/form-data" name="me">

	<div class="form-group row">
    <div class="col-sm-10">
      <a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a>
      <a href="transfer_mini_stock.php"><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;ເພີ່ມໃໜ່</button></a>
      <button type="submit" name="save" class="btn btn-primary" value="save"  ><i class="fa fa-file"></i>&nbsp;ບັນທືກ</button>
      <a href="cart_transfer_mini_stock.php?action=empty" ><button type="button" name="reset" value="reset" class="btn btn-warning"><i class="fa fa-trash"></i>&nbsp;ລືບ</button></a>
     
  
    </div>
    <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
  </div>
<table border="0">
  <tr>
    <td align="right">ເລກທີ:</td>
    <td ><input type="text" class="form-control" name="transfer_id" id="transfer_id" value="<?php echo $receipt_id; ?>" readonly ></td>
    
  </tr>
  <tr>
    <td align="right">ເລກທີອ້າງອີງ:</td>
    <td>
    
    <div class="input-group input-group-sm">
    <input type="text" class="form-control ss" name="refer_no" id="refer_no" value="<?php if($_SESSION['transfer_id']!==''){ echo $_SESSION['transfer_id'];}else{} ?>" >    
   <span class="input-group-addon">
   <button type="button" name="cc" class="btn btn-sm " data-toggle="modal" data-target="#customer_add" ><i class="fa fa-search"></i></button> </span>   
    </div>
    </td>
   <td align="right">ວັນທີ:</td>
    <td ><input type="date" class="form-control" name="transfer_date" id="transfer_date" value="<?php echo @date('Y-m-d');  ?>" required> </td>
  </tr>
 <tr>

  </tr>
  <tr>
    <td align="right">ຈາກສາງ:</td>
    <td>
   <select name="f_stock_id" id="f_stock_id" class="form-control" required>    	
    <?PHP 
	
	 $sql=mysqli_query($con,"select * from stocks where stock_id ='".$_SESSION['stock_id']."'");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
      <?PHP 
	 $sql=mysqli_query($con,"select * from stocks where stock_id !='".$_SESSION['stock_id']."'");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select>
    </td>
    <td align="right" colspan="1">ຫາສາງ</td>
    <td colspan="1">  
    
    
    <select name="t_stock_id" id="t_stock_id" class="form-control" required>  
  
    <?PHP 
	 $sql=mysqli_query($con,"select * from stocks ");	
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
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#select_product" onclick="load_product()" >
        <i class="fa fa-cart-plus"></i> &nbsp; ເລືອກລາຍການສີນຄ້າ</button>
        </td>
      
	</tr>
</table>

<div id="display_cart_receipt"></div>

<div id="error"></div>
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
              <input type="button" name="show" id="" value="ທັງຫມົດ" class="btn btn-sm show_add" ></td> 
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
		 		echo "<tr>";
		 	//	echo "<td>".$p['group_id']."</td>";?>
               
              	<td colspan="2">
              <button name="show" id="<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_ID'];?>" class="btn  btn-sm  show_add" > <?php echo $p['Group_ID'].'&nbsp;'.$p['Group_Name'];?></button></td>
              
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
        <div>        
         &nbsp; <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
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
          <h4 class="modal-title">ລາຍການອ້າງອີງ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
       
        <!-- Modal body -->
        <div class="modal-body">
        
        <table>
             <td>ເລກທີ<br><input  type="text" name="transfer_id" id="transfer_id2" onkeyup="search11()" class="form-control"  ></td> 
             <td>ສາງ<br><input  type="text" name="stock_id" id="stock_id" onkeyup="search22()" class="form-control"  ></td> 
              
             
        </table> 
        
        
        <div id="s_customer">
  
 <?php
         @$sp=mysqli_query($con,"
SELECT quotation_transfer.*,count(quotation_transfer.product_id) as total_item,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version
		   FROM  quotation_transfer 
		   left join products on products.Product_ID=quotation_transfer.product_id
       left join stocks on stocks.stock_id=quotation_transfer.stock_id	
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       
       where      quotation_transfer.status!='0' 
	   group by quotation_transfer.transfer_id order by quotation_transfer.product_id
	   
	          ");
		
          
          ?>
      <script>
function search11() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("transfer_id2");
  filter = input.value.toUpperCase();
  table = document.getElementById("refer2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function search22() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("stock_id");
  filter = input.value.toUpperCase();
  table = document.getElementById("refer2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
 		<table border="1"   class="table-bordered " id="refer2" >
              <tr>
			     <th align="center">ລ/ດ</th>
                <th align="center">ເລກທີ</th>
                <th align="center">ວັນທີ</th>
				<th align="center">ສາງ</th>
               
               
                <th align="center">ຈຳນວນລາຍການ</th>
              
               <th align="center">ເລືອກ</th>
               
              </tr>
           <?php
		   $i=1;
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[transfer_date]");
			?>
            
            
            	<tr>
			
			  <td align="center"><?php echo $i; ?></td>
			   <td align="center"><?php echo  $s["transfer_id"]; ?></td> 
				<td align="center"><?php echo date_format($dd,"d-m-Y"); ?></td>
				<td><?php echo $s["stock_id"]; ?>&nbsp;<?php echo $s["stock_name"]; ?></td>
            	
               
            	<td align="center"><?php echo  $s["total_item"]; ?></td>
				<td align="center">
                <a href="cart_transfer_mini_stock_referno.php?transfer_id=<?=$s['transfer_id'];?>">
                <button type="button" name="cc" class="btn btn-sm btn-success" >ເລືອກ</button></a>  </td>            
                
              
				</tr>
               <?php
			$i++;	
				
				
             } 
       ?>  </table>
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

 function load_product()
	{
		var stock_id = $('#f_stock_id').val();
			$.ajax({
			url:"fetch_product_transfer_list.php",
			method:"POST",
			data:{  stock_id:stock_id },
			//dataType:"json",
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}

$(document).ready(function(){

 
 load_order_receipt();
 load_product();
 
 $("#barcode").focus();

 

 function load_order_receipt()
	{
			$.ajax({
			url:"fetch_cart_transfer_mini_stock.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#display_cart_receipt').html(data);
				
			}
		});
	}


 $(document).on('click', '.show_add', function(){
	
	   var stock_id = $('#f_stock_id').val();
		var gr_id = $(this).attr("id");		
		var action = "show";
	//	alert(gr_id);
			$.ajax({
				url:"fetch_product_transfer_list.php",
				method:"POST",
				data:{  stock_id:stock_id, gr_id:gr_id,action:action },
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
	//	var Product_ID = $('#Product_ID'+ID+'').val();
		var product_name = $('#product_name'+ID+'').val();
		var product_price = $('#price'+ID+'').val();
		var qty_limit = $('#qty_limit'+ID+'').val();
		var product_quantity =1;		
		var action = "add";
	
			$.ajax({
				url:"cart_transfer_mini_stock.php",
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
	
	
	 $(document).on('click', '.delete_or', function(){
	
		var Product_ID = $(this).attr("id");
		var product_lot_id = $(this).attr("value");
		var action = "remove";
	
			$.ajax({
				url:"cart_transfer_mini_stock.php",
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
		 var qty =$('#e_qty'+Product_ID+'').val();
		 var price =$('#e_price'+Product_ID+'').val();		 	
		 var qty_limit = $('#qty_limit'+Product_ID+'').val();
					 			  		   
	//	alert(qty);
		var status ='1';
		var action = "update_x1";

			$.ajax({
				url:"cart_transfer_mini_stock.php",
				method:"POST",
         data:{  Product_ID:Product_ID,qty:qty,price:price,action:action,status:status,qty_limit:qty_limit },
				success:function(data)
				{
					
					
			//	$('#error').html(data);
					load_order_receipt();
					

				
				}
			});
}
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
				url:"cart_transfer_mini_stock.php",
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
 