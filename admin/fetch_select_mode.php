<?php 
  include("init.php");
    
   
       @$s= mysqli_real_escape_string($con,$_POST['s']);	
         if($s=='1'){
			 ?> 
             <tr>
			<td> ວັນທີ<br />
          <input type="date"  name="m" id="m" class="form-control" value="<?php echo date('Y-m-d'); ?>" /> 
            </td>
           
         <td> ວັນທີ<br />
        <input type="date"  name="y" id="y" class="form-control" value="<?php echo date('Y-m-d'); ?>" />      
            </td>
			<td>ສາງ<br>
      <select name="stock_id" id="stock_id" class="form-control" required>   
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from stocks");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select> </td>    
   
      <td>ໝວດສີນຄ້າ<br>
      <select name="group_id" id="group_id" class="form-control" required>   
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from tb_groups");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['Group_ID']?>"><?php echo $f['Group_ID']?> &nbsp; <?php echo $f['Group_Name']?></option>
	<?PHP } ?>
    </select> 
    </td> 
    
       <td><br> <button type="button" class="btn btn-warning" id="print">ພິມ</button></td>      
             <td><br><button type="button" class="btn btn-info" id="search_product" onclick="aa()"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>
	</tr>	 
	 <?php	 } 
		 elseif($s=='2'){ ?>
         <tr>
			 <td>ເດືອນ<br>
    
       <select name="m" id="m" class="form-control">
    <option value="<?=date('m');?>"><?=date('m');?></option>
    <option value="01">01</option>
    <option value="02">02</option>
    <option value="03">03</option>
    <option value="04">04</option>
    <option value="05">05</option>
    <option value="06">06</option>
    <option value="07">07</option>
    <option value="08">08</option>
    <option value="09">09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    </select>
    
    </td>
    <td>ປີ<br>
    <select name="y" id="y" class="form-control">
    <option value="<?=date('Y');?>"><?=date('Y');?></option>
    <?php     
	$yy=date('Y');
	$y_old=$yy-5;
	$y_new=$yy+5;
	
	for ($x = $y_old; $x <= $y_new; $x++) {
	         ?>
    	<option value="<?=$x;?>"><?=$x;?></option>
        <?php } ?>
    </select>
    </td> 
       		<td>ສາງ<br>
      <select name="stock_id" id="stock_id" class="form-control" required>   
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from stocks");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['stock_id']?>"><?php echo $f['stock_id']?> &nbsp; <?php echo $f['stock_name']?></option>
	<?PHP } ?>
    </select> </td>    
   
      <td>ໝວດສີນຄ້າ<br>
      <select name="group_id" id="group_id" class="form-control" required>   
       	<option value="">ທັງຫມົດ</option>
    <?PHP 
	 $sql=mysqli_query($con,"select * from tb_groups");	
	while($f = mysqli_fetch_array($sql)){?>
		<option value="<?php echo $f['Group_ID']?>"><?php echo $f['Group_ID']?> &nbsp; <?php echo $f['Group_Name']?></option>
	<?PHP } ?>
    </select> 
    </td> 
    
       <td><br> <button type="button" class="btn btn-warning" id="print">ພິມ</button></td>      
             <td><br><button type="button" class="btn btn-info" id="search_product" onclick="aa()"><i class="fa fa-search"></i> ຄົ້ນຫາ</button></td>   
		</tr>	 
			 
		<?php	 }
		 
		 
		  else{ ?>
           
          <?php }
		 
       
		
		   ?>