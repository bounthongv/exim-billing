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


<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
<!--	<link href="//fonts.googleapis.com/css?family=Poppins:100i,200,200i,300,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">-->
	<link href="js/iconic.css" rel="stylesheet">
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
.limit_qty{ color:#F00;}
</style>
 <script src="js/numeral.min.js"></script>
  <script>



$(document).ready(function(){

 
 load_product();
 
function load_product()
	{
		 var stock_id = $('#stock_id').val();
			$.ajax({
			url:"fetch_product_qty_list.php",
			method:"POST",
			//dataType:"json",
			data:{   stock_id:stock_id },
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}
// setInterval(load_product, 600);

$(document).on('keyup', '#Quantity', function(){
			
   var qty = $('#Quantity').val();
   var price = $('#Price').val();

   var total=Number(qty.replace(/[^0-9\.-]+/g,""))* Number(price.replace(/[^0-9\.-]+/g,""))

   $('#Amount').val(numeral(total).format('0,0'));
		
	
});
$(document).on('keyup', '#Price', function(){
		
		
   var qty = $('#Quantity').val();
   var price = $('#Price').val();
    var total=Number(qty.replace(/[^0-9\.-]+/g,""))* Number(price.replace(/[^0-9\.-]+/g,""))
   $('#Amount').val(numeral(total).format('0,0'));
		
	
});

$(document).on('click', '.show', function(){
	
		var gr_id = $(this).attr("id");		
		var action = "show";
	//	alert(gr_id);
			$.ajax({
				url:"fetch_product_qty_list.php",
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
	
	
	$(document).on('click', '.edit_pro', function(){
	
		var Product_ID = $(this).attr("id");
		
		var Group_ID = $('#Group_ID'+Product_ID+'').val();
		var Id = $('#Id'+Product_ID+'').val();
		var Price = $('#price'+Product_ID+'').val();
		var Product_Name = $('#name'+Product_ID+'').val();		
		var Bar_Code = $('#Bar_Code'+Product_ID+'').val();	
		var Quantity = $('#Quantity'+Product_ID+'').val();
		var Unit = $('#Unit'+Product_ID+'').val();	
		var Amount = $('#Amount'+Product_ID+'').val();	
	//	var gr_id = $(this).attr("id");		
		//('#Product_ID').val('22332')
	
//	document.getElementById('Group_ID').value = Group_ID;
	
	   $('#Group_ID').val(Group_ID);
	   $("#Product_ID").val( Product_ID );
		 $("#Price").val( Price );
		  $("#Product_Name").val( Product_Name );
		  $("#Bar_Code").val( Bar_Code );
		   $("#Quantity").val( Quantity );
		   $("#Unit").val( Unit );
		  $("#Id").val( Id );
		   $("#Amount").val( Amount );
			$("#action").val('Update');
			
			});
	








});
	$(document).on('click', '.delete_product_qty', function(){
	
		var Id = $(this).attr("id");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_product_qty.php?Id='+Id;
  } 
 

	});

$(function(){
  $('#search_product').click(function(){
   
   var stock_id = $('#stock_id').val();
   var gr_id = $('#group_id').val();
   var product_id = $('#product_id').val();
   

 
         $.ajax({
				url:"fetch_product_qty_list.php",
				method:"POST",
				data:{   gr_id:gr_id,product_id:product_id,stock_id:stock_id },
				success:function(data)
				{
					$('#display_product').html(data);

				}
			});

  });

 });

</script>
<div class="container">
    <br>
    <h3 align="center">ລາຍການຈຳນວນສີນຄ້າ</h3><br>
   


            
  <table>
       <tr>
       <td><br><a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
           <td><br><a href="add_product_qty.php"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_pros">
            <i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ</button></a></td> 
      
      
     
      
      <td>ສາງ<br>
      <select name="stock_id" id="stock_id" class="form-control" required>   
       	
    <?PHP 
	$stock_id=$_SESSION["stock_id"];
	
	 $sql=mysqli_query($con,"select * from stocks where stock_id='$stock_id'");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    <?PHP 
	$stock_id=$_SESSION["stock_id"];
	
	 $sql=mysqli_query($con,"select * from stocks where stock_id!='$stock_id'");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    <option value="">ທັງຫມົດ</option>
    </select> </td>    
       <td>ໝວດສິນຄ້າ<br>
      <select name="group_id" id="group_id" class="form-control" required>   
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from tb_groups");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['Group_ID']?>"><?php echo $f['Group_ID']?> &nbsp; <?php echo $f['Group_Name']?></option>
	<?PHP } ?>
    </select> </td>  
      
    
             <td>ລະຫັດສິນຄ້າ<br><input  type="text" name="product_id" id="product_id" class="form-control"  ></td> 
             <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>
       </tr>
       </table>

        <!-- Content Row -->
        <div class="row">
        <div class="col-lg-12">
        
<br>

 			
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
              <input type="button" name="show" id="" value="ທັງຫມົດ" class="btn btn-sm show" ></td> 
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
		 		echo "<tr>";
		 	//	echo "<td>".$p['group_id']."</td>";?>
               
              	<td colspan="2">
              <input type="button" name="show" id="<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_ID'].'&nbsp;'.$p['Group_Name'];?>" class="btn btn-sm show" ></td>
              
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
  
  	

<!---- add product--->


 <div class="modal" id="add_pro">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ເພີ່ມລາຍການຈຳນວນສີນຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
      <form action="insert_products.php" method="post" enctype="multipart/form-data">
         <table border="0">

  <tr>
    <td align="right">ໜວດສິນຄ້າ:</td>
    <?PHP 
	
	$sql=mysqli_query($con,"select * from tb_groups");
	
	?>
    <td>
    <select name="Group_ID" id="Group_ID" class="form-control" required>
    	<option value="" >ເລືອກໜວດ</option>
    <?PHP 
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['Group_ID']?>"><?php echo $f['Group_ID']?> &nbsp; <?php echo $f['Group_Name']?></option>
	<?PHP } ?>
    </select>
    </td>
    
  </tr>
  
 
  
  <tr>
    <td align="right">ລະຫັດສິນຄ້າ :</td>
    <td><input type="text" class="form-control" name="Product_ID" id="Product_ID"  placeholder="Product ID" >
    <input type="hidden" class="form-control" name="Id" id="Id"  placeholder="Product ID" >
    </td>
  </tr>
   <tr>
    <td align="right">ລະຫັດບາໂຄດ :</td>
    <td><input type="text" class="form-control" name="Bar_Code" id="Bar_Code" placeholder="BarCode ID" ></td>
  </tr>
  <tr>
    <td align="right">ຊື່ ສິນຄ້າ:</td>
    <td><input type="text" class="form-control" name="Product_Name" id="Product_Name" placeholder="Product Name"></td>
  </tr>
    <tr>
    <td align="right">ຫົວໜ່ວຍ:</td>
    <td><input type="text" class="form-control" name="Unit" id="Unit"  placeholder="Unit"></td>
  </tr>
  <tr>
    <td align="right">ຈຳນວນ:</td>
    <td><input type="text" class="form-control" name="Quantity" id="Quantity" onkeyup="total_amount()" placeholder="Quantity"></td>
  </tr>
  <tr>
    <td align="right">ລາຄາ:</td>
    <td><input type="text" class="form-control" name="Price" id="Price" onkeyup="total_amount()" placeholder="Price"></td>
    <tr>
    <td align="right">ລວມເປັນເງີນ:</td>
    <td><input type="text" class="form-control" name="Amount" id="Amount" placeholder="Amount"></td>
  </tr>
  </tr>
</table>

         </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="action" id="action" value="Add"  >Save</button>
          <button type="reset" class="btn btn-warning"  >Reset</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
</div>


<!----->
 <?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?>
 
 
 


</div>
    <!-- /.container -->
    <br>
    <br>

</body>

</html>

