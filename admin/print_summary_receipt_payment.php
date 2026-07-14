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
 }
 th{ background-color:#E0E0E0; text-align:center;
 padding:10px;
font-weight:!important;
height:40px;
font-size:10px;
 }
</style>
  <?php  
   
       
       @$stock_id= mysqli_real_escape_string($con,$_GET['stock_id']);	
         if($stock_id==''){$s_id=""; $s_id2="";}  else{ $s_id="and stock_id='$stock_id'  "; $s_id2="and stock_product.stock_id='$stock_id'  ";}
		 
       
		  
		   @$m= mysqli_real_escape_string($con,$_GET['m']);	
		   @$y= mysqli_real_escape_string($con,$_GET['y']);	
		   
		   if($m==""){ $m=date('m');}
		   if($y==""){ $y=date('Y');}

		  @$group_id= mysqli_real_escape_string($con,$_GET['group_id']);		   
		 if($group_id==''){$g_id="";}  else{ $g_id="and  products.Group_ID='$group_id' ";}
		 
		 
		 
		  @$sql_p=mysqli_query($con," select * from products where 1=1 $g_id ");

		  
		 
		 
		  
		  
		 
          ?>
  <body onLoad="print()" >
  
  <table width="800px"  align="center" >
  <?php  $sql_office = mysqli_query($con," select * from office order by Id desc limit 1");  
	 $r=mysqli_fetch_array($sql_office);
	 ?>  
    <tr>
    <td width="200px"><img src="<?php echo $r['path'] ?>" class="img-rounded" alt="Cinque Terre" width="80" height="50"> 
    <p><?php echo $r['office_name'] ?></p>
    </td>
    <td width="300px" align="center"><h6>ລາຍງານສັງລວມການຮັບ-ຈ່າຍສິນຄ້າ</h6><br><h7>ປະຈຳເດືອນ &nbsp;<?php echo $m.'/'.$y;?> &nbsp; 
</td>
    <td width="200px" align="center"><h6>&nbsp;&nbsp;</h6></td>
    </tr>
  </table>
 		
         		<table border="1"   class="table-bordered " >
              <tr>
                <th  rowspan="2" align="center">ລຳດັບ</th>
                <th  rowspan="2" align="center">ລະຫັດສິນຄ້າ</th>
                <th  rowspan="2" align="center">ຊື່ສິນຄ້າ</th>
                <th  rowspan="2" align="center">ຫົວໜ່ວຍ</th>
                
				<th  rowspan="2" align="center">ລາຄາ</th>
                <th  colspan="2" align="center">ຍອດຍົກ</th>
                <th colspan="2" align="center">ຮັບເຂົ້າ</th>
               
                <th colspan="2" align="center">ຈ່າຍອອກ</th>
                <th  colspan="2" align="center">ຍັງເຫຼືອ</th>
                 
              </tr>
             <tr>
                <th align="center">ຈຳນວນ</th>
                <th align="center">ມູນຄ່າ</th>               
                <th align="center">ຈຳນວນ</th>
                <th align="center">ມູນຄ່າ</th>
                <th align="center">ຈຳນວນ</th>
                <th align="center">ມູນຄ່າ</th>
                <th align="center">ຈຳນວນ</th>
                <th align="center">ມູນຄ່າ</th>
             </tr>
           <?php
		   $i=1;
		   
		   
		  
				
  @$sql_d=mysqli_query($con," select * from summary_receipt_payment where 1=1 and qty !=0
	   
	          ");
			  ?>
			 
             
         
			<?  
			 while($s=mysqli_fetch_array($sql_d)){
			?>	<tr>
                <td align="center"><?=$i;?></td>
			    <td colspan='1' align="center"><?php  echo $s['Product_ID'];?></td>
                <td align="left"><?=$s["Product_Name"];?></td>
				<td align="center"><?=$s["unit"];?></td>
                
                <td align="right"><?=@number_format($s["pprice"],2);?></td> 
                <td align="right"><?=@number_format($s["open_qty"],2);?></td>                
                <td align="right"><?=@number_format($s["open_amt"],2);  ?></td>
                
                <td align="right"><?=@number_format($s["r_qty"],2);?></td>                
                <td align="right"><?=@number_format($s["r_amt"],2);  ?></td>
                
				<td align="right"><?=@number_format($s["s_qty"],2);?></td>                
                <td align="right"><?=@number_format($s["s_amt"],2);  ?></td>
                
                <td align="right"><?=@number_format($s["qty"],2);?></td>                
                <td align="right"><?=@number_format($s["qty"]*$s["pprice"],2);  ?></td>
                
				</tr>
               
			<?php	
		
			$i++;
             
			 @$t_oqty +=$s['open_qty'];
			 @$t_oamt +=$s['open_amt'];
			 
			 @$t_rqty +=$s['r_qty'];
			 @$t_ramt +=$s['r_amt'];
			 
			 @$t_sqty +=$s['s_qty'];
			 @$t_samt +=$s['s_amt'];
			 
			 @$t_qty +=$s['qty'];
			 @$t_amt +=$s['qty']*$s['pprice'];
			 }
			  ?>
              <tr>
             <td colspan="5" align="right">ລວມຍອດ</td>
             <td colspan="1" align="right"><?=@number_format($t_oqty,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_oamt,2);?></td>
             
             <td colspan="1" align="right"><?=@number_format($t_rqty,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_ramt,2);?></td>
             
             <td colspan="1" align="right"><?=@number_format($t_sqty,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_samt,2);?></td>
             
             <td colspan="1" align="right"><?=@number_format($t_qty,2);?></td>
             <td colspan="1" align="right"><?=@number_format($t_amt,2);?></td>
            
             </tr> 
       </table>
        
</body>		  
        <?php  


			
 
 ?>
