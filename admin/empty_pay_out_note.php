<?php 
include("init.php");
$office1=$_SESSION['office'];

$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];
?>
<style>
td{ padding:10px;
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

  

<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

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
.nn{ width:250px;}
.nnn{ width:100px;}
</style>


<script src="js/numeral.min.js"></script>
<script>



/*
$(function(){
  $('#search_product').click(function(){
   
   var Truck_Number = $('#Truck_Number').val();

alert(Truck_Number);
        $.ajax({
				url:"fetch_empty_pay_out_note.php",
				method:"POST",
				data:{ Truck_Number:Truck_Number },
				success:function(data)
				{
					$('#display_cart_receipt').html(data);

				}
			});

  });

 });
*/

$(document).on('click', '#search_product', function(){

  var Truck_Number = $('#Truck_Number').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();


  
  
$.ajax({
				url:"fetch_empty_pay_out_note.php",
				method:"POST",
				data:{  Truck_Number:Truck_Number,from_date:from_date,to_date:to_date },
				success:function(data)
				{
					$('#display_cart_receipt').html(data);

				}
			});

    });







	
	$(document).on('click', '.delete_Id', function(){
	
		var Id = $(this).attr("Id");

        var no = $(this).attr("data-no"); 	


  var r = confirm("ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?");
  if (r == true) {
     window.location = 'delete_empty_pay_out_note.php?no='+no+'';
  } 
 

	});


	$(document).on('click', '.print_Id', function(){
	
    var no = $(this).attr("id");

window.open('print_empty_pay_out_note.php?no='+no+'','_blank');



});	  	  




$(document).on('click', '#print_Id_2', function(){
	
  var Truck_Number = $('#Truck_Number').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();



window.open('print_empty_pay_out_note_2.php?Truck_Number='+Truck_Number+'&from_date='+from_date+'&to_date='+to_date+'','_blank');



});	  	 




</script>
<div class="container">
    <br>
    <h3 align="center">ລາຍການ ໃບຈ່າຍອອກລັງແລະແກ້ວເປົ່າ</h3><br>
   
<table>
<tr>
    <td><br><a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>
    <td><br><a href="add_emp_pay_out.php"><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມໃໜ່</button></a></td>


            <td>
            ເລກລົດ:<br>
            <select name="Truck_Number" id="Truck_Number" class="form-control" > 
    <option value="">ທັງໝົດ</option>
    <?php 
    $sql =mysqli_query($con,"SELECT stocks.stock_name,sr_list.sr_fname
    FROM stocks 
    LEFT JOIN sr_list ON stocks.stock_name=sr_list.truck_registration
    where stocks.office_id='$office1'");
      while($f = mysqli_fetch_array($sql)){
    ?>
        <option value="<?php echo $f['stock_name'];?>"
        data-sr_fname="<?php echo $f['sr_fname']; ?>"
        
        ><?php echo $f['stock_name'];?></option>
        <?php } ?>
    </select>
    </td>
    

    <td>ວັນທີ<br><input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date("Y-m-d"); ?>"></td> 
            
    <td>ຫາ<br><input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d"); ?>"></td> 
      


    <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button> </td>


    <td><br><button type="button" class="btn btn-warning" id="print_Id_2"><i class="fa fa-print"></i> ພິມ</button></td>


        <!-- Content Row -->

      </tr>
      </table>
        <div class="row">
        <div class="col-lg-12">
        
<br>

<div id="display_cart_receipt">

            <?PHP
			
			$vg=mysqli_query($con,"SELECT * FROM tbl_emp_pay_out_no where office_id='$office1' and username='$username'"); ?>
            <table border='1'  class="table-bordered" width="90%">
              <tr class="bgtd">
              <th></th>
                <th>No</th>
                <th>ວັນສົ່ງລັງ</th>
                <th>ເລກລົດ</th>
                <th>ຊື່ຄົນຂັບລົດ</th>
                <th>ແກ້ໄຂ</th>
                 <th>ລົບ</th>
                 <th>ພິມ</th>
              </tr>
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
                    ?>
                <tr>
                <td class="save1" data-toggle="collapse" data-target="#group-of-rows-<?php echo $p['no'];?>" aria-expanded="false" aria-controls="group-of-rows-<?php echo $p['no'];?>" ><i class="fa fa-plus"></i></td>

              	<td ><?php echo $p['no'];?></td>
                <td ><?php 
                $date1=date_create($p['Sending_date']);
                echo date_format($date1,"d/m/Y");
                ?></td>
                <td ><?php echo $p['Truck_Number'];?></td>
                <td ><?php echo $p['Driver_Name'];?></td>
                
                <td width="50" class="save1" align="center"><a href="edit_emp_pay_out.php?no=<?php echo $p['no'];?>"><button class="btn btn-success btn-sm"><i class="fa fa-edit"></i> ແກ້ໄຂ</button></a></td>

                <td ><button class="btn btn-danger btn-sm delete_Id" value="<?php echo $p['Id'];?>" data-no="<?php echo $p['no'];?>" id="<?php echo $p['Id'];?>" >ລົບ</button></td>

                <td ><button class="btn btn-warning print_Id" value="<?php echo $p['no'];?>"  id="<?php echo $p['no'];?>" >ພິມ</button></td>

      <tbody id="group-of-rows-<?php echo $p['no'];?>" class="collapse">
      <td colspan="12" align="left">
      <table width="90%">
       <tr align="center" bgcolor="#F9F8FA"> 
       <th>ລຳດັບ</th>
       <th>ລາຍລະອຽດສິນຄ້າ</th>
                <th>ລະຫັດ</th>
                <th>ຫ.ໝ</th>
    
                <th>ຈຳນວນຈ່າຍ</th>
          
    </tr>
      <?php 
	    $aa=1;
	    $sql2=mysqli_query($con,"SELECT tbl_empty_pay_out_note.* from tbl_empty_pay_out_note 
      where 
      tbl_empty_pay_out_note.`no`='".$p['no']."' 
      and 
      tbl_empty_pay_out_note.`office_id`='".$office1."' 
      and 
      tbl_empty_pay_out_note.username='".$username."' 
      order by tbl_empty_pay_out_note.fomu_id asc");
      while($f2 = mysqli_fetch_array($sql2)){
	   ?>
	  
        <tr bgcolor="#FFFFFF">
          <td class="save1" align="center"> <?php echo $aa; ?></td>
          <td ><?php echo $f2['Description'];?></td>
                <td ><?php echo $f2['Item_number'];?></td>
                <td ><?php echo $f2['UOM'];?></td>
     
                <td ><?php echo $f2['amount_received'];?></td>
        </tr>
           <?php $aa++; 
			

          } ?>

    
       
        </table>
        </td>
    </tbody>  



              <?PHP } ?>

            </table>
  </div>



</div>
<?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
    <!-- /.container -->
    <br>
    <br>

</body>

</html>

