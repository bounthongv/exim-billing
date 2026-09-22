<?php 
  include("init.php");
    /*
   echo $_SESSION['list_id']['07.003'];
   echo $_SESSION['list_id']['02.009'];
	*/
   

       @$select_mode= mysqli_real_escape_string($con,$_POST['select_mode']);
	   
	    
		  
		   @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		     @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
		   
         if($from_date=='' or $to_date==''){$btw="and customer_payment.payment_date='$today'";} 
		  else{ $btw="and customer_payment.payment_date between '$from_date' and '$to_date' ";}
		  
 
  @$sale_id= mysqli_real_escape_string($con,$_POST['sale_id']);		   
 if($sale_id==''){$r_id="";}  else{ $r_id="and ( customer_payment.sale_id like '$sale_id%' or customer_payment.sale_id like '%$sale_id%') ";}
		 

  @$payment_id= mysqli_real_escape_string($con,$_POST['payment_id']);		   
 if($payment_id==''){$p_id="";}  else{ $p_id="and ( customer_payment.payment_id like '$payment_id%' or customer_payment.payment_id like '%$payment_id%') ";}
/*
	 @$payment_type= mysqli_real_escape_string($con,$_POST['payment_type']);		   
    if($payment_type==''){$pt="";}  else{ $pt="and  customer_payment.payment_type='$payment_type'  ";}
		*/
		 
	
		 
		   @$customer_id= mysqli_real_escape_string($con,$_POST['customer_id']);	
         if($customer_id==''){$c_id="";}  else{ $c_id="and ( customer_payment.customer_id like '$customer_id%' 
		 or customer_payment.customer_id like '%$customer_id%' or customers.customer_name like '$customer_id%'
		 or customers.customer_name like '%$customer_id%')  ";}


  $list_id=$_SESSION['list_id'];

	 //@$list_id= mysqli_real_escape_string($con,$_POST['list_id']);

/*
if($_SESSION['list_id']['02.009']=='02.009'){
    $payment_type="and customer_payment.payment_type = '1'"; 
   }elseif($_SESSION['list_id']['07.003']=='07.003'){
    $payment_type="and customer_payment.payment_type = '2'";
   }
*/


/*
if($_SESSION['list_id_e']=='07.001'){
    $payment_type="and customer_payment.payment_type = '1'"; 
   }elseif($_SESSION['list_id_e']=='07.003'){
    $payment_type="and customer_payment.payment_type = '2'";
   }
*/

if($select_mode=='1'){


  @$sp=mysqli_query($con,"SELECT customer_payment.* ,customers.customer_name,
  customers.TIN,
  payment_2.pay_id,
  payment_2.pay_date,
  tb_bank.Bank_Name,
  tb_bank.Bank_account
		 from  customer_payment
		 left join customers on customer_payment.customer_id=customers.customer_id
		 left join payment_2 on customer_payment.sale_id=payment_2.sale_id
		 left join tb_bank on payment_2.Bank_account=tb_bank.Bank_account
		 
		 where 1=1 $btw $r_id $p_id $c_id and customer_payment.payment_type = '1' order by payment_date asc");
		  if($sp){
          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                    <th align="center">ລ/ດ</th>
                	<th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
                    <th align="center">ເລກທີຂາຍ</th>
					<th align="center">ວັນທີຂາຍ</th>
                  
					<th align="center">ຊື່ລູກຄ້າ</th>
					<th align="center">ເລກບິນອາກອນ</th>
					
                    <th align="center">ປະເພດຊຳລະ</th>              
					 
                    <th align="center" >ຈຳນວນເງີນ</th>
					<th align="center" >ວັນທີມອບ</th>
					<th align="center" >ເລກທີມອບ</th>
					<th align="center" >ທະນາຄານ</th>
					<th align="center" >ເລກບັນຊີ</th>
                
                </tr>
           <?php
		   
		   $e_list=0;
            while($s=mysqli_fetch_array($sp)){
				
				$e_list++;
				
				$date1=$s["sale_date"];
				$date1=date_create($date1);
				
				$date2=$s["payment_date"];
				$date2=date_create($date2);

				$date3=$s["pay_date"];
				$date3=date_create($date3);
				
            
			?>
            	<tr>
                <td align="center"><?=$e_list;?></td>
			    <td align="center"><?=$s["payment_id"];?></td>
				<td align="center"><?php if($s["payment_date"]==''){}else{
				echo date_format($date2,"d/m/Y");
					}?></td>
                <td align="center"><?=$s["sale_id"];?></td>
				
				<td align="center"><?php if($s["sale_date"]==''){}else{
				echo date_format($date1,"d/m/Y");
					}?></td>               
				<td><?=$s["customer_name"];?></td>
				<td align="center"><?=$s["TIN"];?></td>
                 <td align="center"><?php 
				 if($s["payment_type"]=='1'){ echo "ເງີນສົດ";}
				 elseif($s["payment_type"]=='2'){ echo "ເງີນໂອນ";}else{}  ?></td>
            	<td align="right"><?=@number_format($s["amount"],0);?></td>


                <td align="right"><?php echo @$s["pay_id"];?></td>
            	<td align="right"><?php 
				
				if($s["pay_date"]==''){echo '';}else{echo date_format($date3,"d/m/Y");}
				?></td>
				<td align="right"><?php echo @$s["Bank_Name"];?></td>
				<td align="right"><?php echo @$s["Bank_account"];?></td>


<?php /*
				<td align="center"><button type="button" class="btn btn-success btn-sm edit_Id" id="<?=$s["sale_id"];?>" data-payment_id="<?=$s["payment_id"];?>" >ແກ້ໄຂ</button></td>     
*/ ?>


				</tr>
              <?php
          
		   @$t_amt +=$s["amount"];
		 
             } 
			 ?>
			<tr>
			<td align="right" colspan="8">ລວມ</td>
            <td align="right"><?= @number_format($t_amt,0);?></td>
           
           
			
        </table>
		  
        <?php }
      }
		elseif($select_mode=='2'){ 
		
		  @$sp=mysqli_query($con,"SELECT customer_payment.* ,customers.customer_name
		 from  customer_payment

		 left join customers on customer_payment.customer_id=customers.customer_id
		 left join tb_bank on customer_payment.Bank_account=tb_bank.Bank_account
		 left join payment_2 on customer_payment.sale_id=payment_2.sale_id
		 where 1=1 $btw $r_id $c_id and customer_payment.payment_type = '1'
		 
		 group by customer_payment.payment_id");
		  if($sp){
          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                    <th align="center">ລ/ດ</th>
                	<th align="center">ເລກທີ</th>
					<th align="center">ວັນທີ</th>
                  
					<th align="center">ຊື່ລູກຄ້າ</th>              
					 
                    <th align="center" >ຈຳນວນເງີນ</th>
                 
                    
                </tr>
           <?php
		   
		   $e_list=0;
            while($s=mysqli_fetch_array($sp)){
				
				$e_list++;
            
			?>
            	<tr>
                <td align="center"><?=$e_list;?></td>
			    <td align="center"><?=$s["payment_id"];?></td>
				<td align="center"><?=$s["payment_date"];?></td>               
				<td align="center"><?=$s["customer_name"];?></td>
            	<td align="right"><?=@number_format($s["total_amount"],0);?></td>
                
            	
				
				</tr>
              <?php
          
		   @$t_amt +=$s["total_amount"];
		 
             } 
			 ?>
			<tr>
			<td align="right" colspan="4">ລວມ</td>
            <td align="right"><?= @number_format($t_amt,0);?></td>
           
           
			
        </table>
		
	<?php	
		  }
	     }else{}
		
		
		

 
 ?>
 <br /> <br /> <br />
