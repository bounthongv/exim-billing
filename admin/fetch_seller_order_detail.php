<?php 
  include("init.php");
    
   
 
           @$order_id= mysqli_real_escape_string($con,$_POST['order_id']);		   
		 if($order_id==''){$or_id="";}  else{ $or_id="where  seller_orders.order_id='$order_id' ";}

		  
		  @$sp=mysqli_query($con,"
       SELECT seller_orders.*,stocks.stock_name,products.Product_ID,products.Product_Name,products.size,products.Unit ,tb_groups.Group_Name
		   FROM  seller_orders 
		left join products on products.Product_ID=seller_orders.product_id
       left join stocks on stocks.stock_id=seller_orders.stock_id
       left join tb_groups on tb_groups.Group_ID=products.group_id  
	   
	     $or_id     ");
		  if($sp){
          
          $output ='
 			<table id="myTable" border="1"  class="table-bordered" align="left">
            	<tr>
                	<th align="center">ເລກທີ</th>
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
			    <td align="center">'. $s["order_id"].'</td>
				<td align="center">'. $s["order_date"].'</td>
            	<td align="left">'. $s["Product_ID"].'&nbsp;'.$s["Product_Name"].'</td>
                <td align="center">'.$s["qty"].' </td>
            	<td align="center">'. $s["Unit"].'</td>
				<td align="center">'. $s["size"].'</td>
                <td align="center">'. $s["price"].'</td>
				<td align="right">'. $s["amount"].'</td>
				</tr>
                ';
            	@ $t_amount+=$s["amount"];
             } 

	   
	    $output .='  <tr>
		<td align="right" colspan="7">ລວມ</td>
		<td align="right">'.@number_format($t_amount,2).'</td>
		              </tr>';
		    $output .='   </table>';
          } 
		 


echo 	  $output; 

 
 
 ?>
