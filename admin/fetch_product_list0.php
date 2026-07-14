<?php 
  include("init.php");
  $office1=$_SESSION['office'];
            @$stock_id= mysqli_real_escape_string($con,$_POST['stock_id']);	
         if($stock_id==''){$s_id="";}  else{ $s_id="and stock_product.stock_id='$stock_id'  ";}
		 
		  @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
		   @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	
		   $today=date("Y-m-d");
         if($from_date=='' or $to_date==''){$dd="and stock_product.stockin_date='$today'";} 
		  else{ $dd="and stock_product.stockin_date between '$from_date' and '$to_date' ";}
		  
		 
           @$gr_id= mysqli_real_escape_string($con,$_POST['gr_id']);		   
		  if($gr_id==''){$g_id="";}  else{ $g_id="and tb_groups.Group_ID='$gr_id' ";}
		  
		  @$product_id= mysqli_real_escape_string($con,$_POST['product_id']);		   
		  if($product_id==''){$p_id="";}  else{ $p_id="and ( stock_product.product_id like '$product_id%' or stock_product.product_id like '%$product_id%' ) ";}
		 
		  		  @$product_name= mysqli_real_escape_string($con,$_POST['product_name']);		   
		  if($product_name==''){$name="";}  else{ $name="and (products.Product_Name like '$product_name%' or products.Product_Name like '%$product_name%')";}


"SELECT 
       products.Id,
       products.Product_ID,
       products.Bar_Code,
       products.Product_Name,
       products.size,
       products.Unit,
       products.QTY,
       products.`version`,
       products.ups,
       products.Group_ID,
       products.s1_price,
       products.s2_price,
       products.s3_price,
       products.s4_price,
       products.`function`,
       products.seven_eleven,
       /*products.crate_price,*/
       products.Product_Name,
       products.Product_Name_EN,
       products.Price,
       /*products.pic_url,*/

       tb_groups.Group_Name,tb_stock_product.stock_qty as total_qty FROM products 
	   
	    left join (select sum(qty) as stock_qty,product_id from stock_product where 1=1 $s_id  group by product_id ) as tb_stock_product
  on products.Product_ID=tb_stock_product.product_id
	   
	   
      
       left join tb_groups on tb_groups.Group_ID=products.group_id
       
       
       where    1=1   $g_id   group by products.Product_ID  order by products.Group_ID,products.Product_ID asc 
		  ";






		  @$sp=mysqli_query($con,"SELECT products.*,products.Product_ID
		  ,products.Product_Name,products.size,products.Unit
      ,if(products.crate_price ='',0,products.crate_price) as crate_price
		  ,tb_groups.Group_Name
      ,if(products.s1_price='',0,products.s1_price) as s1_price
      ,if(products.s2_price='',0,products.s2_price) as s2_price
      ,if(products.s3_price='',0,products.s3_price) as s3_price
      ,if(products.s4_price='',0,products.s4_price) as s4_price
      ,if(tb_stock_product.stock_qty is null,0,tb_stock_product.stock_qty) as total_qty
		   FROM  products
	   
	    left join (select sum(qty) as stock_qty,product_id from stock_product where 1=1 $s_id and office_id='$office1' group by product_id ) as tb_stock_product
  on products.Product_ID=tb_stock_product.product_id
	   
	   
      
       left join tb_groups on tb_groups.Group_ID=products.group_id and tb_groups.office_id='$office1'
       
       
       where    1=1   $g_id  $p_id $name 
       
       and products.office_id='$office1'
        group by products.Product_ID  order by products.Group_ID,products.Product_ID asc 
		  ");

          
       ?>
 			<table id="myTable" border="1"  class="table-bordered" align="center">
            	<tr> 
                   <th align="center">ລ/ດ</th>
                	<th align="center">ລະຫັດ</th>
                    <th align="center">Code</th>
                    <th align="center">ຊື່ສິນຄ້າ</th>
                     <th align="center">ຮູບ</th>
                 <!--   <th align="center" >ລະຫັດບາໂຄດ</th>-->
					<th align="center" >ຈຳນວນ</th>
                    <th align="center" >ຫົວຫນ່ວຍ</th>
					<th align="center" >ຂະຫນາດບັນຈຸ</th>
				<!--	<th align="center" >ຂະຫນາດ</th>
					<th align="center" >ລຸ້ນ</th>-->
                  <!--  <th align="center" >distributor</th>-->
                    <th align="center" >wholesaler</th>
                    <th align="center" >outlet</th>
                     
                 <!--  <th align="center" >ມູນຄ່າສິນຄ້າ</th>
                   <th align="center" >ມູນຄ່າສິນຄ້າ</th>
                   
					<th align="center" >ມູນຄ່າສິນຄ້າ</th>
                    <th align="center" >ລັງເປົ່າ</th>
                     <th align="center" >ມູນຄ່າລວມ</th>-->
					
                    
                    
                    <th align="center" >ແກ້ໄຂ</th>
                    
					 <!--<th align="center" >ລົບ</th>-->
                 
                </tr>
           <?php
		   $e=0;
            while($s=mysqli_fetch_array($sp)){
            $e++;
			?>
            	<tr>
                <td><?php echo  $e; ?> </td>
			    <td><?php echo  @$s["Product_ID"]; ?> </td>
                <td align="center"><?php echo  @$s["Bar_Code"]; ?> </td>
            	<td><?php echo @$s["Product_Name"]; ?></td>
               <td><img src="<?php echo @$s['pic_url'];?>" width="50"  ></td>
                
                
               <!-- <td><a href="barcode/html/BCGcode128.php?id=<?php echo @$s["Bar_Code"]; ?>" target="_blank"><button type="button" 
                class="btn btn-warning btn-sm "><?php echo @$s["Bar_Code"]; ?></button></a></td>-->
				<td align="right"><?php echo @number_format(@$s["total_qty"],0); ?> </td>
            	<td align="center"><?php echo  @$s["Unit"]; ?></td>
				<td align="center"><?php echo  @$s["ups"]; ?></td>

			<!--	<td ><?php echo  @$s["size"]; ?></td>
				<td><?php echo  @$s["version"]; ?></td>-->
               <!-- <td align="right"><?php echo  @number_format(@$s["s1_price"],0); ?></td>-->
                <td align="right"><?php echo  @number_format(@$s["s2_price"],0); ?></td>
                <td align="right"><?php echo  @number_format(@$s["s3_price"],0); ?></td>
                

                
              <!--  <td align="right"><?php echo  @number_format(@$s["s1_price"]*@$s["total_qty"],0); ?></td>
                <td align="right"><?php echo  @number_format(@$s["crate_price"]*@$s["total_qty"],0); ?></td>
                <td align="right"><?php echo  @number_format((@$s["crate_price"]+@$s["s1_price"])*@$s["total_qty"],0); ?></td>-->
				
				
                
                 
                
                <td align="center">
				
			
   <input type="button"  class="btn btn-success btn-sm edit_pro"  id="<?php echo @$s["Product_ID"]; ?>" value="ແກ້ໄຂ" data-toggle="modal" data-target="#add_pro" >
				
				</td>

        <?php /*		<td ><button class="btn btn-danger btn-sm delete_Id" value="<?php echo @$s["Product_ID"]; ?>"  id="<?php echo  @$s["Id"]; ?>">ລົບ</button></td>
                */ ?>

                	<input type="hidden" name="Id" id="Id<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["Id"]; ?>" />
				<input type="hidden" name="Bar_Code" id="Bar_Code<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["Bar_Code"]; ?>" />
				<input type="hidden" name="Quantity" id="Quantity<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["QTY"]; ?>" />
				<input type="hidden" name="Unit" id="Unit<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["Unit"]; ?>" />
				<input type="hidden" name="ups" id="ups<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["ups"]; ?>" />
				<input type="hidden" name="size" id="size<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["size"]; ?>" />
				<input type="hidden" name="version" id="version<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["version"]; ?>" />
				<input type="hidden" name="Group_ID" id="Group_ID<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["Group_ID"]; ?>" />
				<input type="hidden" name="s1_price" id="s1_price<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["s1_price"]; ?>" />
				<input type="hidden" name="s2_price" id="s2_price<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["s2_price"]; ?>" />
				<input type="hidden" name="s3_price" id="s3_price<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["s3_price"]; ?>" />
               
               <input type="hidden" name="s4_price" id="s4_price<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["s4_price"]; ?>" />
			   <input type="hidden" name="function" id="function<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["function"]; ?>" />

			   <input type="hidden" name="seven_eleven" id="seven_eleven<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["seven_eleven"]; ?>" />
               
                <input type="hidden" name="crate_price" id="crate_price<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="<?php echo  @$s["crate_price"]; ?>" />
				<input type="hidden" name="quantity" id="quantity<?php echo  @$s["Product_ID"]; ?>" class="form-control" value="1" />
            	<input type="hidden" name="hidden_name" id="name<?php echo @$s["Product_ID"]; ?>" value="<?php echo @$s["Product_Name"]; ?>" />
				<input type="hidden" name="hidden_name" id="name_en<?php echo @$s["Product_ID"]; ?>" value="<?php echo @$s["Product_Name_EN"]; ?>" />
            	<input type="hidden" name="hidden_price" id="price<?php echo @$s["Product_ID"]; ?>" value="<?php echo @$s["Price"]; ?>" />
                <?php /*
                <input type="hidden" name="hidden_img" id="img_pro<?php echo @$s["Product_ID"]; ?>" value="<?php echo @$s["pic_url"]; ?>" />
                */ ?>
                <?php 
				@$t_qty+=@$s["total_qty"];
				  @$total_1+=@$s["s1_price"]*@$s["total_qty"];
				  @$total_2+=@$s["crate_price"]*@$s["total_qty"];
				  @$total_3+=(@$s["crate_price"]+@$s["s1_price"])*@$s["total_qty"];
				
			} ?>
				</tr>
                <tr>
                <td colspan="5" align="center">ລວມ</td>
                <!--
                <td align="right"><?php echo @number_format($total_1,0); ?></td>
                <td align="right"><?php echo @number_format($total_2,0); ?></td>
                <td align="right"><?php echo @number_format($total_3,0); ?></td>
                -->
                 <td colspan="1" align="right"><?php echo @number_format($t_qty,0); ?></td>
                </tr>
            	
     
        </table>
		  
         <?php 
		 

 
 
 ?>
