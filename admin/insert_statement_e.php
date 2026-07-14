<?php 
  include("init.php");
    
  $from_date = mysqli_real_escape_string($con,$_POST['from_date']);  
$to_date = mysqli_real_escape_string($con,$_POST['to_date']);
$customer_id = mysqli_real_escape_string($con,$_POST['customer_id']);
$Detailed = mysqli_real_escape_string($con,$_POST['Detailed']);

		   
           if($from_date=='' or $to_date==''){$btw="";} 
		  else{ $btw="and (sale_date>='$from_date' and sale_date<='$to_date')
		  ";}
		  

if($customer_id==''){$c="";}
else{
	$c="and customer_id='$customer_id'";
}



if($Detailed=='ລະອຽດ'){




   @$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement_E
	          ");
		  
@$sp1=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHD'  $btw $c and amount!='0' order by sale_date");
@$sp2=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHP' $btw $c and amount!='0' order by sale_date");
@$sp3=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHP1' $btw $c and amount!='0' order by sale_date");
@$sp4=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHP2' $btw $c and amount!='0' order by sale_date");
@$sp5=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHQ' $btw $c and amount!='0' order by sale_date");
@$sp6=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHQ1' $btw $c and amount!='0' order by sale_date");
@$sp7=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHQ2' $btw $c and amount!='0' order by sale_date");
@$sp8=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ENQ'$btw $c and amount!='0' order by sale_date");
@$sp9=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ENQ1' $btw $c and amount!='0' order by sale_date");
@$sp10=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ENQ2' $btw $c and amount!='0' order by sale_date");
@$sp11=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ERP' $btw $c and amount!='0' order by sale_date");
@$sp12=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ERP1' $btw $c and amount!='0' order by sale_date");
@$sp13=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ERQ' $btw $c and amount!='0' order by sale_date");
@$sp14=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0 FROM `product_sale` WHERE product_id='ERQ1' $btw $c and amount!='0' order by sale_date");
@$sp15=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0 FROM `product_sale` WHERE product_id='ETQ' $btw $c and amount!='0' order by sale_date");
@$sp16=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0 FROM `product_sale` WHERE product_id='ETQ1' $btw $c and amount!='0' order by sale_date");
@$sp17=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty FROM `product_sale` WHERE product_id='ETQ2' $btw $c and amount!='0' order by sale_date");

}elseif($Detailed=='ສັງລວມ'){
	

	 @$sp0=mysqli_query($con,"
TRUNCATE TABLE tb_statement_E
	          ");


@$sp1=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHD'  $btw $c and amount!='0'  order by sale_date");
@$sp2=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHP' $btw $c and amount!='0'  order by sale_date");
@$sp3=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHP1' $btw $c and amount!='0' order by sale_date");
@$sp4=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHP2' $btw $c and amount!='0' order by sale_date");
@$sp5=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHQ' $btw $c and amount!='0'  order by sale_date");
@$sp6=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHQ1' $btw $c and amount!='0' order by sale_date");
@$sp7=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='EHQ2' $btw $c and amount!='0'  order by sale_date");
@$sp8=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ENQ' $btw $c and amount!='0'   order by sale_date");
@$sp9=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ENQ1' $btw $c and amount!='0'  order by sale_date");
@$sp10=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ENQ2' $btw $c and amount!='0'  order by sale_date");
@$sp11=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ERP' $btw $c and amount!='0'  order by sale_date");
@$sp12=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ERP1' $btw $c and amount!='0'  order by sale_date");
@$sp13=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0, 0 FROM `product_sale` WHERE product_id='ERQ' $btw $c and amount!='0'  order by sale_date");
@$sp14=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0, 0 FROM `product_sale` WHERE product_id='ERQ1' $btw $c and amount!='0'  order by sale_date");
@$sp15=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0, 0 FROM `product_sale` WHERE product_id='ETQ' $btw $c and amount!='0'  order by sale_date");	
@$sp16=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty, 0 FROM `product_sale` WHERE product_id='ETQ1' $btw $c and amount!='0'  order by sale_date");
@$sp17=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT sale_id,sale_date, amount,customer_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, qty FROM `product_sale` WHERE product_id='ETQ2' $btw $c and amount!='0'  order by sale_date");	
	
	
	
	
	/*
	  @$spaa=mysqli_query($con,"
       SELECT * from tb_statement_E
	  order by inv_date, inv_no asc
          ");
	
         
	  
            while($f=mysqli_fetch_array($spaa)){

     
			  
	@$inv_no=$f["inv_no"];	
	@$inv_date=$f["inv_date"];		  
			  
	@$t_inv_amt+=$f["inv_amt"];	  
	@$t_HD+=$f["HD"];
@$t_HM+=$f["HM"];
@$t_HP+=$f["HP"];
@$t_HP1+=$f["HP1"];
@$t_HQ+=$f["HQ"];
@$t_HQ1+=$f["HQ1"];
@$t_HS+=$f["HS"];
@$t_NC+=$f["NC"];
@$t_NQ+=$f["NQ"];
@$t_RP+=$f["RP"];
@$t_RP1+=$f["RP1"];
@$t_RS+=$f["RS"];
@$t_TC+=$f["TC"];
@$t_TQ+=$f["TQ"];
@$t_HC+=$f["HC"];
		  
	
}
*/	


	
@$sp15=mysqli_query($con,"insert into tb_statement_help_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT inv_no,inv_date,sum(inv_amt),customer_id,
sum(EHD),
sum(EHP),
sum(EHP1),
sum(EHP2),
sum(EHQ),
sum(EHQ1),
sum(EHQ2),
sum(ENQ),
sum(ENQ1),
sum(ENQ2),
sum(ERP),
sum(ERP1),
sum(ERQ),
sum(ERQ1),
sum(ETQ),
sum(ETQ1),
sum(ETQ2)
 from tb_statement_E group by inv_no");
	
 @$sp15_1=mysqli_query($con,"
TRUNCATE TABLE tb_statement_E
	          ");
	
@$sp15_2=mysqli_query($con,"insert into tb_statement_E(inv_no, inv_date, inv_amt,customer_id, EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2)SELECT inv_no,inv_date,inv_amt,customer_id,EHD,EHP,EHP1,EHP2,EHQ,EHQ1,EHQ2,ENQ,ENQ1,ENQ2,ERP,ERP1,ERQ,ERQ1,ETQ,ETQ1,ETQ2 from tb_statement_help_E group by inv_no");	
	
@$sp15_3=mysqli_query($con,"TRUNCATE TABLE tb_statement_help_E");	
}
	
	if($sp){
				$_SESSION['smg']="<div class='alert alert-success'><strong>ບັນທືກສຳເລັດ!</strong></div>";
				 header("location:e.php?customer_id=".$customer_id."&from_date=".$from_date."&to_date=".$to_date."&Detailed=".$Detailed."");
				}
				else{
					$_SESSION['smg']="<div class='alert alert-danger'><strong>ບັນທືກບໍ່ສຳເລັດ!</strong></div>";
				 header("location:e.php?customer_id=".$customer_id."&from_date=".$from_date."&to_date=".$to_date."&Detailed=".$Detailed."");					
					}
	
 ?>
