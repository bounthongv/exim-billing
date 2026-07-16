<?php 
include("init.php");

?>
<style>
td{ padding:50px;
font-weight:!important;
height:20px;
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
 th{ text-align:center;}
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

gen_code();
 
 load_product();
 
function load_product()
	{   var action = "show";
		var stock_id =  $('#stock_id').val();
			$.ajax({
			url:"fetch_product_list.php",
			method:"POST",
			//dataType:"json",
			data:{   action:action,stock_id:stock_id },
			success:function(data)
			{
				$('#display_product').html(data);
				
			}
		});
	}
//setInterval(load_product, 600); // set time load function

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

$(document).on('click', '.show_pro', function(){
	
		var gr_id = $(this).attr("id");	
		var stock_id =  $('#stock_id').val();
		
		var action = "show";

			$.ajax({
				url:"fetch_product_list.php",
				method:"POST",
				data:{   gr_id:gr_id,action:action,stock_id:stock_id },
				success:function(data)
				{
					$('#display_product').html(data);

				}
			});
		
	});
	
	
	$(document).on('click', '.edit_pro', function(){
	
		var Product_ID = $(this).attr("id");
		var Group_ID = $('#Group_ID'+Product_ID+'').val();
		var Id = $('#Id'+Product_ID+'').val();
		var Price = $('#price'+Product_ID+'').val();
		var Product_Name = $('#name'+Product_ID+'').val();	
		var Product_Name_EN = $('#name_en'+Product_ID+'').val();		
		var Bar_Code = $('#Bar_Code'+Product_ID+'').val();	
		var Quantity = $('#Quantity'+Product_ID+'').val();
		var Unit = $('#Unit'+Product_ID+'').val();	
		var ups = $('#ups'+Product_ID+'').val();	
		var size = $('#size'+Product_ID+'').val();	
		var version = $('#version'+Product_ID+'').val();
		var s1_price = $('#s1_price'+Product_ID+'').val();
		var s2_price = $('#s2_price'+Product_ID+'').val();
		var s3_price = $('#s3_price'+Product_ID+'').val();	
		var s4_price = $('#s4_price'+Product_ID+'').val();
   // var s4_price = $('#s4_price'+Product_ID+'').val();
		var function1 = $('#function'+Product_ID+'').val();
    

		var img_pro = $('#img_pro'+Product_ID+'').val();
		var crate_price = $('#crate_price'+Product_ID+'').val();

    var seven_eleven = $('#seven_eleven'+Product_ID+'').val();
	//	var gr_id = $(this).attr("id");		
		//('#Product_ID').val('22332')
	

//	document.getElementById('Group_ID').value = Group_ID;
	
	   $('#Group_ID').val(Group_ID);
	   $("#Product_ID").val( Product_ID );
		 $("#Price").val( Price );
		  $("#Product_Name").val( Product_Name );
		   $("#Product_Name_EN").val( Product_Name_EN );
		  $("#Bar_Code").val( Bar_Code );
		   $("#Quantity").val( Quantity );
		   $("#Unit").val( Unit );
		  $("#Id").val( Id );
		   $("#ups").val( ups );
		   $("#size").val( size );
		   $("#version").val( version );
		     $("#s1_price").val( s1_price );
			 $("#s2_price").val( s2_price );
			 $("#s3_price").val( s3_price );
		$("#s4_price").val( s4_price );
    $("#function").val( function1 );
    

			  $("#crate_price").val( crate_price );
        $("#seven_eleven").val( seven_eleven );
			 
		   
			$("#action").val('Update');
			
			var x_img_pro="<img src='"+img_pro+"' id='show_image' style='border-radius:5px;' width='250' height='250' />";
			
			
			$("#show_img_pro").html(x_img_pro);
			
			});
	

   






});


$(function(){
  $('#search_product').click(function(){
   
   var stock_id = $('#stock_id').val();
   var gr_id = $('#group_id').val();
   var product_id = $('#product_id').val();
  var product_name = $('#product_name').val();
 
         $.ajax({
				url:"fetch_product_list.php",
				method:"POST",
				data:{   gr_id:gr_id,product_id:product_id,stock_id:stock_id,product_name:product_name },
				success:function(data)
				{
					$('#display_product').html(data);

				}
			});

  });

 });


function get_product_id(){


 var Group_ID = $('#Group_ID').val();

        $.ajax({
				url:"get_product_id.php",
				method:"POST",
				data:{   Group_ID:Group_ID},
				success:function(data)
				{
					//$('#Product_ID').val(data);
$('#ddd').html(data);	
				}
			});

}

function gen_code() {
	
    var len = 13;
    var gg = parseInt((Math.random() * 9 + 1) * Math.pow(10,len-1), 10);
    $("#Bar_Code").val(gg);
    

}

	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("id");
		var product_id = $(this).attr("value");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_product.php?Id='+Id + '&product_id='+product_id;
  } 
 

	});
	

function readURL(input) {
	
	
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
$('#show_image')
    .attr('src', e.target.result);
};

reader.readAsDataURL(input.files[0]);
}
}


</script>
<div class="container">
    <br>
    <h3 align="center">ລາຍການສິນຄ້າ</h3><br>
   


            
            
            
            
            
       <table>
       <tr>
       <td><br><a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
           <td><br><button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_pro">
            <i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ</button></td> 
      
      
    
            
      
      <td>ສາງ<br>
      <select name="stock_id" id="stock_id" class="form-control" required>   
       	 
    <?PHP  
	
		
	 $sql=mysqli_query($con,"select * from stocks  ");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>

	<?PHP } ?>
	<option value="">ທັງຫມົດ</option>

   
    </select> </td>    
       <td>ໝວດສິນຄ້າ<br>
      <select name="group_id" id="group_id" class="form-control" required>   
    <?php ?>
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from tb_groups");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['Group_ID']?>"><?php echo $f['Group_ID']?> &nbsp; <?php echo $f['Group_Name']?></option>
	<?PHP } ?>
    </select> </td>  
      
    
          <!--   <td>ລະຫັດສິນຄ້າ <br><input  type="hidden" name="product_id" id="product_id" class="form-control"  ></td> 
             <td>ຊື່ສິນຄ້າ <br><input  type="hidden" name="product_name" id="product_name" class="form-control"  ></td> -->
             <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button>
           
             </td>
       </tr>
       </table>

        <!-- Content Row -->
        <div class="row">
        <div class="col-lg-12">
        
<br>

 			
          <table >
          <tr>
          <td valign="top">
              
            <?php
			
			$vg=mysqli_query($con,"SELECT * FROM tb_groups");
				if($vg){ ?>
            <table border='1'  align="center" class="table-bordered" >
              <tr>
                <th>ລະຫັດປະເພດ</th>
                <th>ຊື່ປະເພດ</th>
              </tr>
             <td colspan="2">
              <input type="button" name="show" id="" value="ທັງຫມົດ" class="btn btn-sm show_pro" ></td> 
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
		 		echo "<tr>";
		 	//	echo "<td>".$p['group_id']."</td>";?>
               
             	<td colspan="2">
              <input type="button" name="show" id="<?php echo $p['Group_ID'];?>" value="<?php echo $p['Group_ID'].'&nbsp;'.$p['Group_Name'];?>"
               class="btn btn-sm show_pro" ></td>
              
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
          <h4 class="modal-title">ເພີ່ມລາຍການສິນຄ້າ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
      <form action="insert_products.php" method="post" enctype="multipart/form-data">
      
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> ປິດ</button>
       <button type="reset" class="btn btn-success"  > ເພີ່ມໃຫມ່</button>
          <button type="submit" class="btn btn-primary" name="action" id="action" value="Add"  >ບັນທືກ</button>
          
         <table border="0">

  <tr>
    <td align="right">ໜວດສິນຄ້າ:</td>
    <?PHP 
	
	$sql=mysqli_query($con,"select * from tb_groups");
	
	?>
    <td>
    <select name="Group_ID" id="Group_ID" class="form-control" onchange="get_product_id()" required>
    	<option value="" >ເລືອກໜວດ</option>
    <?PHP 
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['Group_ID']?>"><?php echo $f['Group_ID']?> &nbsp; <?php echo $f['Group_Name']?></option>
	<?PHP } ?>
    </select>
    </td>
  <!--  <td align="right">ລູ້ນ:</td>
    <td><input type="text" class="form-control" name="version" id="version" placeholder="version"></td>-->
    
     <td align="right">ຮູບ</td>
    <td><input type="file" class="form-control sz" id="pic"  name="pic"  accept="image/*" onchange="readURL(this);"></td>
   <td rowspan="5">&nbsp; &nbsp;
   <div id="show_img_pro">
   <img src="images/shopping-cart.png" id="show_image" style="border-radius:5px;" width="250" height="250" /></div></td>
  </tr>
  
 
  
  <tr>
    <td align="right">ລະຫັດສິນຄ້າ :</td>
    <td>
    
    <input type="text" class="form-control" name="Product_ID" id="Product_ID"  placeholder="Product ID" >
    <?php/*
    <div id="ddd">
       </div>
    */ ?>
    <input type="hidden" class="form-control" name="Id" id="Id"  placeholder="Product ID" >
	 
    </td>
    <td align="right">Code : <!--<button type="button" class="btn btn-success btn-sm" onclick="gen_code()"><i class="fa fa-cog"></i></button>--> </td>
    <td>
    <input type="text" class="form-control" name="Bar_Code" id="Bar_Code" placeholder="BarCode ID" ></td>
     
     
   
  </tr>
  
  <tr>
    <td align="right">ຊື່ ພາສາລາວ:</td>
    <td><input type="text" class="form-control" name="Product_Name" id="Product_Name" placeholder="Product Name LA"></td>
     <td align="right">ຊື່ ພາສາອັງກິດ:</td>
    <td><input type="text" class="form-control" name="Product_Name_EN" id="Product_Name_EN" placeholder="Product Name EN"></td>
  </tr>
    <tr>
    <td align="right">ຫົວໜ່ວຍ:</td>
    <td><input type="text" class="form-control" name="Unit" id="Unit"  placeholder="Unit"></td>
    <td align="right">ຂະໜາດບັນຈຸ:</td>
    <td><input type="text" class="form-control" name="ups" id="ups"  placeholder="UPS"></td>
  </tr>
  <tr>
    <td align="right">ຈຳນວນຈຸດສັ່ງຊື້:</td>
    <td><input type="text" class="form-control" name="Quantity" id="Quantity" onkeyup="total_amount()" placeholder="Quantity"></td>
  <!--  <td align="right">ຂະໜາດ:</td>
    <td><input type="text" class="form-control" name="size" id="size"  placeholder="Size"></td>-->
  </tr>
  <tr>
    <td align="right">distributor:</td>
    <td><input type="text" class="form-control" name="s1_price" id="s1_price"  placeholder="Price"></td>
    <td align="right">ລາຄາລັງເປົ່າ:</td>
    <td><input type="text" class="form-control" name="crate_price" id="crate_price"  placeholder="Price"></td>
    <tr>
     <td align="right">wholesaler:</td>
    <td><input type="text" class="form-control" name="s2_price" id="s2_price"  placeholder="Price"></td>

    <td align="right">7 eleven:</td>
    <td><input type="text" class="form-control" name="seven_eleven" id="seven_eleven"  placeholder="Price"></td>

  </tr>
    <tr>
    <td align="right">outlet:</td>
    <td><input type="text" class="form-control" name="s3_price" id="s3_price" placeholder="Price"></td>
    
    <td align="right">MiniBigC:</td>
    <td><input type="text" class="form-control" name="s4_price" id="s4_price" placeholder="Price"></td>
   <!--  <td align="right"></td>
    <td><input type="hidden" class="form-control" name="Price" id="Price" placeholder="Bye Price"></td>-->
    </tr>

    <tr>
    <td align="right">Function:</td>
    <td><input type="text" class="form-control" name="function" id="function" placeholder="Price"></td>
  </tr>
  
  
</table>
  </form>
         </div>
        
        <!-- Modal footer -->
     
      
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

