<?php 
include("init.php");

?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
<!--	<link href="//fonts.googleapis.com/css?family=Poppins:100i,200,200i,300,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">-->
	<link href="js/iconic.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>


<?php include("header.php"); ?>

<style>

	
	a:hover,a:link {
  
	text-decoration: none;
	

}
</style>
<style type="text/css">
    @import url("LAOS/stylesheet.css");
body,td,th ,h3,h1{
	font-family: LAOS;
}
</style>
<style>

.save1{
	    color:#000;
	    border:1px solid #E4E4E4;
		border-radius:3px;
		padding:5px;
		font-family:"Phetsarath OT";
}
.radio-pink [type="radio"]:checked+label:after {
    border-color: #e91e63;
    background-color: #e91e63;
}
/*Gap*/

.radio-pink-gap [type="radio"].with-gap:checked+label:before {
    border-color: #e91e63;
}

.radio-pink-gap [type="radio"]:checked+label:after {
    border-color: #e91e63;
    background-color: #e91e63;
}
    </style>

<body>
<?php



 $sql_max=mysqli_query($con,"select max(Group_ID) from tb_groups");
$row_max=mysqli_fetch_row($sql_max);

$max_id=$row_max['0'];
 $id1='00'.'1';  
 
 $id2=$max_id+1;
 
 $group_id='';
if($max_id<1){    $group_id=$id1;     }

 else if($max_id<9){  $group_id='00'.$id2;}  // 000.2-000.9
 else if($max_id<99){  $group_id='0'.$id2;}  // 000.2-000.9

 else if($max_id<999){  $group_id=$id2;} // 0010-0099  //   0100 - 999

  else if($max_id<9999){  $group_id=$id2;} 
  else if($max_id<99999){  $group_id= $id2;}
  
   $group_id;

?>

<?php
date_default_timezone_set("Asia/Bangkok");
?>  

<div class="container">

<div class="row">
    <div class="col-lg-12">
                <h1 class="page-header">
                    <small>ເພີ່ມ ໜວດສິນຄ້າ</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><font color="#000000">ຫນ້າຫລັກ</font></a>
                    </li>
                    <li class="active"><a href="group_list.php"><font color="#000000">ກັບຄືນ</font></a></li>
                </ol>
            </div>
        </div>


<form action="insert_groups.php" method="post" enctype="multipart/form-data">

	<div class="form-group row">
    <div class="col-sm-10">
     <button type="reset" class="btn btn-success"><i class=""></i>&nbsp;ລ້າງຂໍ້ມູນ</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;ບັນທຶກ</button>
      <button type="button" class="btn"><i class="fa fa-print"></i>&nbsp;ພິມ</button>
  
    </div>
  </div>
<table border="0">

  <tr>
    <td align="right">ລະຫັດໜວດສິນຄ້າ:</td>
    <td ><input type="text" class="form-control" name="group_id" id="group_id" value="<?php echo $group_id;?>"></td>
  </tr>
 <tr>
    <td align="right">ຊື່ໜວດສິນຄ້າ(ລາວ):</td>
    <td ><input type="text" class="form-control " name="group_name" id="group_name" placeholder="Group Name"></td>
  </tr>
  
 
   <tr>
    <td align="right">ຊື່ໜວດສິນຄ້າ(ອັງກິດ):</td>
    <td ><input type="text" class="form-control " name="group_name_en" id="group_name_en" placeholder="Group Name EN"></td>
  </tr>

  
</table>



</form>
<?php  if(isset($_SESSION['smg'])){ echo $_SESSION['smg']; unset($_SESSION['smg']); } ?>



</div>



<br><br>
</body>
</html>
<script type="text/javascript">
					jQuery(document).ready(function($) {
						$(".scroll").click(function(event){		
							event.preventDefault();
							$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
						});
					});
				</script>

<!-- smooth scrolling -->
