<?php 
include("init.php");

$group_id=mysqli_real_escape_string($con,$_POST['Group_ID']);
/*
$sql_max=mysqli_query($con,"SELECT max(SUBSTRING(Product_ID,4, 4)) as proid  FROM products WHERE Group_ID ='$group_id'");
@$row_max=mysqli_fetch_row($sql_max);

$max_id=$row_max['0'];
 $id1='000'.'1';  
 
 $id2=$max_id+1;
 
 $pro_id='';
if($max_id<1){    $pro_id=$group_id.$id1;     }

 else if($max_id<9){  $pro_id=$group_id.'000'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $pro_id=$group_id.'000'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $pro_id=$group_id.'00'.$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $pro_id=$group_id.'0'.$id2;} 
  else if($max_id<99999){  $pro_id= $group_id.$id2;}
  
  echo $pro_id;
  */


?>
<select name="Product_ID" id="Product_ID" class="form-control sz" >
	<?php $sqlpr="SELECT Product_ID FROM products WHERE Group_ID ='$group_id' ORDER BY Product_ID ASC";
			$sql=mysqli_query($con,$sqlpr);
				while($p=mysqli_fetch_array($sql)){?>
		<option value="<?php echo $p['Product_ID'];?>"><?php echo $p['Product_ID']; ?></option>
				<?php }  ?>
				</select>
