<?php

//action.php

include("init.php");

if (isset($_POST["action"])) {
    if ($_POST["action"] == 'select_item') {
        
/*
	if(isset($_SESSION["cart_payment_edit"]))
		{   		
		unset($_SESSION["cart_payment_edit"]);
		}
*/


        // 1. ดึงรายการ sale_id ที่มีอยู่เดิมใน Session ออกมาเช็กซ้ำ
        $existing_sale_ids = array();
        if (isset($_SESSION["cart_payment_edit"]) && is_array($_SESSION["cart_payment_edit"])) {
            $existing_sale_ids = array_column($_SESSION["cart_payment_edit"], 'sale_id');
        }

        // 2. ตั้งค่า e_list ให้นับต่อจากจำนวนเดิมที่มีอยู่ (ถ้านอกลูปให้กำหนดครั้งเดียว)
        $e_list = !empty($_SESSION["cart_payment_edit"]) ? count($_SESSION["cart_payment_edit"]) : 0;

        // 3. จัดการข้อมูลธนาคาร (ย้ายมาใส่ใน isset ให้ปลอดภัย)
        if (isset($_POST['Bank_info_2'])) {
            $Bank_info_2 = mysqli_real_escape_string($con, $_POST['Bank_info_2']);
            $bank_data   = explode('|', $_POST['Bank_info_2']);
            
            $_SESSION['Bank_account'] = $Bank_account = isset($bank_data[0]) ? $bank_data[0] : '';
            $_SESSION['Bank_Name']    = $Bank_name    = isset($bank_data[1]) ? $bank_data[1] : '';
        }

        // 4. วนลูปบันทึกรายการ
        if (isset($_POST['item_list']) && is_array($_POST['item_list'])) {
            
            for ($i = 0; $i < count($_POST['item_list']); $i++) {
                $sale_id = mysqli_real_escape_string($con, $_POST['item_list'][$i]);

                // ** จุดที่แก้ไข: เช็กว่า sale_id นี้ยังไม่มีใน Session ใช่หรือไม่ **
                if (!in_array($sale_id, $existing_sale_ids)) {

                    $sql_d = mysqli_query($con, "SELECT customer_payment.* ,customers.customer_name,
                        customers.TIN,
                        tb_bank.Bank_Name
                        from customer_payment
                        left join customers on customer_payment.customer_id=customers.customer_id
                        left join tb_bank on customer_payment.Bank_account=tb_bank.Bank_account
                        where 1=1 and customer_payment.payment_type='1' and customer_payment.sale_id='$sale_id' order by payment_date asc");      
                    
                    $f = mysqli_fetch_array($sql_d);

                    if ($f) {
                        $e_list++;
                        $item_array = array(
                            'list_id'   => $e_list,
                            'sale_id'   => $f["sale_id"],  
                            'sale_date' => $f["sale_date"],  
                            'amount'    => $f["amount"]
                        );
                        
                        $_SESSION["cart_payment_edit"][] = $item_array;

                        // บันทึก sale_id เพิ่มเติม เพื่อป้องกันการเลือกซ้ำภายใน POST เดียวกัน
                        $existing_sale_ids[] = $sale_id;
                    }
                }
            }
            header("location:edit_payment.php");
            exit;
        } else {
            header("location:edit_payment.php");
            exit;
        }
    }

    if ($_POST["action"] == 'update_x1') {
        if (isset($_SESSION["cart_payment_edit"]) && is_array($_SESSION["cart_payment_edit"])) {
            foreach ($_SESSION["cart_payment_edit"] as $keys => $values) {
                if ($values["list_id"] == $_POST["Product_ID"]) {
                    $total = mysqli_real_escape_string($con, $_POST['total']);
                    $total = filter_var($total, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    
                    $_SESSION["cart_payment_edit"][$keys]['total'] = $total;
                }
            }
        }
    }

    if ($_POST["action"] == 'remove') {
        if (isset($_SESSION["cart_payment_edit"]) && is_array($_SESSION["cart_payment_edit"])) {
            foreach ($_SESSION["cart_payment_edit"] as $keys => $values) {
                if ($values["sale_id"] == $_POST["Product_ID"]) {
                    unset($_SESSION["cart_payment_edit"][$keys]);
                }
            }
            // Re-index array เพื่อป้องกัน index โหว่
            $_SESSION["cart_payment_edit"] = array_values($_SESSION["cart_payment_edit"]);
        }
    }
    
    if ($_POST["action"] == 'empty') {
        unset($_SESSION["cart_payment_edit"]);
    }
}

if (@$_GET["action"] == 'empty') {
    unset($_SESSION["cart_payment_edit"]);
    header("location:edit_payment.php");
    exit;
}

if (isset($_GET["action"]) && $_GET["action"] == 'close_and_clear') {
    unset($_SESSION["cart_payment_edit"]);
    unset($_SESSION["customer_id"]);
    unset($_SESSION["customer_name"]);
    unset($_SESSION["Bank_account"]);
    unset($_SESSION["Bank_Name"]);
    
    header("location:payment_list.php");
    exit;
}

?>