<?php 
include("init.php");
$office1=$_SESSION['office'];

$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];

 @$no= mysqli_real_escape_string($con,$_GET['no']);		   
	
if(isset($_GET['no'])){	
	  
		if(isset($_SESSION["emp_pay_out"]))
		{
			unset($_SESSION["emp_pay_out"]);
			
			unset($_SESSION["fomu_id"]);
	
			
			
		}
		
		$sql_p=mysqli_query($con,"SELECT * from tbl_emp_pay_out_no where `no`='$no' and office_id='$office1' and username='$username'  ");
 
 if($num=mysqli_num_rows($sql_p)>0){
 
		  while($p = mysqli_fetch_array($sql_p)){
		
		
    
            $_SESSION["no"]=$p['no'];
            $_SESSION["Sending_date"]=$p['Sending_date'];
            $_SESSION["Truck_Number"]=$p['Truck_Number'];
            $_SESSION["Driver_Name"]=$p['Driver_Name'];
            $_SESSION["Distributor_Name"]=$p['Distributor_Name'];
            

            
		  }
		  }









		
					$sql_pl=mysqli_query($con,"SELECT * from tbl_empty_pay_out_note where `no`='$no' and office_id='$office1' and username='$username'");
 
 if($num=mysqli_num_rows($sql_pl)>0){
 
		  while($t = mysqli_fetch_array($sql_pl)){

       $item_array = array(

                    'no'   =>     $t["no"],
                    'Description'   =>     $t["Description"],
                    'Item_number'   =>     $t["Item_number"],
                    'UOM'   =>     $t["UOM"],
                    'amount_received'   =>     $t["amount_received"],
                    'fomu_id'   =>     $t["fomu_id"]
                    

                    

			);
			$_SESSION["emp_pay_out"][] = $item_array;
			
      }
    
	
            
   }
   header("location:edit_empty_pay_out_note.php?a=add");			
			  
}
else{ header("location:edit_empty_pay_out_note.php?a=error"); }
