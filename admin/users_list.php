<?php
include("init.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>ລະບົບບໍລິຫານເງີນເດືອນ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/png" href="images/shopping-cart.png">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
	
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
    	
</head>
<body>
	
<?PHP 
		
		include("header.php");
?>
<style>
td{ padding:10px;
font-weight:!important;
height:20px;
 }
</style>

    <!-- Navigation -->
<style>
.bgtd{background-color: #EBEBEB;
		
}
</style>


    <div class="container">
    <br>
    <h4>ຂໍ້​ມູນ​ຜູ້ໃຊ້  Users List</h4>
   <hr>
    <a href="add_users.php"><button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i> ເພີ່ມ ຜູ້ນໍາໃຊ້</button></a>
	   <p>&nbsp;</p>
      
            <table id="example" width="100%"  class="table-bordered" >
                        
                        <thead>
                         <tr bgcolor="#E4E4E4">
                                <td align="center"><strong>ລຳດັບ</strong></td>
                                <td align="center"><strong>ລະຫັດຜູ້ໃຊ້</strong></td>
                                 <td align="center"><strong>ຊື່ຜູ້ໃຊ້</strong></td>
                              
								  <td align="center"><strong>ສະຖານະ</strong></td>
                                <td align="center"><strong>ຫ້ອງການ</strong></td>
                              
                           
                                <td align="center"><strong>ແກ້ໄຂ</strong></td>
                                 <td align="center" ><strong>ລືບ</strong></td>
                            
                        </tr>
              </thead>
                        
                        <tbody>
                        <?php 
              include("init.php");
						$e=0;
						
						$sql1 = mysqli_query($con,"SELECT * FROM login");
                        while($f = mysqli_fetch_array($sql1)){
						$e++;
                        ?>
                        <tr>
                            <td align="center"><?php echo $e;?></td>
                            <td align="center"><?php echo $f['User_ID']; ?></td>
                            <td><?php echo $f['User_Name']; ?></td>                      
                            <td><?php echo $f['status']; ?></td>
                            <td align="center"><?php echo $f['office']; ?></td>
                            
                            <td align="center"><a href="edit_users.php?Id=<?php echo $f['ID'];?>">
                       <button class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> ແກ້ໄຂ</button></a></td>
                                                   
                        <td align="center"><a onClick="return confirm('ຕ້ອງການລຶບຂໍ້ມູນແທ້ ຫຼື ບໍ່?')" href="del_users.php?Id=<?PHP echo $f['ID'];?>">
						<button class="btn btn-danger btn-sm"><font color="#F0FFFF"><i class="fa fa-trash"></i> ລົບ </button></font></a></td>
                        </tr>
                        <?php }?>
                        </tbody>
  </table>  
</div>
</body>
</html>



 
