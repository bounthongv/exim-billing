<?php 



include("init.php");


if(isset($_GET['aksi']) == 'delete'){
				$Id = $_GET['Id'];
				$cek = mysqli_query($con, "SELECT * FROM tb_cta WHERE Id='$Id'");
				if(mysqli_num_rows($cek) == 0){
                echo "<script>
                alert('ບໍ່ພົບຂໍ້ມູນນີ້');
                window.location.href = 'Credit_Term_Agreement.php';
              </script>";
                    }else{
					$delete = mysqli_query($con, "DELETE FROM tb_cta WHERE Id='$Id'");
					if($delete){
					  echo "<script>
                    alert('ການລົບຂໍ້ມູນສຳເລັດ');
                    window.location.href = 'Credit_Term_Agreement.php';
                  </script>";
                        }else{
					 echo "<script>
                    alert('ການລົບຂໍ້ມູນບໍ່ສຳເລັດ');
                    window.location.href = 'Credit_Term_Agreement.php';
                  </script>";
                        }
				}
			}



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

  





<?php  include("header.php"); ?>


 <link rel="stylesheet" href="select2/select2.min.css">
<script src="select2/select2.full.min.js"></script>
<script>

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
 <script src="js/numeral.min.js"></script>
  <script>
/*
 load_product();
 load_list();
 
 function load_list()
	{
			$.ajax({
			url:"fetch_cta_list.php",
			method:"POST",
			//dataType:"json",
			success:function(data)
			{
				$('#head_list').html(data);
			}
		});
	}




$(function(){
  $('#search_product').click(function(){
   
 
  // var stock_id = $('#stock_id').val(); 
   var sale_id = $('#sale_id').val();   
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var status_payment = $('#status_payment').val();
   var customer_id = $('#customer_id').val();
    var status = $('#status').val();
	
	var sale_order_id = $('#sale_order_id').val();
   
   
 //  alert(stock_id);
   
         $.ajax({
				url:"fetch_cta_list.php",
				method:"POST",
data:{  from_date:from_date,to_date:to_date,sale_id:sale_id,status_payment:status_payment,customer_id:customer_id,status:status,sale_order_id:sale_order_id },
				success:function(data)
				{
					$('#head_list').html(data);

				}
			});

  });

 });
*/




$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    // ຮັນທັງ 2 function ແຍກກັນ ເພື່ອບໍ່ໃຫ້ error ໜຶ່ງບລັອກອີກອັນ
    try {
      load_product();
    } catch (e) {
      console.error('load_product error:', e);
    }

    load_list();
  });

  function load_list() {
    $.ajax({
      url: "fetch_cta_list.php",
      method: "POST",
      success: function (data) {
        $('#head_list').html(data);
      },
      error: function (xhr, status, error) {
        // ຖ້າມີບັນຫາ ຈະເຫັນລາຍລະອຽດຢູ່ Console
        console.error('AJAX Error:', status, error);
        console.error('Response:', xhr.responseText);
        $('#head_list').html('<p style="color:red">ໂຫລດຂໍ້ມູນບໍ່ໄດ້ - ກະລຸນາກວດສອບ Console</p>');
      }
    });
  }




$(function(){
  $('#search_product').click(function(){
   
 
  
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();

   
   
 //  alert(stock_id);
   
         $.ajax({
				url:"fetch_cta_list.php",
				method:"POST",
data:{  from_date:from_date,to_date:to_date },
				success:function(data)
				{
					$('#head_list').html(data);

				}
			});

  });

 });



</script>


<body>


<div class="container">
    <br>
    <h3 align="center">ໃບສັນຍາການໃຫ້ເຄດິດຮ້ານຄ້າ</h3><br>
   </div>


<table>
       <tr>
     <td> <br>  <a href="index.php"> <button type="button" name="reset" value="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
       <td> <br><a href="add_cta.php"  ><button type="button" class="btn btn-success" >
            <i class="fa fa-plus-square"></i>&nbsp; ເພິ່ມ</button></a></td>
            
            
            <td>ວັນທີ<br><input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date("Y-m-d"); ?>"></td> 
            
            <td>ຫາ<br><input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d"); ?>"></td> 
      

 <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>


</table>

<br>
<div class="tableFixHead">  
 <div class="container_xx">    

             <div id="head_list" align="center"></div>

  </div>
</div>


</body>

</html>





<script>
</script>