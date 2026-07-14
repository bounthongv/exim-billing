<?php

include('init.php');
$office1=$_SESSION['office'];
  
if(!empty($_SESSION["emp_pay_out"]))
{      
        
	foreach($_SESSION["emp_pay_out"] as $keys => $values)
	{
		$fomu_id=$values["fomu_id"]+1;
	

	
	}
}else{
	 $fomu_id=1;
	 
	}

	
?>
<input type="hidden" name="fomu_id_item" id="fomu_id_item" value="<?php echo $fomu_id; ?>">

	<table class="table" align="center" style="max-width:1250px; " >

       

	 <tr align="center" class="bgtd"> 
        <th align="center" >ລ/ດ</th> 
        <th align="center">ລະຫັດ</th>
                	 <th align="center">ລາຍລະອຽດສິນຄ້າ</th>
                
			             <th align="center">ຫ.ໝ</th> 
                     <th align="center">ຈຳນວນຈ່າຍ</th>
               
      
                  <th align="center" >ລົບ</th>
        


        </tr>

              
		<?php
if(!empty($_SESSION["emp_pay_out"]))
{      
       $e=1;
	foreach($_SESSION["emp_pay_out"] as $keys => $values)
	{
		
	?>
		<tr>
	<td align="center" ><font style="font-size: 15px;"><?=$e;?><input type="hidden" name="fomu_id_1[]" id="fomu_id_1<?php echo $values["fomu_id"];?>" value="<?php echo $values["fomu_id"];?>"readonly></font></td>
       

       <td align="center">
   <?php /*
   <input type="text" name="Description[]" style="text-align:center; max-width:120px; " id="Description<?=$e;?>"  class="form-control"
          value="<?php echo $values["Description"];?>">
   */ ?>



          <select name="Item_number[]" id="Item_number<?=$e;?>" class="form-control Description_change"  required> 



    <option value="<?php echo $values['Item_number'];?>"><?php echo $values['Item_number'];?></option>

    <?php $sql =mysqli_query($con,"SELECT * FROM products where office_id='$office1' and Product_ID like 'E%' and CHAR_LENGTH(REPLACE(Product_ID, ' ', ''))='4'");
      while($f = mysqli_fetch_array($sql)){
    ?>
        <option value="<?php echo $f['Product_ID'];?>"

        data-Unit="<?php echo $f['Unit']; ?>"
        data-Product_ID="<?php echo $f['Product_ID']; ?>"
        data-e="<?=$e;?>"
        data-Product_Name="<?php echo $f['Product_Name']; ?>"
        ><?php echo $f['Product_ID'];?></option>
        <?php } ?>
    </select>

        </td>  
   
		<td align="center">
   
   <input type="text" name="Description[]" style="max-width:350px;" id="Description<?=$e;?>"  class="form-control"
          value="<?php echo $values["Description"];?>">
   
        </td>  

		
		<td align="center">
   
   <input type="text" name="UOM[]" style="text-align:center; max-width:80px; " id="UOM<?=$e;?>"  class="form-control"
          value="<?php echo $values["UOM"];?>">
   
        </td>  



		<td align="center">
   
   <input type="text" name="amount_received[]" style="text-align:center; max-width:150px; " id="amount_received<?=$e;?>"  class="form-control"
          value="<?php echo $values["amount_received"];?>">
   
        </td>  

	
	



<td align="center"><button type="button" name="delete"  class="btn btn-danger btn-sm delete_or" id="<?= $values["fomu_id"];?>" 
	value=""><i class="fa fa-trash" aria-hidden="true"></i></button></td> 
       

      	
	<?php	
		
		$e++;
	}
	
	
	?>


<tr>  
      
  
        
    </tr>
	<?php
}
else
{
	?>
    <tr>
    	<td colspan="12" align="center">
    	<div>	ບໍ່ມີລາຍການຂາຍ</div>
    	</td>
    </tr>
   <?php
}
?>
</table>

