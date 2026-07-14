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
<div class="container">

<div class="row">
    <div class="col-lg-12">
                <h1 class="page-header">
                    <small>ແກ້ໄຂ ລາຍການຫມວດອາໄຫລ່</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><font color="#000000">ຫນ້າຫລັກ</font></a>
                    </li>
                    <li class="active"><a href="group_list.php"><font color="#000000">ກັບຄືນ</font></a></li>
                </ol>
            </div>
        </div>
	<?php

 
  @$id = mysqli_real_escape_string($con,$_GET['Group_ID']);
  $sql = mysqli_query($con,"select * from tb_groups where Group_ID='$id' ");
  $f = mysqli_fetch_array($sql);

date_default_timezone_set("Asia/Vientiane");
 date("Y-m-d H:i:s");
?>
<form action="update_groups.php" method="post" enctype="multipart/form-data">

	<div class="form-group row">
    <div class="col-sm-10">
      <button type="reset" class="btn btn-success"><i class=""></i>&nbsp;ລ້າງຂໍ້ມູນ</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;ອັບເດດ</button>
      <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i>&nbsp;ລືບ</button>
      <button type="button" class="btn"><i class="fa fa-print"></i>&nbsp;ພິມ</button>
  
    </div>
  </div>
<table border="0">
    
   <tr>
    <td align="right">ລະຫັດ ໜວດ:</td>
    <td ><input type="text" class="form-control" name="group_id" id="group_id" value="<?php echo $f['Group_ID'];?>" readonly></td>
  </tr>
 <tr>
    <td align="right">ຊື່ ໜວດອາໄຫລ່:</td>
    <td ><input type="text" class="form-control " name="group_name" id="group_name" value="<?php echo $f['Group_Name'];?>"></td>
  </tr>


  
</table>

</form>


	
		</table>
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

