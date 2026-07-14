<?php 
include("init.php");
$office1=$_SESSION['office'];

$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<title>SPD</title>
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

<style type="text/css">
    @import url("LAOS/stylesheet.css");
body,td,th ,h1,h2,h3,h4,h5,h6,h7,small,input[type='button'],input[type='text'],input[type='submit'], a{
	font-family: LAOS;


}
.ui-autocomplete { font-family:"Phetsarath OT";}
	
</style>




<style>
#search{border:1px solid #008000; border-radius:4px; background-color:#008000; padding:5px; color:#FFF; font-family:"Phetsarath OT";}

input{padding:4px; border:1px solid #D8D8D8; border-radius:4px;}


</style>
<style>
td{ padding:10px;
font-weight:!important;
height:20px;
font-size:10px;
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
font-size:10px;
 }
</style>
<?php
    
   
       
         @$Truck_Number= mysqli_real_escape_string($con,$_GET['Truck_Number']);	

         if($Truck_Number==''){$Truck="";}else{ $Truck="and Truck_Number='$Truck_Number'";}
		  
         @$from_date= mysqli_real_escape_string($con,$_GET['from_date']);	
         @$to_date= mysqli_real_escape_string($con,$_GET['to_date']);	
       
         if($from_date=='' && $to_date=='')
         
         {$time="";}else{ 
           
           $time="and ( Sending_date between '$from_date' and '$to_date')";}
       
       
	
          ?>
        
<body onLoad="print()" >
<?php  $sql_office = mysqli_query($con," select * from office where Id='$office1' order by Id desc limit 1");  
	 $r=mysqli_fetch_array($sql_office);
	 ?>  
  
  <table width="800px"  align="center" >
    <tr>
    <td width="200px"><img src="<?php echo $r['path'] ?>" class="img-rounded" alt="Cinque Terre" width="100" height="35"> 
    <p><?php echo $r['office_name'] ?></p>
    </td>
    <td width="300px" align="center"><h6>ລາຍການ ໃບສົ່ງລັງແລະແກ້ວເປົ່າ</h6><br><h7>ປະຈຳວັນທີ &nbsp;<?php $date=date_create("$from_date");
echo date_format($date,"d/m/Y"); ?> &nbsp; - &nbsp; <?php $date=date_create("$to_date");
echo date_format($date,"d/m/Y"); ?> </h7>
</td>
    <td width="200px" align="center"><h6>&nbsp;&nbsp;</h6></td>
    </tr>
  </table>
 		<table border="1"  align="center"   class="table-bordered " width="800px" >
              <tr>
              <th>ລະຫັດ</th>
              <th>ວັນສົ່ງລັງ</th>
                <th>ເລກລົດ</th>
                <th>ຊື່ຄົນຂັບລົດ</th>
        
                <th>ຈຳນວນຮັບ</th>
              </tr>
           <?php
  
	  @$sp=mysqli_query($con,"SELECT * FROM tbl_emp_no where 1=1 $Truck $time and office_id='$office1' and username='$username'");

            while($s=mysqli_fetch_array($sp)){ ?>	
            <tr>
			 	<td ><?php echo $s['no'];?></td>
                <td ><?php 
                $date1=date_create($s['Sending_date']);
                echo date_format($date1,"d/m/Y");
                ?></td>
                <td ><?php echo $s['Truck_Number'];?></td>
                <td ><?php echo $s['Driver_Name'];?></td>
              
             
				</tr>
               


<?php /*
                <tr align="center" bgcolor="#F9F8FA"> 
       <th>ລຳດັບ</th>
       <th>ລາຍລະອຽດສິນຄ້າ</th>
                <th>ລະຫັດ</th>
                <th>ຫ.ໝ</th>
                <th>ປະເພດລັງ</th>
                <th>ຈຳນວນຮັບ</th>
          
    </tr>
*/ ?>


      <?php 

       // $amount_received=0;

	    $aa=1;



	    $sql2=mysqli_query($con,"SELECT tbl_empty_return_note.*,
         if(amount_received='' or amount_received is null,0,amount_received)as amount_received 
         from tbl_empty_return_note 
      where 
      tbl_empty_return_note.`no`='".$s['no']."' 
      and 
      tbl_empty_return_note.`office_id`='".$office1."' 
      and 
      tbl_empty_return_note.`username`='".$username."' 
      order by tbl_empty_return_note.fomu_id asc");
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
			$amount_received+=$f2['amount_received'];
         
          } ?>



			<?php } ?>
     

          
            </table>

            <br>

<?php   

$amount_received_1=mysqli_query($con,"SELECT tbl_empty_return_note.*,
         sum(if(amount_received='' or amount_received is null,0,amount_received))as amount_received 
         from tbl_empty_return_note 
      where 
      tbl_empty_return_note.`office_id`='$office1' 
      and tbl_empty_return_note.`username`='$username' 
      and `no` in (select `no` from tbl_emp_no where 1=1 $time and office_id='$office1' and tbl_emp_no.`username`='$username'  )

      order by tbl_empty_return_note.fomu_id asc");
      $fa_1 = mysqli_fetch_array($amount_received_1);
     


$amount_received_2=mysqli_query($con,"SELECT tbl_empty_return_note.*,
      sum(if(amount_received='' or amount_received is null,0,amount_received))as amount_received 
      from tbl_empty_return_note 
   where 
   tbl_empty_return_note.`office_id`='$office1' 
   and tbl_empty_return_note.`username`='$username' 
   and `no` in (select `no` from tbl_emp_no where 1=1 $time and office_id='$office1' and tbl_emp_no.`username`='$username' )
   order by tbl_empty_return_note.fomu_id asc");
   $fa_2 = mysqli_fetch_array($amount_received_2);


?>
       <table  align="center"   class="table-bordered " width="800px">
            <tr>
            <td align="center" colspan="5">ລວມ</td>
            <td align="center">ລັງເປົ່າ</td>
            <td ><?php echo $fa_1['amount_received'];;?></td>
            <td align="center">ລັງເຕັມ</td>
            <td ><?php echo $fa_2['amount_received'];;?></td>
            </tr>

       </table>
       
		  
      
