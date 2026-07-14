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
  

<div class="container">
    <br>
    <h3 align="center">ລາຍງານສັງລວມການຮັບ-ຈ່າຍສິນຄ້າ</h3><br>
   
<table> 

       <tr>
     <td> <br>  <a href="index.php"> <button type="button" name="reset" value="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
       
            
            <td>ຮູບແບບ <br>
              <select name="s" id="s" class="form-control" onChange="select_mode()">
              <option value="1">ວັນທີ</option>
              <option value="2">ເດືອນ</option>
              </select>
            </td>
    
        
       </tr>
       
       </table>     
       <table>
         <div id="display_mode">
           
      </div> 
       </table>  
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
 
 
 
<script>
  select_mode();
  function select_mode(){
	  
	  var s=$('#s').val();
	 // alert(stock_id);
   
         $.ajax({
				url:"fetch_select_mode.php",
				method:"POST",
				data:{  s:s },
				success:function(data)
				{
					$('#display_mode').html(data);

				}
			});
	  
	  }
	  function aa(){  
	 // alert('aa2');
	  var stock_id = $('#stock_id').val(); 
     var s = $('#s').val();   
      var m = $('#m').val();
     var y = $('#y').val();
 //  var product_id = $('#product_id').val(); 
     var group_id = $('#group_id').val(); 
   
  
   
         $.ajax({
				url:"fetch_summary_receipt_payment.php",
				method:"POST",
				data:{  stock_id:stock_id,m:m,y:y,group_id:group_id,s:s },
				success:function(data)
				{
					$('#head_list').html(data);

				}
			});

	  
	  
	   }
</script>
<script>

$(document).ready(function(){

 
// load_list();
 
 function load_list()
	{
			$.ajax({
			url:"fetch_summary_receipt_payment.php",
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
  $('#search_product2').click(function(){
   
  alert('s');
   var stock_id = $('#stock_id').val(); 
  var s = $('#s').val();   
   var m = $('#m').val();
   var y = $('#y').val();
 //  var product_id = $('#product_id').val(); 
   var group_id = $('#group_id').val(); 
   
  
   
         $.ajax({
				url:"fetch_summary_receipt_payment.php",
				method:"POST",
				data:{  stock_id:stock_id,m:m,y:y,group_id:group_id,s:s },
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
//   var sale_id = $('#sale_id').val();   
   var m = $('#m').val();
   var y = $('#y').val();
 //  var product_id = $('#product_id').val(); 
   var group_id = $('#group_id').val(); 


     window.open('print_summary_receipt_payment.php?stock_id='+stock_id + '&m='+m  + '&y='+y+ '&group_id='+group_id+' ','_blank'); 
   
 

	});
</script>
</div>
    <!-- /.container -->
    <br>
    <br>

</body>

</html>
