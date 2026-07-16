<?php
include("dblink.php");

$username = stripslashes($_POST['username']);
$user_id=mysqli_real_escape_string($con,$username);	
	
	 $sql = mysqli_query($con,"SELECT * FROM users WHERE User_Name ='$username' ");
    $ch=mysqli_num_rows($sql);
    if($ch > 0){
		$f=mysqli_fetch_array($sql);
		
		if($f['status']=="0"){
		
        ?>
      <select name="stock_id" id="stock_id" >
      <?php 
	  $sql_st=mysqli_query($con,"select * from stocks ");
	   while($r=mysqli_fetch_array($sql_st)){
        ?>
        <option value="<?php echo $r['stock_id'];?>"><?php echo $r['stock_id']; echo " &nbsp;"; echo $r['stock_name'];?></option>
		
		<?php   } ?>
      </select>
		<?php
		}
	     if($f['status']=="1"){
		
        ?>
      <select name="stock_id" id="stock_id" >
      <?php 
	  $sql_st=mysqli_query($con,"select * from stocks where stock_id='$f[stock_id]' ");
	   while($r=mysqli_fetch_array($sql_st)){
        ?>
        <option value="<?php echo $r['stock_id'];?>"><?php echo $r['stock_id']; echo " &nbsp;"; echo $r['stock_name'];?></option>
		<?php
		}
		?>
      </select>
		<?php
		 }
	
    }else{
       echo '<select required > 
        <option value="">ສາງ</option>
      </select>';
    }
    
   
	
?>
