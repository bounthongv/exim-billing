<?php 
include("init.php");




 @$no= mysqli_real_escape_string($con,$_GET['no']);		   
	
if(isset($_GET['no'])){	
	  
		if(isset($_SESSION["emp"]))
		{
			unset($_SESSION["emp"]);
			
			unset($_SESSION["fomu_id"]);
	
			
			
		}
		
		$sql_p=mysqli_query($con,"SELECT * from tbl_emp_no where `no`='$no'   ");
 
 if($num=mysqli_num_rows($sql_p)>0){
 
		  while($p = mysqli_fetch_array($sql_p)){
		
		
    
            $_SESSION["no"]=$p['no'];
            $_SESSION["Sending_date"]=$p['Sending_date'];
            $_SESSION["Truck_Number"]=$p['Truck_Number'];
            $_SESSION["Driver_Name"]=$p['Driver_Name'];
            $_SESSION["Distributor_Name"]=$p['Distributor_Name'];
            

            
		  }
		  }









		
					$sql_pl=mysqli_query($con,"SELECT * from tbl_empty_return_note where `no`='$no'");
 
 if($num=mysqli_num_rows($sql_pl)>0){
 
		  while($t = mysqli_fetch_array($sql_pl)){

       $item_array = array(

                    'no'   =>     $t["no"],
                    'Description'   =>     $t["Description"],
                    'Item_number'   =>     $t["Item_number"],
                    'UOM'   =>     $t["UOM"],
                    'Customer_Count'   =>     $t["Customer_Count"],
                    'Driver_Count'   =>     $t["Driver_Count"],
                    'Driver_Count_in_WareHouse'   =>     $t["Driver_Count_in_WareHouse"],
                    'Storekeeper_Count'   =>     $t["Storekeeper_Count"],
                    'Detall_of_Information'   =>     $t["Detall_of_Information"],
                    'fomu_id'   =>     $t["fomu_id"]
                    

                    

			);
			$_SESSION["emp"][] = $item_array;
			
      }
    
	
            
   }
   header("location:edit_empty_return_note.php?a=add");			
			  
}
else{ header("location:edit_empty_return_note.php?a=error"); }
