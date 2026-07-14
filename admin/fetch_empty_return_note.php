<?php 
  include("init.php");
  $office1=$_SESSION['office'];

  $user_id=$_SESSION['user_id'];
  $username=$_SESSION['username'];


   @$Truck_Number= mysqli_real_escape_string($con,$_POST['Truck_Number']);	

  if($Truck_Number==''){$Truck="";}else{ $Truck="and Truck_Number='$Truck_Number'";}
  
  @$from_date= mysqli_real_escape_string($con,$_POST['from_date']);	
  @$to_date= mysqli_real_escape_string($con,$_POST['to_date']);	

  if($from_date=='' && $to_date=='')
  
  {$time="";}else{ 
    
    $time="and ( Sending_date between '$from_date' and '$to_date')";}


$vg=mysqli_query($con,"SELECT * FROM tbl_emp_no where 1=1 
$Truck $time
and office_id='$office1' and username='$username'"); ?>
            <table border='1'  class="table-bordered" width="90%">
              <tr class="bgtd">
              <th></th>
                <th>No</th>
                <th>ວັນສົ່ງລັງ</th>
                <th>ເລກລົດ</th>
                <th>ຊື່ຄົນຂັບລົດ</th>
                <th>ແກ້ໄຂ</th>
                 <th>ລົບ</th>
                 <th>ພິມ</th>
              </tr>
              <?PHP
			 	while($p=mysqli_fetch_array($vg)){
                    ?>
                <tr>
                <td class="save1" data-toggle="collapse" data-target="#group-of-rows-<?php echo $p['no'];?>" aria-expanded="false" aria-controls="group-of-rows-<?php echo $p['no'];?>" ><i class="fa fa-plus"></i></td>

              	<td ><?php echo $p['no'];?></td>
                <td ><?php 
                $date1=date_create($p['Sending_date']);
                echo date_format($date1,"d/m/Y");
                ?></td>
                <td ><?php echo $p['Truck_Number'];?></td>
                <td ><?php echo $p['Driver_Name'];?></td>
                
                <td width="50" class="save1" align="center"><a href="edit_emp.php?no=<?php echo $p['no'];?>"><button class="btn btn-success btn-sm"><i class="fa fa-edit"></i> ແກ້ໄຂ</button></a></td>

                <td ><button class="btn btn-danger btn-sm delete_Id" value="<?php echo $p['Id'];?>" data-no="<?php echo $p['no'];?>"  id="<?php echo $p['Id'];?>" >ລົບ</button></td>

                <td ><button class="btn btn-warning print_Id" value="<?php echo $p['no'];?>"  id="<?php echo $p['no'];?>" >ພິມ</button></td>

      <tbody id="group-of-rows-<?php echo $p['no'];?>" class="collapse">
      <td colspan="12" align="left">
      <table width="90%">
       <tr align="center" bgcolor="#F9F8FA"> 
       <th>ລຳດັບ</th>
       <th>ລາຍລະອຽດສິນຄ້າ</th>
                <th>ລະຫັດ</th>
                <th>ຫ.ໝ</th>
            
                <th>ຈຳນວນຮັບ</th>
          
    </tr>
      <?php 
	    $aa=1;
	    $sql2=mysqli_query($con,"SELECT tbl_empty_return_note.* from tbl_empty_return_note 
      where 
      tbl_empty_return_note.`no`='".$p['no']."' 
      and 
      tbl_empty_return_note.`office_id`='".$office1."' 
      and 
      tbl_empty_return_note.`username`='".$username."' 
      order by tbl_empty_return_note.fomu_id asc");
      while($f2 = mysqli_fetch_array($sql2)){
	   ?>
	  
        <tr bgcolor="#FFFFFF">
          <td class="save1" align="center"> <?php echo $aa; ?></td>
          <td ><?php echo $f2['Description'];?></td>
                <td ><?php echo $f2['Item_number'];?></td>
                <td ><?php echo $f2['UOM'];?></td>
           
                <td ><?php echo $f2['amount_received'];?></td>
        </tr>
           <?php $aa++; 
			

          } ?>

    
       
        </table>
        </td>
    </tbody>  



              <?PHP } ?>

            </table>