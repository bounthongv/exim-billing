<?php 
include("init.php");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php




	$Group_ID = mysqli_real_escape_string($con,$_POST['Group_ID']);
	$Product_ID = mysqli_real_escape_string($con,$_POST['Product_ID']);
	$Bar_Code = mysqli_real_escape_string($con,$_POST['Bar_Code']);
	$Product_Name = mysqli_real_escape_string($con,$_POST['Product_Name']);
	$Product_Name_EN = mysqli_real_escape_string($con,$_POST['Product_Name_EN']);
	$Unit = mysqli_real_escape_string($con,$_POST['Unit']);
	
	$Quantity = mysqli_real_escape_string($con,$_POST['Quantity']);
	$Quantity = filter_var($Quantity, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
	
	$Price = mysqli_real_escape_string($con,$_POST['Price']);
	$Price = filter_var($Price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$s1_price = mysqli_real_escape_string($con,$_POST['s1_price']);
	$s1_price = filter_var($s1_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$s2_price = mysqli_real_escape_string($con,$_POST['s2_price']);
	$s2_price = filter_var($s2_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$s3_price = mysqli_real_escape_string($con,$_POST['s3_price']);
	$s3_price = filter_var($s3_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$s4_price = mysqli_real_escape_string($con,$_POST['s4_price']);
	$s4_price = filter_var($s4_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

	$seven_eleven = mysqli_real_escape_string($con,$_POST['seven_eleven']);
	$seven_eleven = filter_var($seven_eleven, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

	$function = mysqli_real_escape_string($con,$_POST['function']);
	$function = filter_var($function, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$version = mysqli_real_escape_string($con,$_POST['version']);
	
	$size = mysqli_real_escape_string($con,$_POST['size']);
	$ups = mysqli_real_escape_string($con,$_POST['ups']);
	
	
	$action = mysqli_real_escape_string($con,$_POST['action']);
	$Id = mysqli_real_escape_string($con,$_POST['Id']);
	$Id  = str_replace(" ","",$Id);


	$crate_price = mysqli_real_escape_string($con,$_POST['crate_price']);
	
	
	 $fileinfo=PATHINFO($_FILES["pic"]["name"]);	  
	  $newFilename=$fileinfo['filename'] ."_". date('Ymd') . time() . "." . $fileinfo['extension'];
		$location="images/".$newFilename;
	
	if(move_uploaded_file($_FILES["pic"]["tmp_name"],"images/" . $newFilename)){
		$img_up=" ,pic='$newFilename' ";
		$img_up_url=" ,pic_url='$location' ";
		}
	else{$img_up="";$img_up_url="";}
	
	
	

	
if($action=="Add"){

$sad=mysqli_query($con,"INSERT INTO products (Group_ID,Product_Name,Product_Name_EN,Bar_Code,Product_ID,Unit,QTY,Price,s1_price,s2_price,s3_price,s4_price,`function`,seven_eleven,crate_price,ups,version,pic,pic_url)
     values('$Group_ID', '$Product_Name', '$Product_Name_EN','$Bar_Code','$Product_ID','$Unit','$Quantity','$Price','$s1_price','$s2_price','$s3_price','$s4_price','$function','$seven_eleven','$crate_price','$ups','$version','$newFilename','$location')");


	if($sad){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:product_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong> </div>";
		header("location:product_list.php");
	}
		
}
else if($action=="Update"){
	
	   $sad=mysqli_query($con,"Update  products set Product_ID='$Product_ID',Group_ID='$Group_ID',Product_Name='$Product_Name',Product_Name_EN='$Product_Name_EN'
	   ,Bar_Code='$Bar_Code',Unit='$Unit',QTY='$Quantity',Price='$Price',ups='$ups',size='$size',version='$version',s1_price='$s1_price',s2_price='$s2_price',s3_price='$s3_price',s4_price='$s4_price',`function`='$function',seven_eleven='$seven_eleven',crate_price='$crate_price' $img_up $img_up_url  where Id='$Id'  ");


	if($sad){
		
		
		$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
		header("location:product_list.php");
			}
		
			else {
		$_SESSION['smg']="<div class='alert alert-danger'><strong>ບໍ່ສຳເລັດ!</strong>Update </div>";
		header("location:product_list.php");
	}
	
	
	}
else{
	
	
	
	
	}

?>
</html>

 