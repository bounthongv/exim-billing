<?php
//	session_start();
	
	//unset($_SESSION['username']);
	//unset($_SESSION['user_id']);
	//check if can login again
/*	if(isset($_SESSION['jum_nuan_log_again'])){
	echo	$now = time(); echo '<br>';
	echo	$_SESSION['jum_nuan_log_again'];
		if($now >= $_SESSION['jum_nuan_log_again']){
			 unset($_SESSION['jum_nuan_log']);
			 unset($_SESSION['jum_nuan_log_again']);
			 unset($_SESSION['error']);
			 header('location:index.php');	
		}
	}
	if(isset( $_SESSION['jum_nuan_log'])){
		
		$_SESSION['jum_nuan_log'];
		}
		*/
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  	<link rel="shortcut icon" type="image/png" href="locked-padlock.png">
  <link rel="stylesheet" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="css/jquery.min.js"></script>
  <script src="css/bootstrap.min.js"></script>

  
</head>


<style type="text/css">
    @import url("LAOS/stylesheet.css");
body,td,th ,h3{
	font-family: LAOS;
}

 @import url("LAOS/stylesheet.css");
.save{
	font-family: LAOS;
}
</style>


<body>
  

<div class="pen-title">
  <h2>ຍີນດີຕ້ອນຮັບເຂົ້າສູ່ ໂປຣແກຣມ</h2>
</div>
<!-- Form Module-->



<div class="module form-module">

  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
    <div class="tooltip">ເຂົ້າສູ່ລະບົບ</div>
  </div>
 <div class="form">
    
    <form name="me" action="check_login.php" method="post" enctype="multipart/form-data">
    ຜຸ້ໃຊ້ລະບົບ:
      <input type="text" name="username" id="username" placeholder="Username"  onKeyUp="query_user()" required/>
      ລະຫັດຜ່ານ:
      <input type="password" name="passs" id="passs" placeholder="Password" onMouseDown="query_user()" required/>&nbsp;
      
      ສາງ:
      <div id="s_id">
      <select required > 
        <option value="">ສາງ</option>
      </select>
      </div>
     &nbsp;
      
     	
	
	 <input type="submit" name="login" value="ເຂົ້າລະບົບ" class="submit save" >
	
    </form>
    <?php
				if(isset($_SESSION['error'])){
					?>
					<div class="alert alert-danger text-center" style="margin-top:20px;">
						<?php echo $_SESSION['error']; ?>
					</div>
					<?php

				//	unset($_SESSION['error']);
				}
         ?>
  </div>

  <script type="text/javascript" src="check_js.js?v=1"></script>





</body>

</html>
