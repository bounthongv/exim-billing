<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
set_time_limit(0);
ini_set('memory_limit', '256M');

setlocale(LC_ALL, 'th_TH.UTF-8');

// ==========================================
// 🛠️ ZONE 1: ระบบดักจับปัญหา
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST) && empty($_FILES)) {
        die("<div style='color:red; font-size:20px; padding:20px;'>❌ <b>เซิร์ฟเวอร์สลัดข้อมูลทิ้ง:</b> ไฟล์ใหญ่เกินเกณฑ์กำหนดของ post_max_size</div>");
    }
    if (!isset($_POST['import']) || !isset($_FILES['excel_file'])) {
        die("<div style='color:orange; font-size:20px; padding:20px;'>⚠️ <b>ตั้งชื่อ Form ไม่ตรง:</b> กรุณาเช็กชื่อปุ่มหรืออินพุตไฟล์ในหน้า HTML</div>");
    }
}

// ==========================================
// ⚙️ ZONE 2: โหลดไฟล์เชื่อมต่อ และฟังก์ชันคำนวณ
// ==========================================
include("init.php");

if (!isset($con) || !$con) {
    die("❌ <b>ข้อผิดพลาด:</b> ไม่พบตัวแปรเชื่อมต่อฐานข้อมูล \$con");
}

function excelColumnToIndex($column) {
    $column = strtoupper(trim($column));
    $length = strlen($column);
    $index = 0;
    for ($i = 0; $i < $length; $i++) {
        $index = $index * 26 + (ord($column[$i]) - ord('A') + 1);
    }
    return $index - 1;
}

// ==========================================
// 🚀 ZONE 3: เริ่มกระบวนการ Sync เข้าตารางพัก (sale_import)
// ==========================================
if (isset($_POST['import'])) {

    $fileTmpPath = $_FILES['excel_file']['tmp_name'];
    $fileName    = $_FILES['excel_file']['name'];

    // ✅ ກວດສອບຄວາມຜິດພາດຂອງການອັບໂຫລດໄຟລ໌
    if ($_FILES['excel_file']['error'] !== UPLOAD_ERR_OK || empty($fileTmpPath)) {
        switch ($_FILES['excel_file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $errMsg = 'ຂະໜາດໄຟລ໌ໃຫຍ່ເກີນກຳນົດຂອງ upload_max_filesize ໃນ php.ini';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $errMsg = 'ຂະໜາດໄຟລ໌ໃຫຍ່ເກີນກຳນົດຂອງຟອມ (MAX_FILE_SIZE)';
                break;
            case UPLOAD_ERR_PARTIAL:
                $errMsg = 'ໄຟລ໌ຖືກອັບໂຫລດບໍ່ຄົບຖ້ວນ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ';
                break;
            case UPLOAD_ERR_NO_FILE:
                $errMsg = 'ກະລຸນາເລືອກໄຟລ໌ກ່ອນກົດອັບໂຫລດ';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $errMsg = 'ບໍ່ພົບໂຟນເດີຊົ່ວຄາວ (tmp) ຢູ່ເຊີບເວີ';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $errMsg = 'ບໍ່ສາມາດຂຽນໄຟລ໌ລົງດິສກ໌ໄດ້';
                break;
            default:
                $errMsg = 'ເກີດຄວາມຜິດພາດທີ່ບໍ່ຮູ້ສາເຫດ (code: ' . $_FILES['excel_file']['error'] . ')';
                break;
        }
        die("<div style='color:red; font-size:20px; padding:20px;'>❌ <b>ອັບໂຫລດໄຟລ໌ລົ້ມເຫລວ:</b> {$errMsg}</div>");
    }

    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($fileExtension !== 'csv') {
        echo "<script>alert('กรุณาอัปโหลดเฉพาะไฟล์ .csv เท่านั้น');window.history.back();</script>";
        exit;
    }

    try {
        if (($handle = fopen($fileTmpPath, "r")) !== FALSE) {

            // ตรวจจับเครื่องหมายคั่นข้อมูลอัตโนมัติ
            $firstLine = fgets($handle);
            $separator = (substr_count($firstLine, ';') > substr_count($firstLine, ',')) ? ';' : ',';
            rewind($handle);

            // -----------------------------------------------------------------
            // 🔄 ขั้นตอนที่ 1: อ่านทุกแถว, กรองเฉพาะ delivered, เก็บเป็น array ในหน่วยความจำ
            //     (อ่านไฟล์รอบเดียว แทนที่จะอ่าน 2 รอบเหมือนเดิม)
            // -----------------------------------------------------------------
            $colA  = excelColumnToIndex('A');
            $colC  = excelColumnToIndex('C');
            $colI  = excelColumnToIndex('I');
            $colM  = excelColumnToIndex('M');
            $colAK = excelColumnToIndex('AK');
            $colAL = excelColumnToIndex('AL');
            $colBL = excelColumnToIndex('BL');
            $colBN = excelColumnToIndex('BN');
            $colBO = excelColumnToIndex('BO');
            $colBP = excelColumnToIndex('BP');
            $colBU = excelColumnToIndex('BU');
            $colU  = excelColumnToIndex('U');

            $dates_in_csv    = [];
            $csv_record_keys = [];
            $rows_to_insert  = [];
            $rowIndex        = 0;
            $skippedCount    = 0;

            while (($data = fgetcsv($handle, 0, $separator)) !== FALSE) {
                $rowIndex++;
                if ($rowIndex == 1) continue; // ข้ามหัวตาราง

                $Extended_Status = isset($data[$colU]) ? trim((string)$data[$colU]) : '';

                if (strtolower($Extended_Status) !== 'delivered') {
                    $skippedCount++;
                    continue;
                }

                $Item_ID            = isset($data[$colA])  ? trim((string)$data[$colA])  : '';
                $Display_ID         = isset($data[$colC])  ? trim((string)$data[$colC])  : '';
                $Invoiced_Date      = isset($data[$colI])  ? trim((string)$data[$colI])  : '';
                $Invoice_Number     = isset($data[$colM])  ? trim((string)$data[$colM])  : '';
                $Outlet_Name        = isset($data[$colAK]) ? trim((string)$data[$colAK]) : '';
                $Outlet_External_ID = isset($data[$colAL]) ? trim((string)$data[$colAL]) : '';
                $Product_SKU        = isset($data[$colBL]) ? trim((string)$data[$colBL]) : '';
                $Product_Name       = isset($data[$colBN]) ? trim((string)$data[$colBN]) : '';
                $Quantity           = isset($data[$colBO]) ? trim((string)$data[$colBO]) : '';
                $Price              = isset($data[$colBP]) ? trim((string)$data[$colBP]) : '';
                $Total              = isset($data[$colBU]) ? trim((string)$data[$colBU]) : '';

                if ($Invoice_Number === '' || $Item_ID === '' || $Invoiced_Date === '') {
                    continue;
                }

                $dates_in_csv[$Invoiced_Date] = true;
                $csv_record_keys[$Item_ID . '_' . $Invoiced_Date] = true;

                $rows_to_insert[] = [
                    $Item_ID, $Display_ID, $Invoiced_Date, $Invoice_Number,
                    $Outlet_External_ID, $Outlet_Name, $Extended_Status,
                    $Product_SKU, $Product_Name, $Quantity, $Price, $Total
                ];
            }
            fclose($handle);

            // 🔍 DEBUG: ดูว่าอ่านไฟล์ได้กี่แถว กรองผ่านกี่แถว
            echo "<div style='background:#eef; padding:10px; margin:5px; font-family:monospace;'>";
            echo "DEBUG: separator ที่ตรวจพบ = [" . htmlspecialchars($separator) . "]<br>";
            echo "DEBUG: อ่านทั้งหมด " . ($rowIndex - 1) . " แถว (ไม่รวม header)<br>";
            echo "DEBUG: ข้าม (ไม่ใช่ delivered) = $skippedCount แถว<br>";
            echo "DEBUG: ผ่านเงื่อนไข delivered และมีค่าครบ (Item_ID/Invoiced_Date/Invoice_Number) = " . count($rows_to_insert) . " แถว<br>";
            if (count($rows_to_insert) > 0) {
                echo "DEBUG: ตัวอย่างแถวแรกที่จะบันทึก: <pre>" . htmlspecialchars(print_r($rows_to_insert[0], true)) . "</pre>";
            }
            echo "</div>";

            // -----------------------------------------------------------------
            // 🔄 ขั้นตอนที่ 2: หาว่าแถวไหน "มีอยู่แล้ว" (update) แถวไหน "ใหม่" (insert)
            //     โดยดึงข้อมูลที่มีอยู่แล้วมาครั้งเดียว (ไม่ query ทีละแถวเหมือนเดิม)
            //     ไม่ต้องแก้โครงสร้างตาราง / ไม่ต้องมี UNIQUE KEY
            // -----------------------------------------------------------------
            $existing_keys = [];
            if (!empty($dates_in_csv)) {
                $date_escaped = [];
                foreach (array_keys($dates_in_csv) as $d) {
                    $date_escaped[] = "'" . mysqli_real_escape_string($con, $d) . "'";
                }
                $date_range_str = implode(',', $date_escaped);

                $res_existing = mysqli_query($con, "SELECT Item_ID, Invoiced_Date FROM sale_import WHERE Invoiced_Date IN ($date_range_str)");
                if ($res_existing) {
                    while ($r = mysqli_fetch_assoc($res_existing)) {
                        $existing_keys[$r['Item_ID'] . '_' . $r['Invoiced_Date']] = true;
                    }
                }
            }

            $rows_for_insert = [];
            $rows_for_update  = [];
            foreach ($rows_to_insert as $row) {
                // row = [Item_ID, Display_ID, Invoiced_Date, Invoice_Number, Outlet_External_ID,
                //        Outlet_Name, Extended_Status, Product_SKU, Product_Name, Quantity, Price, Total]
                $key = $row[0] . '_' . $row[2];
                if (isset($existing_keys[$key])) {
                    $rows_for_update[] = $row;
                } else {
                    $rows_for_insert[] = $row;
                }
            }

            $insert_count = 0;
            $update_count = 0;

            mysqli_begin_transaction($con);

            // ---- Batch INSERT สำหรับแถวใหม่ (multi-row insert ทีละ 500 แถว) ----
            if (!empty($rows_for_insert)) {
                $sql_insert_base = "INSERT INTO sale_import (
                                Item_ID, Display_ID, Invoiced_Date, Invoice_Number,
                                Outlet_External_ID, Outlet_Name, Extended_Status,
                                Product_SKU, Product_Name, Quantity, Price, Total
                            ) VALUES ";

                $chunks = array_chunk($rows_for_insert, 500);

                foreach ($chunks as $chunk) {
                    $placeholders = [];
                    $values_flat  = [];

                    foreach ($chunk as $row) {
                        $placeholders[] = "(" . implode(',', array_fill(0, 12, '?')) . ")";
                        foreach ($row as $v) {
                            $values_flat[] = $v;
                        }
                    }

                    $sql = $sql_insert_base . implode(',', $placeholders);
                    $stmt = mysqli_prepare($con, $sql);

                    if (!$stmt) {
                        mysqli_rollback($con);
                        die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL (batch insert): " . mysqli_error($con));
                    }

                    $types = str_repeat('s', count($values_flat));
                    $bind_names = [$types];
                    foreach ($values_flat as $i => $v) {
                        $bind_name = 'bind' . $i;
                        $$bind_name = $v;
                        $bind_names[] = &$$bind_name;
                    }
                    call_user_func_array('mysqli_stmt_bind_param', array_merge([$stmt], $bind_names));
                    unset($bind_names);

                    if (!mysqli_stmt_execute($stmt)) {
                        mysqli_rollback($con);
                        die("เกิดข้อผิดพลาดขณะบันทึกข้อมูลใหม่: " . mysqli_stmt_error($stmt));
                    }

                    $insert_count += mysqli_stmt_affected_rows($stmt);
                    mysqli_stmt_close($stmt);
                }
            }

            // ---- UPDATE สำหรับแถวที่มีอยู่แล้ว (ใช้ prepared statement วนใน transaction เดียว) ----
            if (!empty($rows_for_update)) {
                $sql_update = "UPDATE sale_import SET
                                Display_ID = ?,  Invoice_Number = ?,
                                Outlet_External_ID = ?, Outlet_Name = ?, Extended_Status = ?,
                                Product_SKU = ?, Product_Name = ?, Quantity = ?, Price = ?, Total = ?
                            WHERE Item_ID = ? AND Invoiced_Date = ?";
                $stmt_update = mysqli_prepare($con, $sql_update);

                if (!$stmt_update) {
                    mysqli_rollback($con);
                    die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL (update): " . mysqli_error($con));
                }

                foreach ($rows_for_update as $row) {
                    // row = [Item_ID, Display_ID, Invoiced_Date, Invoice_Number, Outlet_External_ID,
                    //        Outlet_Name, Extended_Status, Product_SKU, Product_Name, Quantity, Price, Total]
                    $Item_ID            = $row[0];
                    $Display_ID         = $row[1];
                    $Invoiced_Date      = $row[2];
                    $Invoice_Number     = $row[3];
                    $Outlet_External_ID = $row[4];
                    $Outlet_Name        = $row[5];
                    $Extended_Status    = $row[6];
                    $Product_SKU        = $row[7];
                    $Product_Name       = $row[8];
                    $Quantity           = $row[9];
                    $Price              = $row[10];
                    $Total              = $row[11];

                    mysqli_stmt_bind_param($stmt_update, "ssssssssssss",
                        $Display_ID, $Invoice_Number,
                        $Outlet_External_ID, $Outlet_Name, $Extended_Status,
                        $Product_SKU, $Product_Name, $Quantity, $Price, $Total,
                        $Item_ID, $Invoiced_Date
                    );
                    mysqli_stmt_execute($stmt_update);
                    $update_count++;
                }
                mysqli_stmt_close($stmt_update);
            }

            mysqli_commit($con);

            // 🔍 DEBUG: ดูผลลัพธ์การ insert/update เข้า sale_import
            echo "<div style='background:#efe; padding:10px; margin:5px; font-family:monospace;'>";
            echo "DEBUG: existing_keys ที่พบในตารางอยู่แล้ว = " . count($existing_keys) . " รายการ<br>";
            echo "DEBUG: แถวที่จะ INSERT ใหม่ = " . count($rows_for_insert) . " แถว, insert_count จริง = $insert_count<br>";
            echo "DEBUG: แถวที่จะ UPDATE = " . count($rows_for_update) . " แถว, update_count จริง = $update_count<br>";
            echo "DEBUG: mysqli_error ล่าสุด = " . mysqli_error($con) . "<br>";
            $check_count = mysqli_query($con, "SELECT COUNT(*) AS c FROM sale_import");
            if ($check_count) {
                $row_check = mysqli_fetch_assoc($check_count);
                echo "DEBUG: จำนวนแถวในตาราง sale_import ตอนนี้ = " . $row_check['c'] . "<br>";
            }
            echo "</div>";

            // -----------------------------------------------------------------
            // 🔄 ขั้นตอนที่ 3: ลบข้อมูลเก่าที่ไม่อยู่ใน CSV รอบนี้ (เฉพาะวันที่ที่เกี่ยวข้อง)
            //     ทำเป็น query เดียว แทนการ loop fetch + delete ทีละแถว
            // -----------------------------------------------------------------
            $delete_count = 0;
            if (!empty($dates_in_csv) && !empty($csv_record_keys)) {
                $date_escaped = [];
                foreach (array_keys($dates_in_csv) as $d) {
                    $date_escaped[] = "'" . mysqli_real_escape_string($con, $d) . "'";
                }
                $date_range_str = implode(',', $date_escaped);

                $key_escaped = [];
                foreach (array_keys($csv_record_keys) as $k) {
                    $key_escaped[] = "'" . mysqli_real_escape_string($con, $k) . "'";
                }
                $key_range_str = implode(',', $key_escaped);

                $delete_sql = "DELETE FROM sale_import
                                WHERE Invoiced_Date IN ($date_range_str)
                                AND CONCAT(Item_ID, '_', Invoiced_Date) NOT IN ($key_range_str)";

                if (mysqli_query($con, $delete_sql)) {
                    $delete_count = mysqli_affected_rows($con);
                }
            }

            // -----------------------------------------------------------------
            // 🎯 ขั้นตอนที่ 4: ย้ายข้อมูลจากตารางพัก (sale_import) ไปตารางจริง (product_sale)
            // 🛠️ ตรรกะใหม่: เลือกเฉพาะข้อมูลที่ไม่มีในตารางจริงเท่านั้น (ไม่ให้ซ้ำ ไม่ลบ ไม่แก้อันเดิม)
            // -----------------------------------------------------------------
            $sql_sync_to_product_sale = "
                INSERT INTO product_sale (customer_id, product_id, price, qty, Total, sale_date, sale_time, order_id, sale_id, remain)
                SELECT
                    si.Outlet_External_ID,
                    si.Product_SKU,
                    si.Price,
                    si.Quantity,
                    si.total,
                    DATE_FORMAT(STR_TO_DATE(si.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d'),
                    DATE_FORMAT(STR_TO_DATE(si.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%H:%i:%s'),
                    si.Display_ID,
                    si.Invoice_Number,
                    sale_import_2.remain
                FROM sale_import si

                -- ส่วนคำนวณเชื่อมยอดรวมคงเหลือ (remain) ราย Invoice
                LEFT JOIN (
                    SELECT Invoice_Number, SUM(Quantity * Price) AS remain
                    FROM sale_import
                    GROUP BY Invoice_Number
                ) AS sale_import_2 ON sale_import_2.Invoice_Number = si.Invoice_Number

                -- ตรวจสอบกับตารางจริง เพื่อดูว่ามี Invoice และ Product ชิ้นนี้อยู่หรือยัง
                LEFT JOIN product_sale ps ON ps.sale_id = si.Invoice_Number AND ps.product_id = si.Product_SKU

                -- กรองเอาเฉพาะข้อมูลแถวใหม่เอี่ยม (ตัวที่ยังไม่มีในตารางจริง ค่าจะเป็น NULL)
                WHERE ps.sale_id IS NULL
            ";

            $sync_ok = mysqli_query($con, $sql_sync_to_product_sale);

            // 🔍 DEBUG: ดูผลลัพธ์การ sync เข้า product_sale
            echo "<div style='background:#ffe; padding:10px; margin:5px; font-family:monospace;'>";
            echo "DEBUG: sync ไป product_sale " . ($sync_ok ? "สำเร็จ" : "ล้มเหลว") . "<br>";
            if (!$sync_ok) {
                echo "DEBUG: mysqli_error = " . mysqli_error($con) . "<br>";
            } else {
                echo "DEBUG: แถวที่ถูก insert เข้า product_sale = " . mysqli_affected_rows($con) . "<br>";
            }
            echo "</div>";

            // ⚠️ ชั่วคราว: คอมเมนต์ redirect ออกก่อน เพื่อให้เห็น DEBUG ด้านบนก่อน (ลบ /* */ ออกเมื่อแก้เสร็จแล้ว)
            /*
            echo "<script>
                    alert('ดำเนินการซิงค์ข้อมูลเสร็จสิ้น!\\n- เพิ่มเฉพาะข้อมูลใหม่เข้าสู่ระบบเรียบร้อยแล้ว (ไม่แตะต้องข้อมูลเดิม)');
                    window.location='sale_list.php';
                  </script>";
            */

        } else {
            echo "ไม่สามารถเปิดไฟล์ CSV ได้";
        }

    } catch (Exception $e) {
        echo "เกิดข้อผิดพลาดในระบบ: " . $e->getMessage();
    }
}


// ⚠️ ชั่วคราว: ปิด TRUNCATE ไว้ก่อนเพื่อให้เข้าไปเช็คข้อมูลใน sale_import ผ่าน phpMyAdmin ได้
// mysqli_query($con, "TRUNCATE sale_import");

mysqli_close($con);
?>