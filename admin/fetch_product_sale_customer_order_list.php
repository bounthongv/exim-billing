<?php 
  include("init.php");
    
	
/* if(empty($_SESSION["list_id"]))
{ 
     echo $_SESSION["list_id"]='0';
}else{ 
 echo 'dd'.$_SESSION["list_id"]+1; 
 
 }
*/


           @$gr_id= mysqli_real_escape_string($con,$_POST['gr_id']);		   
		/*  if($gr_id==''){$g_id=" and products.Group_ID!='001'";} 
		  else if($gr_id=='001'){ $g_id=" and products.Group_ID!='001' "; }
		   else{ $g_id="and products.Group_ID='$gr_id' ";}
		   */
		   
		     if($gr_id==''){$g_id="";} 		 
		   else{ $g_id="and products.Group_ID='$gr_id' ";}
		   
		  
		        @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);		   
		  if($stock_id==''){$s_id="";}  else{ $s_id="and  stock_product.stock_id='$stock_id' ";}
		  
		      @$price_type= mysqli_real_escape_string($con,$_POST['price_type']);		   
		  if($price_type==''){$pp=",products.Price ";}  
		  elseif($price_type=='001'){ $pp=",products.s1_price  as price";}
		  elseif($price_type=='002'){ $pp=",products.s2_price  as price";}
		  elseif($price_type=='003'){ $pp=",products.s3_price  as price";}

 if($price_type==''){ echo "<h3>ກະລຸນາເລືອກລູກຄ້າກ່ອນ</h3>";}
 else{		  
		  @$sp=mysqli_query($con," SELECT products.* $pp ,tb_stock_product.stock_qty
 
		             
		   FROM  products
        left join (select sum(qty) as stock_qty,product_id from stock_product where 1=1 $s_id  group by product_id ) as tb_stock_product
  on products.Product_ID=tb_stock_product.product_id
              where    1=1  $g_id order by products.Group_ID,products.Product_ID 
		    ");
		  if($sp){
          ?>
 <script>
 $('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
 </script>
          <input type="hidden" name="price_type_item" value="<?php echo $price_type;?>" />  
 			<table  border="1"  class="table-bordered" >
            	<tr class="bgtd" align="center"> 
                
                     <th align="center" ><input type="checkbox" name="select-all" id="select-all" /> ເລືອກ</th>
                     <th align="center"> ຮູບ</th>
                	 <th align="center">ຊື່ສິນຄ້າ</th>
					 <th align="center" >ໃນສາງ</th>                   
                     <th align="center" >ຫົວໜ່ວຍ</th>
					 <th align="center" >ລາຄາ</th>
                   
					
                    
                </tr>
         <?php  
		   $e=1;
            while($s=mysqli_fetch_array($sp)){
            ?>
		  <tr <?php if($s['Group_ID']=='001'){ echo 'style="background-color:#FFFFFF;"';}
				elseif($s['Group_ID']=='002'){ echo 'style="background-color:#E3FFE3;"';}
				elseif($s['Group_ID']=='003'){ echo 'style="background-color:#FFFFEE;"';} ?>  >
                 <td align="center">
       <!--<button type="button"  class="btn btn-success btn-sm add_pro"  id="<?=$s["Product_ID"];?>" value="<?=$s["Product_ID"];?>" data-dismiss="modal" ><i class="fa fa-check" aria-hidden="true"></i></button>-->
          <input type="checkbox" name="item_list[]" value="<?=$s["Product_ID"];?>" class="form-control"  />
               
                 </td>
              <td><img src="<?=$s["pic_url"];?>" width="50" /></td>
			 <td><?=$s["Product_ID"];?> &nbsp; <?=$s["Product_Name"];?></td>
				<td align="center"><?=$s["stock_qty"];?> </td>
               
            	<td align="center"><?=$s["Unit"];?></td>
				<td align="right"><?=@number_format($s["price"],2);?></td>
               
				
				<input type="hidden" name="Id[]" id="Id<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["Id"];?>" />
				<input type="hidden" name="Bar_Code[]" id="Bar_Code<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["Bar_Code"];?>" />
				<input type="hidden" name="Quantity[]" id="Quantity<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["QTY"];?>" />
				<input type="hidden" name="Unit[]" id="Unit<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["Unit"];?>" />
				<input type="hidden" name="ups[]" id="ups<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["ups"];?>" />
				
				<input type="hidden" name="Group_ID" id="Group_ID<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["Group_ID"];?>" />
				
				<input type="hidden" name="qty_limit[]" id="qty_limit<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["stock_qty"];?>" />
				<input type="hidden" name="Product_ID[]" id="Product_ID<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["Product_ID"];?>" />
                <input type="hidden" name="product_lot_id[]" id="product_lot_id<?=$s["Product_ID"];?>" class="form-control" value="<?=$s["product_lot_id"];?>" />
				<input type="hidden" name="product_quantity[]" id="quantity<?=$s["Product_ID"];?>" class="form-control" value="1" />
            	<input type="hidden" name="product_name[]" id="product_name<?=$s["Product_ID"];?>" value="<?=$s["Product_Name"];?>" />
            	<input type="hidden" name="product_price[]" id="price<?=$s["Product_ID"];?>" value="<?=$s["price"];?>" />
                
                <input type="hidden" name="pic[]" id="pic<?=$s["Product_ID"];?>" value="<?=$s["pic"];?>" />
                <input type="hidden" name="pic_url[]" id="pic_url<?=$s["Product_ID"];?>" value="<?=$s["pic_url"];?>" />
                
 
        
				
               <?php 
            $e++;	
             } 
      ?>   </table><?php
		  
          } 
		 

 }



 
 
 ?>
