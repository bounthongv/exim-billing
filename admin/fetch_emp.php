<?php

include('init.php');

  
if(!empty($_SESSION["emp"]))
{      
        
	foreach($_SESSION["emp"] as $keys => $values)
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

                	 <th align="center">ລາຍລະອຽດສິນຄ້າ</th>
                	 <th align="center">ລະຫັດ</th>
			         <th align="center">ຫ.ໝ</th> 
                     <th align="center">ລູກຄ້ານັບ</th>
                     <th align="center">ຄົນຂັບລົດນັບເຄື່ອງຂື້ນລົດ</th>
                     <th align="center">ຄົນຂັບລົດນັບລົງຢູ່ສາງ</th>
                     <th align="center">ນາຍສາງນັບ</th>
                     <th align="center">ລາຍລະອຽດ</th>
      
                  <th align="center" >ລົບ</th>
        


        </tr>

              
		<?php
if(!empty($_SESSION["emp"]))
{      
       $e=1;
	foreach($_SESSION["emp"] as $keys => $values)
	{
		
	?>
		<tr>
	<td align="center" ><font style="font-size: 15px;"><?=$e;?><input type="hidden" name="fomu_id_1[]" id="fomu_id_1<?php echo $values["fomu_id"];?>" value="<?php echo $values["fomu_id"];?>"readonly></font></td>
       

       <td align="center">
   
   <input type="text" name="Description[]" style="text-align:center; max-width:120px; " id="Description<?=$e;?>"  class="form-control"
          value="<?php echo $values["Description"];?>">
   
        </td>  
   
		<td align="center">
   
   <input type="text" name="Item_number[]" style="text-align:center; max-width:80px; " id="Item_number<?=$e;?>"  class="form-control"
          value="<?php echo $values["Item_number"];?>">
   
        </td>  

		
		<td align="center">
   
   <input type="text" name="UOM[]" style="text-align:center; max-width:80px; " id="UOM<?=$e;?>"  class="form-control"
          value="<?php echo $values["UOM"];?>">
   
        </td>  

		<td align="center">
   
   <input type="text" name="Customer_Count[]" style="text-align:center; max-width:80px; " id="Customer_Count<?=$e;?>"  class="form-control"
          value="<?php echo $values["Customer_Count"];?>">
   
        </td>  

		<td align="center">
   
   <input type="text" name="Driver_Count[]" style="text-align:center; max-width:150px; " id="Driver_Count<?=$e;?>"  class="form-control"
          value="<?php echo $values["Driver_Count"];?>">
   
        </td>  

		<td align="center">
   
   <input type="text" name="Driver_Count_in_WareHouse[]" style="text-align:center; max-width:150px; " id="Driver_Count_in_WareHouse<?=$e;?>"  class="form-control"
          value="<?php echo $values["Driver_Count_in_WareHouse"];?>">
   
        </td>  

		<td align="center">
   
   <input type="text" name="Storekeeper_Count[]" style="text-align:center; max-width:80px; " id="Storekeeper_Count<?=$e;?>"  class="form-control"
          value="<?php echo $values["Storekeeper_Count"];?>">
   
        </td>  

		<td align="center">
   
   <input type="text" name="Detall_of_Information[]" style="text-align:center; max-width:80px; " id="Detall_of_Information<?=$e;?>"  class="form-control"
          value="<?php echo $values["Detall_of_Information"];?>">
   
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

