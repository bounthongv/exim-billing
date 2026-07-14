<?php 
  include("init.php");
    
   
 
           @$receipt_id= mysqli_real_escape_string($con,$_POST['receipt_id']);		   
		 if($receipt_id==''){$r_id="";}  else{ $r_id="where  product_receipt.receipt_id='$receipt_id' ";}

		  
		  @$sp=mysqli_query($con,"
       SELECT product_receipt.*,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit ,tb_groups.Group_Name
		   FROM  product_receipt 
		left join products on products.Product_ID=product_receipt.product_id
       left join stocks on stocks.stock_id=product_receipt.stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id  
	   
	     $r_id     ");
		  if($sp){
          
          $output ='
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                	<th align="center">ເລກທີຮັບເຂົ້າ</th>
					<th align="center">ວັນທີ</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>
                    <th align="center" >ຈຳນວນ</th>
                    <th align="center" >ຫົວຫນ່ວຍ</th>
                    <th align="center" >ຂະຫນາດບັນຈຸ</th>
					<th align="center" >ລາຄາ</th>
                    <th align="center" >ເປັນເງີນ</th>
                </tr>
           ';
            while($s=mysqli_fetch_array($sp)){
            
			$output .='	<tr>
			    <td>'. $s["receipt_id"].'</td>
				<td>'. $s["receipt_date"].'</td>
            	<td>'. $s["Product_ID"].'&nbsp;'.$s["Product_Name"].'</td>
                <td>'.$s["qty"].' </td>
            	<td>'. $s["Unit"].'</td>
				
                <td align="center">'. $s["size"].'</td>
				 <td align="center">'. $s["price"].'</td>
				  <td align="center">'.@number_format($s["amount"],2).'</td>
				</tr>
                ';
				
            	@$total_amount+=$s["amount"];
             } 
		  $output .='	<tr>
		     <td colspan="7" align="center">ລວມ</td>
		     <td align="center">'.@number_format($total_amount,2).'</td>
		  </tr>  ';	 
       $output .='   </table>';
		  
          } 
		 


echo 	  $output; 

 
 
 ?>
