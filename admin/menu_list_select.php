<?php 
  include("init.php");
    
	foreach ($_GET as $key => $value) {
  $_GET[$key]=addslashes(strip_tags(trim($value)));
}

if ($_GET['User_ID'] !='') {
	   $s_id=(string) $_GET['User_ID']; 
	    }
	   
extract($_GET); 
   
	if(isset($_GET['User_ID'])){  $user_id_edit=$_GET['User_ID']; }
	?>
	<table class="table table-bordered  mb-0">
    <thead>
      <tr >
      
        <th scope="col">ລ/ດ</th>
        <th scope="col"><input type="checkbox" onclick="toggle(this)" /> All</th>
        <th scope="col">ລາຍການ</th>
       
        
      </tr>
    </thead>
    <tbody>
  <?php
    $sp=mysqli_query($con,"    select menu_user.user_id,menu_list.header_id,  menu_user.list_id,menu_list.list_name,menu_list.link,menu_header.header_name
     
     from menu_user
     
     left join menu_list on menu_user.list_id=menu_list.list_id
     left join menu_header on menu_list.header_id=menu_header.header_id   
           
      where menu_user.user_id='$user_id_edit'   
      group by  menu_list.header_id order by  menu_list.header_id  ");
  
	  $e=1;
	 if($sqln=mysqli_num_rows($sp)>0){
	while($s=mysqli_fetch_array($sp)){		?>
      <tr>
        <td width="5%" class="bgtd"><?php echo $e; ?></td>
        
        <td colspan="2"  class="bgtd"><?php echo $s['header_id']; ?> &nbsp;<?php echo $s['header_name']; ?></td>
    <?php    
        $spd=mysqli_query($con," 
		select menu_user.user_id,menu_list.header_id,  menu_user.list_id,menu_list.list_name,menu_list.link,menu_header.header_name,menu_user.status
     
     from menu_user
     
     left join menu_list on menu_user.list_id=menu_list.list_id
     left join menu_header on menu_list.header_id=menu_header.header_id   
           
      where menu_user.user_id='$user_id_edit' and menu_list.header_id='$s[header_id]' 
      order by  menu_list.header_id,menu_user.list_id
		 ");  
	
	 $e2=1;
	  while($sd=mysqli_fetch_array($spd)){
	  ?>
     
            <tr>
              <td width="15%"><?php echo $e.'.'.$e2; ?></td>
              <td>
   <input type="checkbox" name="menu_list[]" id="s_menu_list" class="select_product" <?php if($sd["status"]=='on'){ echo "checked";}?>  value="<?php echo $sd["list_id"];?>" >
             </td>
              <td><?php echo $sd['list_id']; ?> &nbsp;<?php echo $sd['list_name']; ?></td>
            </tr>
        <?php  $e2++; } ?>
      
      </tr>
<?php  $e++;
}
///////////////////
	 }else{
		 
	
		 $sp2=mysqli_query($con," select * from menu_header order by header_id  "); 
		while($s=mysqli_fetch_array($sp2)){		?>
      <tr>
        <td width="5%" class="bgtd"><?php echo $e; ?></td>
        
        <td colspan="2"  class="bgtd"><?php echo $s['header_id']; ?> &nbsp;<?php echo $s['header_name']; ?></td>
    <?php    
        $spd=mysqli_query($con," 
		select *   from menu_list  where header_id='$s[header_id]'     order by  header_id,list_id
		 ");  
	
	 $e2=1;
	  while($sd=mysqli_fetch_array($spd)){
	  ?>
     
            <tr>
              <td width="15%"><?php echo $e.'.'.$e2; ?></td>
              <td>
   <input type="checkbox" name="menu_list[]" id="s_menu_list" class="select_product"   value="<?php echo $sd["list_id"];?>" >
             </td>
              <td><?php echo $sd['list_id']; ?> &nbsp;<?php echo $sd['list_name']; ?></td>
            </tr>
        <?php  $e2++; } ?>
      
      </tr>
<?php  $e++;
} ?> 
		 
<?php		 
		 }


 ?>

    </tbody>
  </table>

		  
    
