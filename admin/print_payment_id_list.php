<?php 
include("init.php");

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
font-size:16px;
 }
 th{ background-color:#E0E0E0; text-align:center;
 padding:10px;
font-weight:!important;
height:40px;
font-size:20px;
 }


</style>
<?php 
  
    
         @$pay_id= mysqli_real_escape_string($con,$_GET['pay_id']);	
         if($pay_id==''){$p_id="";}  else{ $p_id="and payment_2.pay_id='$pay_id'  ";}
		 

		  @$sp1=mysqli_query($con,"SELECT payment_2.pay_id,payment_2.pay_date,tb_bank.Bank_account,tb_bank.Bank_Name,users.fname
          FROM payment_2
LEFT JOIN tb_bank ON payment_2.Bank_account = tb_bank.Bank_account
LEFT JOIN users ON payment_2.user_id = users.user_id 
  WHERE 1=1 $p_id");



          ?>
        
<body onLoad="print()" >
  <?php  $sql_office = mysqli_query($con," select * from office order by Id desc limit 1");  
	 $r=mysqli_fetch_array($sql_office);
	 ?>  
  <table width="800px"  align="center" >
    <tr>
    <td width="200px"><img src="<?php echo $r['path'] ?>" class="img-rounded" alt="Cinque Terre" width="80" height="50"> 
    <p><?php echo $r['office_name'] ?></p>
    </td>
    <td width="300px" align="center"><h5>ໃບບິນມອບເງິນສົດ</h5>
</td>
    <td width="200px" align="center"><h6>&nbsp;&nbsp;</h6></td>
    </tr>
  </table>

<?php 
$s1=mysqli_fetch_array($sp1);
$dd1=date_create($s1['pay_date']);
?>


<table border="0" align="center" width="800px">
  <tr>
    <td align="left">ເລກທີ:</td>
    <td ><?php echo $s1['pay_id']; ?></td>
    <td align="right">ວັນທີ:</td>
    <td ><?=date_format($dd1,"d/m/Y");?></td>
  </tr>

 <tr>
    <td align="left">ຜູ້ມອບ:</td>
    <td ><?php echo $s1['fname']; ?></td>
    <td align="right">ບັນຊີທະນາຄານ:</td>
    <td ><?php echo $s1['Bank_account'].' '.$s1['Bank_Name']; ?></td>
  </tr>

</table>



 		<table border="1"  align="center"   class="table-bordered " width="800px" >
              <tr>
                 <th align="center">ລ/ດ</th>
                <th align="center">ເລກທີບິນຂາຍ</th>
                <th align="center">ວັນທີຂາຍ</th>
                <th align="center">ຈຳນວນເງິນ</th>
        
               
          
             
              </tr>
           <?php

           $i=0;
            @$sp=mysqli_query($con,"SELECT payment_2.*,tb_bank.Bank_account,tb_bank.Bank_Name,users.fname
          FROM payment_2
LEFT JOIN tb_bank ON payment_2.Bank_account = tb_bank.Bank_account
LEFT JOIN users ON payment_2.user_id = users.user_id 
  WHERE 1=1 $p_id");
            while($s=mysqli_fetch_array($sp)){
            $dd=date_create("$s[sale_date]");

$i++;


			?>	<tr>
            <td><?=$i;?></td>
			<td align="center"><?= $s["sale_id"];?></td> 
			<td align="center"><?=date_format($dd,"d/m/Y");?></td>
            <td align="right"><?=@number_format($s["amount"],0);?></td>

             
				</tr>
               
			<?php	
	
				@$t_amt +=$s["amount"];
             } ?>
             <td colspan="3" align="right">ລວມ</td>
             <td colspan="1" align="right"><?=@number_format($t_amt,0);?></td>
         
             
             
       </table>
       
		  
<br>

    <table border="0" align="center" width="800px">
  <tr>
    <td align="left">ລາຍເຊັນຜູ້ຮັບເງິນ</td>
    <td align="right">ລາຍເຊັນຜູ້ມອບ</td>
  </tr>

</table>