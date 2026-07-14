<?php 
  include("init.php");
  $office1=$_SESSION['office'];



  $date =  mysqli_real_escape_string($con, $_POST['date']);


            
            
                        mysqli_query($con,"TRUNCATE table_empty");
            
            
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT sum(amount_received),0,0,0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='EHQ2' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,sum(amount_received),0,0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='EHQ1' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,sum(amount_received),0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='EHP2' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
            
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,sum(amount_received),0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='EHP1' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,sum(amount_received),0,0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ENQ2' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,sum(amount_received),0,0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ENQ1' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
            
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,sum(amount_received),0,0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ERP2' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,sum(amount_received),0,0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ERP1' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,sum(amount_received),0,0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ERQ2' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
            
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,sum(amount_received),0,0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='ERQ1' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,sum(amount_received),0,0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='HD20L' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,sum(amount_received),0,0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='HD30L' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
            
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,0,sum(amount_received),0 FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='Empty-CO2' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
                        mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,0,0,sum(amount_received) FROM tbl_emp_pay_out_no left join tbl_empty_pay_out_note on tbl_emp_pay_out_no.no=tbl_empty_pay_out_note.no where tbl_empty_pay_out_note.Item_number='Pallet' and tbl_emp_pay_out_no.Sending_date='$date' group by tbl_emp_pay_out_no.Truck_Number"); 
            
            
                        mysqli_query($con,"INSERT into table_empty (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet,total,comment,`date`) SELECT if(sum(HQ_crate) is null,0,sum(HQ_crate)),if(sum(HQ_glasses) is null,0,sum(HQ_glasses)),if(sum(HP_crate) is null,0,sum(HP_crate)),if(sum(HP_glasses) is null,0,sum(HP_glasses)),if(sum(NQ_crate) is null,0,sum(NQ_crate)),if(sum(NQ_glasses) is null,0,sum(NQ_glasses)),if(sum(RP_crate) is null,0,sum(RP_crate)),if(sum(RP_glasses) is null,0,sum(RP_glasses)),if(sum(RQ_crate) is null,0,sum(RQ_crate)),if(sum(RQ_glasses) is null,0,sum(RQ_glasses) ),if(sum(HD20L) is null,0,sum(HD20L)),if(sum(HD30L) is null,0,sum(HD30L)),if(sum(`Empty-CO2`) is null,0,sum(`Empty-CO2`)),if(sum(`Pallet`) is null,0,sum(`Pallet`)),
                        if(sum(HQ_crate) is null,0,sum(HQ_crate))+if(sum(HQ_glasses) is null,0,HQ_glasses)+if(sum(HP_crate) is null,0,sum(HP_crate))+if(sum(HP_glasses)is null,0,sum(HP_glasses))+if(sum(NQ_crate) is null ,0,sum(NQ_crate))+if(sum(NQ_glasses) is null,0,sum(NQ_glasses))+if(sum(RP_crate) is null,0,sum(RP_crate))+if(sum(RP_glasses)is null,0,sum(RP_glasses))+if(sum(RQ_crate)is null,0,sum(RQ_crate))+if(sum(RQ_glasses) is null,0,sum(RQ_glasses))+if(sum(HD20L) is null,0,sum(HD20L))+if(sum(HD30L) is null,0,sum(HD30L))+if(sum(`Empty-CO2`)is null,0,`Empty-CO2`)+if(sum(`Pallet`) is null,0,sum(`Pallet`))
                        ,'ຍອດຮັບເຂົ້າ','$date' FROM table_empty_help"); 
            
            
            
                        mysqli_query($con,"TRUNCATE table_empty_help");
            
            /////
            
            
            
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT sum(amount_received),0,0,0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='EHQ2' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,sum(amount_received),0,0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='EHQ1' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,sum(amount_received),0,0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='EHP2' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,sum(amount_received),0,0,0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='EHP1' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,sum(amount_received),0,0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ENQ2' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,sum(amount_received),0,0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ENQ1' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,sum(amount_received),0,0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ERP2' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,sum(amount_received),0,0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ERP1' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,sum(amount_received),0,0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ERQ2' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,sum(amount_received),0,0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='ERQ1' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,sum(amount_received),0,0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='HD20L' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,sum(amount_received),0,0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='HD30L' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,0,sum(amount_received),0 FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='Empty-CO2' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            mysqli_query($con,"INSERT into table_empty_help (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet) SELECT 0,0,0,0,0,0,0,0,0,0,0,0,0,sum(amount_received) FROM tbl_emp_no left join tbl_empty_return_note on tbl_emp_no.no=tbl_empty_return_note.no where tbl_empty_return_note.Item_number='Pallet' and tbl_emp_no.Sending_date='$date' group by tbl_emp_no.Truck_Number"); 
            
            
            
            mysqli_query($con,"INSERT into table_empty (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet,total,comment,`date`) SELECT if(sum(HQ_crate) is null,0,sum(HQ_crate)),if(sum(HQ_glasses) is null,0,sum(HQ_glasses)),if(sum(HP_crate) is null,0,sum(HP_crate)),if(sum(HP_glasses) is null,0,sum(HP_glasses)),if(sum(NQ_crate) is null,0,sum(NQ_crate)),if(sum(NQ_glasses) is null,0,sum(NQ_glasses)),if(sum(RP_crate) is null,0,sum(RP_crate)),if(sum(RP_glasses) is null,0,sum(RP_glasses)),if(sum(RQ_crate) is null,0,sum(RQ_crate)),if(sum(RQ_glasses) is null,0,sum(RQ_glasses) ),if(sum(HD20L) is null,0,sum(HD20L)),if(sum(HD30L) is null,0,sum(HD30L)),if(sum(`Empty-CO2`) is null,0,sum(`Empty-CO2`)),if(sum(`Pallet`) is null,0,sum(`Pallet`)),
                        if(sum(HQ_crate) is null,0,sum(HQ_crate))+if(sum(HQ_glasses) is null,0,HQ_glasses)+if(sum(HP_crate) is null,0,sum(HP_crate))+if(sum(HP_glasses)is null,0,sum(HP_glasses))+if(sum(NQ_crate) is null ,0,sum(NQ_crate))+if(sum(NQ_glasses) is null,0,sum(NQ_glasses))+if(sum(RP_crate) is null,0,sum(RP_crate))+if(sum(RP_glasses)is null,0,sum(RP_glasses))+if(sum(RQ_crate)is null,0,sum(RQ_crate))+if(sum(RQ_glasses) is null,0,sum(RQ_glasses))+if(sum(HD20L) is null,0,sum(HD20L))+if(sum(HD30L) is null,0,sum(HD30L))+if(sum(`Empty-CO2`)is null,0,`Empty-CO2`)+if(sum(`Pallet`) is null,0,sum(`Pallet`))
            ,'ຍອດຈ່າຍອອກ','$date' FROM table_empty_help"); 
            
            


            $keep=mysqli_query($con,"SELECT * FROM table_empty WHERE `date`='$date' and comment='ຍອດຮັບເຂົ້າ'");
            $k=mysqli_fetch_array($keep);

            $payout=mysqli_query($con,"SELECT * FROM table_empty WHERE `date`='$date' and comment='ຍອດຈ່າຍອອກ'");
            $po=mysqli_fetch_array($payout);

            
            $HQ_crate=$k['HQ_crate']-$po['HQ_crate'];
            $HQ_glasses=$k['HQ_glasses']-$po['HQ_glasses'];
            $HP_crate=$k['HP_crate']-$po['HP_crate'];
            $HP_glasses=$k['HP_glasses']-$po['HP_glasses'];
            $NQ_crate=$k['NQ_crate']-$po['NQ_crate'];
            $NQ_glasses=$k['NQ_glasses']-$po['NQ_glasses'];
            $RP_crate=$k['RP_crate']-$po['RP_crate'];
            $RP_glasses=$k['RP_glasses']-$po['RP_glasses'];
            $RQ_crate=$k['RQ_crate']-$po['RQ_crate'];
            $RQ_glasses=$k['RQ_glasses']-$po['RQ_glasses'];
            $HD20L=$k['HD20L']-$po['HD20L'];
            $HD30L=$k['HD30L']-$po['HD30L'];
            $Empty_CO2=$k['Empty-CO2']-$po['Empty-CO2'];
            $Pallet=$k['Pallet']-$po['Pallet'];
            $total=$k['total']-$po['total'];


            mysqli_query($con,"INSERT into table_empty (HQ_crate,HQ_glasses,HP_crate,HP_glasses,NQ_crate,NQ_glasses,RP_crate,RP_glasses,RQ_crate,RQ_glasses,HD20L,HD30L,`Empty-CO2`,Pallet,total,`comment`,`date`) 
            VALUES('$HQ_crate','$HQ_glasses','$HP_crate','$HP_glasses','$NQ_crate','$NQ_glasses','$RP_crate','$RP_glasses','$RQ_crate','$RQ_glasses','$HD20L','$HD30L','$Empty_CO2','$Pallet','$total','ຍອດຄົງເຫຼືອ','$date')"); 



            mysqli_query($con,"TRUNCATE table_empty_help");
                       
            
            
                        $i=1;
            
                        $vg=mysqli_query($con,"SELECT * FROM table_empty WHERE `date`='$date' "); ?>
                        <table border='1'  class="table-bordered" width="100%">
                          <tr class="bgtd">
            
                            <th>No</th>
                            <th>HQ/ລັງ</th>
                            <th>HQ/ແກ້ວ</th>
                            <th>HP/ລັງ</th>
                            <th>HP/ແກ້ວ</th>
                            <th>NQ/ລັງ</th>
                            <th>NQ/ແກ້ວ</th>
                            <th>RP/ລັງ</th>
                            <th>RP/ແກ້ວ</th>
                            <th>RQ/ລັງ</th>
                            <th>RQ/ແກ້ວ</th>
                            <th>HD20L/ຖັງ</th>
                            <th>HD30L/ຖັງ</th>
                            <th>Empty-CO2</th>
                            <th>Pallet</th>
                            <th>ລວມ</th>
                            <th width="100px">&nbsp;</th>
                          </tr>
                          <?PHP
                             while($p=mysqli_fetch_array($vg)){
                                ?>
                            <tr>
                
                              <td><?php echo $i;?></td>
                
                            <td><?php echo $p['HQ_crate'];?></td>
                            <td><?php echo $p['HQ_glasses'];?></td>
                            <td><?php echo $p['HP_crate'];?></td>
                            <td><?php echo $p['HP_glasses'];?></td>
                            <td><?php echo $p['NQ_crate'];?></td>
                            <td><?php echo $p['NQ_glasses'];?></td>
                            <td><?php echo $p['RP_crate'];?></td>
                            <td><?php echo $p['RP_glasses'];?></td>
                            <td><?php echo $p['RQ_crate'];?></td>
                            <td><?php echo $p['RQ_glasses'];?></td>
                            <td><?php echo $p['HD20L'];?></td>
                            <td><?php echo $p['HD30L'];?></td>
                            <td><?php echo $p['Empty-CO2'];?></td>
                            <td><?php echo $p['Pallet'];?></td>
                            <td><?php echo $p['total'];?></td>
                            <td><?php echo $p['comment'];?></td>
            
                            
                          <?PHP
                        $i++;
                        
                        } ?>
            
                        </table>