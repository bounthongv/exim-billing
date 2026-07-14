<?php
include("init.php");


$Product_ID='0010001';
$stock_id='0001';
//$qty='53';
/*
 do{
					 
				$sql_pl=mysqli_query($con,"
          select * from  stock_product where qty >0 and product_id='$Product_ID' and stock_id='$stock_id' order by product_lot_id ");
		   $p = mysqli_fetch_array($sql_pl);
		   $p['product_lot_id']; 
		   $p['qty'];
			
					
			
				    if($qty>$p['qty']){ 
					
						// $p['qty'].'<br>';
					
					$qty;//$in_qty=$p['qty'];
					
				//	 @$t_s+=$in_qty;
					$qty=$qty-$p['qty']; 
					
														
						
		//	$sql_up1=mysqli_query($con,"update stock_product set qty=0 where product_lot_id='$p[product_lot_id]' and stock_id='$stock_id' ");
					
 
						              }
									  
					elseif($qty==$p['qty']){	
							// $qty.'2<br>';					
		//	$sql_up2=mysqli_query($con,"update stock_product set qty=0 where product_lot_id='$p[product_lot_id]' and stock_id='$stock_id' ");		
						
						$qty=0;	
					                  }
					elseif($qty<$p['qty']){	
						//	 $qty.'3<br>';
		//	$sql_up3=mysqli_query($con,"update stock_product set qty=qty-$qty where product_lot_id='$p[product_lot_id]' and stock_id='$stock_id' ");
						
						$qty=0;
									  }
					else{ echo "Error";}
			
					                  }
			 while( $qty>0);*/
			 
		/*$sql_in=mysqli_query($con,"INSERT INTO product_sale 
		(refer_no,stock_id,product_id,qty) 
		values('0001','$stock_id','$Product_ID','$x_qty') ");*/	 
			 
			 
			 $qty=100;
			 
			 $sql_pl=mysqli_query($con,"
          select * from  stock_product where qty >0 and product_id='$Product_ID' and stock_id='$stock_id' order by product_lot_id ");
		  while( $p = mysqli_fetch_array($sql_pl))
	{
		   $p['product_lot_id']; 
		   $p['qty'];
			 
			$q=$p['qty']; 
			
			 if($qty > 0)
			 {	
			              
					   	
						 
			 $t_qty=$qty-$q;
			 
	
                
			 $x_qty=$qty-$t_qty; 
	           
				
				if($qty >$q){
					
					echo $x_qty;
					
					
		/*	$sql_in=mysqli_query($con,"INSERT INTO product_sale 
		(refer_no,stock_id,product_id,product_lot_id,qty) 
		values('0001','$stock_id','$Product_ID','$p[product_lot_id]','$x_qty') ");*/
					}
					else{
						
					echo $qty;
				
			/*$sql_in=mysqli_query($con,"INSERT INTO product_sale 
		(refer_no,stock_id,product_id,product_lot_id,qty) 
		values('0001','$stock_id','$Product_ID','$p[product_lot_id]','$qty') ");*/
						}
				 $qty=$qty-$q;
	
	
			   
		
			                  
		
			  }
			 
	}
			 


?>