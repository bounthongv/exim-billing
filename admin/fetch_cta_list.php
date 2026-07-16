<?php 


  include("init.php");

  ?>


<table border="1"   class="table-bordered" style="width:80%">
<thead>
<tr>
  <th align="center">ລ/ດ</th>
    <th align="center">ຊື່ຮ້ານລູກຄ້າ <br> Outlet Name</th>
    <th align="center">ທີ່ຢູ່ <br></th>
    <th align="center">ຜູ້ຕິດຕໍ່ <br></th>
    <th align="center">ເບີໂທ <br></th>
    <th align="center">ລະຫັດລູກຄ້າ Customer ID <br> (OMNI) ຫລື ເລກທີ່ສັນຍາ</th>
    <th align="center">ຊ່ອງທາງການຈຳໜ່າຍ<br>Outlet Sales Channels:</th>
    <th align="center">ລະຫັດສາຍທາງ<br>Route Number</th>
    <th align="center">ສັນຍາ</th>


</tr> 


</thead>

<?php 
 $list_id=1;

 @$sp=mysqli_query($con,"SELECT * FROM tb_cta");
 while($s=mysqli_fetch_array($sp)){

 $channels = [];
    if ($s['MONT_SEP'] == 1) $channels[] = "MONT (SEP)";
    if ($s['MOFT_SEP'] == 1) $channels[] = "MOFT (SEP)";
    if ($s['TONT'] == 1)     $channels[] = "TONT";
    if ($s['TOFT_SPP_SLP'] == 1) $channels[] = "TOFT (SPP/SLP)";
    $channels_text = implode(", ", $channels);

?>
<tr> 
 <td align="center">
    <a href="edit_cta.php?Id=<?=$s["Id"];?>" target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button></a>
          
          </td>

   <td align="center"><?php echo $list_id; ?></td>
    <td align="center"><?php echo $s['Outlet_Name']; ?></td>
    <td align="center"><?php echo $s['Address']; ?></td>
    <td align="center"><?php echo $s['Contact_Person']; ?></td>
    <td align="center"><?php echo $s['Tel']; ?></td>
    <td align="center"><?php echo $s['Customer_ID']; ?></td>
    <td align="center"><?php echo $channels_text; ?></td>
    <td align="center"><?php echo $s['Route_Number']; ?></td>


 <td align="center">
    <a href="print_cta.php?Id=<?=$s["Id"];?>" target="_blank" ><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button></a>
          
          </td>


</tr> 
<?php

$list_id++;
} 

?>
