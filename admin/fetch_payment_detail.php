<?php 
  include("init.php");
    
   
      
		  
 
        @$pay_id= mysqli_real_escape_string($con,$_POST['pay_id']);		   
		 if($pay_id==''){$r_id="";}  else{ 
			
		 $r_id="and  payment_2.pay_id='$pay_id' ";
		 
/*
		$r_id="and Invoice_Number='$sale_id' ";
*/

		 }
		
		
		 if($pay_id==''){}
		 else{
		 

		  @$sp=mysqli_query($con,"SELECT * FROM  payment_2 where 1=1 $r_id");

		  if($sp){
          ?>
          
 			<table id="myTable" border="1"  class="table-bordered" align="left" style="width:80%">
            	<tr>
                	<th align="center">ເລກທີມອບ</th>
					<th align="center">ວັນທີມອບ</th>
					<th align="center">ເລກທີຂາຍ</th> 
                    <th align="center">ລາຄາ</th>
                
                    
                </tr>
           <?php
            while($s=mysqli_fetch_array($sp)){
            
                $pay_date=$s["pay_date"];
				$pay_date=date_create($pay_date);


			?>
            	<tr>
			    <td align="center"><?=$s["pay_id"];?></td>
				<td align="center"><?php if($s["pay_date"]==''){echo '';}else{echo date_format($pay_date,"d/m/Y");} ?></td>
				<td align="center"><?=$s["sale_id"];?></td>
                <td align="right"><?=@number_format($s["amount"],0);?></td>


				</tr>
              <?php
	
		   @$t_last_amount += $s["amount"];
             } 
			 ?>
			<tr>
			<td align="right" colspan="3">ລວມ</td>
            <td align="right"><?=@number_format($t_last_amount,0);?></td>
			</tr> 
           
			
        </table>
		<?php
		  
          } 
		 }
 
 ?>
 
            
 
