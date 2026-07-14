<?php 
include("init.php");

?>





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

    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

  





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



td{ padding:10px;
font-weight:!important;
height:40px;
 }
 th{ background-color:#E0E0E0; text-align:center;
 padding:10px;
font-weight:!important;
height:40px;
 }
</style>
 <script src="js/numeral.min.js"></script>
  <script>



$(document).ready(function(){

 

 load_list();
 
 function load_list()
	{
			$.ajax({
			url:"fetch_best_seller.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#head_list').html(data);
				
			}
		});
	}
 



});

$(function(){
  $('#search_product').click(function(){
   
 
   var stock_id = $('#stock_id').val(); 
   var sale_id = $('#sale_id').val();   
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
 //  var product_id = $('#product_id').val(); 
   var group_id = $('#group_id').val(); 
   
 //  alert(stock_id);
   
         $.ajax({
				url:"fetch_best_seller.php",
				method:"POST",
				data:{  stock_id:stock_id,from_date:from_date,to_date:to_date,sale_id:sale_id,group_id:group_id },
				success:function(data)
				{
					$('#head_list').html(data);

				}
			});

  });

 });
$(document).on('click', '.delete_Id', function(){
	
		var sale_id = $(this).attr("id");
	//	var action = $(this).attr("value");

  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_product_sale.php?sale_id='+sale_id ;
  } 
 

	});

$(document).on('click', '.edit_Id', function(){
	
		var transfer_id = $(this).attr("id");
	//	var action = $(this).attr("value");


     window.location = 'cart_transfer_mini_stock_edit.php?transfer_id='+transfer_id ;
   
 

	});
$(document).on('click', '#print', function(){
	
   var stock_id = $('#stock_id').val();    
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
 //  var product_id = $('#product_id').val(); 
   var group_id = $('#group_id').val(); 
	//	var action = $(this).attr("value");


     window.open('print_best_seller.php?stock_id='+stock_id + '&from_date='+from_date  + '&to_date='+to_date+  '&group_id='+group_id+' ','_blank'); 
   
 

	});
</script>

<div class="container">
    <br>
    <h3 align="center">ລາຍງານສິນຄ້າຂາຍດີ</h3><br>
   
<table>
       <tr>
     <td> <br>  <a href="product_qty_list.php"> <button type="button" name="reset" value="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
       
            
            
            <td>ວັນທີ<br><input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date("Y-m-d"); ?>"></td> 
            
            <td>ຫາ<br><input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d"); ?>"></td> 
      
      <td>ສາງ<br>
      <select name="stock_id" id="stock_id" class="form-control" required>   
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from stocks");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select> </td>    
   
      <td>ໝວດສີນຄ້າ<br>
      <select name="group_id" id="group_id" class="form-control" required>   
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from tb_groups");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['Group_ID']?>"><?php echo $f['Group_ID']?> &nbsp; <?php echo $f['Group_Name']?></option>
	<?PHP } ?>
    </select> 
    </td> 
     
      <td><br> <button type="button" class="btn btn-warning" id="print">ພິມ</button></td>      
             
             <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>
       </tr>
       </table>

           <br>
           
 <div class="container">          
             <div id="head_list"></div>	          
         </div>
           
 
            

  
  	

<!---- add product--->


 <div class="modal" id="pro_detail">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ລາຍການຂາຍສິນຄ້າດ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
        
        <div id="display_product">     </div>
    
    <br>
    
   
    
    </div>
    
     <div  >
       &nbsp;   <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>
        </div>
    
    <br>
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

