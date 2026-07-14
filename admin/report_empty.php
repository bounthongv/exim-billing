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
				url:"fetch_report_empty.php",
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

  var date = $('#date').val();
  

$.ajax({
				url:"fetch_report_empty.php",
				method:"POST",
				data:{  date:date },
				success:function(data)
				{
					$('#display_cart_receipt').html(data);

				}
			});

    });









	$(document).on('click', '.print_Id', function(){
	
    var no = $(this).attr("id");

window.open('print_empty_return_note.php?no='+no+'','_blank');



});	  	  




$(document).on('click', '#print_Id_2', function(){
	
  var Truck_Number = $('#Truck_Number').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();



window.open('print_empty_return_note_2.php?Truck_Number='+Truck_Number+'&from_date='+from_date+'&to_date='+to_date+'','_blank');



});	  	 




</script>
<div class="container">
    <br>
    <h3 align="center">ລາຍການ ໃບສົ່ງລັງແລະແກ້ວເປົ່າ</h3><br>
   
<table>
<tr>
    <td><br><a href="index.php"><button type="button" name="close"  class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;ປິດ</button></a></td>


    

    <td>ວັນທີ<br><input type="date" class="form-control" name="date" id="date" value="<?php echo date("Y-m-d"); ?>"></td> 
            


    <td><br><button type="button" class="btn btn-info" id="search_product"><i class="fa fa-search"></i> ຄົ້ນຫາ</button> </td>


    <td><br><button type="button" class="btn btn-warning" id="print_Id_2"><i class="fa fa-print"></i> ພິມ</button></td>


        <!-- Content Row -->

      </tr>
      </table>
        <div class="row">
        <div class="col-lg-12">
        
<br>
<!--  display_cart_receipt -->
<div id="display_cart_receipt">

            <?PHP
			

mysqli_query($con,"SELECT *,sum(amount_received) FROM tbl_emp_no 
left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no 
where tbl_empty_return_note.Item_number='EHP'
group by tbl_emp_no.Truck_Number"); 

/*
            mysqli_query($con,"SELECT * FROM WHERE office_id='$office1' and username='$username'"); 
*/


            mysqli_query($con,"TRUNCATE table_empty");


            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT sum(amount_received),0,0,0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='EHQ2' group by tbl_emp_pay_out_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,sum(amount_received),0,0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='EHQ1' group by tbl_emp_pay_out_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,sum(amount_received),0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='EHP2' group by tbl_emp_pay_out_no.Truck_Number"); 

            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,sum(amount_received),0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='EHP1' group by tbl_emp_pay_out_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,sum(amount_received),0,0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ENQ2' group by tbl_emp_pay_out_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,sum(amount_received),0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ENQ1' group by tbl_emp_pay_out_no.Truck_Number"); 

            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,sum(amount_received),0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ERP2' group by tbl_emp_pay_out_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,sum(amount_received),0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ERP1' group by tbl_emp_pay_out_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,sum(amount_received),0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ERQ2' group by tbl_emp_pay_out_no.Truck_Number"); 

            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,sum(amount_received),0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ERQ1' group by tbl_emp_pay_out_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,sum(amount_received),0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='HD20L' group by tbl_emp_pay_out_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,sum(amount_received),0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='HD30L' group by tbl_emp_pay_out_no.Truck_Number"); 

            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,0,sum(amount_received),0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='Empty-CO2' group by tbl_emp_pay_out_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,0,0,sum(amount_received) FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='Pallet' group by tbl_emp_pay_out_no.Truck_Number"); 


            mysqli_query($con,"INSERT into table_empty (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet,total,comment) SELECT sum(HQ_crate),sum(HQ_glasses),sum(HP_crate),sum(HP_glasses),sum(NQ_crate),sum(NQ_glasses),sum(RP_crate),sum(RP_glasses),sum(RQ_crate),sum(RQ_glasses),sum(HD20L),sum(HD30L),sum(`Empty-CO2`),sum(`Pallet`),
            sum(if(HQ_crate='',0,HQ_crate))+sum(if(HQ_glasses='',0,HQ_glasses))+sum(if(HP_crate='',0,HP_crate))+sum(if(HP_glasses='',0,HP_glasses))+sum(if(NQ_crate='',0,NQ_crate))+sum(if(NQ_glasses='',0,NQ_glasses))+sum(if(RP_crate='',0,RP_crate))+sum(if(RP_glasses='',0,RP_glasses))+sum(if(RQ_crate='',0,RQ_crate))+sum(if(RQ_glasses='',0,RQ_glasses))+sum(if(HD20L='',0,HD20L))+sum(if(HD30L='',0,HD30L))+sum(if(`Empty-CO2`='',0,`Empty-CO2`))+sum(if(`Pallet`='',0,`Pallet`))
            ,'ຍອດຮັບເຂົ້າ' FROM table_empty_help"); 



            mysqli_query($con,"TRUNCATE table_empty_help");

/////



mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT sum(amount_received),0,0,0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='EHQ2' group by tbl_emp_no.Truck_Number"); 
mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,sum(amount_received),0,0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='EHQ1' group by tbl_emp_no.Truck_Number"); 
mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,sum(amount_received),0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='EHP2' group by tbl_emp_no.Truck_Number"); 

mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,sum(amount_received),0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='EHP1' group by tbl_emp_no.Truck_Number"); 
mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,sum(amount_received),0,0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ENQ2' group by tbl_emp_no.Truck_Number"); 
mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,sum(amount_received),0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ENQ1' group by tbl_emp_no.Truck_Number"); 

mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,sum(amount_received),0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ERP2' group by tbl_emp_no.Truck_Number"); 
mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,sum(amount_received),0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ERP1' group by tbl_emp_no.Truck_Number"); 
mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,sum(amount_received),0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ERQ2' group by tbl_emp_no.Truck_Number"); 

mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,sum(amount_received),0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ERQ1' group by tbl_emp_no.Truck_Number"); 
mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,sum(amount_received),0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='HD20L' group by tbl_emp_no.Truck_Number"); 
mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,sum(amount_received),0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='HD30L' group by tbl_emp_no.Truck_Number"); 

mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,0,sum(amount_received),0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='Empty-CO2' group by tbl_emp_no.Truck_Number"); 
mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,0,0,sum(amount_received) FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='Pallet' group by tbl_emp_no.Truck_Number"); 



mysqli_query($con,"INSERT into table_empty (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet,total,comment) SELECT sum(HQ_crate),sum(HQ_glasses),sum(HP_crate),sum(HP_glasses),sum(NQ_crate),sum(NQ_glasses),sum(RP_crate),sum(RP_glasses),sum(RQ_crate),sum(RQ_glasses),sum(HD20L),sum(HD30L),sum(`Empty-CO2`),sum(`Pallet`),
sum(if(HQ_crate='',0,HQ_crate))+sum(if(HQ_glasses='',0,HQ_glasses))+sum(if(HP_crate='',0,HP_crate))+sum(if(HP_glasses='',0,HP_glasses))+sum(if(NQ_crate='',0,NQ_crate))+sum(if(NQ_glasses='',0,NQ_glasses))+sum(if(RP_crate='',0,RP_crate))+sum(if(RP_glasses='',0,RP_glasses))+sum(if(RQ_crate='',0,RQ_crate))+sum(if(RQ_glasses='',0,RQ_glasses))+sum(if(HD20L='',0,HD20L))+sum(if(HD30L='',0,HD30L))+sum(if(`Empty-CO2`='',0,`Empty-CO2`))+sum(if(`Pallet`='',0,`Pallet`))
,'ຍອດຈ່າຍອອກ' FROM table_empty_help"); 



$keep=mysqli_query($con,"SELECT * FROM table_empty WHERE  comment='ຍອດຮັບເຂົ້າ'");
$k=mysqli_fetch_array($keep);

$payout=mysqli_query($con,"SELECT * FROM table_empty WHERE  comment='ຍອດຈ່າຍອອກ'");
$po=mysqli_fetch_array($payout);


$HQ_crate=$k['HQ_crate']-$po['HQ_crate'];
$HQ_glasses=$k['HQ_glasses']-$po['HQ_glasses'];
$HP_crate=$k['HP_crate']-$po['HP_crate'];
$HP_glasses=$k['HP_glasses']-$po['HP_glasses'];
$NQ_crate=$k['NQ_crate']-$po['NQ_crate'];
$NQ_glasses=$k['NQ_glasses']-$po['NQ_glasses'];
$RP_crate=$k['RP_crate']-$po['RP_crate'];
$RP_glasses=$k['RP_glasses']-$po['RP_glasses'];
$RQ_crate=$k['RQ_crate']-$po['RQ_crate'];
$RQ_glasses=$k['RQ_glasses']-$po['RQ_glasses'];
$HD20L=$k['HD20L']-$po['HD20L'];
$HD30L=$k['HD30L']-$po['HD30L'];
$Empty_CO2=$k['Empty-CO2']-$po['Empty-CO2'];
$Pallet=$k['Pallet']-$po['Pallet'];
$total=$k['total']-$po['total'];


mysqli_query($con,"INSERT into table_empty (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet,total,`comment`) 
VALUES('$HQ_crate','$HQ_glasses','$HP_crate','$HP_glasses','$NQ_crate','$NQ_glasses','$RP_crate','$RP_glasses','$RQ_crate','$RQ_glasses','$HD20L','$HD30L','$Empty_CO2','$Pallet','$total','ຍອດຄົງເຫຼືອ')"); 



            mysqli_query($con,"TRUNCATE table_empty_help");
           


            $i=1;

			$vg=mysqli_query($con,"SELECT * FROM table_empty"); ?>
            <table border='1'  class="table-bordered" width="100%">
              <tr class="bgtd">

                <th>No</th>
                <th>HQ/ລັງ</th>
                <th>HQ/ແກ້ວ</th>
                <th>HP/ລັງ</th>
                <th>HP/ແກ້ວ</th>
                <th>NQ/ລັງ</th>
                <th>NQ/ແກ້ວ</th>
                <th>RP/ລັງ</th>
                <th>RP/ແກ້ວ</th>
                <th>RQ/ລັງ</th>
                <th>RQ/ແກ້ວ</th>
                <th>HD20L/ຖັງ</th>
                <th>HD30L/ຖັງ</th>
                <th>Empty-CO2</th>
                <th>Pallet</th>
                <th>ລວມ</th>
                <th width="100px">&nbsp;</th>
              </tr>
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
                    ?>
                <tr>
    
              	<td><?php echo $i;?></td>
    
                <td><?php echo $p['HQ_crate'];?></td>
                <td><?php echo $p['HQ_glasses'];?></td>
                <td><?php echo $p['HP_crate'];?></td>
                <td><?php echo $p['HP_glasses'];?></td>
                <td><?php echo $p['NQ_crate'];?></td>
                <td><?php echo $p['NQ_glasses'];?></td>
                <td><?php echo $p['RP_crate'];?></td>
                <td><?php echo $p['RP_glasses'];?></td>
                <td><?php echo $p['RQ_crate'];?></td>
                <td><?php echo $p['RQ_glasses'];?></td>
                <td><?php echo $p['HD20L'];?></td>
                <td><?php echo $p['HD30L'];?></td>
                <td><?php echo $p['Empty-CO2'];?></td>
                <td><?php echo $p['Pallet'];?></td>
                <td><?php echo $p['total'];?></td>
                <td><?php echo $p['comment'];?></td>

                
              <?PHP
            $i++;
            
            } ?>

            </table>
  </div>



</div>
<?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?> 
    <!-- /.container -->
    <br>
    <br>

</body>

</html>

